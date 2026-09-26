<?php

require_once __DIR__ . '/../models/Database.php';
require_once __DIR__ . '/../models/LienHe.php';

class LienHeController
{
    private LienHe $lienHe;

    public function __construct()
    {
        $db = Database::connect();
        $this->lienHe = new LienHe($db);
    }

    /**
     * Hiển thị form liên hệ
     */
    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $khachHang = $_SESSION['khach_hang'] ?? null;

        $title = 'Liên hệ - ZAVYWEB';

        $contentView = __DIR__ . '/../views/lien-he/index.php';

        require_once __DIR__ . '/../views/layouts/layout.php';
    }


    /**
     * Xử lý gửi liên hệ
     */
    public function xuLyGui()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?url=lien-he');
            exit;
        }

        $hoTen = trim($_POST['ho_ten'] ?? '');
        $soDienThoai = trim($_POST['so_dien_thoai'] ?? '');
        $diaChi = trim($_POST['dia_chi'] ?? '');
        $noiDung = trim($_POST['noi_dung'] ?? '');

        // Kiểm tra dữ liệu
        if (
            $hoTen === '' ||
            $soDienThoai === '' ||
            $diaChi === '' ||
            $noiDung === ''
        ) {
            header('Location: index.php?url=lien-he&error=1');
            exit;
        }

        // Lưu liên hệ vào Database
        $this->lienHe->them(
            $hoTen,
            $soDienThoai,
            $diaChi,
            $noiDung
        );

        // Chuyển sang trang thông báo thành công
        header('Location: index.php?url=lien-he-thanh-cong');
        exit;
    }


    /**
     * Trang gửi liên hệ thành công
     */
    public function thanhCong()
    {
        $title = 'Gửi liên hệ thành công - ZAVYWEB';

        $contentView = __DIR__ . '/../views/lien-he/thanh-cong.php';

        require_once __DIR__ . '/../views/layouts/layout.php';
    }
}