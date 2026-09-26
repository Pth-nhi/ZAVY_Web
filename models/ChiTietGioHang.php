<?php

require_once __DIR__ . '/Database.php';

class ChiTietGioHang
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    // Lấy toàn bộ sản phẩm trong giỏ hàng
    public function layTheoGioHang(int $gioHangId): array
    {
        $sql = "
            SELECT
                ChiTietGioHang.*,
                BienTheSanPham.size,
                BienTheSanPham.mau_sac,
                BienTheSanPham.so_luong AS ton_kho,
                SanPham.ten_san_pham,
                SanPham.gia,
                SanPham.hinh_anh
            FROM ChiTietGioHang

            INNER JOIN BienTheSanPham
                ON ChiTietGioHang.bien_the_san_pham_id
                = BienTheSanPham.id

            INNER JOIN SanPham
                ON BienTheSanPham.san_pham_id
                = SanPham.id

            WHERE ChiTietGioHang.gio_hang_id = :gio_hang_id

            ORDER BY ChiTietGioHang.id DESC
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':gio_hang_id' => $gioHangId
        ]);

        return $stmt->fetchAll();
    }

    // Tìm một biến thể đã có trong giỏ hàng
    public function timSanPhamTrongGio(
        int $gioHangId,
        int $bienTheSanPhamId
    ): ?array {
        $sql = "
            SELECT *
            FROM ChiTietGioHang
            WHERE gio_hang_id = :gio_hang_id
            AND bien_the_san_pham_id = :bien_the_san_pham_id
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':gio_hang_id' => $gioHangId,
            ':bien_the_san_pham_id' => $bienTheSanPhamId
        ]);

        $chiTiet = $stmt->fetch();

        return $chiTiet ?: null;
    }

    // Thêm biến thể vào giỏ hàng
    public function them(
        int $gioHangId,
        int $bienTheSanPhamId,
        int $soLuong
    ): bool {
        $sql = "
            INSERT INTO ChiTietGioHang
            (
                gio_hang_id,
                bien_the_san_pham_id,
                so_luong
            )
            VALUES
            (
                :gio_hang_id,
                :bien_the_san_pham_id,
                :so_luong
            )
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':gio_hang_id' => $gioHangId,
            ':bien_the_san_pham_id' => $bienTheSanPhamId,
            ':so_luong' => $soLuong
        ]);
    }

    // Cập nhật số lượng
    public function capNhatSoLuong(
        int $id,
        int $soLuong
    ): bool {
        $sql = "
            UPDATE ChiTietGioHang
            SET so_luong = :so_luong
            WHERE id = :id
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':so_luong' => $soLuong
        ]);
    }

    // Xóa một sản phẩm khỏi giỏ hàng
    public function xoa(int $id): bool
    {
        $sql = "
            DELETE FROM ChiTietGioHang
            WHERE id = :id
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':id' => $id
        ]);
    }

    // Xóa toàn bộ sản phẩm trong giỏ hàng
    public function xoaTheoGioHang(int $gioHangId): bool
    {
        $sql = "
            DELETE FROM ChiTietGioHang
            WHERE gio_hang_id = :gio_hang_id
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':gio_hang_id' => $gioHangId
        ]);
    }

    // Tìm chi tiết giỏ hàng theo ID
public function timTheoId(int $id): ?array
{
    $sql = "
        SELECT *
        FROM ChiTietGioHang
        WHERE id = :id
    ";

    $stmt = $this->db->prepare($sql);

    $stmt->execute([
        ':id' => $id
    ]);

    $chiTiet = $stmt->fetch();

    return $chiTiet ?: null;
}
}