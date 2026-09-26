<?php

require_once __DIR__ . '/Database.php';

class BienTheSanPham
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    // Lấy tất cả biến thể của một sản phẩm
    public function layTheoSanPham(int $sanPhamId): array
    {
        $sql = "
            SELECT *
            FROM BienTheSanPham
            WHERE san_pham_id = :san_pham_id
            ORDER BY id ASC
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':san_pham_id' => $sanPhamId
        ]);

        return $stmt->fetchAll();
    }

    // Tìm biến thể theo ID
    public function timTheoId(int $id): ?array
    {
        $sql = "
            SELECT
                BienTheSanPham.*,
                SanPham.ten_san_pham
            FROM BienTheSanPham
            INNER JOIN SanPham
                ON BienTheSanPham.san_pham_id = SanPham.id
            WHERE BienTheSanPham.id = :id
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        $bienThe = $stmt->fetch();

        return $bienThe ?: null;
    }

    // Kiểm tra biến thể còn đủ số lượng hay không
    public function kiemTraTonKho(
        int $id,
        int $soLuong
    ): bool {
        $sql = "
            SELECT so_luong
            FROM BienTheSanPham
            WHERE id = :id
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        $bienThe = $stmt->fetch();

        if ($bienThe === false) {
            return false;
        }

        return (int) $bienThe['so_luong'] >= $soLuong;
    }

    // Tìm biến thể theo sản phẩm, size và màu sắc
public function timTheoSanPhamSizeMau(
    int $sanPhamId,
    string $size,
    string $mauSac
): ?array {
    $sql = "
        SELECT *
        FROM BienTheSanPham
        WHERE san_pham_id = :san_pham_id
        AND size = :size
        AND mau_sac = :mau_sac
    ";

    $stmt = $this->db->prepare($sql);

    $stmt->execute([
        ':san_pham_id' => $sanPhamId,
        ':size' => $size,
        ':mau_sac' => $mauSac
    ]);

    $bienThe = $stmt->fetch();

    return $bienThe ?: null;
}

public function giamTonKho(int $id, int $soLuong): bool
{
    $sql = "
        UPDATE BienTheSanPham
        SET so_luong = so_luong - :so_luong_tru
        WHERE id = :id
        AND so_luong >= :so_luong_kiem_tra
    ";

    $stmt = $this->db->prepare($sql);

    $stmt->execute([
        ':so_luong_tru' => $soLuong,
        ':id' => $id,
        ':so_luong_kiem_tra' => $soLuong
    ]);

    return $stmt->rowCount() > 0;
}

public function tangTonKho(int $id, int $soLuong): bool
{
    $sql = "
        UPDATE BienTheSanPham
        SET so_luong = so_luong + :so_luong
        WHERE id = :id
    ";

    $stmt = $this->db->prepare($sql);

    $stmt->execute([
        ':so_luong' => $soLuong,
        ':id' => $id
    ]);

    return $stmt->rowCount() > 0;
}
}