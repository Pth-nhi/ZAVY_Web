<?php

require_once __DIR__ . '/../models/Database.php';
require_once __DIR__ . '/../models/SanPham.php';
require_once __DIR__ . '/../models/DanhMuc.php';
require_once __DIR__ . '/../models/BienTheSanPham.php';
require_once __DIR__ . '/../models/DanhGia.php';

class SanPhamController
{
    private SanPham $sanPham;
    private DanhMuc $danhMuc;
    private BienTheSanPham $bienTheSanPham;
    private DanhGia $danhGia;

    public function __construct()
    {
        $db = Database::connect();

        $this->sanPham = new SanPham($db);
        $this->danhMuc = new DanhMuc($db);
        $this->bienTheSanPham = new BienTheSanPham($db);
        $this->danhGia = new DanhGia($db);
    }

    // Hiển thị danh sách sản phẩm và tìm kiếm sản phẩm
    public function index()
    {
        // Lấy danh sách danh mục
        $danhMucs = $this->danhMuc->layTatCa();

        // Lấy ID danh mục từ URL
        $danhMucId = isset($_GET['danh-muc'])
            ? (int) $_GET['danh-muc']
            : 0;

        // Lấy từ khóa tìm kiếm từ URL
        $tuKhoa = trim($_GET['tu-khoa'] ?? '');

        // Biến danh mục mặc định
        $danhMuc = null;

        // Nếu có từ khóa tìm kiếm
        if ($tuKhoa !== '') {

            $sanPhams = $this->sanPham->timKiem($tuKhoa);

            $title = 'Tìm kiếm: ' . $tuKhoa . ' - ZAVYWEB';

        // Nếu có chọn danh mục
        } elseif ($danhMucId > 0) {

            $danhMuc = $this->danhMuc->timTheoId($danhMucId);

            if ($danhMuc === null) {
                http_response_code(404);
                echo '404 - Không tìm thấy danh mục';
                return;
            }

            $sanPhams = $this->sanPham->layTheoDanhMuc($danhMucId);

            $title = $danhMuc['ten_danh_muc'] . ' - ZAVYWEB';

        // Nếu chưa tìm kiếm và chưa chọn danh mục
        } else {

            // Hiển thị 6 sản phẩm mới nhất
            $sanPhams = $this->sanPham->lay6SanPham();

            $title = 'Sản phẩm - ZAVYWEB';
        }

        $contentView = __DIR__ . '/../views/san-pham/index.php';

        require_once __DIR__ . '/../views/layouts/layout.php';
    }

    // Hiển thị chi tiết sản phẩm
    public function chiTiet()
    {
        $id = isset($_GET['id'])
            ? (int) $_GET['id']
            : 0;

        if ($id <= 0) {
            http_response_code(404);
            echo '404 - Sản phẩm không hợp lệ';
            return;
        }

        $sanPham = $this->sanPham->timTheoId($id);

        if ($sanPham === null) {
            http_response_code(404);
            echo '404 - Không tìm thấy sản phẩm';
            return;
        }

        // Lấy các biến thể của sản phẩm
        $bienThes = $this->bienTheSanPham->layTheoSanPham($id);

        // Lấy đánh giá của sản phẩm
        $danhGias = $this->danhGia->layTheoSanPham($id);

        $title = $sanPham['ten_san_pham'] . ' - ZAVYWEB';

        $contentView = __DIR__ . '/../views/san-pham/chitiet.php';

        require_once __DIR__ . '/../views/layouts/layout.php';
    }

    // Xử lý gửi đánh giá
    public function themDanhGia()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Chưa đăng nhập
        if (!isset($_SESSION['khach_hang'])) {
            header('Location: index.php?url=dang-nhap');
            exit;
        }

        // Chỉ nhận POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?url=san-pham');
            exit;
        }

        $khachHangId = (int) $_SESSION['khach_hang']['id'];

        $sanPhamId = (int) ($_POST['san_pham_id'] ?? 0);

        $soSao = (int) ($_POST['so_sao'] ?? 0);

        $noiDung = trim($_POST['noi_dung'] ?? '');

        // Kiểm tra sản phẩm
        if ($sanPhamId <= 0) {
            http_response_code(400);
            echo 'Sản phẩm không hợp lệ.';
            return;
        }

        $sanPham = $this->sanPham->timTheoId($sanPhamId);

        if ($sanPham === null) {
            http_response_code(404);
            echo '404 - Không tìm thấy sản phẩm.';
            return;
        }

        // Kiểm tra số sao
        if ($soSao < 1 || $soSao > 5) {
            header(
                'Location: index.php?url=chi-tiet-san-pham&id='
                . $sanPhamId
            );
            exit;
        }

        // Kiểm tra nội dung
        if ($noiDung === '') {
            header(
                'Location: index.php?url=chi-tiet-san-pham&id='
                . $sanPhamId
            );
            exit;
        }

        // Thêm đánh giá
        $this->danhGia->them(
            $khachHangId,
            $sanPhamId,
            $soSao,
            $noiDung
        );

        // Quay lại trang chi tiết
        header(
            'Location: index.php?url=chi-tiet-san-pham&id='
            . $sanPhamId
        );

        exit;
    }
}