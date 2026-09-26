<?php

require_once __DIR__ . '/../models/Database.php';
require_once __DIR__ . '/../models/DonHang.php';

class QuanLyDonHangController
{
    private PDO $db;
    private DonHang $donHang;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->db = Database::connect();

        $this->donHang = new DonHang($this->db);
    }

    /**
     * Kiểm tra khách hàng đã đăng nhập chưa
     */
    private function kiemTraDangNhap()
    {
        if (!isset($_SESSION['khach_hang'])) {
            header('Location: index.php?url=dang-nhap');
            exit;
        }
    }

    /**
     * Trang quản lý đơn hàng
     */
    public function index()
    {
        $this->kiemTraDangNhap();

        $khachHang = $_SESSION['khach_hang'];

        $khachHangId = (int) $khachHang['id'];

        // Lấy toàn bộ đơn hàng của khách hàng đang đăng nhập
        $donHangs = $this->donHang->layTheoKhachHang(
            $khachHangId
        );

        require __DIR__ . '/../views/quanlydonhang/index.php';
    }
}