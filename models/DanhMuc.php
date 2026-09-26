<?php

require_once __DIR__ . '/Database.php';

class DanhMuc
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    // Lấy tất cả danh mục
    public function layTatCa(): array
    {
        $sql = "
            SELECT *
            FROM DanhMuc
            ORDER BY id DESC
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    // Tìm danh mục theo ID
    public function timTheoId(int $id): ?array
    {
        $sql = "
            SELECT *
            FROM DanhMuc
            WHERE id = :id
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':id' => $id
        ]);

        $danhMuc = $stmt->fetch();

        return $danhMuc ?: null;
    }

    // Thêm danh mục
    public function them(string $tenDanhMuc, string $moTa = ''): bool
    {
        $sql = "
            INSERT INTO DanhMuc (ten_danh_muc, mo_ta)
            VALUES (:ten_danh_muc, :mo_ta)
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':ten_danh_muc' => $tenDanhMuc,
            ':mo_ta' => $moTa
        ]);
    }

    // Sửa danh mục
    public function sua(
        int $id,
        string $tenDanhMuc,
        string $moTa = ''
    ): bool {
        $sql = "
            UPDATE DanhMuc
            SET ten_danh_muc = :ten_danh_muc,
                mo_ta = :mo_ta
            WHERE id = :id
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':ten_danh_muc' => $tenDanhMuc,
            ':mo_ta' => $moTa
        ]);
    }

    // Xóa danh mục
    public function xoa(int $id): bool
    {
        $sql = "
            DELETE FROM DanhMuc
            WHERE id = :id
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':id' => $id
        ]);
    }
}