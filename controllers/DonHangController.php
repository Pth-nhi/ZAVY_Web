<?php

require_once __DIR__ . '/../models/Database.php';
require_once __DIR__ . '/../models/SanPham.php';
require_once __DIR__ . '/../models/GioHang.php';
require_once __DIR__ . '/../models/ChiTietGioHang.php';
require_once __DIR__ . '/../models/BienTheSanPham.php';
require_once __DIR__ . '/../models/DonHang.php';
require_once __DIR__ . '/../models/ChiTietDonHang.php';
require_once __DIR__ . '/../models/HoaDon.php';

class DonHangController
{
    private PDO $db;
    private SanPham $sanPham;
    private GioHang $gioHang;
    private ChiTietGioHang $chiTietGioHang;
    private BienTheSanPham $bienTheSanPham;
    private DonHang $donHang;
    private ChiTietDonHang $chiTietDonHang;
    private HoaDon $hoaDon;

    public function __construct()
    {
        $this->db = Database::connect();

        $this->sanPham = new SanPham($this->db);
        $this->gioHang = new GioHang($this->db);
        $this->chiTietGioHang = new ChiTietGioHang($this->db);
        $this->bienTheSanPham = new BienTheSanPham($this->db);
        $this->donHang = new DonHang($this->db);
        $this->chiTietDonHang = new ChiTietDonHang($this->db);
        $this->hoaDon = new HoaDon($this->db);
    }


    /* =========================================================
       ĐẶT HÀNG TỪ GIỎ HÀNG
       ========================================================= */

