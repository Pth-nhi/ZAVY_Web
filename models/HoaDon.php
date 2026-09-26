<?php

require_once __DIR__ . '/Database.php';

class HoaDon
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    // Tạo hóa đơn
    public function taoHoaDon(
        int $donHangId,
        string $maHoaDon,
        float $tongTien,
        string $phuongThucThanhToan
    ): bool {
        $sql = "
            INSERT INTO HoaDon
            (
                don_hang_id,
                ma_hoa_don,
                tong_tien,
                phuong_thuc_thanh_toan,
                trang_thai_thanh_toan
            )
            VALUES
            (
                :don_hang_id,
                :ma_hoa_don,
                :tong_tien,
                :phuong_thuc_thanh_toan,
                'Chưa thanh toán'
            )
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':don_hang_id' => $donHangId,
            ':ma_hoa_don' => $maHoaDon,
            ':tong_tien' => $tongTien,
            ':phuong_thuc_thanh_toan' => $phuongThucThanhToan
        ]);
    }

    // Tìm hóa đơn theo đơn hàng
    public function timTheoDonHang(
        int $donHangId
    ): ?array {
        $sql = "
            SELECT *
            FROM HoaDon
            WHERE don_hang_id = :don_hang_id
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':don_hang_id' => $donHangId
        ]);

        $hoaDon = $stmt->fetch();

        return $hoaDon ?: null;
    }
}