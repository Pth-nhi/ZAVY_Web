<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$khachHang = $_SESSION['khach_hang'] ?? null;

require_once __DIR__ . '/../../models/Database.php';
require_once __DIR__ . '/../../models/DanhMuc.php';

$db = Database::connect();

$danhMucModel = new DanhMuc($db);

$danhMucs = $danhMucModel->layTatCa();

?>

<!DOCTYPE html>
<html lang="vi">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title><?= $title ?? 'ZAVYWEB' ?></title>

    <link
        rel="stylesheet"
        href="/ZAVYWEB/public/css/style.css?v=3"
    >

</head>

<body>

<header>

    <!-- LOGO -->

    <div class="logo">

        <a href="index.php?url=home">

            <img
                src="public/images/logo.jpg"
                alt="ZAVYWEB"
            >

        </a>

    </div>


    <nav>

        <!-- TRANG CHỦ -->

        <a href="index.php?url=home">
            Trang chủ
        </a>


        <!-- SẢN PHẨM -->

        <div class="menu-san-pham">

            <a
                href="index.php?url=san-pham"
                class="menu-san-pham-link"
            >
                Sản phẩm
                <span class="menu-arrow">▼</span>
            </a>


            <div class="dropdown-danh-muc">

                <?php foreach ($danhMucs as $danhMuc): ?>

                    <a
                        href="index.php?url=san-pham&danh-muc=<?= (int) $danhMuc['id'] ?>"
                    >
                        <?= htmlspecialchars($danhMuc['ten_danh_muc']) ?>
                    </a>

                <?php endforeach; ?>

            </div>

        </div>


        <!-- THANH TÌM KIẾM -->

        <form
            action="index.php"
            method="GET"
            class="search-form"
        >

            <input
                type="hidden"
                name="url"
                value="san-pham"
            >

            <input
                type="text"
                name="tu-khoa"
                class="search-input"
                placeholder="Tìm sản phẩm..."
                value="<?= htmlspecialchars($_GET['tu-khoa'] ?? '') ?>"
            >

        </form>


        <!-- GIỎ HÀNG -->

        <a href="index.php?url=gio-hang">
            Giỏ hàng
        </a>


        <!-- QUẢN LÝ ĐƠN HÀNG -->

        <a href="index.php?url=quan-ly-don-hang">
            Quản lý đơn hàng
        </a>


        <!-- LIÊN HỆ -->

        <a href="index.php?url=lien-he">
            Liên hệ
        </a>


        <?php if ($khachHang !== null): ?>

            <!-- AVATAR TÀI KHOẢN -->

            <a
                href="index.php?url=thong-tin-tai-khoan"
                class="account-avatar"
                title="Thông tin tài khoản"
            >
                <span class="avatar-icon">
                    👤
                </span>
            </a>


            <!-- ĐĂNG XUẤT -->

            <a href="index.php?url=dang-xuat">
                Đăng xuất
            </a>

        <?php else: ?>

            <!-- ĐĂNG NHẬP -->

            <a href="index.php?url=dang-nhap">
                Đăng nhập
            </a>


            <!-- ĐĂNG KÝ -->

            <a href="index.php?url=dang-ky">
                Đăng ký
            </a>

        <?php endif; ?>

    </nav>

</header>

<main>