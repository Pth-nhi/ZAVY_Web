<?php

require_once __DIR__ . '/Database.php';

class SanPham
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    // Lấy tất cả sản phẩm
    public function layTatCa(): array
    {
        $sql = "
            SELECT
                SanPham.*,
                DanhMuc.ten_danh_muc
            FROM SanPham
            INNER JOIN DanhMuc
                ON SanPham.danh_muc_id = DanhMuc.id
            ORDER BY SanPham.id DESC
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    // Lấy đúng 8 sản phẩm được chọn để hiển thị ở trang Sản phẩm
    public function lay8SanPhamTrangChu(): array
    {
        $sql = "
            SELECT
                SanPham.*,
                DanhMuc.ten_danh_muc
            FROM SanPham
            INNER JOIN DanhMuc
                ON SanPham.danh_muc_id = DanhMuc.id
            WHERE SanPham.id IN (
                1, 24, 16, 33, 46, 58, 66, 77
            )
            ORDER BY FIELD(
                SanPham.id,
                1, 24, 16, 33, 46, 58, 66, 77
            )
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    // Lấy 6 sản phẩm mới nhất
    public function lay6SanPham(): array
    {
        $sql = "
            SELECT
                SanPham.*,
                DanhMuc.ten_danh_muc
            FROM SanPham
            INNER JOIN DanhMuc
                ON SanPham.danh_muc_id = DanhMuc.id
            ORDER BY SanPham.id DESC
            LIMIT 6
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    // Lấy sản phẩm theo danh mục
    public function layTheoDanhMuc(int $danhMucId): array
    {
        $sql = "
            SELECT
                SanPham.*,
                DanhMuc.ten_danh_muc
            FROM SanPham
            INNER JOIN DanhMuc
                ON SanPham.danh_muc_id = DanhMuc.id
            WHERE SanPham.danh_muc_id = :danh_muc_id
            ORDER BY SanPham.id DESC
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':danh_muc_id' => $danhMucId
        ]);

        return $stmt->fetchAll();
    }

    // Tìm sản phẩm theo tên sản phẩm hoặc tên danh mục
    public function timKiem(string $tuKhoa): array
    {
        $sql = "
            SELECT
                SanPham.*,
                DanhMuc.ten_danh_muc
            FROM SanPham
            INNER JOIN DanhMuc
                ON SanPham.danh_muc_id = DanhMuc.id
            WHERE
                SanPham.ten_san_pham LIKE :tu_khoa_san_pham
                OR DanhMuc.ten_danh_muc LIKE :tu_khoa_danh_muc
            ORDER BY SanPham.id DESC
        ";

        $stmt = $this->db->prepare($sql);

        $tuKhoaLike = '%' . $tuKhoa . '%';

        $stmt->execute([
            ':tu_khoa_san_pham' => $tuKhoaLike,
            ':tu_khoa_danh_muc' => $tuKhoaLike
        ]);

        return $stmt->fetchAll();
    }

    // Tìm sản phẩm theo ID
    public function timTheoId(int $id): ?array
    {
        $sql = "
            SELECT
                SanPham.*,
                DanhMuc.ten_danh_muc
            FROM SanPham
            INNER JOIN DanhMuc
                ON SanPham.danh_muc_id = DanhMuc.id
            WHERE SanPham.id = :id
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        $sanPham = $stmt->fetch();

        return $sanPham ?: null;
    }

    // Thêm sản phẩm
    public function them(
        string $tenSanPham,
        int $danhMucId,
        float $gia,
        string $moTa = '',
        string $hinhAnh = ''
    ): bool {
        $sql = "
            INSERT INTO SanPham
            (
                ten_san_pham,
                danh_muc_id,
                mo_ta,
                gia,
                hinh_anh
            )
            VALUES
            (
                :ten_san_pham,
                :danh_muc_id,
                :mo_ta,
                :gia,
                :hinh_anh
            )
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':ten_san_pham' => $tenSanPham,
            ':danh_muc_id' => $danhMucId,
            ':mo_ta' => $moTa,
            ':gia' => $gia,
            ':hinh_anh' => $hinhAnh
        ]);
    }

    // Sửa sản phẩm
    public function sua(
        int $id,
        string $tenSanPham,
        int $danhMucId,
        float $gia,
        string $moTa = '',
        string $hinhAnh = ''
    ): bool {
        $sql = "
            UPDATE SanPham
            SET
                ten_san_pham = :ten_san_pham,
                danh_muc_id = :danh_muc_id,
                mo_ta = :mo_ta,
                gia = :gia,
                hinh_anh = :hinh_anh
            WHERE id = :id
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':ten_san_pham' => $tenSanPham,
            ':danh_muc_id' => $danhMucId,
            ':mo_ta' => $moTa,
            ':gia' => $gia,
            ':hinh_anh' => $hinhAnh
        ]);
    }

    // Xóa sản phẩm
    public function xoa(int $id): bool
    {
        $sql = "
            DELETE FROM SanPham
            WHERE id = :id
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':id' => $id
        ]);
    }
}