<?php

require_once __DIR__ . '/../models/Database.php';
require_once __DIR__ . '/../models/GioHang.php';
require_once __DIR__ . '/../models/ChiTietGioHang.php';
require_once __DIR__ . '/../models/BienTheSanPham.php';

class GioHangController
{
    private GioHang $gioHang;
    private ChiTietGioHang $chiTietGioHang;
    private BienTheSanPham $bienTheSanPham;

    public function __construct()
    {
        $db = Database::connect();

        $this->gioHang = new GioHang($db);
        $this->chiTietGioHang = new ChiTietGioHang($db);
        $this->bienTheSanPham = new BienTheSanPham($db);
    }


    /* =========================================================
       HIỂN THỊ GIỎ HÀNG
       ========================================================= */

    public function index()
    {
        // Kiểm tra session
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Kiểm tra đăng nhập
        if (!isset($_SESSION['khach_hang'])) {
            header('Location: index.php?url=dang-nhap');
            exit;
        }

        // ID khách hàng
        $khachHangId = (int) $_SESSION['khach_hang']['id'];

        // Lấy hoặc tạo giỏ hàng
        $gioHang = $this->gioHang->layHoacTao($khachHangId);

        // Lấy các sản phẩm trong giỏ hàng
        $chiTietGioHang = $this->chiTietGioHang
            ->layTheoGioHang($gioHang['id']);

        // Tính tổng tiền
        $tongTien = 0;

        foreach ($chiTietGioHang as $item) {
            $gia = (float) $item['gia'];
            $soLuong = (int) $item['so_luong'];

            $tongTien += $gia * $soLuong;
        }

        // Tiêu đề trang
        $title = 'Giỏ hàng - ZAVYWEB';

        // View
        $contentView = __DIR__ . '/../views/gio-hang/index.php';

        require_once __DIR__ . '/../views/layouts/layout.php';
    }


    /* =========================================================
       THÊM SẢN PHẨM VÀO GIỎ HÀNG
       ========================================================= */

    public function them()
    {
        // Kiểm tra session
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Kiểm tra đăng nhập
        if (!isset($_SESSION['khach_hang'])) {
            header('Location: index.php?url=dang-nhap');
            exit;
        }

        // Chỉ xử lý POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?url=san-pham');
            exit;
        }

        // ID khách hàng
        $khachHangId = (int) $_SESSION['khach_hang']['id'];

        // Lấy dữ liệu từ form
        $sanPhamId = (int) ($_POST['san_pham_id'] ?? 0);
        $size = trim($_POST['size'] ?? '');
        $mauSac = trim($_POST['mau_sac'] ?? '');
        $soLuong = (int) ($_POST['so_luong'] ?? 1);

        // Kiểm tra dữ liệu
        if (
            $sanPhamId <= 0 ||
            $size === '' ||
            $mauSac === '' ||
            $soLuong <= 0
        ) {
            header(
                'Location: index.php?url=chi-tiet-san-pham&id='
                . $sanPhamId
            );
            exit;
        }

        // Tìm biến thể sản phẩm
        $bienThe = $this->bienTheSanPham
            ->timTheoSanPhamSizeMau(
                $sanPhamId,
                $size,
                $mauSac
            );

        // Không tìm thấy biến thể
        if ($bienThe === null) {
            header(
                'Location: index.php?url=chi-tiet-san-pham&id='
                . $sanPhamId
            );
            exit;
        }

        // Kiểm tra tồn kho
        if (
            !$this->bienTheSanPham->kiemTraTonKho(
                (int) $bienThe['id'],
                $soLuong
            )
        ) {
            header(
                'Location: index.php?url=chi-tiet-san-pham&id='
                . $sanPhamId
            );
            exit;
        }

        // Lấy hoặc tạo giỏ hàng
        $gioHang = $this->gioHang
            ->layHoacTao($khachHangId);

        // Kiểm tra sản phẩm đã có trong giỏ chưa
        $chiTiet = $this->chiTietGioHang
            ->timSanPhamTrongGio(
                (int) $gioHang['id'],
                (int) $bienThe['id']
            );

