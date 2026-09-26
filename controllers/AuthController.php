<?php

require_once __DIR__ . '/../models/Database.php';
require_once __DIR__ . '/../models/KhachHang.php';

class AuthController
{
    private KhachHang $khachHang;

    public function __construct()
    {
        $db = Database::connect();
        $this->khachHang = new KhachHang($db);
    }

    // Hiển thị trang đăng ký
    public function dangKy()
    {
        $title = 'Đăng ký - ZAVYWEB';
        $error = '';
        $success = '';

        $contentView = __DIR__ . '/../views/auth/dangky.php';

        require_once __DIR__ . '/../views/layouts/layout.php';
    }

    // Xử lý đăng ký
    public function xuLyDangKy()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?url=dang-ky');
            exit;
        }

        $hoTen = trim($_POST['ho_ten'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $matKhau = $_POST['mat_khau'] ?? '';
        $soDienThoai = trim($_POST['so_dien_thoai'] ?? '');
        $diaChi = trim($_POST['dia_chi'] ?? '');

        if (
            $hoTen === '' ||
            $email === '' ||
            $matKhau === ''
        ) {
            $title = 'Đăng ký - ZAVYWEB';
            $error = 'Vui lòng nhập đầy đủ thông tin bắt buộc.';
            $success = '';

            $contentView = __DIR__ . '/../views/auth/dangky.php';

            require_once __DIR__ . '/../views/layouts/layout.php';
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $title = 'Đăng ký - ZAVYWEB';
            $error = 'Email không hợp lệ.';
            $success = '';

            $contentView = __DIR__ . '/../views/auth/dangky.php';

            require_once __DIR__ . '/../views/layouts/layout.php';
            return;
        }

        $khachHangTonTai = $this->khachHang->timTheoEmail($email);

        if ($khachHangTonTai !== null) {
            $title = 'Đăng ký - ZAVYWEB';
            $error = 'Email này đã được sử dụng.';
            $success = '';

            $contentView = __DIR__ . '/../views/auth/dangky.php';

            require_once __DIR__ . '/../views/layouts/layout.php';
            return;
        }

        $ketQua = $this->khachHang->dangKy(
            $hoTen,
            $email,
            $matKhau,
            $soDienThoai,
            $diaChi
        );

        if ($ketQua) {
            header('Location: index.php?url=dang-nhap&success=1');
            exit;
        }

        $title = 'Đăng ký - ZAVYWEB';
        $error = 'Đăng ký không thành công. Vui lòng thử lại.';
        $success = '';

        $contentView = __DIR__ . '/../views/auth/dangky.php';

        require_once __DIR__ . '/../views/layouts/layout.php';
    }

    // Hiển thị trang đăng nhập
    public function dangNhap()
    {
        $title = 'Đăng nhập - ZAVYWEB';
        $error = '';
        $success = '';

        if (isset($_GET['success'])) {
            $success = 'Đăng ký thành công. Vui lòng đăng nhập.';
        }

        $contentView = __DIR__ . '/../views/auth/dangnhap.php';

        require_once __DIR__ . '/../views/layouts/layout.php';
    }

    // Xử lý đăng nhập
    public function xuLyDangNhap()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?url=dang-nhap');
            exit;
        }

        $email = trim($_POST['email'] ?? '');
        $matKhau = $_POST['mat_khau'] ?? '';

        $khachHang = $this->khachHang->dangNhap(
            $email,
            $matKhau
        );

        if ($khachHang === null) {
            $title = 'Đăng nhập - ZAVYWEB';
            $error = 'Email hoặc mật khẩu không chính xác.';
            $success = '';

            $contentView = __DIR__ . '/../views/auth/dangnhap.php';

            require_once __DIR__ . '/../views/layouts/layout.php';
            return;
        }

        session_start();

        $_SESSION['khach_hang'] = [
            'id' => $khachHang['id'],
            'ho_ten' => $khachHang['ho_ten'],
            'email' => $khachHang['email']
        ];

        header('Location: index.php?url=home');
        exit;
    }

    // Đăng xuất
    public function dangXuat()
    {
        session_start();

        unset($_SESSION['khach_hang']);

        header('Location: index.php?url=home');
        exit;
    }
}