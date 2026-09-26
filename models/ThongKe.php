<?php

require_once __DIR__ . '/Database.php';

class ThongKe
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    /*
     * Lấy tổng quan doanh thu và số đơn hàng
     * trong tháng được chọn.
     */
    public function layTongQuanTheoThang(
        int $thang,
        int $nam
    ): array {

        $sql = "
            SELECT
                COUNT(DISTINCT DonHang.id) AS tong_don_hang,
                COALESCE(SUM(DonHang.tong_tien), 0) AS tong_doanh_thu
            FROM DonHang
            WHERE MONTH(DonHang.ngay_dat) = :thang
              AND YEAR(DonHang.ngay_dat) = :nam
              AND DonHang.trang_thai <> 'Đã hủy'
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':thang' => $thang,
            ':nam' => $nam
        ]);

        $ketQua = $stmt->fetch();

        return $ketQua ?: [
            'tong_don_hang' => 0,
            'tong_doanh_thu' => 0
        ];
    }


    /*
     * Lấy danh sách sản phẩm đã bán
     * trong tháng được chọn.
     */
    public function laySanPhamTheoThang(
        int $thang,
        int $nam
    ): array {

        $sql = "
            SELECT
                ChiTietDonHang.ten_san_pham,
                ChiTietDonHang.size,
                ChiTietDonHang.mau_sac,
                SUM(ChiTietDonHang.so_luong) AS tong_so_luong,
                SUM(ChiTietDonHang.thanh_tien) AS tong_thanh_tien
            FROM ChiTietDonHang

            INNER JOIN DonHang
                ON ChiTietDonHang.don_hang_id = DonHang.id

            WHERE MONTH(DonHang.ngay_dat) = :thang
              AND YEAR(DonHang.ngay_dat) = :nam
              AND DonHang.trang_thai <> 'Đã hủy'

            GROUP BY
                ChiTietDonHang.ten_san_pham,
                ChiTietDonHang.size,
                ChiTietDonHang.mau_sac

            ORDER BY
                tong_so_luong DESC,
                tong_thanh_tien DESC
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':thang' => $thang,
            ':nam' => $nam
        ]);

        return $stmt->fetchAll();
    }
}