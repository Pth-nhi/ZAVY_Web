<?php

require_once __DIR__ . '/Database.php';

class Admin
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    // Tìm tài khoản Admin theo email
    public function timTheoEmail(string $email): ?array
    {
        $sql = "
            SELECT *
            FROM Admin
            WHERE email = :email
            LIMIT 1
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':email' => $email
        ]);

        $admin = $stmt->fetch();

        return $admin ?: null;
    }

    // Tìm tài khoản Admin theo ID
    public function timTheoId(int $id): ?array
    {
        $sql = "
            SELECT *
            FROM Admin
            WHERE id = :id
            LIMIT 1
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        $admin = $stmt->fetch();

        return $admin ?: null;
    }

    // Cập nhật thông tin cá nhân Admin
    public function capNhatThongTin(
        int $id,
        string $hoTen,
        string $email,
        string $soDienThoai,
        string $diaChi
    ): bool {
        $sql = "
            UPDATE Admin
            SET
                ho_ten = :ho_ten,
                email = :email,
                so_dien_thoai = :so_dien_thoai,
                dia_chi = :dia_chi
            WHERE id = :id
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':ho_ten' => $hoTen,
            ':email' => $email,
            ':so_dien_thoai' => $soDienThoai,
            ':dia_chi' => $diaChi
        ]);
    }
}