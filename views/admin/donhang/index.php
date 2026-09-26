<?php

function dinhDangTien($tien): string
{
    return number_format((float) $tien, 0, ',', '.') . ' VNĐ';
}

function tenTrangThai($trangThai): string
{
    return $trangThai !== ''
        ? $trangThai
        : 'Chưa cập nhật';
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
        Quản lý đơn hàng - ZAVYWEB ADMIN
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

        .admin-header {
            background: #6a1b9a;
            color: white;
            padding: 18px 40px;

            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .admin-header h1 {
            margin: 0;
            font-size: 24px;
        }

        .admin-header a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        .container {
            width: 1200px;
            max-width: calc(100% - 40px);

            margin: 40px auto;

            background: white;

            padding: 30px;

            border-radius: 12px;

            box-shadow:
                0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .title-row {
            display: flex;

            align-items: center;
            justify-content: space-between;

            margin-bottom: 25px;
        }

        .title {
            margin: 0;

            color: #6a1b9a;

            font-size: 26px;
        }

        .back-button {
            display: inline-block;

            padding: 10px 18px;

            background: #222;
            color: white;

            text-decoration: none;

            border-radius: 6px;

            font-weight: bold;
        }

        .back-button:hover {
            background: #000;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;

            border-collapse: collapse;

            min-width: 1000px;
        }

        th,
        td {
            border: 1px solid #ddd;

            padding: 12px;

            text-align: left;

            vertical-align: middle;
        }

        th {
            background: #6a1b9a;

            color: white;

            font-size: 14px;

            white-space: nowrap;
        }

        td {
            font-size: 14px;
        }

        tbody tr:hover {
            background: #faf5ff;
        }

        .order-id {
            font-weight: bold;

            color: #6a1b9a;
        }

        .customer-name {
            font-weight: bold;
        }

        .customer-email {
            margin-top: 4px;

            color: #777;

            font-size: 12px;
        }

        .price {
            font-weight: bold;

            white-space: nowrap;
        }

        .status {
            display: inline-block;

            padding: 6px 10px;

            border-radius: 20px;

            background: #f0e6f7;

            color: #6a1b9a;

            font-weight: bold;

            font-size: 12px;

            white-space: nowrap;
        }

        .payment-status {
            display: inline-block;

            padding: 6px 10px;

            border-radius: 20px;

            background: #eeeeee;

            color: #333;

            font-size: 12px;

            font-weight: bold;

            white-space: nowrap;
        }

        .payment-method {
            color: #555;

            line-height: 1.5;
        }

        .empty {
            text-align: center;

            padding: 40px;

            color: #777;

            font-size: 16px;
        }

        .action-button {
            display: inline-block;

            padding: 8px 12px;

            background: #6a1b9a;

            color: white;

            text-decoration: none;

            border-radius: 5px;

            font-size: 13px;

            font-weight: bold;

            white-space: nowrap;
        }

        .action-button:hover {
            background: #4a148c;
        }

    </style>

</head>

<body>

<header class="admin-header">

    <h1>
        ZAVYWEB ADMIN
    </h1>

    <a href="index.php?url=admin">
        Trang chủ Admin
    </a>

</header>


<div class="container">

    <div class="title-row">

        <h2 class="title">
            Quản lý đơn hàng
        </h2>

        <a
            href="index.php?url=admin"
            class="back-button"
        >
            Quay lại
        </a>

    </div>


    <?php if (empty($donHangs)): ?>

        <div class="empty">
            Hiện chưa có đơn hàng nào.
        </div>

    <?php else: ?>

        <div class="table-wrapper">

            <table>

                <thead>

                    <tr>

                        <th>
                            Mã đơn
                        </th>

                        <th>
                            Khách hàng
                        </th>

                        <th>
                            Ngày đặt
                        </th>

                        <th>
                            Tổng tiền
                        </th>

                        <th>
                            Trạng thái đơn
                        </th>

                        <th>
                            Thanh toán
                        </th>

                        <th>
                            Thao tác
                        </th>

                    </tr>

                </thead>

                <tbody>

                    <?php foreach ($donHangs as $donHang): ?>

                        <tr>

                            <td>

                                <span class="order-id">
                                    #<?= (int) $donHang['id'] ?>
                                </span>

                                <?php if (!empty($donHang['ma_hoa_don'])): ?>

                                    <div
                                        style="
                                            margin-top: 5px;
                                            color: #777;
                                            font-size: 12px;
                                        "
                                    >
                                        HĐ:
                                        <?= htmlspecialchars($donHang['ma_hoa_don']) ?>
                                    </div>

                                <?php endif; ?>

                            </td>


                            <td>

                                <div class="customer-name">

                                    <?= htmlspecialchars(
                                        $donHang['ho_ten'] ?? ''
                                    ) ?>

                                </div>

                                <?php if (!empty($donHang['email'])): ?>

                                    <div class="customer-email">

                                        <?= htmlspecialchars(
                                            $donHang['email']
                                        ) ?>

                                    </div>

                                <?php endif; ?>

                            </td>


                            <td>

                                <?= !empty($donHang['ngay_dat'])
                                    ? date(
                                        'd/m/Y H:i',
                                        strtotime($donHang['ngay_dat'])
                                    )
                                    : '---'
                                ?>

                            </td>


                            <td>

                                <span class="price">

                                    <?= dinhDangTien(
                                        $donHang['tong_tien']
                                    ) ?>

                                </span>

                            </td>


                            <td>

                                <span class="status">

                                    <?= htmlspecialchars(
                                        tenTrangThai(
                                            $donHang['trang_thai'] ?? ''
                                        )
                                    ) ?>

                                </span>

                            </td>


                            <td>

                                <div class="payment-method">

                                    <?= !empty(
                                        $donHang['phuong_thuc_thanh_toan']
                                    )
                                        ? htmlspecialchars(
                                            $donHang[
                                                'phuong_thuc_thanh_toan'
                                            ]
                                        )
                                        : 'Chưa có'
                                    ?>

                                </div>


                                <?php if (!empty(
                                    $donHang['trang_thai_thanh_toan']
                                )): ?>

                                    <div
                                        style="
                                            margin-top: 5px;
                                        "
                                    >

                                        <span class="payment-status">

                                            <?= htmlspecialchars(
                                                $donHang[
                                                    'trang_thai_thanh_toan'
                                                ]
                                            ) ?>

                                        </span>

                                    </div>

                                <?php endif; ?>

                            </td>


                            <td>

                                <a
                                    href="index.php?url=admin-chi-tiet-don-hang&id=<?= (int) $donHang['id'] ?>"
                                    class="action-button"
                                >
                                    Xem chi tiết
                                </a>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    <?php endif; ?>

</div>

</body>

</html>