        if ($chiTiet !== null) {

            // Đã có → cộng thêm số lượng
            $soLuongMoi =
                (int) $chiTiet['so_luong']
                + $soLuong;

            // Kiểm tra tồn kho sau khi cộng
            if (
                !$this->bienTheSanPham->kiemTraTonKho(
                    (int) $bienThe['id'],
                    $soLuongMoi
                )
            ) {
                header(
                    'Location: index.php?url=chi-tiet-san-pham&id='
                    . $sanPhamId
                );
                exit;
            }

            // Cập nhật số lượng
            $this->chiTietGioHang
                ->capNhatSoLuong(
                    (int) $chiTiet['id'],
                    $soLuongMoi
                );

        } else {

            // Chưa có → thêm mới
            $this->chiTietGioHang
                ->them(
                    (int) $gioHang['id'],
                    (int) $bienThe['id'],
                    $soLuong
                );
        }

        // Thêm thành công → chuyển đến giỏ hàng
        header('Location: index.php?url=gio-hang');
        exit;
    }


    /* =========================================================
       CẬP NHẬT SỐ LƯỢNG
       ========================================================= */

    public function capNhat()
    {
        // Kiểm tra session
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Kiểm tra đăng nhập
        if (!isset($_SESSION['khach_hang'])) {
            header('Location: index.php?url=dang-nhap');
            exit;
        }

        // Chỉ xử lý POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?url=gio-hang');
            exit;
        }

        // ID khách hàng
        $khachHangId = (int) $_SESSION['khach_hang']['id'];

        // Dữ liệu từ form
        $chiTietId = (int) ($_POST['id'] ?? 0);
        $soLuong = (int) ($_POST['so_luong'] ?? 0);

        // Kiểm tra dữ liệu
        if (
            $chiTietId <= 0 ||
            $soLuong <= 0
        ) {
            header('Location: index.php?url=gio-hang');
            exit;
        }

        // Lấy giỏ hàng của khách hàng
        $gioHang = $this->gioHang
            ->timTheoKhachHang($khachHangId);

        if ($gioHang === null) {
            header('Location: index.php?url=gio-hang');
            exit;
        }

        // Lấy sản phẩm trong giỏ
        $chiTiet = $this->chiTietGioHang
            ->timTheoId($chiTietId);

        if ($chiTiet === null) {
            header('Location: index.php?url=gio-hang');
            exit;
        }

        // Đảm bảo sản phẩm thuộc giỏ hàng của khách hiện tại
        if (
            (int) $chiTiet['gio_hang_id']
            !== (int) $gioHang['id']
        ) {
            header('Location: index.php?url=gio-hang');
            exit;
        }

        // Kiểm tra tồn kho
        if (
            !$this->bienTheSanPham->kiemTraTonKho(
                (int) $chiTiet['bien_the_san_pham_id'],
                $soLuong
            )
        ) {
            header('Location: index.php?url=gio-hang');
            exit;
        }

        // Cập nhật số lượng
        $this->chiTietGioHang
            ->capNhatSoLuong(
                $chiTietId,
                $soLuong
            );

        // Quay lại giỏ hàng
        header('Location: index.php?url=gio-hang');
        exit;
    }


    /* =========================================================
       XÓA SẢN PHẨM KHỎI GIỎ HÀNG
       ========================================================= */

    public function xoa()
    {
        // Kiểm tra session
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Kiểm tra đăng nhập
        if (!isset($_SESSION['khach_hang'])) {
            header('Location: index.php?url=dang-nhap');
            exit;
        }

        // Chỉ xử lý POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?url=gio-hang');
            exit;
        }

        // ID khách hàng
        $khachHangId = (int) $_SESSION['khach_hang']['id'];

        // ID chi tiết giỏ hàng
        $chiTietId = (int) ($_POST['id'] ?? 0);

        // Kiểm tra ID
        if ($chiTietId <= 0) {
            header('Location: index.php?url=gio-hang');
            exit;
        }

        // Lấy giỏ hàng của khách hàng
        $gioHang = $this->gioHang
            ->timTheoKhachHang($khachHangId);

        if ($gioHang === null) {
            header('Location: index.php?url=gio-hang');
            exit;
        }

        // Lấy sản phẩm trong giỏ
        $chiTiet = $this->chiTietGioHang
            ->timTheoId($chiTietId);

        if ($chiTiet === null) {
            header('Location: index.php?url=gio-hang');
            exit;
        }

        // Đảm bảo sản phẩm thuộc giỏ hàng của khách hiện tại
        if (
            (int) $chiTiet['gio_hang_id']
            !== (int) $gioHang['id']
        ) {
            header('Location: index.php?url=gio-hang');
            exit;
        }

        // Xóa sản phẩm
        $this->chiTietGioHang
            ->xoa($chiTietId);

        // Quay lại giỏ hàng
        header('Location: index.php?url=gio-hang');
        exit;
    }
}