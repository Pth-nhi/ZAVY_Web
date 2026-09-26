<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['admin'])) {
    header('Location: index.php?url=admin-dang-nhap');
    exit;
}

$title = 'Thống kê báo cáo';

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
            max-width: 1100px;
            margin: 40px auto;
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

        .filter-card {
            background: #ffffff;
            padding: 25px;
            border-radius: 12px;

            box-shadow:
                0 3px 15px rgba(0, 0, 0, 0.08);

            margin-bottom: 25px;
        }

        .filter-form {
            display: flex;
            align-items: end;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .form-group label {
            font-weight: bold;
            color: #333333;
        }

        .form-group select {
            min-width: 150px;
            padding: 11px 13px;

            border: 1px solid #cccccc;
            border-radius: 7px;

            font-size: 15px;
            background: #ffffff;
        }

        .form-group select:focus {
            outline: none;
            border-color: #6a1b9a;
        }

        .btn-statistics {
            padding: 11px 25px;

            border: none;
            border-radius: 7px;

            background: #6a1b9a;
            color: #ffffff;

            font-size: 15px;
            font-weight: bold;

            cursor: pointer;
        }

        .btn-statistics:hover {
            background: #4a126d;
        }

        .report-title {
            text-align: center;
            margin: 30px 0 20px;
        }

        .report-title h2 {
            margin: 0;
            color: #333333;
        }

        .overview {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;

            margin-bottom: 30px;
        }

        .overview-card {
            background: #ffffff;
            padding: 25px;
            border-radius: 12px;

            text-align: center;

            box-shadow:
                0 3px 15px rgba(0, 0, 0, 0.08);
        }

        .overview-card h3 {
            margin: 0 0 12px;
            color: #666666;
            font-size: 16px;
        }

        .overview-card .number {
            font-size: 28px;
            font-weight: bold;
            color: #6a1b9a;
        }

        .table-card {
            background: #ffffff;
            padding: 25px;
            border-radius: 12px;

            box-shadow:
                0 3px 15px rgba(0, 0, 0, 0.08);

            overflow-x: auto;
        }

        .table-card h2 {
            margin: 0 0 20px;
            color: #333333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            padding: 13px 12px;
            border-bottom: 1px solid #eeeeee;
            text-align: left;
        }

        table th {
            background: #6a1b9a;
            color: #ffffff;
        }

        table tbody tr:hover {
            background: #faf7fc;
        }

        .money {
            font-weight: bold;
        }

        .empty {
            text-align: center;
            padding: 30px;
            color: #777777;
        }

        .bottom-buttons {
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }

        .btn-back {
            display: inline-block;

            padding: 12px 25px;

            border-radius: 7px;

            text-decoration: none;

            background: #222222;
            color: #ffffff;

            font-weight: bold;
        }

        .btn-back:hover {
            background: #000000;
        }

        @media (max-width: 700px) {

            .admin-header {
                padding: 15px 20px;

                flex-direction: column;
                gap: 15px;
            }

            .admin-nav a {
                margin-left: 10px;
                margin-right: 10px;
            }

            .overview {
                grid-template-columns: 1fr;
            }

            .filter-form {
                flex-direction: column;
                align-items: stretch;
            }

            .form-group select,
            .btn-statistics {
                width: 100%;
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

        <h1>Thống kê báo cáo</h1>

        <p>
            Thống kê doanh thu và sản phẩm đã bán theo tháng
        </p>

    </div>


    <!-- Bộ lọc tháng -->

    <div class="filter-card">

        <form
            action="index.php"
            method="GET"
            class="filter-form"
        >

            <input
                type="hidden"
                name="url"
                value="admin-thong-ke"
            >


            <div class="form-group">

                <label for="thang">
                    Chọn tháng
                </label>

                <select
                    name="thang"
                    id="thang"
                >

                    <?php for ($i = 1; $i <= 12; $i++): ?>

                        <option
                            value="<?= $i ?>"
                            <?= $i === $thang ? 'selected' : '' ?>
                        >
                            Tháng <?= $i ?>
                        </option>

                    <?php endfor; ?>

                </select>

            </div>


            <div class="form-group">

                <label for="nam">
                    Chọn năm
                </label>

                <select
                    name="nam"
                    id="nam"
                >

                    <?php
                    $namHienTai = (int) date('Y');

                    for (
                        $i = $namHienTai - 5;
                        $i <= $namHienTai + 1;
                        $i++
                    ):
                    ?>

                        <option
                            value="<?= $i ?>"
                            <?= $i === $nam ? 'selected' : '' ?>
                        >
                            <?= $i ?>
                        </option>

                    <?php endfor; ?>

                </select>

            </div>


            <button
                type="submit"
                class="btn-statistics"
            >
                Xem báo cáo
            </button>

        </form>

    </div>


    <!-- Tiêu đề báo cáo -->

    <div class="report-title">

        <h2>
            Báo cáo tháng <?= $thang ?>/<?= $nam ?>
        </h2>

    </div>


    <!-- Tổng quan -->

    <div class="overview">


        <div class="overview-card">

            <h3>
                Tổng số đơn hàng
            </h3>

            <div class="number">

                <?= (int) $tongQuan['tong_don_hang'] ?>

            </div>

        </div>


        <div class="overview-card">

            <h3>
                Tổng doanh thu
            </h3>

            <div class="number">

                <?= number_format(
                    (float) $tongQuan['tong_doanh_thu'],
                    0,
                    ',',
                    '.'
                ) ?>

                VNĐ

            </div>

        </div>


    </div>


    <!-- Danh sách sản phẩm -->

    <div class="table-card">

        <h2>
            Các sản phẩm đã bán
        </h2>


        <?php if (!empty($sanPhams)): ?>

            <table>

                <thead>

                    <tr>

                        <th>
                            STT
                        </th>

                        <th>
                            Tên sản phẩm
                        </th>

                        <th>
                            Size
                        </th>

                        <th>
                            Màu sắc
                        </th>

                        <th>
                            Số lượng
                        </th>

                        <th>
                            Thành tiền
                        </th>

                    </tr>

                </thead>


                <tbody>

                    <?php foreach ($sanPhams as $index => $sanPham): ?>

                        <tr>

                            <td>
                                <?= $index + 1 ?>
                            </td>

                            <td>
                                <?= htmlspecialchars(
                                    $sanPham['ten_san_pham']
                                ) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars(
                                    $sanPham['size']
                                ) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars(
                                    $sanPham['mau_sac']
                                ) ?>
                            </td>

                            <td>
                                <?= (int) $sanPham['tong_so_luong'] ?>
                            </td>

                            <td class="money">

                                <?= number_format(
                                    (float) $sanPham['tong_thanh_tien'],
                                    0,
                                    ',',
                                    '.'
                                ) ?>

                                VNĐ

                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>


        <?php else: ?>

            <div class="empty">

                Không có dữ liệu bán hàng trong tháng này.

            </div>

        <?php endif; ?>


    </div>


    <div class="bottom-buttons">

        <a
            href="index.php?url=admin"
            class="btn-back"
        >
            Quay lại trang chủ
        </a>

    </div>


</div>


</body>

</html>