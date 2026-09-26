<?php

require_once __DIR__ . '/../models/Database.php';
require_once __DIR__ . '/../models/DanhMuc.php';

class AdminDanhMucController
{
    private PDO $db;
    private DanhMuc $danhMucModel;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Kiểm tra Admin đã đăng nhập chưa
        if (!isset($_SESSION['admin'])) {
            header('Location: index.php?url=admin-dang-nhap');
            exit;
        }

        $this->db = Database::connect();
        $this->danhMucModel = new DanhMuc($this->db);
    }

    // Hiển thị danh sách danh mục
    public function index()
    {
        $danhMucs = $this->danhMucModel->layTatCa();

        require __DIR__ . '/../views/admin/danhmuc/index.php';
    }

    // Hiển thị form thêm danh mục
    public function them()
    {
        require __DIR__ . '/../views/admin/danhmuc/them.php';
    }

    // Xử lý thêm danh mục
    public function xuLyThem()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?url=admin-danh-muc');
            exit;
        }

        $tenDanhMuc = trim($_POST['ten_danh_muc'] ?? '');
        $moTa = trim($_POST['mo_ta'] ?? '');

        if ($tenDanhMuc === '') {
            die('Tên danh mục không được để trống.');
        }

        $this->danhMucModel->them($tenDanhMuc, $moTa);

        header('Location: index.php?url=admin-danh-muc');
        exit;
    }

    // Hiển thị form sửa danh mục
    public function sua()
    {
        $id = (int) ($_GET['id'] ?? 0);

        if ($id <= 0) {
            die('ID danh mục không hợp lệ.');
        }

        $danhMuc = $this->danhMucModel->timTheoId($id);

        if (!$danhMuc) {
            die('Không tìm thấy danh mục.');
        }

        require __DIR__ . '/../views/admin/danhmuc/sua.php';
    }

    // Xử lý sửa danh mục
    public function xuLySua()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?url=admin-danh-muc');
            exit;
        }

        $id = (int) ($_POST['id'] ?? 0);
        $tenDanhMuc = trim($_POST['ten_danh_muc'] ?? '');
        $moTa = trim($_POST['mo_ta'] ?? '');

        if ($id <= 0 || $tenDanhMuc === '') {
            die('Dữ liệu danh mục không hợp lệ.');
        }

        $this->danhMucModel->sua(
            $id,
            $tenDanhMuc,
            $moTa
        );

        header('Location: index.php?url=admin-danh-muc');
        exit;
    }

    // Xóa danh mục
    public function xoa()
    {
        $id = (int) ($_GET['id'] ?? 0);

        if ($id <= 0) {
            die('ID danh mục không hợp lệ.');
        }

        try {
            $this->danhMucModel->xoa($id);
        } catch (PDOException $e) {
            die('Không thể xóa danh mục vì danh mục đang được sử dụng.');
        }

        header('Location: index.php?url=admin-danh-muc');
        exit;
    }
}