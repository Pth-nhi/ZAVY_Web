<?php

require_once __DIR__ . '/Database.php';

class ChiTietDonHang
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    // Thêm chi tiết đơn hàng
    public function them(
        int $donHangId,
        int $bienTheSanPhamId,
        string $tenSanPham,
        string $size,
        string $mauSac,
        float $donGia,
        int $soLuong,
        float $thanhTien
    ): bool {
        $sql = "
            INSERT INTO ChiTietDonHang
            (
                don_hang_id,
                bien_the_san_pham_id,
                ten_san_pham,
                size,
                mau_sac,
                don_gia,
                so_luong,
                thanh_tien
            )
            VALUES
            (
                :don_hang_id,
                :bien_the_san_pham_id,
                :ten_san_pham,
                :size,
                :mau_sac,
                :don_gia,
                :so_luong,
                :thanh_tien
            )
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':don_hang_id' => $donHangId,
            ':bien_the_san_pham_id' => $bienTheSanPhamId,
            ':ten_san_pham' => $tenSanPham,
            ':size' => $size,
            ':mau_sac' => $mauSac,
            ':don_gia' => $donGia,
            ':so_luong' => $soLuong,
            ':thanh_tien' => $thanhTien
        ]);
    }

    // Lấy các sản phẩm trong một đơn hàng
    public function layTheoDonHang(
        int $donHangId
    ): array {
        $sql = "
            SELECT *
            FROM ChiTietDonHang
            WHERE don_hang_id = :don_hang_id
            ORDER BY id ASC
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':don_hang_id' => $donHangId
        ]);

        return $stmt->fetchAll();
    }
}