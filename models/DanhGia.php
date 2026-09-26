<?php

require_once __DIR__ . '/Database.php';

class DanhGia
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    // Lấy tất cả đánh giá của một sản phẩm
    public function layTheoSanPham(int $sanPhamId): array
    {
        $sql = "
            SELECT
                DanhGia.*,
                KhachHang.ho_ten
            FROM DanhGia
            INNER JOIN KhachHang
                ON DanhGia.khach_hang_id = KhachHang.id
            WHERE DanhGia.san_pham_id = :san_pham_id
            ORDER BY DanhGia.id DESC
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':san_pham_id' => $sanPhamId
        ]);

        return $stmt->fetchAll();
    }

    // Thêm đánh giá
    public function them(
        int $khachHangId,
        int $sanPhamId,
        int $soSao,
        string $noiDung
    ): bool {
        $sql = "
            INSERT INTO DanhGia
            (
                khach_hang_id,
                san_pham_id,
                so_sao,
                noi_dung
            )
            VALUES
            (
                :khach_hang_id,
                :san_pham_id,
                :so_sao,
                :noi_dung
            )
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':khach_hang_id' => $khachHangId,
            ':san_pham_id' => $sanPhamId,
            ':so_sao' => $soSao,
            ':noi_dung' => $noiDung
        ]);
    }
}