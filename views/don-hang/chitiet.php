<section class="order-detail-page">

    <!-- HEADER -->

    <div class="order-detail-header">

        <p class="section-subtitle">
            ZAVY ORDER
        </p>

        <h2>
            Chi tiết đơn hàng #<?= (int) $donHang['id'] ?>
        </h2>

        <p>
            Thông tin chi tiết về đơn hàng của bạn.
        </p>

    </div>


    <!-- THÔNG TIN ĐƠN HÀNG -->

    <div class="order-detail-info-box">

        <div class="order-detail-box-header">

            <h3>
                Thông tin đơn hàng
            </h3>

            <span class="order-detail-code">
                #<?= (int) $donHang['id'] ?>
            </span>

        </div>


        <div class="order-detail-info-grid">

            <div class="order-detail-info-item">

                <span class="info-label">
                    Mã đơn hàng
                </span>

                <strong class="info-value order-detail-purple">
                    #<?= (int) $donHang['id'] ?>
                </strong>

            </div>


            <div class="order-detail-info-item">

                <span class="info-label">
                    Ngày đặt
                </span>

                <strong class="info-value">
                    <?= htmlspecialchars($donHang['ngay_dat']) ?>
                </strong>

            </div>


            <div class="order-detail-info-item">

                <span class="info-label">
                    Trạng thái
                </span>

                <?php
                $trangThai = $donHang['trang_thai'] ?? '';
                ?>

                <span
                    class="order-status
                    <?=
                        $trangThai === 'Đã hủy'
                            ? 'cancelled'
                            : (
                                $trangThai === 'Đã giao'
                                    ? 'delivered'
                                    : (
                                        $trangThai === 'Đang giao'
                                            ? 'shipping'
                                            : (
                                                $trangThai === 'Đã xác nhận'
                                                    ? 'confirmed'
                                                    : 'pending'
                                            )
                                    )
                            )
                    ?>"
                >
                    <?= htmlspecialchars($trangThai) ?>
                </span>

            </div>


            <div class="order-detail-info-item">

                <span class="info-label">
                    Địa chỉ giao hàng
                </span>

                <strong class="info-value">
                    <?= htmlspecialchars($donHang['dia_chi_giao_hang']) ?>
                </strong>

            </div>


            <div class="order-detail-info-item">

                <span class="info-label">
                    Số điện thoại
                </span>

                <strong class="info-value">
                    <?= htmlspecialchars($donHang['so_dien_thoai']) ?>
                </strong>

            </div>

        </div>

    </div>


    <!-- SẢN PHẨM -->

    <div class="order-detail-products-box">

        <div class="order-detail-box-header">

            <h3>
                Sản phẩm trong đơn hàng
            </h3>

            <span>
                <?= count($chiTietDonHang) ?> sản phẩm
            </span>

        </div>


        <div class="order-detail-table-wrapper">

            <table class="order-detail-table">

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

                    <?php foreach ($chiTietDonHang as $item): ?>

                        <tr>

                            <td>

                                <div class="order-product-name">

                                    <?php if (!empty($item['hinh_anh'])): ?>

                                        <img
                                            src="public/images/<?= htmlspecialchars($item['hinh_anh']) ?>"
                                            alt="<?= htmlspecialchars($item['ten_san_pham']) ?>"
                                        >

                                    <?php else: ?>

                                        <div class="order-product-no-image">
                                            —
                                        </div>

                                    <?php endif; ?>


                                    <strong>
                                        <?= htmlspecialchars($item['ten_san_pham']) ?>
                                    </strong>

                                </div>

                            </td>


                            <td>

                                <span class="order-product-option">
                                    <?= htmlspecialchars($item['size']) ?>
                                </span>

                            </td>


                            <td>

                                <span class="order-product-option">
                                    <?= htmlspecialchars($item['mau_sac']) ?>
                                </span>

                            </td>


                            <td>

                                <?= number_format(
                                    (float) $item['don_gia'],
                                    0,
                                    ',',
                                    '.'
                                ) ?> VNĐ

                            </td>


                            <td>

                                <span class="order-product-quantity">
                                    <?= (int) $item['so_luong'] ?>
                                </span>

                            </td>


                            <td>

                                <strong class="order-product-total">

                                    <?= number_format(
                                        (float) $item['don_gia']
                                        * (int) $item['so_luong'],
                                        0,
                                        ',',
                                        '.'
                                    ) ?> VNĐ

                                </strong>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>


        <!-- TỔNG TIỀN -->

        <div class="order-detail-total">

            <span>
                Tổng tiền
            </span>

            <strong>
                <?= number_format(
                    (float) $donHang['tong_tien'],
                    0,
                    ',',
                    '.'
                ) ?> VNĐ
            </strong>

        </div>

    </div>


    <!-- HÓA ĐƠN -->

    <div class="order-detail-invoice-box">

        <div class="order-detail-box-header">

            <h3>
                Thông tin hóa đơn
            </h3>

            <span>
                HÓA ĐƠN
            </span>

        </div>


        <div class="invoice-info-grid">

            <div class="invoice-info-item">

                <span>
                    Mã hóa đơn
                </span>

                <strong class="invoice-code">
                    <?= htmlspecialchars($hoaDon['ma_hoa_don']) ?>
                </strong>

            </div>


            <div class="invoice-info-item">

                <span>
                    Phương thức thanh toán
                </span>

                <strong>
                    <?= htmlspecialchars($hoaDon['phuong_thuc_thanh_toan']) ?>
                </strong>

            </div>


            <div class="invoice-info-item">

                <span>
                    Trạng thái thanh toán
                </span>

                <strong>
                    <?= htmlspecialchars($hoaDon['trang_thai_thanh_toan']) ?>
                </strong>

            </div>


            <div class="invoice-info-item">

                <span>
                    Tổng tiền hóa đơn
                </span>

                <strong class="invoice-total">
                    <?= number_format(
                        (float) $hoaDon['tong_tien'],
                        0,
                        ',',
                        '.'
                    ) ?> VNĐ
                </strong>

            </div>


            <div class="invoice-info-item">

                <span>
                    Ngày tạo hóa đơn
                </span>

                <strong>
                    <?= htmlspecialchars($hoaDon['ngay_tao']) ?>
                </strong>

            </div>

        </div>

    </div>


    <!-- BUTTON -->

    <div class="order-detail-actions">

        <a
            href="index.php?url=lich-su-don-hang"
            class="order-detail-back-button"
        >
            ← Quay lại lịch sử đơn hàng
        </a>


        <a
            href="index.php?url=san-pham"
            class="order-detail-shopping-button"
        >
            ← Tiếp tục mua hàng
        </a>

    </div>

</section>