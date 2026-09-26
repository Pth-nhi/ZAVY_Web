<?php

require_once __DIR__ . '/../models/Database.php';
require_once __DIR__ . '/../models/DonHang.php';

class AdminDonHangController
{
    private PDO $db;
    private DonHang $donHangModel;

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

        $this->donHangModel = new DonHang($this->db);
    }

    // Danh sách đơn hàng
    public function index()
    {
        $sql = "
            SELECT
                DonHang.*,
                KhachHang.ho_ten,
                KhachHang.email,
                HoaDon.ma_hoa_don,
                HoaDon.phuong_thuc_thanh_toan,
                HoaDon.trang_thai_thanh_toan
            FROM DonHang
            INNER JOIN KhachHang
                ON DonHang.khach_hang_id = KhachHang.id
            LEFT JOIN HoaDon
                ON HoaDon.don_hang_id = DonHang.id
            ORDER BY DonHang.id DESC
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        $donHangs = $stmt->fetchAll();

        require __DIR__ . '/../views/admin/donhang/index.php';
    }

    // Xem chi tiết đơn hàng
public function chiTiet()
{
    $id = (int) ($_GET['id'] ?? 0);

    if ($id <= 0) {
        die('ID đơn hàng không hợp lệ.');
    }

    // Lấy thông tin đơn hàng + khách hàng
    $sqlDonHang = "
        SELECT
            DonHang.*,
            KhachHang.ho_ten,
            KhachHang.email,
            HoaDon.id AS hoa_don_id,
            HoaDon.ma_hoa_don,
            HoaDon.tong_tien AS hoa_don_tong_tien,
            HoaDon.phuong_thuc_thanh_toan,
            HoaDon.trang_thai_thanh_toan,
            HoaDon.ngay_tao AS hoa_don_ngay_tao
        FROM DonHang
        INNER JOIN KhachHang
            ON DonHang.khach_hang_id = KhachHang.id
        LEFT JOIN HoaDon
            ON HoaDon.don_hang_id = DonHang.id
        WHERE DonHang.id = :id
        LIMIT 1
    ";

    $stmtDonHang = $this->db->prepare($sqlDonHang);

    $stmtDonHang->execute([
        ':id' => $id
    ]);

    $donHang = $stmtDonHang->fetch();

    if (!$donHang) {
        die('Không tìm thấy đơn hàng.');
    }

    // Lấy danh sách sản phẩm trong đơn
    $sqlChiTiet = "
        SELECT *
        FROM ChiTietDonHang
        WHERE don_hang_id = :don_hang_id
        ORDER BY id ASC
    ";

    $stmtChiTiet = $this->db->prepare($sqlChiTiet);

    $stmtChiTiet->execute([
        ':don_hang_id' => $id
    ]);

    $chiTietDonHangs = $stmtChiTiet->fetchAll();

    require __DIR__ . '/../views/admin/donhang/chitiet.php';
}

// Cập nhật trạng thái đơn hàng
public function capNhatTrangThai()
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: index.php?url=admin-don-hang');
        exit;
    }

    $id = (int) ($_POST['id'] ?? 0);
    $trangThai = trim($_POST['trang_thai'] ?? '');

    if ($id <= 0) {
        die('ID đơn hàng không hợp lệ.');
    }

    $cacTrangThaiHopLe = [
        'Chờ xác nhận',
        'Đã xác nhận',
        'Đang giao',
        'Đã giao',
        'Đã hủy'
    ];

    if (!in_array($trangThai, $cacTrangThaiHopLe, true)) {
        die('Trạng thái đơn hàng không hợp lệ.');
    }

    // Kiểm tra đơn hàng có tồn tại không
    $sqlKiemTra = "
        SELECT id
        FROM DonHang
        WHERE id = :id
        LIMIT 1
    ";

    $stmtKiemTra = $this->db->prepare($sqlKiemTra);

    $stmtKiemTra->execute([
        ':id' => $id
    ]);

    $donHang = $stmtKiemTra->fetch();

    if (!$donHang) {
        die('Không tìm thấy đơn hàng.');
    }

    // Cập nhật trạng thái
    $sql = "
        UPDATE DonHang
        SET trang_thai = :trang_thai
        WHERE id = :id
    ";

    $stmt = $this->db->prepare($sql);

    $stmt->execute([
        ':trang_thai' => $trangThai,
        ':id' => $id
    ]);

    header(
        'Location: index.php?url=admin-chi-tiet-don-hang&id='
        . $id
    );

    exit;
}
}