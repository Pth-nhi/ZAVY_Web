<?php

require_once __DIR__ . '/../models/Database.php';
require_once __DIR__ . '/../models/KhachHang.php';

class TaiKhoanController
{
    private KhachHang $khachHang;

    public function __construct()
    {
        $db = Database::connect();
        $this->khachHang = new KhachHang($db);
    }


    /*
     * Trang thông tin cá nhân
     */
    public function thongTin()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['khach_hang'])) {
            header('Location: index.php?url=dang-nhap');
            exit;
        }

        $id = (int) $_SESSION['khach_hang']['id'];

        $khachHang = $this->khachHang->timTheoId($id);

        if ($khachHang === null) {
            session_unset();
            session_destroy();

            header('Location: index.php?url=dang-nhap');
            exit;
        }

        $title = 'Thông tin cá nhân - ZAVYWEB';

        $contentView = __DIR__ . '/../views/tai-khoan/thongtin.php';

        require_once __DIR__ . '/../views/layouts/layout.php';
    }


    /*
     * Trang sửa tài khoản
     */
    public function sua()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['khach_hang'])) {
            header('Location: index.php?url=dang-nhap');
            exit;
        }

        $id = (int) $_SESSION['khach_hang']['id'];

        $khachHang = $this->khachHang->timTheoId($id);

        if ($khachHang === null) {
            header('Location: index.php?url=dang-nhap');
            exit;
        }

        $title = 'Sửa tài khoản - ZAVYWEB';

        $contentView = __DIR__ . '/../views/tai-khoan/sua.php';

        require_once __DIR__ . '/../views/layouts/layout.php';
    }


    /*
     * Xử lý cập nhật tài khoản
     */
    public function xuLySua()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['khach_hang'])) {
            header('Location: index.php?url=dang-nhap');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?url=thong-tin-tai-khoan');
            exit;
        }

        $id = (int) $_SESSION['khach_hang']['id'];

        $hoTen = trim($_POST['ho_ten'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $soDienThoai = trim($_POST['so_dien_thoai'] ?? '');
        $diaChi = trim($_POST['dia_chi'] ?? '');


        if (
            $hoTen === '' ||
            $email === '' ||
            $soDienThoai === '' ||
            $diaChi === ''
        ) {
            header(
                'Location: index.php?url=sua-tai-khoan&error=1'
            );
            exit;
        }


        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header(
                'Location: index.php?url=sua-tai-khoan&error=2'
            );
            exit;
        }


        /*
         * Kiểm tra email đã được tài khoản khác sử dụng chưa
         */
        $khachHangHienTai = $this->khachHang->timTheoId($id);

        if ($khachHangHienTai === null) {
            header('Location: index.php?url=dang-nhap');
            exit;
        }


        if ($email !== $khachHangHienTai['email']) {

            $khachHangTrungEmail =
                $this->khachHang->timTheoEmail($email);

            if (
                $khachHangTrungEmail !== null &&
                (int) $khachHangTrungEmail['id'] !== $id
            ) {
                header(
                    'Location: index.php?url=sua-tai-khoan&error=3'
                );
                exit;
            }
        }


        $this->khachHang->capNhatThongTin(
            $id,
            $hoTen,
            $email,
            $soDienThoai,
            $diaChi
        );


        /*
         * Cập nhật lại Session
         */
        $_SESSION['khach_hang'] = [
            'id' => $id,
            'ho_ten' => $hoTen,
            'email' => $email
        ];


        header(
            'Location: index.php?url=thong-tin-tai-khoan&success=1'
        );
        exit;
    }


    /*
     * Xóa tài khoản
     */
    public function xoa()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['khach_hang'])) {
            header('Location: index.php?url=dang-nhap');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header(
                'Location: index.php?url=thong-tin-tai-khoan'
            );
            exit;
        }

        $id = (int) $_SESSION['khach_hang']['id'];

        $xoaThanhCong = $this->khachHang->xoaTaiKhoan($id);

        if (!$xoaThanhCong) {
            header(
                'Location: index.php?url=thong-tin-tai-khoan&error=4'
            );
            exit;
        }


        /*
         * Xóa Session
         */
        $_SESSION = [];

        if (ini_get('session.use_cookies')) {

            $params = session_get_cookie_params();

            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }

        session_destroy();


        /*
         * Chuyển về trang chủ
         */
        header(
            'Location: index.php?url=home&deleted=1'
        );
        exit;
    }
}