<?php

require_once __DIR__ . '/../models/Database.php';
require_once __DIR__ . '/../models/SanPham.php';
require_once __DIR__ . '/../models/DanhMuc.php';

class AdminSanPhamController
{
    private PDO $db;
    private SanPham $sanPhamModel;
    private DanhMuc $danhMucModel;

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

        $this->sanPhamModel = new SanPham($this->db);
        $this->danhMucModel = new DanhMuc($this->db);
    }


    // =========================================================
    // HIỂN THỊ DANH SÁCH SẢN PHẨM
    // =========================================================

    public function index()
    {
        $sanPhams = $this->sanPhamModel->layTatCa();

        require __DIR__ . '/../views/admin/sanpham/index.php';
    }


    // =========================================================
    // HIỂN THỊ FORM THÊM SẢN PHẨM
    // =========================================================

    public function them()
    {
        $danhMucs = $this->danhMucModel->layTatCa();

        require __DIR__ . '/../views/admin/sanpham/them.php';
    }


    // =========================================================
    // XỬ LÝ THÊM SẢN PHẨM
    // =========================================================

    public function xuLyThem()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?url=admin-san-pham');
            exit;
        }

        // Lấy dữ liệu từ form
        $tenSanPham = trim($_POST['ten_san_pham'] ?? '');
        $danhMucId = (int) ($_POST['danh_muc_id'] ?? 0);
        $gia = (float) ($_POST['gia'] ?? 0);
        $moTa = trim($_POST['mo_ta'] ?? '');

        // Kiểm tra tên sản phẩm
        if ($tenSanPham === '') {
            die('Tên sản phẩm không được để trống.');
        }

        // Kiểm tra danh mục
        if ($danhMucId <= 0) {
            die('Vui lòng chọn danh mục sản phẩm.');
        }

        // Kiểm tra giá
        if ($gia < 0) {
            die('Giá sản phẩm không hợp lệ.');
        }


        // =====================================================
        // XỬ LÝ HÌNH ẢNH
        // =====================================================

        $hinhAnh = '';

        if (
            isset($_FILES['hinh_anh']) &&
            $_FILES['hinh_anh']['error'] !== UPLOAD_ERR_NO_FILE
        ) {

            $file = $_FILES['hinh_anh'];


            // Kiểm tra lỗi upload
            if ($file['error'] !== UPLOAD_ERR_OK) {
                die('Không thể tải hình ảnh lên.');
            }


            // Kiểm tra dung lượng tối đa 5MB
            if ($file['size'] > 5 * 1024 * 1024) {
                die('Hình ảnh không được lớn hơn 5MB.');
            }


            // Các định dạng được cho phép
            $allowedExtensions = [
                'jpg',
                'jpeg',
                'png',
                'webp'
            ];


            // Lấy phần mở rộng file
            $extension = strtolower(
                pathinfo(
                    $file['name'],
                    PATHINFO_EXTENSION
                )
            );


            // Kiểm tra phần mở rộng
            if (!in_array($extension, $allowedExtensions, true)) {
                die('Định dạng hình ảnh không được hỗ trợ.');
            }


            // Kiểm tra MIME thực tế
            $allowedMimeTypes = [
                'image/jpeg',
                'image/png',
                'image/webp'
            ];


            $mimeType = mime_content_type(
                $file['tmp_name']
            );


            if (!in_array($mimeType, $allowedMimeTypes, true)) {
                die('File được chọn không phải là hình ảnh hợp lệ.');
            }


            // =================================================
            // TẠO TÊN FILE MỚI
            // =================================================

            $tenFile = uniqid('sp_', true)
                . '.'
                . $extension;


            // =================================================
            // THƯ MỤC LƯU ẢNH
            // =================================================

            $thuMucUpload = __DIR__
                . '/../public/images/san-pham/';


            // Tạo thư mục nếu chưa tồn tại
            if (!is_dir($thuMucUpload)) {

                if (!mkdir(
                    $thuMucUpload,
                    0777,
                    true
                )) {

                    die('Không thể tạo thư mục lưu hình ảnh.');
                }
            }


            // Đường dẫn file cần lưu
            $duongDanFile = $thuMucUpload . $tenFile;


            // Di chuyển file upload vào thư mục
            if (!move_uploaded_file(
                $file['tmp_name'],
                $duongDanFile
            )) {

                die('Không thể lưu hình ảnh.');
            }


            // =================================================
            // LƯU ĐƯỜNG DẪN TƯƠNG ĐỐI VÀO DATABASE
            // =================================================

            $hinhAnh = 'san-pham/' . $tenFile;
        }


        // =====================================================
        // LƯU SẢN PHẨM VÀO DATABASE
        // =====================================================

        $this->sanPhamModel->them(
            $tenSanPham,
            $danhMucId,
            $gia,
            $moTa,
            $hinhAnh
        );


        // Quay lại danh sách sản phẩm
        header('Location: index.php?url=admin-san-pham');
        exit;
    }


    // =========================================================
    // HIỂN THỊ FORM SỬA SẢN PHẨM
    // =========================================================

    public function sua()
    {
        $id = (int) ($_GET['id'] ?? 0);

        if ($id <= 0) {
            die('ID sản phẩm không hợp lệ.');
        }

        $sanPham = $this->sanPhamModel->timTheoId($id);

        if (!$sanPham) {
            die('Không tìm thấy sản phẩm.');
        }

        $danhMucs = $this->danhMucModel->layTatCa();

        require __DIR__ . '/../views/admin/sanpham/sua.php';
    }


    // =========================================================
    // XỬ LÝ SỬA SẢN PHẨM
    // =========================================================

    public function xuLySua()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?url=admin-san-pham');
            exit;
        }

        // Lấy dữ liệu từ form
        $id = (int) ($_POST['id'] ?? 0);
        $tenSanPham = trim($_POST['ten_san_pham'] ?? '');
        $danhMucId = (int) ($_POST['danh_muc_id'] ?? 0);
        $gia = (float) ($_POST['gia'] ?? 0);
        $moTa = trim($_POST['mo_ta'] ?? '');


        // =====================================================
        // KIỂM TRA DỮ LIỆU
        // =====================================================

        if ($id <= 0) {
            die('ID sản phẩm không hợp lệ.');
        }

        if ($tenSanPham === '') {
            die('Tên sản phẩm không được để trống.');
        }

        if ($danhMucId <= 0) {
            die('Vui lòng chọn danh mục sản phẩm.');
        }

        if ($gia < 0) {
            die('Giá sản phẩm không hợp lệ.');
        }


        // =====================================================
        // LẤY SẢN PHẨM HIỆN TẠI
        // =====================================================

        $sanPham = $this->sanPhamModel->timTheoId($id);

        if (!$sanPham) {
            die('Không tìm thấy sản phẩm.');
        }


        // =====================================================
        // GIỮ ẢNH CŨ
        // =====================================================

        $hinhAnhCu = trim(
            $sanPham['hinh_anh'] ?? ''
        );

        $hinhAnh = $hinhAnhCu;


        // =====================================================
        // XỬ LÝ ẢNH MỚI
        // =====================================================

        if (
            isset($_FILES['hinh_anh']) &&
            $_FILES['hinh_anh']['error'] !== UPLOAD_ERR_NO_FILE
        ) {

            $file = $_FILES['hinh_anh'];


            // Kiểm tra lỗi upload
            if ($file['error'] !== UPLOAD_ERR_OK) {
                die('Không thể tải hình ảnh lên.');
            }


            // Kiểm tra dung lượng tối đa 5MB
            if ($file['size'] > 5 * 1024 * 1024) {
                die('Hình ảnh không được lớn hơn 5MB.');
            }


            // Các định dạng cho phép
            $allowedExtensions = [
                'jpg',
                'jpeg',
                'png',
                'webp'
            ];


            // Lấy phần mở rộng file
            $extension = strtolower(
                pathinfo(
                    $file['name'],
                    PATHINFO_EXTENSION
                )
            );


            // Kiểm tra phần mở rộng
            if (!in_array($extension, $allowedExtensions, true)) {
                die('Định dạng hình ảnh không được hỗ trợ.');
            }


            // MIME được phép
            $allowedMimeTypes = [
                'image/jpeg',
                'image/png',
                'image/webp'
            ];


            // Kiểm tra MIME thực tế
            $mimeType = mime_content_type(
                $file['tmp_name']
            );


            if (!in_array($mimeType, $allowedMimeTypes, true)) {
                die('File được chọn không phải là hình ảnh hợp lệ.');
            }


            // =================================================
            // TẠO TÊN FILE MỚI
            // =================================================

            $tenFile = uniqid('sp_', true)
                . '.'
                . $extension;


            // =================================================
            // THƯ MỤC LƯU ẢNH
            // =================================================

            $thuMucUpload = __DIR__
                . '/../public/images/san-pham/';


            // Tạo thư mục nếu chưa tồn tại
            if (!is_dir($thuMucUpload)) {

                if (!mkdir(
                    $thuMucUpload,
                    0777,
                    true
                )) {

                    die('Không thể tạo thư mục lưu hình ảnh.');
                }
            }


            // Đường dẫn file mới
            $duongDanFile = $thuMucUpload . $tenFile;


            // Lưu ảnh mới
            if (!move_uploaded_file(
                $file['tmp_name'],
                $duongDanFile
            )) {

                die('Không thể lưu hình ảnh.');
            }


            // Đường dẫn lưu vào Database
            $hinhAnh = 'san-pham/' . $tenFile;
        }


        // =====================================================
        // CẬP NHẬT SẢN PHẨM
        // =====================================================

        $capNhatThanhCong = $this->sanPhamModel->sua(
            $id,
            $tenSanPham,
            $danhMucId,
            $gia,
            $moTa,
            $hinhAnh
        );


        // =====================================================
        // NẾU CẬP NHẬT THÀNH CÔNG VÀ CÓ ẢNH MỚI
        // → XÓA ẢNH CŨ
        // =====================================================

        if (
            $capNhatThanhCong &&
            $hinhAnh !== $hinhAnhCu &&
            $hinhAnhCu !== ''
        ) {

            $duongDanAnhCu = __DIR__
                . '/../public/images/'
                . ltrim($hinhAnhCu, '/');


            if (is_file($duongDanAnhCu)) {
                unlink($duongDanAnhCu);
            }
        }


        // =====================================================
        // QUAY LẠI DANH SÁCH SẢN PHẨM
        // =====================================================

        header('Location: index.php?url=admin-san-pham');
        exit;
    }


    // =========================================================
    // XÓA SẢN PHẨM
    // =========================================================

    public function xoa()
    {
        $id = (int) ($_GET['id'] ?? 0);


        // Kiểm tra ID
        if ($id <= 0) {
            die('ID sản phẩm không hợp lệ.');
        }


        // Kiểm tra sản phẩm tồn tại
        $sanPham = $this->sanPhamModel->timTheoId($id);

        if (!$sanPham) {
            die('Không tìm thấy sản phẩm.');
        }


        // Xóa sản phẩm
        try {

            $this->sanPhamModel->xoa($id);

        } catch (PDOException $e) {

            die('Không thể xóa sản phẩm.');
        }


        // Quay lại danh sách
        header('Location: index.php?url=admin-san-pham');
        exit;
    }
}