<?php

require_once __DIR__ . '/../models/Database.php';
require_once __DIR__ . '/../models/KhachHang.php';

class AdminKhachHangController
{
    private PDO $db;
    private KhachHang $khachHangModel;


    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->db = Database::connect();

        $this->khachHangModel = new KhachHang($this->db);
    }


    // =========================================================
    // KIỂM TRA ĐĂNG NHẬP ADMIN
    // =========================================================

    private function kiemTraAdmin()
    {
        if (!isset($_SESSION['admin'])) {

            header('Location: index.php?url=admin-dang-nhap');

            exit;
        }
    }


    // =========================================================
    // DANH SÁCH KHÁCH HÀNG
    // =========================================================

    public function index()
    {
        $this->kiemTraAdmin();


        $sql = "
            SELECT
                id,
                ho_ten,
                email,
                so_dien_thoai,
                dia_chi,
                ngay_tao
            FROM KhachHang
            ORDER BY id DESC
        ";


        $stmt = $this->db->prepare($sql);

        $stmt->execute();

        $khachHangs = $stmt->fetchAll();


        require __DIR__ . '/../views/admin/khachhang/index.php';
    }


    // =========================================================
    // XÓA KHÁCH HÀNG
    // =========================================================

    public function xoa()
    {
        $this->kiemTraAdmin();


        $id = (int) ($_GET['id'] ?? 0);


        if ($id <= 0) {

            die('ID khách hàng không hợp lệ.');

        }


        $khachHang = $this->khachHangModel->timTheoId($id);


        if (!$khachHang) {

            die('Không tìm thấy khách hàng.');

        }


        $xoaThanhCong = $this->khachHangModel->xoaKhachHangAdmin($id);


        if (!$xoaThanhCong) {

            die(
                'Không thể xóa khách hàng. ' .
                'Có thể khách hàng đang có dữ liệu liên quan.'
            );

        }


        header('Location: index.php?url=admin-khach-hang');

        exit;
    }
}