    public function datHang()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['khach_hang'])) {
            header('Location: index.php?url=dang-nhap');
            exit;
        }

        /*
         * NHẬN DANH SÁCH SẢN PHẨM ĐƯỢC CHỌN
         */

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $selectedIds = $_POST['selected_ids'] ?? [];

            if (!is_array($selectedIds)) {
                $selectedIds = [];
            }

            $selectedIds = array_map(
                'intval',
                $selectedIds
            );

            $selectedIds = array_values(
                array_unique(
                    array_filter(
                        $selectedIds,
                        function ($id) {
                            return $id > 0;
                        }
                    )
                )
            );

            if (empty($selectedIds)) {
                header(
                    'Location: index.php?url=gio-hang'
                );
                exit;
            }

            /*
             * Lưu sản phẩm được chọn vào Session
             */

            $_SESSION['san_pham_dat_hang'] = $selectedIds;
        }

        /*
         * Nếu không có sản phẩm được chọn
         */

        if (
            empty(
                $_SESSION['san_pham_dat_hang']
                ?? []
            )
        ) {
            header(
                'Location: index.php?url=gio-hang'
            );
            exit;
        }

        $khachHangId =
            (int) $_SESSION['khach_hang']['id'];

        /*
         * Lấy giỏ hàng
         */

        $gioHang =
            $this->gioHang
                ->timTheoKhachHang($khachHangId);

        if ($gioHang === null) {

            unset(
                $_SESSION['san_pham_dat_hang']
            );

            header(
                'Location: index.php?url=gio-hang'
            );

            exit;
        }

        /*
         * Lấy toàn bộ sản phẩm trong giỏ
         */

        $tatCaChiTiet =
            $this->chiTietGioHang
                ->layTheoGioHang(
                    (int) $gioHang['id']
                );

        if (empty($tatCaChiTiet)) {

            unset(
                $_SESSION['san_pham_dat_hang']
            );

            header(
                'Location: index.php?url=gio-hang'
            );

            exit;
        }

        /*
         * Lọc chỉ sản phẩm được chọn
         */

        $selectedIds =
            $_SESSION['san_pham_dat_hang'];

        $chiTietGioHang = [];

        foreach ($tatCaChiTiet as $item) {

            if (
                in_array(
                    (int) $item['id'],
                    $selectedIds,
                    true
                )
            ) {
                $chiTietGioHang[] = $item;
            }
        }

        /*
         * Nếu sản phẩm được chọn không còn trong giỏ
         */

        if (empty($chiTietGioHang)) {

            unset(
                $_SESSION['san_pham_dat_hang']
            );

            header(
                'Location: index.php?url=gio-hang'
            );

            exit;
        }

        /*
         * Tính tổng tiền sản phẩm được chọn
         */

        $tongTien = 0;

        foreach ($chiTietGioHang as $item) {

            $tongTien +=
                (float) $item['gia']
                * (int) $item['so_luong'];
        }

        $title =
            'Đặt hàng - ZAVYWEB';

        /*
         * ĐƯỜNG DẪN ĐÚNG ĐẾN VIEW
         *
         * layout.php đang require trực tiếp
         * $contentView nên phải truyền đường dẫn đầy đủ.
         */

        $contentView =
            __DIR__
            . '/../views/don-hang/dat-hang.php';

        require_once
            __DIR__
            . '/../views/layouts/layout.php';
    }


    /* =========================================================
       XỬ LÝ ĐẶT HÀNG TỪ GIỎ HÀNG
       ========================================================= */

    public function xuLyDatHang()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['khach_hang'])) {
            header(
                'Location: index.php?url=dang-nhap'
            );
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header(
                'Location: index.php?url=gio-hang'
            );
            exit;
        }

        /*
         * Lấy danh sách sản phẩm đã chọn
         */

        $selectedIds =
            $_SESSION['san_pham_dat_hang']
            ?? [];

        if (
            !is_array($selectedIds)
            || empty($selectedIds)
        ) {
            header(
                'Location: index.php?url=gio-hang'
            );
            exit;
        }

        $selectedIds = array_map(
            'intval',
            $selectedIds
        );

        $selectedIds = array_values(
            array_unique(
                array_filter(
                    $selectedIds,
                    function ($id) {
                        return $id > 0;
                    }
                )
            )
        );

        if (empty($selectedIds)) {

            unset(
                $_SESSION['san_pham_dat_hang']
            );

            header(
                'Location: index.php?url=gio-hang'
            );

            exit;
        }

        $khachHangId =
            (int) $_SESSION['khach_hang']['id'];

        /*
         * Thông tin giao hàng
         */

        $diaChiGiaoHang =
            trim(
                $_POST['dia_chi_giao_hang'] ?? ''
            );

        $soDienThoai =
            trim(
                $_POST['so_dien_thoai'] ?? ''
            );

        $phuongThucThanhToan =
            trim(
                $_POST['phuong_thuc_thanh_toan'] ?? ''
            );

        if (
            $diaChiGiaoHang === ''
            || $soDienThoai === ''
            || $phuongThucThanhToan === ''
        ) {
            header(
                'Location: index.php?url=dat-hang'
            );
            exit;
        }

        /*
         * Lấy giỏ hàng
         */

        $gioHang =
            $this->gioHang
                ->timTheoKhachHang($khachHangId);

        if ($gioHang === null) {

            unset(
                $_SESSION['san_pham_dat_hang']
            );

            header(
                'Location: index.php?url=gio-hang'
            );

            exit;
        }

        /*
         * Lấy toàn bộ sản phẩm trong giỏ
         */

        $tatCaChiTiet =
            $this->chiTietGioHang
                ->layTheoGioHang(
                    (int) $gioHang['id']
                );

        /*
         * Lọc chỉ sản phẩm được chọn
         */

        $chiTietGioHang = [];

        foreach ($tatCaChiTiet as $item) {

            if (
                in_array(
                    (int) $item['id'],
                    $selectedIds,
                    true
                )
            ) {
                $chiTietGioHang[] = $item;
            }
        }

        if (empty($chiTietGioHang)) {

            unset(
                $_SESSION['san_pham_dat_hang']
            );

            header(
                'Location: index.php?url=gio-hang'
            );

            exit;
        }

        /*
         * Kiểm tra tồn kho và tính tổng tiền
         */

        $tongTien = 0;

        foreach ($chiTietGioHang as $item) {

            $soLuong =
                (int) $item['so_luong'];

            $tonKho =
                (int) $item['ton_kho'];

            if (
                $soLuong <= 0
                || $soLuong > $tonKho
            ) {
                header(
                    'Location: index.php?url=gio-hang'
                );
                exit;
            }

            $tongTien +=
                (float) $item['gia']
                * $soLuong;
        }

        /*
         * Bắt đầu transaction
         */

        $this->db->beginTransaction();

        try {

            /*
             * Tạo đơn hàng
             */

            $donHangId =
                $this->donHang
                    ->taoDonHang(
                        $khachHangId,
                        $tongTien,
                        $diaChiGiaoHang,
                        $soDienThoai
                    );

            /*
             * Lưu chi tiết đơn hàng
             * và trừ tồn kho
             */

            foreach ($chiTietGioHang as $item) {

                $soLuong =
                    (int) $item['so_luong'];

                /*
                 * Trừ tồn kho
                 */

                $giamTonKho =
                    $this->bienTheSanPham
                        ->giamTonKho(
                            (int) $item[
                                'bien_the_san_pham_id'
                            ],
                            $soLuong
                        );

                if (!$giamTonKho) {

                    throw new Exception(
                        'Sản phẩm "'
                        . $item['ten_san_pham']
                        . '" không đủ tồn kho.'
                    );
                }

                /*
                 * Thành tiền
                 */

                $thanhTien =
                    (float) $item['gia']
                    * $soLuong;

                /*
                 * Lưu chi tiết đơn hàng
                 */

                $this->chiTietDonHang->them(
                    $donHangId,
                    (int) $item[
                        'bien_the_san_pham_id'
                    ],
                    $item['ten_san_pham'],
                    $item['size'],
                    $item['mau_sac'],
                    (float) $item['gia'],
                    $soLuong,
                    $thanhTien
                );
            }

            /*
             * Tạo mã hóa đơn
             */

            $maHoaDon =
                'HD'
                . date('YmdHis')
                . $donHangId;

            /*
             * Tạo hóa đơn
             */

            $this->hoaDon
                ->taoHoaDon(
                    $donHangId,
                    $maHoaDon,
                    $tongTien,
                    $phuongThucThanhToan
                );

            /*
             * XÓA CHỈ SẢN PHẨM ĐÃ ĐẶT
             *
             * Các sản phẩm chưa chọn
             * vẫn giữ nguyên trong giỏ hàng.
             */

            foreach ($chiTietGioHang as $item) {

                $sqlXoa = "
                    DELETE FROM ChiTietGioHang
                    WHERE id = :id
                    AND gio_hang_id = :gio_hang_id
                ";

                $stmtXoa =
                    $this->db
                        ->prepare($sqlXoa);

                $stmtXoa->execute([
                    ':id' =>
                        (int) $item['id'],

                    ':gio_hang_id' =>
                        (int) $gioHang['id']
                ]);
            }

            /*
             * Xóa danh sách sản phẩm đã chọn
             * khỏi Session
             */

            unset(
                $_SESSION['san_pham_dat_hang']
            );

            /*
             * Hoàn tất transaction
             */

            $this->db->commit();

            /*
             * Chuyển đến trang thành công
             */

            header(
                'Location: index.php?url=dat-hang-thanh-cong&id='
                . $donHangId
            );

            exit;

        } catch (Exception $e) {

            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }

            die(
                'Đặt hàng không thành công: '
                . $e->getMessage()
            );
        }
    }


    /* =========================================================
       MUA NGAY
       ========================================================= */

    public function muaNgay()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['khach_hang'])) {
            header('Location: index.php?url=dang-nhap');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?url=san-pham');
            exit;
        }

        $sanPhamId =
            isset($_POST['san_pham_id'])
                ? (int) $_POST['san_pham_id']
                : 0;

        $size =
            trim(
                $_POST['size'] ?? ''
            );

        $mauSac =
            trim(
                $_POST['mau_sac'] ?? ''
            );

        $soLuong =
            isset($_POST['so_luong'])
                ? (int) $_POST['so_luong']
                : 0;

        if (
            $sanPhamId <= 0
            || $size === ''
            || $mauSac === ''
            || $soLuong <= 0
        ) {
            header(
                'Location: index.php?url=chi-tiet-san-pham&id='
                . $sanPhamId
            );
            exit;
        }

        $bienThe =
            $this->bienTheSanPham
                ->timTheoSanPhamSizeMau(
                    $sanPhamId,
                    $size,
                    $mauSac
                );

        if ($bienThe === null) {
            header(
                'Location: index.php?url=chi-tiet-san-pham&id='
                . $sanPhamId
            );
            exit;
        }

        if (
            $soLuong >
            (int) $bienThe['so_luong']
        ) {
            header(
                'Location: index.php?url=chi-tiet-san-pham&id='
                . $sanPhamId
            );
            exit;
        }

        $_SESSION['mua_ngay'] = [
            'san_pham_id' =>
                $sanPhamId,

            'bien_the_san_pham_id' =>
                (int) $bienThe['id'],

            'size' =>
                $size,

            'mau_sac' =>
                $mauSac,

            'so_luong' =>
                $soLuong
        ];

        header(
            'Location: index.php?url=mua-ngay-dat-hang'
        );

        exit;
    }


    /* =========================================================
       TRANG XÁC NHẬN MUA NGAY
       ========================================================= */

    public function muaNgayDatHang()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['khach_hang'])) {
            header('Location: index.php?url=dang-nhap');
            exit;
        }

        if (!isset($_SESSION['mua_ngay'])) {
            header('Location: index.php?url=san-pham');
            exit;
        }

        $muaNgay =
            $_SESSION['mua_ngay'];

        $sanPhamId =
            (int) $muaNgay['san_pham_id'];

        $bienTheId =
            (int) $muaNgay['bien_the_san_pham_id'];

        $size =
            $muaNgay['size'];

        $mauSac =
            $muaNgay['mau_sac'];

        $soLuong =
            (int) $muaNgay['so_luong'];

        $sanPham =
            $this->sanPham
                ->timTheoId($sanPhamId);

        if ($sanPham === null) {

            unset(
                $_SESSION['mua_ngay']
            );

            header(
                'Location: index.php?url=san-pham'
            );

            exit;
        }

        $bienThe =
            $this->bienTheSanPham
                ->timTheoId($bienTheId);

        if ($bienThe === null) {

            unset(
                $_SESSION['mua_ngay']
            );

            header(
                'Location: index.php?url=chi-tiet-san-pham&id='
                . $sanPhamId
            );

            exit;
        }

        if (
            $soLuong <= 0
            || $soLuong > (int) $bienThe['so_luong']
        ) {

            unset(
                $_SESSION['mua_ngay']
            );

            header(
                'Location: index.php?url=chi-tiet-san-pham&id='
                . $sanPhamId
            );

            exit;
        }

        $tongTien =
            (float) $sanPham['gia']
            * $soLuong;

        $title =
            'Mua ngay - ZAVYWEB';

        $contentView =
            __DIR__
            . '/../views/don-hang/mua-ngay-dat-hang.php';

        require_once
            __DIR__
            . '/../views/layouts/layout.php';
    }


    /* =========================================================
       XỬ LÝ ĐẶT HÀNG MUA NGAY
       ========================================================= */

    public function xuLyMuaNgay()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['khach_hang'])) {
            header('Location: index.php?url=dang-nhap');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?url=san-pham');
            exit;
        }

        if (!isset($_SESSION['mua_ngay'])) {
            header('Location: index.php?url=san-pham');
            exit;
        }

        $khachHangId =
            (int) $_SESSION['khach_hang']['id'];

        $diaChiGiaoHang =
            trim(
                $_POST['dia_chi_giao_hang'] ?? ''
            );

        $soDienThoai =
            trim(
                $_POST['so_dien_thoai'] ?? ''
            );

        $phuongThucThanhToan =
            trim(
                $_POST['phuong_thuc_thanh_toan'] ?? ''
            );

        if (
            $diaChiGiaoHang === ''
            || $soDienThoai === ''
            || $phuongThucThanhToan === ''
        ) {
            header(
                'Location: index.php?url=mua-ngay-dat-hang'
            );
            exit;
        }

        $muaNgay =
            $_SESSION['mua_ngay'];

        $sanPhamId =
            (int) $muaNgay['san_pham_id'];

        $bienTheId =
            (int) $muaNgay['bien_the_san_pham_id'];

        $size =
            $muaNgay['size'];

        $mauSac =
            $muaNgay['mau_sac'];

        $soLuong =
            (int) $muaNgay['so_luong'];

        if ($soLuong <= 0) {

            unset(
                $_SESSION['mua_ngay']
            );

            header(
                'Location: index.php?url=chi-tiet-san-pham&id='
                . $sanPhamId
            );

            exit;
        }

        $sanPham =
            $this->sanPham
                ->timTheoId($sanPhamId);

        if ($sanPham === null) {

            unset(
                $_SESSION['mua_ngay']
            );

            header(
                'Location: index.php?url=san-pham'
            );

            exit;
        }

        $bienThe =
            $this->bienTheSanPham
                ->timTheoId($bienTheId);

        if ($bienThe === null) {

            unset(
                $_SESSION['mua_ngay']
            );

            header(
                'Location: index.php?url=chi-tiet-san-pham&id='
                . $sanPhamId
            );

            exit;
        }

        if (
            (int) $bienThe['san_pham_id']
            !== $sanPhamId
        ) {

            unset(
                $_SESSION['mua_ngay']
            );

            header(
                'Location: index.php?url=chi-tiet-san-pham&id='
                . $sanPhamId
            );

            exit;
        }

        if (
            $soLuong >
            (int) $bienThe['so_luong']
        ) {
            header(
                'Location: index.php?url=mua-ngay-dat-hang'
            );
            exit;
        }

        $tongTien =
            (float) $sanPham['gia']
            * $soLuong;

        $this->db->beginTransaction();

        try {

            $donHangId =
                $this->donHang
                    ->taoDonHang(
                        $khachHangId,
                        $tongTien,
                        $diaChiGiaoHang,
                        $soDienThoai
                    );

            $giamTonKho =
                $this->bienTheSanPham
                    ->giamTonKho(
                        $bienTheId,
                        $soLuong
                    );

            if (!$giamTonKho) {
                throw new Exception(
                    'Sản phẩm không đủ tồn kho.'
                );
            }

            $thanhTien =
                (float) $sanPham['gia']
                * $soLuong;

            $this->chiTietDonHang->them(
                $donHangId,
                $bienTheId,
                $sanPham['ten_san_pham'],
                $size,
                $mauSac,
                (float) $sanPham['gia'],
                $soLuong,
                $thanhTien
            );

            $maHoaDon =
                'HD'
                . date('YmdHis')
                . $donHangId;

            $this->hoaDon->taoHoaDon(
                $donHangId,
                $maHoaDon,
                $tongTien,
                $phuongThucThanhToan
            );

            unset(
                $_SESSION['mua_ngay']
            );

            $this->db->commit();

            header(
                'Location: index.php?url=dat-hang-thanh-cong&id='
                . $donHangId
            );

            exit;

        } catch (Exception $e) {

            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }

            die(
                'Mua ngay không thành công: '
                . $e->getMessage()
            );
        }
    }


    /* =========================================================
       ĐẶT HÀNG THÀNH CÔNG
       ========================================================= */

    public function datHangThanhCong()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['khach_hang'])) {
            header('Location: index.php?url=dang-nhap');
            exit;
        }

        $donHangId =
            isset($_GET['id'])
                ? (int) $_GET['id']
                : 0;

        if ($donHangId <= 0) {
            header(
                'Location: index.php?url=gio-hang'
            );
            exit;
        }

        $donHang =
            $this->donHang
                ->timTheoId($donHangId);

        if ($donHang === null) {
            header(
                'Location: index.php?url=gio-hang'
            );
            exit;
        }

        if (
            (int) $donHang['khach_hang_id']
            !== (int) $_SESSION['khach_hang']['id']
        ) {

            http_response_code(403);

            echo
                '403 - Bạn không có quyền xem đơn hàng này.';

            return;
        }

        $title =
            'Đặt hàng thành công - ZAVYWEB';

        $contentView =
            __DIR__
            . '/../views/don-hang/thanh-cong.php';

        require_once
            __DIR__
            . '/../views/layouts/layout.php';
    }


    /* =========================================================
       LỊCH SỬ ĐƠN HÀNG
       ========================================================= */

    public function lichSuDonHang()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['khach_hang'])) {
            header('Location: index.php?url=dang-nhap');
            exit;
        }

        $khachHangId =
            (int) $_SESSION['khach_hang']['id'];

        $donHangs =
            $this->donHang
                ->layTheoKhachHang($khachHangId);

        $title =
            'Lịch sử đơn hàng - ZAVYWEB';

        $contentView =
            __DIR__
            . '/../views/don-hang/lich-su.php';

        require_once
            __DIR__
            . '/../views/layouts/layout.php';
    }


    /* =========================================================
       CHI TIẾT ĐƠN HÀNG
       ========================================================= */

    public function chiTietDonHang()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['khach_hang'])) {
            header('Location: index.php?url=dang-nhap');
            exit;
        }

        $donHangId =
            isset($_GET['id'])
                ? (int) $_GET['id']
                : 0;

        if ($donHangId <= 0) {
            header(
                'Location: index.php?url=lich-su-don-hang'
            );
            exit;
        }

        $donHang =
            $this->donHang
                ->timTheoId($donHangId);

        if ($donHang === null) {

            http_response_code(404);

            echo
                '404 - Không tìm thấy đơn hàng';

            return;
        }

        if (
            (int) $donHang['khach_hang_id']
            !== (int) $_SESSION['khach_hang']['id']
        ) {

            http_response_code(403);

            echo
                '403 - Bạn không có quyền xem đơn hàng này.';

            return;
        }

        $chiTietDonHang =
            $this->chiTietDonHang
                ->layTheoDonHang($donHangId);

        $hoaDon =
            $this->hoaDon
                ->timTheoDonHang($donHangId);

        $title =
            'Chi tiết đơn hàng - ZAVYWEB';

        $contentView =
            __DIR__
            . '/../views/don-hang/chitiet.php';

        require_once
            __DIR__
            . '/../views/layouts/layout.php';
    }


    /* =========================================================
       HỦY ĐƠN HÀNG
       ========================================================= */

    public function huyDonHang()
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
                'Location: index.php?url=lich-su-don-hang'
            );
            exit;
        }

        $khachHangId =
            (int) $_SESSION['khach_hang']['id'];

        $donHangId =
            isset($_POST['id'])
                ? (int) $_POST['id']
                : 0;

        if ($donHangId <= 0) {
            header(
                'Location: index.php?url=lich-su-don-hang'
            );
            exit;
        }

        $donHang =
            $this->donHang
                ->timTheoId($donHangId);

        if ($donHang === null) {

            http_response_code(404);

            echo
                '404 - Không tìm thấy đơn hàng';

            return;
        }

        if (
            (int) $donHang['khach_hang_id']
            !== $khachHangId
        ) {

            http_response_code(403);

            echo
                '403 - Bạn không có quyền hủy đơn hàng này.';

            return;
        }

        if (
            $donHang['trang_thai']
            !== 'Chờ xác nhận'
        ) {

            header(
                'Location: index.php?url=lich-su-don-hang'
            );

            exit;
        }

        $chiTietDonHang =
            $this->chiTietDonHang
                ->layTheoDonHang($donHangId);

        if (empty($chiTietDonHang)) {

            header(
                'Location: index.php?url=lich-su-don-hang'
            );

            exit;
        }

        $this->db->beginTransaction();

        try {

            foreach ($chiTietDonHang as $item) {

                $soLuong =
                    (int) $item['so_luong'];

                if ($soLuong <= 0) {

                    throw new Exception(
                        'Số lượng sản phẩm trong đơn hàng không hợp lệ.'
                    );
                }

                $tangTonKho =
                    $this->bienTheSanPham
                        ->tangTonKho(
                            (int) $item[
                                'bien_the_san_pham_id'
                            ],
                            $soLuong
                        );

                if (!$tangTonKho) {

                    throw new Exception(
                        'Không thể hoàn lại tồn kho.'
                    );
                }
            }

            $huyDonHang =
                $this->donHang
                    ->huyDonHang(
                        $donHangId,
                        $khachHangId
                    );

            if (!$huyDonHang) {

                throw new Exception(
                    'Không thể hủy đơn hàng.'
                );
            }

            $this->db->commit();

            header(
                'Location: index.php?url=lich-su-don-hang'
            );

            exit;

        } catch (Exception $e) {

            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }

            die(
                'Hủy đơn hàng không thành công: '
                . $e->getMessage()
            );
        }
    }
}