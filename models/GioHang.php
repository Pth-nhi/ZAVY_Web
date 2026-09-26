<?php

require_once __DIR__ . '/Database.php';

class GioHang
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    // Tìm giỏ hàng của khách hàng
    public function timTheoKhachHang(int $khachHangId): ?array
    {
        $sql = "
            SELECT *
            FROM GioHang
            WHERE khach_hang_id = :khach_hang_id
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':khach_hang_id' => $khachHangId
        ]);

        $gioHang = $stmt->fetch();

        return $gioHang ?: null;
    }

    // Tạo giỏ hàng cho khách hàng
    public function taoGioHang(int $khachHangId): int
    {
        $sql = "
            INSERT INTO GioHang (khach_hang_id)
            VALUES (:khach_hang_id)
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':khach_hang_id' => $khachHangId
        ]);

        return (int) $this->db->lastInsertId();
    }

    // Lấy giỏ hàng, nếu chưa có thì tự tạo
    public function layHoacTao(int $khachHangId): array
    {
        $gioHang = $this->timTheoKhachHang($khachHangId);

        if ($gioHang !== null) {
            return $gioHang;
        }

        $gioHangId = $this->taoGioHang($khachHangId);

        return [
            'id' => $gioHangId,
            'khach_hang_id' => $khachHangId
        ];
    }
}