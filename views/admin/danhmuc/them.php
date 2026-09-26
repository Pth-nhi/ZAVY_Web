<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['admin'])) {
    header('Location: index.php?url=admin-dang-nhap');
    exit;
}

$admin = $_SESSION['admin'];

?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Thêm danh mục - ZAVYWEB ADMIN</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f3f8;
            color: #222;
        }

        .admin-header {
            background: #5b2a86;
            color: white;
            height: 75px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 40px;
        }

        .admin-logo {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .admin-logo img {
            width: 48px;
            height: 48px;
            object-fit: cover;
            border-radius: 8px;
            background: white;
        }

        .admin-logo h2 {
            margin: 0;
            font-size: 22px;
        }

        .admin-header-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .logout-btn {
            text-decoration: none;
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.7);
            padding: 9px 16px;
            border-radius: 6px;
        }

        .logout-btn:hover {
            background: white;
            color: #5b2a86;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 40px 25px 60px;
        }

        .page-title {
            margin-bottom: 25px;
        }

        .page-title h1 {
            margin: 0 0 6px;
            font-size: 28px;
        }

        .page-title p {
            margin: 0;
            color: #666;
        }

        .form-box {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
        }

        .form-group {
            margin-bottom: 22px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .required {
            color: #d00000;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
            font-family: Arial, sans-serif;
            outline: none;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: #5b2a86;
        }

        .form-group textarea {
            min-height: 130px;
            resize: vertical;
        }

        .form-actions {
            display: flex;
            gap: 12px;
            margin-top: 28px;
        }

        .btn {
            border: none;
            text-decoration: none;
            padding: 11px 20px;
            border-radius: 6px;
            font-size: 15px;
            cursor: pointer;
            font-weight: bold;
        }

        .btn-save {
            background: #5b2a86;
            color: white;
        }

        .btn-save:hover {
            background: #431f64;
        }

        .btn-cancel {
            background: #222;
            color: white;
        }

        .btn-cancel:hover {
            background: #000;
        }

        @media (max-width: 700px) {
            .admin-header {
                padding: 0 15px;
            }

            .admin-header-right span {
                display: none;
            }

            .container {
                padding: 25px 15px;
            }

            .form-box {
                padding: 20px;
            }
        }
    </style>
</head>

<body>

<header class="admin-header">

    <div class="admin-logo">
        <img src="public/images/logo.jpg" alt="ZAVYWEB">
        <h2>ZAVYWEB ADMIN</h2>
    </div>

    <div class="admin-header-right">

        <span>
            Xin chào, <?= htmlspecialchars($admin['ho_ten']) ?>
        </span>

        <a
            href="index.php?url=dang-xuat-admin"
            class="logout-btn"
        >
            Đăng xuất
        </a>

    </div>

</header>

<div class="container">

    <div class="page-title">

        <h1>Thêm danh mục</h1>

        <p>
            Nhập thông tin danh mục sản phẩm mới.
        </p>

    </div>

    <div class="form-box">

        <form
            action="index.php?url=admin-xu-ly-them-danh-muc"
            method="POST"
        >

            <div class="form-group">

                <label for="ten_danh_muc">
                    Tên danh mục <span class="required">*</span>
                </label>

                <input
                    type="text"
                    id="ten_danh_muc"
                    name="ten_danh_muc"
                    placeholder="Nhập tên danh mục"
                    required
                    maxlength="100"
                >

            </div>

            <div class="form-group">

                <label for="mo_ta">
                    Mô tả
                </label>

                <textarea
                    id="mo_ta"
                    name="mo_ta"
                    placeholder="Nhập mô tả danh mục..."
                    maxlength="255"
                ></textarea>

            </div>

            <div class="form-actions">

                <button
                    type="submit"
                    class="btn btn-save"
                >
                    Thêm danh mục
                </button>

                <a
                    href="index.php?url=admin-danh-muc"
                    class="btn btn-cancel"
                >
                    Hủy
                </a>

            </div>

        </form>

    </div>

</div>

</body>

</html>