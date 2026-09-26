<?php

require_once __DIR__ . '/../models/Database.php';
require_once __DIR__ . '/../models/Admin.php';

class AdminController
{
    private PDO $db;
    private Admin $adminModel;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->db = Database::connect();

        $this->adminModel = new Admin($this->db);
    }

    // Hiển thị trang đăng nhập Admin
    public function dangNhap()
    {
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = trim($_POST['email'] ?? '');

            $matKhau = $_POST['mat_khau'] ?? '';

            if ($email === '' || $matKhau === '') {

                $error =
                    'Vui lòng nhập đầy đủ email và mật khẩu.';

            } else {

                $admin =
                    $this->adminModel->timTheoEmail($email);

                if (
                    $admin &&
                    password_verify(
                        $matKhau,
                        $admin['mat_khau']
                    )
                ) {

                    $_SESSION['admin'] = [
                        'id' => $admin['id'],
                        'ho_ten' => $admin['ho_ten'],
                        'email' => $admin['email']
                    ];

                    header(
                        'Location: index.php?url=admin'
                    );

                    exit;
                }

                $error =
                    'Email hoặc mật khẩu không chính xác.';
            }
        }

        require __DIR__ . '/../views/admin/dangnhap.php';
    }

    // Trang chủ Admin
    public function index()
    {
        if (!isset($_SESSION['admin'])) {

            header(
                'Location: index.php?url=admin-dang-nhap'
            );

            exit;
        }

        $admin = $_SESSION['admin'];

        require __DIR__ . '/../views/admin/index.php';
    }

    // Đăng xuất Admin
    public function dangXuat()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        unset($_SESSION['admin']);

        header(
            'Location: index.php?url=admin-dang-nhap'
        );

        exit;
    }

    // Hiển thị thông tin cá nhân Admin
    public function taiKhoan()
    {
        if (!isset($_SESSION['admin'])) {

            header(
                'Location: index.php?url=admin-dang-nhap'
            );

            exit;
        }

        $id = (int) $_SESSION['admin']['id'];

        $admin =
            $this->adminModel->timTheoId($id);

        if (!$admin) {
            die('Không tìm thấy tài khoản Admin.');
        }

        require __DIR__ . '/../views/admin/taikhoan/index.php';
    }

    // Hiển thị form sửa thông tin cá nhân
    public function suaTaiKhoan()
    {
        if (!isset($_SESSION['admin'])) {

            header(
                'Location: index.php?url=admin-dang-nhap'
            );

            exit;
        }

        $id = (int) $_SESSION['admin']['id'];

        $admin =
            $this->adminModel->timTheoId($id);

        if (!$admin) {
            die('Không tìm thấy tài khoản Admin.');
        }

        require __DIR__ . '/../views/admin/taikhoan/sua.php';
    }

    // Xử lý cập nhật thông tin cá nhân
    public function xuLySuaTaiKhoan()
    {
        if (!isset($_SESSION['admin'])) {

            header(
                'Location: index.php?url=admin-dang-nhap'
            );

            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

            header(
                'Location: index.php?url=admin-tai-khoan'
            );

            exit;
        }

        $id =
            (int) $_SESSION['admin']['id'];

        $hoTen =
            trim($_POST['ho_ten'] ?? '');

        $email =
            trim($_POST['email'] ?? '');

        $soDienThoai =
            trim($_POST['so_dien_thoai'] ?? '');

        $diaChi =
            trim($_POST['dia_chi'] ?? '');

        if ($hoTen === '') {
            die('Họ tên không được để trống.');
        }

        if ($email === '') {
            die('Email không được để trống.');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            die('Email không hợp lệ.');
        }

        // Kiểm tra email có thuộc Admin khác không
        $adminTheoEmail =
            $this->adminModel->timTheoEmail($email);

        if (
            $adminTheoEmail &&
            (int) $adminTheoEmail['id'] !== $id
        ) {
            die('Email này đã được sử dụng.');
        }

        $capNhatThanhCong =
            $this->adminModel->capNhatThongTin(
                $id,
                $hoTen,
                $email,
                $soDienThoai,
                $diaChi
            );

        if (!$capNhatThanhCong) {
            die('Không thể cập nhật thông tin Admin.');
        }

        // Cập nhật lại Session
        $_SESSION['admin']['ho_ten'] = $hoTen;
        $_SESSION['admin']['email'] = $email;

        header(
            'Location: index.php?url=admin-tai-khoan'
        );

        exit;
    }
}