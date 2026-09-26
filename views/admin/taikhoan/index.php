<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['admin'])) {
    header('Location: index.php?url=admin-dang-nhap');
    exit;
}

$title = 'Thông tin tài khoản Admin';

?>

<!DOCTYPE html>
<html lang="vi">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $title ?></title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            color: #222;
        }

        .admin-header {
            background: #ffffff;
            border-bottom: 1px solid #ddd;
            padding: 18px 50px;

            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .admin-logo {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .admin-logo img {
            width: 55px;
            height: 55px;
            object-fit: contain;
        }

        .admin-logo h2 {
            margin: 0;
            color: #6a1b9a;
            font-size: 22px;
        }

        .admin-nav a {
            text-decoration: none;
            margin-left: 20px;
            color: #333;
            font-weight: bold;
        }

        .admin-nav a:hover {
            color: #6a1b9a;
        }

        .page {
            max-width: 900px;
            margin: 45px auto;
            padding: 0 20px;
        }

        .page-title {
            text-align: center;
            margin-bottom: 30px;
        }

        .page-title h1 {
            margin: 0 0 8px;
            color: #6a1b9a;
        }

        .page-title p {
            margin: 0;
            color: #666;
        }

        .account-card {
            background: #ffffff;
            border-radius: 12px;
            padding: 35px;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.08);
        }

        .account-row {
            display: grid;
            grid-template-columns: 220px 1fr;
            padding: 17px 0;
            border-bottom: 1px solid #eeeeee;
        }

        .account-row:last-child {
            border-bottom: none;
        }

        .account-label {
            font-weight: bold;
            color: #555;
        }

        .account-value {
            color: #222;
            word-break: break-word;
        }

        .button-area {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 30px;
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
            border-radius: 7px;
            text-decoration: none;
            font-weight: bold;
            border: none;
            cursor: pointer;
        }

        .btn-edit {
            background: #6a1b9a;
            color: #ffffff;
        }

        .btn-edit:hover {
            background: #4a126d;
        }

        .btn-back {
            background: #222222;
            color: #ffffff;
        }

        .btn-back:hover {
            background: #000000;
        }

        @media (max-width: 650px) {

            .admin-header {
                padding: 15px 20px;
                flex-direction: column;
                gap: 15px;
            }

            .admin-nav a {
                margin-left: 10px;
                margin-right: 10px;
            }

            .account-card {
                padding: 20px;
            }

            .account-row {
                grid-template-columns: 1fr;
                gap: 7px;
            }

            .button-area {
                flex-direction: column;
            }

            .btn {
                text-align: center;
            }

        }

    </style>

</head>

<body>


<header class="admin-header">

    <div class="admin-logo">

        <img
            src="public/images/logo.jpg"
            alt="ZAVYWEB"
        >

        <h2>ZAVYWEB ADMIN</h2>

    </div>


    <nav class="admin-nav">

        <a href="index.php?url=admin">
            Trang chủ
        </a>

        <a href="index.php?url=dang-xuat-admin">
            Đăng xuất
        </a>

    </nav>

</header>


<div class="page">


    <div class="page-title">

        <h1>Thông tin tài khoản</h1>

        <p>Thông tin cá nhân của Admin</p>

    </div>


    <div class="account-card">


        <div class="account-row">

            <div class="account-label">
                Họ và tên
            </div>

            <div class="account-value">
                <?= htmlspecialchars($admin['ho_ten']) ?>
            </div>

        </div>


        <div class="account-row">

            <div class="account-label">
                Email
            </div>

            <div class="account-value">
                <?= htmlspecialchars($admin['email']) ?>
            </div>

        </div>


        <div class="account-row">

            <div class="account-label">
                Số điện thoại
            </div>

            <div class="account-value">

                <?= !empty($admin['so_dien_thoai'])
                    ? htmlspecialchars($admin['so_dien_thoai'])
                    : 'Chưa cập nhật'
                ?>

            </div>

        </div>


        <div class="account-row">

            <div class="account-label">
                Địa chỉ
            </div>

            <div class="account-value">

                <?= !empty($admin['dia_chi'])
                    ? htmlspecialchars($admin['dia_chi'])
                    : 'Chưa cập nhật'
                ?>

            </div>

        </div>


        <div class="account-row">

            <div class="account-label">
                Ngày tạo tài khoản
            </div>

            <div class="account-value">

                <?= !empty($admin['ngay_tao'])
                    ? htmlspecialchars($admin['ngay_tao'])
                    : 'Không có dữ liệu'
                ?>

            </div>

        </div>


        <div class="button-area">

            <a
                href="index.php?url=admin-sua-tai-khoan"
                class="btn btn-edit"
            >
                Sửa thông tin
            </a>


            <a
                href="index.php?url=admin"
                class="btn btn-back"
            >
                Quay lại trang chủ
            </a>

        </div>


    </div>

</div>


</body>

</html>