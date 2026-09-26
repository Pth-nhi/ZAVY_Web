<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['admin'])) {
    header('Location: index.php?url=admin-dang-nhap');
    exit;
}

$title = 'Sửa thông tin tài khoản Admin';

?>

<!DOCTYPE html>
<html lang="vi">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title><?= $title ?></title>

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

        .admin-header {
            background: #ffffff;
            border-bottom: 1px solid #dddddd;
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
            color: #333333;
            font-weight: bold;
        }

        .admin-nav a:hover {
            color: #6a1b9a;
        }

        .page {
            max-width: 800px;
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
            color: #666666;
        }

        .form-card {
            background: #ffffff;
            border-radius: 12px;
            padding: 35px;

            box-shadow:
                0 3px 15px rgba(0, 0, 0, 0.08);
        }

        .form-group {
            margin-bottom: 22px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;

            font-weight: bold;
            color: #333333;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;

            padding: 12px 14px;

            border: 1px solid #cccccc;
            border-radius: 7px;

            font-size: 15px;
            font-family: Arial, sans-serif;

            outline: none;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: #6a1b9a;

            box-shadow:
                0 0 0 2px rgba(106, 27, 154, 0.1);
        }

        .form-group textarea {
            min-height: 100px;
            resize: vertical;
        }

        .button-area {
            display: flex;
            justify-content: center;
            gap: 15px;

            margin-top: 30px;
        }

        .btn {
            display: inline-block;

            padding: 12px 25px;

            border-radius: 7px;

            text-decoration: none;

            font-weight: bold;

            border: none;

            cursor: pointer;

            font-size: 15px;
        }

        .btn-save {
            background: #6a1b9a;
            color: #ffffff;
        }

        .btn-save:hover {
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

            .form-card {
                padding: 20px;
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

        <h1>Sửa thông tin tài khoản</h1>

        <p>Cập nhật thông tin cá nhân của Admin</p>

    </div>


    <div class="form-card">


        <form
            action="index.php?url=admin-xu-ly-sua-tai-khoan"
            method="POST"
        >


            <!-- Họ tên -->

            <div class="form-group">

                <label for="ho_ten">
                    Họ và tên
                </label>

                <input
                    type="text"
                    id="ho_ten"
                    name="ho_ten"
                    value="<?= htmlspecialchars($admin['ho_ten']) ?>"
                    required
                >

            </div>


            <!-- Email -->

            <div class="form-group">

                <label for="email">
                    Email
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="<?= htmlspecialchars($admin['email']) ?>"
                    required
                >

            </div>


            <!-- Số điện thoại -->

            <div class="form-group">

                <label for="so_dien_thoai">
                    Số điện thoại
                </label>

                <input
                    type="text"
                    id="so_dien_thoai"
                    name="so_dien_thoai"
                    value="<?= htmlspecialchars($admin['so_dien_thoai'] ?? '') ?>"
                >

            </div>


            <!-- Địa chỉ -->

            <div class="form-group">

                <label for="dia_chi">
                    Địa chỉ
                </label>

                <textarea
                    id="dia_chi"
                    name="dia_chi"
                ><?= htmlspecialchars($admin['dia_chi'] ?? '') ?></textarea>

            </div>


            <!-- Nút -->

            <div class="button-area">

                <button
                    type="submit"
                    class="btn btn-save"
                >
                    Lưu thay đổi
                </button>


                <a
                    href="index.php?url=admin-tai-khoan"
                    class="btn btn-back"
                >
                    Hủy
                </a>

            </div>


        </form>


    </div>

</div>


</body>

</html>