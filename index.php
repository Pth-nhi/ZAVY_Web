<?php

require_once __DIR__ . '/controllers/HomeController.php';
require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/controllers/SanPhamController.php';
require_once __DIR__ . '/controllers/GioHangController.php';
require_once __DIR__ . '/controllers/DonHangController.php';
require_once __DIR__ . '/controllers/LienHeController.php';
require_once __DIR__ . '/controllers/TaiKhoanController.php';
require_once __DIR__ . '/controllers/QuanLyDonHangController.php';

// =========================================================
// ADMIN
// =========================================================

require_once __DIR__ . '/controllers/AdminController.php';
require_once __DIR__ . '/controllers/AdminDanhMucController.php';
require_once __DIR__ . '/controllers/AdminSanPhamController.php';
require_once __DIR__ . '/controllers/AdminDonHangController.php';
require_once __DIR__ . '/controllers/AdminKhachHangController.php';
require_once __DIR__ . '/controllers/AdminThongKeController.php';


$url = $_GET['url'] ?? 'home';


switch ($url) {

    /* =========================================================
       TRANG CHỦ
       ========================================================= */

    case 'home':

        $controller = new HomeController();

        $controller->index();

        break;


    /* =========================================================
       SẢN PHẨM
       ========================================================= */

    // Danh sách sản phẩm
    case 'san-pham':

        $controller = new SanPhamController();

        $controller->index();

        break;


    // Chi tiết sản phẩm
    case 'chi-tiet-san-pham':

        $controller = new SanPhamController();

        $controller->chiTiet();

        break;


    // Thêm đánh giá
    case 'them-danh-gia':

        $controller = new SanPhamController();

        $controller->themDanhGia();

        break;


    /* =========================================================
       TÀI KHOẢN KHÁCH HÀNG
       ========================================================= */

    // Hiển thị đăng ký
    case 'dang-ky':

        $controller = new AuthController();

        $controller->dangKy();

        break;


    // Xử lý đăng ký
    case 'xu-ly-dang-ky':

        $controller = new AuthController();

        $controller->xuLyDangKy();

        break;


    // Hiển thị đăng nhập
    case 'dang-nhap':

        $controller = new AuthController();

        $controller->dangNhap();

        break;


    // Xử lý đăng nhập
    case 'xu-ly-dang-nhap':

        $controller = new AuthController();

        $controller->xuLyDangNhap();

        break;


    // Đăng xuất khách hàng
    case 'dang-xuat':

        $controller = new AuthController();

        $controller->dangXuat();

        break;


    /* =========================================================
       GIỎ HÀNG
       ========================================================= */

    // Xem giỏ hàng
    case 'gio-hang':

        $controller = new GioHangController();

        $controller->index();

        break;


    // Thêm sản phẩm vào giỏ hàng
    case 'them-gio-hang':

        $controller = new GioHangController();

        $controller->them();

        break;


    // Cập nhật số lượng trong giỏ hàng
    case 'cap-nhat-gio-hang':

        $controller = new GioHangController();

        $controller->capNhat();

        break;


    // Xóa sản phẩm khỏi giỏ hàng
    case 'xoa-gio-hang':

        $controller = new GioHangController();

        $controller->xoa();

        break;


    /* =========================================================
       ĐẶT HÀNG TỪ GIỎ HÀNG
       ========================================================= */

    // Hiển thị trang đặt hàng
    case 'dat-hang':

        $controller = new DonHangController();

        $controller->datHang();

        break;


    // Xử lý đặt hàng
    case 'xu-ly-dat-hang':

        $controller = new DonHangController();

        $controller->xuLyDatHang();

        break;


    /* =========================================================
       MUA NGAY
       ========================================================= */

    // Nhận sản phẩm và chuẩn bị dữ liệu mua ngay
    case 'mua-ngay':

        $controller = new DonHangController();

        $controller->muaNgay();

        break;


    // Hiển thị trang đặt hàng mua ngay
    case 'mua-ngay-dat-hang':

        $controller = new DonHangController();

        $controller->muaNgayDatHang();

        break;


    // Xử lý đặt hàng mua ngay
    case 'xu-ly-mua-ngay':

        $controller = new DonHangController();

        $controller->xuLyMuaNgay();

        break;


    /* =========================================================
       ĐƠN HÀNG KHÁCH HÀNG
       ========================================================= */

    // Đặt hàng thành công
    case 'dat-hang-thanh-cong':

        $controller = new DonHangController();

        $controller->datHangThanhCong();

        break;


    // Lịch sử đơn hàng
    case 'lich-su-don-hang':

        $controller = new DonHangController();

        $controller->lichSuDonHang();

        break;


    // Chi tiết đơn hàng
    case 'chi-tiet-don-hang':

        $controller = new DonHangController();

        $controller->chiTietDonHang();

        break;


    // Hủy đơn hàng
    case 'huy-don-hang':

        $controller = new DonHangController();

        $controller->huyDonHang();

        break;


    /* =========================================================
       KHÁCH HÀNG - QUẢN LÝ ĐƠN HÀNG
       ========================================================= */

    // Trang quản lý đơn hàng
    case 'quan-ly-don-hang':

        $controller = new QuanLyDonHangController();

        $controller->index();

        break;


    /* =========================================================
       LIÊN HỆ
       ========================================================= */

    // Hiển thị liên hệ
    case 'lien-he':

        $controller = new LienHeController();

        $controller->index();

        break;


    // Xử lý gửi liên hệ
    case 'xu-ly-lien-he':

        $controller = new LienHeController();

        $controller->xuLyGui();

        break;


    // Liên hệ thành công
    case 'lien-he-thanh-cong':

        $controller = new LienHeController();

        $controller->thanhCong();

        break;


    /* =========================================================
       TÀI KHOẢN KHÁCH HÀNG - THÔNG TIN
       ========================================================= */

    // Thông tin tài khoản
    case 'thong-tin-tai-khoan':

        $controller = new TaiKhoanController();

        $controller->thongTin();

        break;


    // Sửa tài khoản
    case 'sua-tai-khoan':

        $controller = new TaiKhoanController();

        $controller->sua();

        break;


    // Xử lý sửa tài khoản
    case 'xu-ly-sua-tai-khoan':

        $controller = new TaiKhoanController();

        $controller->xuLySua();

        break;


    // Xóa tài khoản
    case 'xoa-tai-khoan':

        $controller = new TaiKhoanController();

        $controller->xoa();

        break;


    /* =========================================================
       ADMIN
       ========================================================= */

    // Đăng nhập Admin
    case 'admin-dang-nhap':

        $controller = new AdminController();

        $controller->dangNhap();

        break;


    // Trang chủ Admin
    case 'admin':

        $controller = new AdminController();

        $controller->index();

        break;


    // Đăng xuất Admin
    case 'dang-xuat-admin':

        $controller = new AdminController();

        $controller->dangXuat();

        break;


    /* =========================================================
       ADMIN - QUẢN LÝ DANH MỤC
       ========================================================= */

    // Danh sách danh mục
    case 'admin-danh-muc':

        $controller = new AdminDanhMucController();

        $controller->index();

        break;


    // Form thêm danh mục
    case 'admin-them-danh-muc':

        $controller = new AdminDanhMucController();

        $controller->them();

        break;


    // Xử lý thêm danh mục
    case 'admin-xu-ly-them-danh-muc':

        $controller = new AdminDanhMucController();

        $controller->xuLyThem();

        break;


    // Form sửa danh mục
    case 'admin-sua-danh-muc':

        $controller = new AdminDanhMucController();

        $controller->sua();

        break;


    // Xử lý sửa danh mục
    case 'admin-xu-ly-sua-danh-muc':

        $controller = new AdminDanhMucController();

        $controller->xuLySua();

        break;


    // Xóa danh mục
    case 'admin-xoa-danh-muc':

        $controller = new AdminDanhMucController();

        $controller->xoa();

        break;


    /* =========================================================
       ADMIN - QUẢN LÝ SẢN PHẨM
       ========================================================= */

    // Danh sách sản phẩm
    case 'admin-san-pham':

        $controller = new AdminSanPhamController();

        $controller->index();

        break;


    // Form thêm sản phẩm
    case 'admin-them-san-pham':

        $controller = new AdminSanPhamController();

        $controller->them();

        break;


    // Xử lý thêm sản phẩm
    case 'admin-xu-ly-them-san-pham':

        $controller = new AdminSanPhamController();

        $controller->xuLyThem();

        break;


    // Form sửa sản phẩm
    case 'admin-sua-san-pham':

        $controller = new AdminSanPhamController();

        $controller->sua();

        break;


    // Xử lý sửa sản phẩm
    case 'admin-xu-ly-sua-san-pham':

        $controller = new AdminSanPhamController();

        $controller->xuLySua();

        break;


    // Xóa sản phẩm
    case 'admin-xoa-san-pham':

        $controller = new AdminSanPhamController();

        $controller->xoa();

        break;


    /* =========================================================
       ADMIN - QUẢN LÝ ĐƠN HÀNG
       ========================================================= */

    // Danh sách đơn hàng
    case 'admin-don-hang':

        $controller = new AdminDonHangController();

        $controller->index();

        break;


    // Chi tiết đơn hàng
    case 'admin-chi-tiet-don-hang':

        $controller = new AdminDonHangController();

        $controller->chiTiet();

        break;


    // Cập nhật trạng thái đơn hàng
    case 'admin-cap-nhat-trang-thai-don-hang':

        $controller = new AdminDonHangController();

        $controller->capNhatTrangThai();

        break;


    /* =========================================================
       ADMIN - QUẢN LÝ KHÁCH HÀNG
       ========================================================= */

    // Danh sách khách hàng
    case 'admin-khach-hang':

        $controller = new AdminKhachHangController();

        $controller->index();

        break;


    // Xóa khách hàng
    case 'admin-xoa-khach-hang':

        $controller = new AdminKhachHangController();

        $controller->xoa();

        break;


    /* =========================================================
       ADMIN - QUẢN LÝ THÔNG TIN CÁ NHÂN
       ========================================================= */

    // Xem thông tin cá nhân Admin
    case 'admin-tai-khoan':

        $controller = new AdminController();

        $controller->taiKhoan();

        break;


    // Form sửa thông tin cá nhân Admin
    case 'admin-sua-tai-khoan':

        $controller = new AdminController();

        $controller->suaTaiKhoan();

        break;


    // Xử lý sửa thông tin cá nhân Admin
    case 'admin-xu-ly-sua-tai-khoan':

        $controller = new AdminController();

        $controller->xuLySuaTaiKhoan();

        break;


    /* =========================================================
       ADMIN - THỐNG KÊ BÁO CÁO
       ========================================================= */

    case 'admin-thong-ke':

        $controller = new AdminThongKeController();

        $controller->index();

        break;


    /* =========================================================
       KHÔNG TÌM THẤY
       ========================================================= */

    default:

        http_response_code(404);

        echo '404 - Không tìm thấy trang';

        break;
}