<?php

$title = 'Trang chủ Admin - ZAVYWEB';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$admin = $_SESSION['admin'] ?? null;

// Nếu chưa đăng nhập Admin thì quay về trang đăng nhập
if ($admin === null) {
    header('Location: index.php?url=admin-dang-nhap');
    exit;
}

?>

<!DOCTYPE html>
<html lang="vi">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= htmlspecialchars($title) ?></title>

    <link
        rel="stylesheet"
        href="/ZAVYWEB/public/css/style.css?v=4"
    >

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;

            font-family: Arial, sans-serif;

            background: #f5f5f5;

            color: #222222;
        }

        /* =========================================
           TRANG ADMIN
           ========================================= */

        .admin-page {
            min-height: 100vh;
        }


        /* =========================================
           HEADER ADMIN
           ========================================= */

        .admin-header {
            height: 70px;

            background: #ffffff;

            display: flex;

            align-items: center;

            justify-content: space-between;

            padding: 0 40px;

            border-bottom: 1px solid #dddddd;

            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }


        /* Logo */

        .admin-logo {
            display: flex;

            align-items: center;

            gap: 12px;
        }

        .admin-logo img {
            width: 48px;

            height: 48px;

            object-fit: cover;

            border-radius: 6px;
        }

        .admin-logo span {
            font-size: 22px;

            font-weight: bold;

            color: #6a1b9a;
        }


        /* Thông tin Admin */

        .admin-header-right {
            display: flex;

            align-items: center;

            gap: 20px;
        }

        .admin-welcome {
            color: #333333;

            font-size: 15px;
        }

        .admin-welcome strong {
            color: #6a1b9a;
        }


        /* Nút đăng xuất */

        .admin-logout {
            padding: 9px 16px;

            background: #6a1b9a;

            color: #ffffff;

            text-decoration: none;

            border-radius: 6px;

            font-weight: bold;

            transition: 0.2s;
        }

        .admin-logout:hover {
            background: #4a126b;
        }


        /* =========================================
           NỘI DUNG
           ========================================= */

        .admin-content {
            padding: 40px;
        }

        .admin-title {
            margin: 0 0 10px;

            font-size: 30px;

            color: #222222;
        }

        .admin-subtitle {
            margin: 0 0 30px;

            color: #666666;

            font-size: 16px;
        }


        /* =========================================
           MENU CHỨC NĂNG
           ========================================= */

        .admin-menu {
            display: grid;

            grid-template-columns: repeat(3, 1fr);

            gap: 25px;

            max-width: 1100px;
        }


        /* Card */

        .admin-card {
            display: block;

            background: #ffffff;

            padding: 30px;

            border-radius: 10px;

            border: 1px solid #e0e0e0;

            text-decoration: none;

            color: #222222;

            transition: 0.2s;
        }

        .admin-card:hover {
            transform: translateY(-3px);

            border-color: #6a1b9a;

            box-shadow:
                0 5px 18px rgba(0, 0, 0, 0.08);
        }


        /* Icon */

        .admin-card-icon {
            width: 50px;

            height: 50px;

            display: flex;

            align-items: center;

            justify-content: center;

            background: #f0e6f5;

            border-radius: 8px;

            color: #6a1b9a;

            font-size: 24px;

            margin-bottom: 18px;
        }


        /* Tiêu đề card */

        .admin-card h3 {
            margin: 0 0 8px;

            font-size: 19px;

            color: #222222;
        }


        /* Mô tả */

        .admin-card p {
            margin: 0;

            color: #666666;

            font-size: 14px;

            line-height: 1.5;
        }


        /* =========================================
           RESPONSIVE
           ========================================= */

        @media (max-width: 900px) {

            .admin-menu {
                grid-template-columns: repeat(2, 1fr);
            }

        }


        @media (max-width: 600px) {

            .admin-header {
                padding: 0 20px;
            }

            .admin-welcome {
                display: none;
            }

            .admin-content {
                padding: 25px 20px;
            }

            .admin-menu {
                grid-template-columns: 1fr;
            }

            .admin-logo span {
                font-size: 18px;
            }

        }

    </style>

</head>


<body>

<div class="admin-page">


    <!-- =========================================
         HEADER ADMIN
         ========================================= -->

    <header class="admin-header">


        <!-- Logo -->

        <div class="admin-logo">

            <img
                src="public/images/logo.jpg"
                alt="ZAVYWEB"
            >

            <span>
                ZAVYWEB ADMIN
            </span>

        </div>


        <!-- Thông tin Admin -->

        <div class="admin-header-right">

            <div class="admin-welcome">

                Xin chào,

                <strong>
                    <?= htmlspecialchars($admin['ho_ten']) ?>
                </strong>

            </div>


            <a
                href="index.php?url=dang-xuat-admin"
                class="admin-logout"
            >
                Đăng xuất
            </a>

        </div>


    </header>


    <!-- =========================================
         NỘI DUNG TRANG CHỦ
         ========================================= -->

    <main class="admin-content">


        <h1 class="admin-title">
            Trang chủ Admin
        </h1>


        <p class="admin-subtitle">
            Quản lý hoạt động của website ZAVYWEB
        </p>


        <!-- =====================================
             CÁC CHỨC NĂNG ADMIN
             ===================================== -->

        <div class="admin-menu">


            <!-- 1. QUẢN LÝ DANH MỤC -->

            <a
                href="index.php?url=admin-danh-muc"
                class="admin-card"
            >

                <div class="admin-card-icon">
                    ☰
                </div>

                <h3>
                    Quản lý danh mục
                </h3>

                <p>
                    Thêm, sửa và xóa danh mục sản phẩm.
                </p>

            </a>


            <!-- 2. QUẢN LÝ SẢN PHẨM -->

            <a
                href="index.php?url=admin-san-pham"
                class="admin-card"
            >

                <div class="admin-card-icon">
                    ◈
                </div>

                <h3>
                    Quản lý sản phẩm
                </h3>

                <p>
                    Thêm, sửa và xóa sản phẩm trong hệ thống.
                </p>

            </a>


            <!-- 3. QUẢN LÝ KHÁCH HÀNG -->

            <a
                href="index.php?url=admin-khach-hang"
                class="admin-card"
            >

                <div class="admin-card-icon">
                    👥
                </div>

                <h3>
                    Quản lý khách hàng
                </h3>

                <p>
                    Xem và quản lý thông tin khách hàng của website.
                </p>

            </a>


            <!-- 4. QUẢN LÝ ĐƠN HÀNG -->

            <a
                href="index.php?url=admin-don-hang"
                class="admin-card"
            >

                <div class="admin-card-icon">
                    🛒
                </div>

                <h3>
                    Quản lý đơn hàng
                </h3>

                <p>
                    Theo dõi đơn hàng và cập nhật trạng thái đơn hàng.
                </p>

            </a>


            <!-- 5. THÔNG TIN CÁ NHÂN -->

            <a
                href="index.php?url=admin-tai-khoan"
                class="admin-card"
            >

                <div class="admin-card-icon">
                    👤
                </div>

                <h3>
                    Thông tin cá nhân
                </h3>

                <p>
                    Xem và chỉnh sửa thông tin cá nhân của Admin.
                </p>

            </a>


            <!-- 6. THỐNG KÊ BÁO CÁO -->

            <a
                href="index.php?url=admin-thong-ke"
                class="admin-card"
            >

                <div class="admin-card-icon">
                    📊
                </div>

                <h3>
                    Thống kê báo cáo
                </h3>

                <p>
                    Xem báo cáo doanh thu và sản phẩm theo tháng.
                </p>

            </a>


        </div>

    </main>

</div>

</body>

</html>