<?php

class LienHe
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function them(
        string $hoTen,
        string $soDienThoai,
        string $diaChi,
        string $noiDung
    ): bool {
        $sql = "
            INSERT INTO LienHe (
                ho_ten,
                so_dien_thoai,
                dia_chi,
                noi_dung
            )
            VALUES (
                :ho_ten,
                :so_dien_thoai,
                :dia_chi,
                :noi_dung
            )
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':ho_ten' => $hoTen,
            ':so_dien_thoai' => $soDienThoai,
            ':dia_chi' => $diaChi,
            ':noi_dung' => $noiDung
        ]);
    }
}