<?php

require_once __DIR__ . '/../models/Database.php';
require_once __DIR__ . '/../models/ThongKe.php';

class AdminThongKeController
{
    private PDO $db;
    private ThongKe $thongKeModel;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Kiểm tra đăng nhập Admin
        if (!isset($_SESSION['admin'])) {
            header('Location: index.php?url=admin-dang-nhap');
            exit;
        }

        $this->db = Database::connect();

        $this->thongKeModel = new ThongKe($this->db);
    }


    /*
     * Hiển thị trang thống kê
     */
    public function index()
    {
        // Tháng và năm hiện tại
        $thang = (int) date('m');
        $nam = (int) date('Y');

        // Nếu Admin chọn tháng/năm khác
        if (isset($_GET['thang'])) {
            $thang = (int) $_GET['thang'];
        }

        if (isset($_GET['nam'])) {
            $nam = (int) $_GET['nam'];
        }


        // Kiểm tra tháng hợp lệ
        if ($thang < 1 || $thang > 12) {
            $thang = (int) date('m');
        }


        // Kiểm tra năm hợp lệ
        if ($nam < 2000 || $nam > 2100) {
            $nam = (int) date('Y');
        }


        // Lấy tổng quan
        $tongQuan =
            $this->thongKeModel->layTongQuanTheoThang(
                $thang,
                $nam
            );


        // Lấy sản phẩm đã bán
        $sanPhams =
            $this->thongKeModel->laySanPhamTheoThang(
                $thang,
                $nam
            );


        require __DIR__ . '/../views/admin/thongke/index.php';
    }
}