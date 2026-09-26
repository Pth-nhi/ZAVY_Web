<section class="order-history-page">

    <div class="order-history-header">

        <p class="section-subtitle">
            ZAVY ORDER
        </p>

        <h2>
            Lịch sử đơn hàng
        </h2>

        <p>
            Theo dõi các đơn hàng bạn đã đặt tại ZAVYWEB.
        </p>

    </div>


    <?php if (empty($donHangs)): ?>

        <div class="order-history-empty">

            <div class="order-history-empty-icon">
                🛍
            </div>

            <h3>
                Bạn chưa có đơn hàng nào
            </h3>

            <p>
                Hãy khám phá các sản phẩm và bắt đầu mua sắm.
            </p>

            <a
                href="index.php?url=san-pham"
                class="order-history-shopping-button"
            >
                Bắt đầu mua sắm
            </a>

        </div>

    <?php else: ?>

        <div class="order-history-box">

            <div class="order-history-box-header">

                <h3>
                    Danh sách đơn hàng
                </h3>

                <span>
                    <?= count($donHangs) ?> đơn hàng
                </span>

            </div>


            <div class="order-history-table-wrapper">

                <table class="order-history-table">

                    <thead>

                        <tr>

                            <th>
                                Mã đơn hàng
                            </th>

                            <th>
                                Tổng tiền
                            </th>

                            <th>
                                Trạng thái
                            </th>

                            <th>
                                Địa chỉ giao hàng
                            </th>

                            <th>
                                Số điện thoại
                            </th>

                            <th>
                                Ngày đặt
                            </th>

                            <th>
                                Thao tác
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        <?php foreach ($donHangs as $donHang): ?>

                            <tr>

                                <!-- MÃ ĐƠN -->

                                <td>

                                    <span class="order-code">
                                        #<?= (int) $donHang['id'] ?>
                                    </span>

                                </td>


                                <!-- TỔNG TIỀN -->

                                <td>

                                    <strong class="order-history-price">

                                        <?= number_format(
                                            (float) $donHang['tong_tien'],
                                            0,
                                            ',',
                                            '.'
                                        ) ?> VNĐ

                                    </strong>

                                </td>


                                <!-- TRẠNG THÁI -->

                                <td>

                                    <?php
                                    $trangThai =
                                        $donHang['trang_thai'] ?? '';
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

                                </td>


                                <!-- ĐỊA CHỈ -->

                                <td>

                                    <span class="order-history-address">
                                        <?= htmlspecialchars(
                                            $donHang['dia_chi_giao_hang']
                                        ) ?>
                                    </span>

                                </td>


                                <!-- SỐ ĐIỆN THOẠI -->

                                <td>

                                    <?= htmlspecialchars(
                                        $donHang['so_dien_thoai']
                                    ) ?>

                                </td>


                                <!-- NGÀY ĐẶT -->

                                <td>

                                    <span class="order-history-date">
                                        <?= htmlspecialchars(
                                            $donHang['ngay_dat']
                                        ) ?>
                                    </span>

                                </td>


                                <!-- THAO TÁC -->

                                <td>

                                    <div class="order-history-actions">

                                        <a
                                            href="index.php?url=chi-tiet-don-hang&id=<?= (int) $donHang['id'] ?>"
                                            class="order-detail-button"
                                        >
                                            Xem chi tiết
                                        </a>


                                        <?php if (
                                            ($donHang['trang_thai'] ?? '')
                                            === 'Chờ xác nhận'
                                        ): ?>

                                            <form
                                                method="POST"
                                                action="index.php?url=huy-don-hang"
                                                onsubmit="return confirm('Bạn có chắc muốn hủy đơn hàng này?');"
                                            >

                                                <input
                                                    type="hidden"
                                                    name="id"
                                                    value="<?= (int) $donHang['id'] ?>"
                                                >

                                                <button
                                                    type="submit"
                                                    class="order-cancel-button"
                                                >
                                                    Hủy đơn
                                                </button>

                                            </form>

                                        <?php endif; ?>

                                    </div>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        </div>

    <?php endif; ?>


    <!-- TIẾP TỤC MUA HÀNG -->

    <div class="order-history-footer">

        <a
            href="index.php?url=san-pham"
            class="order-history-back"
        >
            ← Tiếp tục mua hàng
        </a>

    </div>

</section>