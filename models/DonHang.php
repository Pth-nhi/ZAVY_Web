<?php

require_once __DIR__ . '/Database.php';

class DonHang
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    // Tạo đơn hàng
    public function taoDonHang(
        int $khachHangId,
        float $tongTien,
        string $diaChiGiaoHang,
        string $soDienThoai
    ): int {
        $sql = "
            INSERT INTO DonHang
            (
                khach_hang_id,
                tong_tien,
                trang_thai,
                dia_chi_giao_hang,
                so_dien_thoai
            )
            VALUES
            (
                :khach_hang_id,
                :tong_tien,
                'Chờ xác nhận',
                :dia_chi_giao_hang,
                :so_dien_thoai
            )
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':khach_hang_id' => $khachHangId,
            ':tong_tien' => $tongTien,
            ':dia_chi_giao_hang' => $diaChiGiaoHang,
            ':so_dien_thoai' => $soDienThoai
        ]);

        return (int) $this->db->lastInsertId();
    }

    // Tìm đơn hàng theo ID
    public function timTheoId(int $id): ?array
    {
        $sql = "
            SELECT *
            FROM DonHang
            WHERE id = :id
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        $donHang = $stmt->fetch();

        return $donHang ?: null;
    }

    // Lấy danh sách đơn hàng của khách hàng
    public function layTheoKhachHang(
        int $khachHangId
    ): array {
        $sql = "
            SELECT *
            FROM DonHang
            WHERE khach_hang_id = :khach_hang_id
            ORDER BY id DESC
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':khach_hang_id' => $khachHangId
        ]);

        return $stmt->fetchAll();
    }

    public function huyDonHang(int $donHangId, int $khachHangId): bool
{
    $sql = "
        UPDATE DonHang
        SET trang_thai = 'Đã hủy'
        WHERE id = :id
        AND khach_hang_id = :khach_hang_id
        AND trang_thai = 'Chờ xác nhận'
    ";

    $stmt = $this->db->prepare($sql);

    $stmt->execute([
        ':id' => $donHangId,
        ':khach_hang_id' => $khachHangId
    ]);

    return $stmt->rowCount() > 0;
}

public function layTrangThai(int $donHangId): ?string
{
    $sql = "
        SELECT trang_thai
        FROM DonHang
        WHERE id = :id
    ";

    $stmt = $this->db->prepare($sql);

    $stmt->execute([
        ':id' => $donHangId
    ]);

    $donHang = $stmt->fetch();

    return $donHang
        ? $donHang['trang_thai']
        : null;
}
}