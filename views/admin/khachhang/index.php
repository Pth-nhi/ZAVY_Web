<?php

$title = 'Quản lý khách hàng';


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if (!isset($_SESSION['admin'])) {

    header('Location: index.php?url=admin-dang-nhap');

    exit;
}

?>

<!DOCTYPE html>

<html lang="vi">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        <?= htmlspecialchars($title) ?> - ZAVYWEB ADMIN
    </title>


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


        /* ==============================
           HEADER
           ============================== */

        .admin-header {

            background: #000;

            color: #fff;

            padding: 18px 40px;

            display: flex;

            align-items: center;

            justify-content: space-between;
        }


        .admin-header-left {

            display: flex;

            align-items: center;

            gap: 15px;
        }


        .admin-logo {

            width: 55px;

            height: 55px;

            object-fit: cover;

            border-radius: 8px;
        }


        .admin-header h1 {

            margin: 0;

            font-size: 24px;
        }


        .admin-header p {

            margin: 4px 0 0;

            color: #ddd;

            font-size: 14px;
        }


        .admin-header a {

            color: #fff;

            text-decoration: none;

            padding: 10px 18px;

            border: 1px solid #fff;

            border-radius: 6px;

            transition: 0.2s;
        }


        .admin-header a:hover {

            background: #fff;

            color: #000;
        }


        /* ==============================
           CONTAINER
           ============================== */

        .container {

            width: 92%;

            margin: 35px auto;
        }


        .top-bar {

            display: flex;

            justify-content: space-between;

            align-items: center;

            margin-bottom: 20px;
        }


        .top-bar h2 {

            margin: 0;

            font-size: 28px;
        }


        .back-button {

            text-decoration: none;

            color: #fff;

            background: #6a1b9a;

            padding: 11px 18px;

            border-radius: 6px;

            transition: 0.2s;
        }


        .back-button:hover {

            background: #4a116d;
        }


        /* ==============================
           THỐNG KÊ SỐ KHÁCH HÀNG
           ============================== */

        .count {

            margin-bottom: 15px;

            color: #555;
        }


        .count strong {

            color: #6a1b9a;
        }


        /* ==============================
           TABLE
           ============================== */

        .table-wrapper {

            background: #fff;

            border-radius: 10px;

            padding: 20px;

            overflow-x: auto;

            box-shadow:
                0 2px 10px rgba(0, 0, 0, 0.08);
        }


        table {

            width: 100%;

            border-collapse: collapse;

            min-width: 950px;
        }


        th {

            background: #000;

            color: #fff;

            padding: 14px 12px;

            text-align: left;
        }


        td {

            padding: 13px 12px;

            border-bottom: 1px solid #ddd;

            vertical-align: middle;
        }


        tr:hover td {

            background: #faf5ff;
        }


        /* ==============================
           NÚT XÓA
           ============================== */

        .btn-delete {

            display: inline-block;

            padding: 8px 14px;

            background: #000;

            color: #fff;

            text-decoration: none;

            border-radius: 5px;

            transition: 0.2s;
        }


        .btn-delete:hover {

            background: #6a1b9a;
        }


        /* ==============================
           KHÔNG CÓ KHÁCH HÀNG
           ============================== */

        .empty {

            text-align: center;

            padding: 35px;

            color: #777;
        }

    </style>

</head>


<body>


<!-- =========================================================
     HEADER ADMIN
     ========================================================= -->

<header class="admin-header">

    <div class="admin-header-left">

        <img
            src="public/images/logo.jpg"
            alt="ZAVYWEB"
            class="admin-logo"
        >


        <div>

            <h1>ZAVYWEB ADMIN</h1>

            <p>Quản lý khách hàng</p>

        </div>

    </div>


    <a href="index.php?url=dang-xuat-admin">
        Đăng xuất
    </a>

</header>



<!-- =========================================================
     NỘI DUNG
     ========================================================= -->

<div class="container">


    <div class="top-bar">

        <h2>
            Quản lý khách hàng
        </h2>


        <a
            href="index.php?url=admin"
            class="back-button"
        >
            ← Trang quản trị
        </a>

    </div>



    <div class="count">

        Tổng số khách hàng:

        <strong>
            <?= count($khachHangs) ?>
        </strong>

    </div>



    <div class="table-wrapper">


        <?php if (empty($khachHangs)): ?>


            <div class="empty">

                Chưa có khách hàng nào.

            </div>


        <?php else: ?>


            <table>


                <thead>

                    <tr>

                        <th>ID</th>

                        <th>Họ tên</th>

                        <th>Email</th>

                        <th>Số điện thoại</th>

                        <th>Địa chỉ</th>

                        <th>Ngày tạo</th>

                        <th>Thao tác</th>

                    </tr>

                </thead>



                <tbody>


                    <?php foreach ($khachHangs as $khachHang): ?>


                        <tr>


                            <td>

                                <?= (int) $khachHang['id'] ?>

                            </td>


                            <td>

                                <?= htmlspecialchars(
                                    $khachHang['ho_ten']
                                ) ?>

                            </td>


                            <td>

                                <?= htmlspecialchars(
                                    $khachHang['email']
                                ) ?>

                            </td>


                            <td>

                                <?= htmlspecialchars(
                                    $khachHang['so_dien_thoai'] ?? ''
                                ) ?>

                            </td>


                            <td>

                                <?= htmlspecialchars(
                                    $khachHang['dia_chi'] ?? ''
                                ) ?>

                            </td>


                            <td>

                                <?= htmlspecialchars(
                                    $khachHang['ngay_tao'] ?? ''
                                ) ?>

                            </td>


                            <td>


                                <a
                                    href="index.php?url=admin-xoa-khach-hang&id=<?= (int) $khachHang['id'] ?>"
                                    class="btn-delete"
                                    onclick="return confirm('Bạn có chắc chắn muốn xóa khách hàng này không?');"
                                >
                                    Xóa
                                </a>


                            </td>


                        </tr>


                    <?php endforeach; ?>


                </tbody>


            </table>


        <?php endif; ?>


    </div>


</div>


</body>

</html>