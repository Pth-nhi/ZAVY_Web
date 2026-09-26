<?php

require_once __DIR__ . '/Database.php';

class KhachHang
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }


    // =========================================================
    // TÌM KHÁCH HÀNG THEO EMAIL
    // =========================================================

    public function timTheoEmail(string $email): ?array
    {
        $sql = "
            SELECT *
            FROM KhachHang
            WHERE email = :email
            LIMIT 1
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':email' => $email
        ]);

        $khachHang = $stmt->fetch();

        return $khachHang ?: null;
    }


    // =========================================================
    // TÌM KHÁCH HÀNG THEO ID
    // =========================================================

    public function timTheoId(int $id): ?array
    {
        $sql = "
            SELECT
                id,
                ho_ten,
                email,
                so_dien_thoai,
                dia_chi,
                ngay_tao
            FROM KhachHang
            WHERE id = :id
            LIMIT 1
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        $khachHang = $stmt->fetch();

        return $khachHang ?: null;
    }


    // =========================================================
    // ĐĂNG KÝ KHÁCH HÀNG MỚI
    // =========================================================

    public function dangKy(
        string $hoTen,
        string $email,
        string $matKhau,
        string $soDienThoai,
        string $diaChi
    ): bool {

        // Mã hóa mật khẩu trước khi lưu Database
        $matKhauMaHoa = password_hash(
            $matKhau,
            PASSWORD_DEFAULT
        );

        $sql = "
            INSERT INTO KhachHang
            (
                ho_ten,
                email,
                mat_khau,
                so_dien_thoai,
                dia_chi
            )
            VALUES
            (
                :ho_ten,
                :email,
                :mat_khau,
                :so_dien_thoai,
                :dia_chi
            )
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':ho_ten' => $hoTen,
            ':email' => $email,
            ':mat_khau' => $matKhauMaHoa,
            ':so_dien_thoai' => $soDienThoai,
            ':dia_chi' => $diaChi
        ]);
    }


    // =========================================================
    // ĐĂNG NHẬP
    // =========================================================

    public function dangNhap(
        string $email,
        string $matKhau
    ): ?array {

        $khachHang = $this->timTheoEmail($email);

        if ($khachHang === null) {
            return null;
        }

        // Kiểm tra mật khẩu đã mã hóa
        if (
            !password_verify(
                $matKhau,
                $khachHang['mat_khau']
            )
        ) {
            return null;
        }

        return $khachHang;
    }


    // =========================================================
    // CẬP NHẬT THÔNG TIN CÁ NHÂN
    // =========================================================

    public function capNhatThongTin(
        int $id,
        string $hoTen,
        string $email,
        string $soDienThoai,
        string $diaChi
    ): bool {

        $sql = "
            UPDATE KhachHang
            SET
                ho_ten = :ho_ten,
                email = :email,
                so_dien_thoai = :so_dien_thoai,
                dia_chi = :dia_chi
            WHERE id = :id
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':ho_ten' => $hoTen,
            ':email' => $email,
            ':so_dien_thoai' => $soDienThoai,
            ':dia_chi' => $diaChi,
            ':id' => $id
        ]);
    }


    // =========================================================
    // XÓA TÀI KHOẢN KHÁCH HÀNG
    // Dùng cho khách hàng tự xóa tài khoản
    // =========================================================

    public function xoaTaiKhoan(int $id): bool
    {
        try {

            // Bắt đầu transaction
            $this->db->beginTransaction();


            // -------------------------------------------------
            // 1. Xóa đánh giá của khách hàng
            // -------------------------------------------------

            $stmt = $this->db->prepare("
                DELETE FROM DanhGia
                WHERE khach_hang_id = :id
            ");

            $stmt->execute([
                ':id' => $id
            ]);


            // -------------------------------------------------
            // 2. Lấy giỏ hàng của khách hàng
            // -------------------------------------------------

            $stmt = $this->db->prepare("
                SELECT id
                FROM GioHang
                WHERE khach_hang_id = :id
            ");

            $stmt->execute([
                ':id' => $id
            ]);

            $gioHangs = $stmt->fetchAll();


            // -------------------------------------------------
            // 3. Xóa chi tiết giỏ hàng
            // -------------------------------------------------

            foreach ($gioHangs as $gioHang) {

                $stmt = $this->db->prepare("
                    DELETE FROM ChiTietGioHang
                    WHERE gio_hang_id = :gio_hang_id
                ");

                $stmt->execute([
                    ':gio_hang_id' => $gioHang['id']
                ]);
            }


            // -------------------------------------------------
            // 4. Xóa giỏ hàng
            // -------------------------------------------------

            $stmt = $this->db->prepare("
                DELETE FROM GioHang
                WHERE khach_hang_id = :id
            ");

            $stmt->execute([
                ':id' => $id
            ]);


            // -------------------------------------------------
            // 5. Lấy danh sách đơn hàng
            // -------------------------------------------------

            $stmt = $this->db->prepare("
                SELECT id
                FROM DonHang
                WHERE khach_hang_id = :id
            ");

            $stmt->execute([
                ':id' => $id
            ]);

            $donHangs = $stmt->fetchAll();


            // -------------------------------------------------
            // 6. Xóa chi tiết đơn hàng
            // -------------------------------------------------

            foreach ($donHangs as $donHang) {

                $donHangId = (int) $donHang['id'];

                $stmt = $this->db->prepare("
                    DELETE FROM ChiTietDonHang
                    WHERE don_hang_id = :don_hang_id
                ");

                $stmt->execute([
                    ':don_hang_id' => $donHangId
                ]);
            }


            // -------------------------------------------------
            // 7. Xóa hóa đơn
            // -------------------------------------------------

            foreach ($donHangs as $donHang) {

                $donHangId = (int) $donHang['id'];

                $stmt = $this->db->prepare("
                    DELETE FROM HoaDon
                    WHERE don_hang_id = :don_hang_id
                ");

                $stmt->execute([
                    ':don_hang_id' => $donHangId
                ]);
            }


            // -------------------------------------------------
            // 8. Xóa đơn hàng
            // -------------------------------------------------

            $stmt = $this->db->prepare("
                DELETE FROM DonHang
                WHERE khach_hang_id = :id
            ");

            $stmt->execute([
                ':id' => $id
            ]);


            // -------------------------------------------------
            // 9. Cuối cùng xóa tài khoản khách hàng
            // -------------------------------------------------

            $stmt = $this->db->prepare("
                DELETE FROM KhachHang
                WHERE id = :id
            ");

            $stmt->execute([
                ':id' => $id
            ]);


            // Hoàn tất transaction
            $this->db->commit();

            return true;

        } catch (PDOException $e) {

            // Nếu xảy ra lỗi thì hoàn tác toàn bộ
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }

            return false;
        }
    }


    // =========================================================
    // LẤY DANH SÁCH TẤT CẢ KHÁCH HÀNG
    // Dùng cho Admin quản lý khách hàng
    // =========================================================

    public function layTatCa(): array
    {
        $sql = "
            SELECT
                id,
                ho_ten,
                email,
                so_dien_thoai,
                dia_chi,
                ngay_tao
            FROM KhachHang
            ORDER BY id DESC
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll();
    }


    // =========================================================
    // XÓA KHÁCH HÀNG
    // Dùng cho Admin
    // =========================================================

    public function xoaKhachHangAdmin(int $id): bool
    {
        try {

            // Bắt đầu transaction
            $this->db->beginTransaction();


            // -------------------------------------------------
            // 1. Xóa đánh giá của khách hàng
            // -------------------------------------------------

            $stmt = $this->db->prepare("
                DELETE FROM DanhGia
                WHERE khach_hang_id = :id
            ");

            $stmt->execute([
                ':id' => $id
            ]);


            // -------------------------------------------------
            // 2. Lấy giỏ hàng của khách hàng
            // -------------------------------------------------

            $stmt = $this->db->prepare("
                SELECT id
                FROM GioHang
                WHERE khach_hang_id = :id
            ");

            $stmt->execute([
                ':id' => $id
            ]);

            $gioHangs = $stmt->fetchAll();


            // -------------------------------------------------
            // 3. Xóa chi tiết giỏ hàng
            // -------------------------------------------------

            foreach ($gioHangs as $gioHang) {

                $stmt = $this->db->prepare("
                    DELETE FROM ChiTietGioHang
                    WHERE gio_hang_id = :gio_hang_id
                ");

                $stmt->execute([
                    ':gio_hang_id' => $gioHang['id']
                ]);
            }


            // -------------------------------------------------
            // 4. Xóa giỏ hàng
            // -------------------------------------------------

            $stmt = $this->db->prepare("
                DELETE FROM GioHang
                WHERE khach_hang_id = :id
            ");

            $stmt->execute([
                ':id' => $id
            ]);


            // -------------------------------------------------
            // 5. Lấy danh sách đơn hàng
            // -------------------------------------------------

            $stmt = $this->db->prepare("
                SELECT id
                FROM DonHang
                WHERE khach_hang_id = :id
            ");

            $stmt->execute([
                ':id' => $id
            ]);

            $donHangs = $stmt->fetchAll();


            // -------------------------------------------------
            // 6. Xóa chi tiết đơn hàng
            // -------------------------------------------------

            foreach ($donHangs as $donHang) {

                $donHangId = (int) $donHang['id'];

                $stmt = $this->db->prepare("
                    DELETE FROM ChiTietDonHang
                    WHERE don_hang_id = :don_hang_id
                ");

                $stmt->execute([
                    ':don_hang_id' => $donHangId
                ]);
            }


            // -------------------------------------------------
            // 7. Xóa hóa đơn
            // -------------------------------------------------

            foreach ($donHangs as $donHang) {

                $donHangId = (int) $donHang['id'];

                $stmt = $this->db->prepare("
                    DELETE FROM HoaDon
                    WHERE don_hang_id = :don_hang_id
                ");

                $stmt->execute([
                    ':don_hang_id' => $donHangId
                ]);
            }


            // -------------------------------------------------
            // 8. Xóa đơn hàng
            // -------------------------------------------------

            $stmt = $this->db->prepare("
                DELETE FROM DonHang
                WHERE khach_hang_id = :id
            ");

            $stmt->execute([
                ':id' => $id
            ]);


            // -------------------------------------------------
            // 9. Cuối cùng xóa khách hàng
            // -------------------------------------------------

            $stmt = $this->db->prepare("
                DELETE FROM KhachHang
                WHERE id = :id
            ");

            $stmt->execute([
                ':id' => $id
            ]);


            // Hoàn tất transaction
            $this->db->commit();

            return true;

        } catch (PDOException $e) {

            // Nếu có lỗi thì hoàn tác toàn bộ
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }

            return false;
        }
    }
}