<?php

function dinhDangTienChiTiet($tien): string
{
    return number_format((float) $tien, 0, ',', '.') . ' VNĐ';
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
        Chi tiết đơn hàng - ZAVYWEB ADMIN
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
            width: 1100px;
            max-width: calc(100% - 40px);

            margin: 40px auto;
        }

        .top-title {
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

        .card {
            background: white;

            padding: 25px;

            border-radius: 12px;

            margin-bottom: 20px;

            box-shadow:
                0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .card h3 {
            margin-top: 0;
            margin-bottom: 20px;

            color: #6a1b9a;

            border-bottom: 2px solid #eee;

            padding-bottom: 10px;
        }

        .info-grid {
            display: grid;

            grid-template-columns: 1fr 1fr;

            gap: 15px 40px;
        }

        .info-item strong {
            display: inline-block;

            min-width: 150px;
        }

        .status {
            display: inline-block;

            padding: 6px 12px;

            border-radius: 20px;

            background: #f0e6f7;

            color: #6a1b9a;

            font-weight: bold;

            font-size: 13px;
        }

        .payment-status {
            display: inline-block;

            padding: 6px 12px;

            border-radius: 20px;

            background: #eee;

            font-weight: bold;

            font-size: 13px;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;

            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;

            padding: 12px;

            text-align: left;
        }

        th {
            background: #6a1b9a;
            color: white;
        }

        td {
            vertical-align: middle;
        }

        .product-name {
            font-weight: bold;
        }

        .money {
            white-space: nowrap;
            font-weight: bold;
        }

        .total-box {
            margin-top: 20px;

            text-align: right;

            font-size: 20px;

            font-weight: bold;

            color: #6a1b9a;
        }

        .invoice-box {
            background: #fafafa;

            border: 1px solid #ddd;

            padding: 20px;

            border-radius: 8px;
        }

        .empty {
            text-align: center;

            padding: 30px;

            color: #777;
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

    <div class="top-title">

        <h2 class="title">
            Chi tiết đơn hàng #<?= (int) $donHang['id'] ?>
        </h2>

        <a
            href="index.php?url=admin-don-hang"
            class="back-button"
        >
            Quay lại
        </a>

    </div>


    <!-- THÔNG TIN ĐƠN HÀNG -->

    <div class="card">

        <h3>
            Thông tin đơn hàng
        </h3>

        <div class="info-grid">

            <div class="info-item">

                <strong>
                    Mã đơn hàng:
                </strong>

                #<?= (int) $donHang['id'] ?>

            </div>

            <div class="info-item">

                <strong>
                    Ngày đặt:
                </strong>

                <?= !empty($donHang['ngay_dat'])
                    ? date(
                        'd/m/Y H:i',
                        strtotime($donHang['ngay_dat'])
                    )
                    : '---'
                ?>

            </div>

            <div class="info-item">

    <strong>
        Trạng thái:
    </strong>

    <span class="status">

        <?= htmlspecialchars(
            $donHang['trang_thai'] ?? ''
        ) ?>

    </span>

</div>

    <!-- CẬP NHẬT TRẠNG THÁI -->

    <div
        style="
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        "
    >

        <form
            method="POST"
            action="index.php?url=admin-cap-nhat-trang-thai-don-hang"
            style="
                display: flex;
                align-items: center;
                gap: 12px;
                flex-wrap: wrap;
            "
        >

            <input
                type="hidden"
                name="id"
                value="<?= (int) $donHang['id'] ?>"
            >

            <label
                for="trang_thai"
                style="font-weight: bold;"
            >
                Cập nhật trạng thái:
            </label>

            <select
                id="trang_thai"
                name="trang_thai"
                required
                style="
                    width: 220px;
                    padding: 10px;
                    border: 1px solid #ccc;
                    border-radius: 6px;
                    font-size: 14px;
                "
            >

                <?php
                $cacTrangThai = [
                    'Chờ xác nhận',
                    'Đã xác nhận',
                    'Đang giao',
                    'Đã giao',
                    'Đã hủy'
                ];
                ?>

                <?php foreach ($cacTrangThai as $trangThai): ?>

                    <option
                        value="<?= htmlspecialchars($trangThai) ?>"
                        <?= ($donHang['trang_thai'] ?? '') === $trangThai
                            ? 'selected'
                            : ''
                        ?>
                    >
                        <?= htmlspecialchars($trangThai) ?>
                    </option>

                <?php endforeach; ?>

            </select>

            <button
                type="submit"
                style="
                    padding: 10px 18px;
                    border: none;
                    border-radius: 6px;
                    background: #6a1b9a;
                    color: white;
                    font-weight: bold;
                    cursor: pointer;
                "
            >
                Cập nhật trạng thái
            </button>

        </form>

    </div>

            <div class="info-item">

                <strong>
                    Tổng tiền:
                </strong>

                <?= dinhDangTienChiTiet(
                    $donHang['tong_tien']
                ) ?>

            </div>

        </div>

    </div>


    <!-- THÔNG TIN KHÁCH HÀNG -->

    <div class="card">

        <h3>
            Thông tin khách hàng
        </h3>

        <div class="info-grid">

            <div class="info-item">

                <strong>
                    Họ tên:
                </strong>

                <?= htmlspecialchars(
                    $donHang['ho_ten'] ?? ''
                ) ?>

            </div>

            <div class="info-item">

                <strong>
                    Email:
                </strong>

                <?= htmlspecialchars(
                    $donHang['email'] ?? ''
                ) ?>

            </div>

            <div class="info-item">

                <strong>
                    Số điện thoại:
                </strong>

                <?= htmlspecialchars(
                    $donHang['so_dien_thoai'] ?? ''
                ) ?>

            </div>

            <div class="info-item">

                <strong>
                    Địa chỉ giao hàng:
                </strong>

                <?= htmlspecialchars(
                    $donHang['dia_chi_giao_hang'] ?? ''
                ) ?>

            </div>

        </div>

    </div>


    <!-- SẢN PHẨM -->

    <div class="card">

        <h3>
            Sản phẩm trong đơn hàng
        </h3>

        <?php if (empty($chiTietDonHangs)): ?>

            <div class="empty">
                Không có sản phẩm trong đơn hàng.
            </div>

        <?php else: ?>

            <div class="table-wrapper">

                <table>

                    <thead>

                        <tr>

                            <th>
                                Sản phẩm
                            </th>

                            <th>
                                Size
                            </th>

                            <th>
                                Màu sắc
                            </th>

                            <th>
                                Đơn giá
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

                        <?php foreach (
                            $chiTietDonHangs
                            as $chiTiet
                        ): ?>

                            <tr>

                                <td>

                                    <span class="product-name">

                                        <?= htmlspecialchars(
                                            $chiTiet['ten_san_pham']
                                                ?? ''
                                        ) ?>

                                    </span>

                                </td>

                                <td>

                                    <?= htmlspecialchars(
                                        $chiTiet['size'] ?? ''
                                    ) ?>

                                </td>

                                <td>

                                    <?= htmlspecialchars(
                                        $chiTiet['mau_sac'] ?? ''
                                    ) ?>

                                </td>

                                <td class="money">

                                    <?= dinhDangTienChiTiet(
                                        $chiTiet['don_gia']
                                    ) ?>

                                </td>

                                <td>

                                    <?= (int) $chiTiet['so_luong'] ?>

                                </td>

                                <td class="money">

                                    <?= dinhDangTienChiTiet(
                                        $chiTiet['thanh_tien']
                                    ) ?>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>


            <div class="total-box">

                Tổng tiền:

                <?= dinhDangTienChiTiet(
                    $donHang['tong_tien']
                ) ?>

            </div>

        <?php endif; ?>

    </div>


    <!-- HÓA ĐƠN -->

    <div class="card">

        <h3>
            Thông tin hóa đơn
        </h3>

        <?php if (!empty($donHang['hoa_don_id'])): ?>

            <div class="invoice-box">

                <div class="info-grid">

                    <div class="info-item">

                        <strong>
                            Mã hóa đơn:
                        </strong>

                        <?= htmlspecialchars(
                            $donHang['ma_hoa_don'] ?? ''
                        ) ?>

                    </div>

                    <div class="info-item">

                        <strong>
                            Ngày tạo:
                        </strong>

                        <?= !empty(
                            $donHang['hoa_don_ngay_tao']
                        )
                            ? date(
                                'd/m/Y H:i',
                                strtotime(
                                    $donHang[
                                        'hoa_don_ngay_tao'
                                    ]
                                )
                            )
                            : '---'
                        ?>

                    </div>

                    <div class="info-item">

                        <strong>
                            Phương thức thanh toán:
                        </strong>

                        <?= htmlspecialchars(
                            $donHang[
                                'phuong_thuc_thanh_toan'
                            ] ?? ''
                        ) ?>

                    </div>

                    <div class="info-item">

                        <strong>
                            Trạng thái thanh toán:
                        </strong>

                        <span class="payment-status">

                            <?= htmlspecialchars(
                                $donHang[
                                    'trang_thai_thanh_toan'
                                ] ?? ''
                            ) ?>

                        </span>

                    </div>

                    <div class="info-item">

                        <strong>
                            Tổng tiền hóa đơn:
                        </strong>

                        <?= dinhDangTienChiTiet(
                            $donHang[
                                'hoa_don_tong_tien'
                            ]
                        ) ?>

                    </div>

                </div>

            </div>

        <?php else: ?>

            <div class="empty">
                Đơn hàng chưa có hóa đơn.
            </div>

        <?php endif; ?>

    </div>

</div>

</body>

</html>