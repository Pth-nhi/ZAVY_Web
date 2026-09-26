<section class="order-success-page">

    <div class="order-success-box">

        <!-- ICON THÀNH CÔNG -->

        <div class="order-success-icon">
            ✓
        </div>


        <!-- TIÊU ĐỀ -->

        <p class="section-subtitle">
            ZAVY ORDER
        </p>

        <h2>
            Đặt hàng thành công
        </h2>

        <p class="order-success-message">
            Cảm ơn bạn đã đặt hàng tại ZAVYWEB.
        </p>


        <!-- MÃ ĐƠN HÀNG -->

        <div class="order-success-code">

            <span>
                Mã đơn hàng
            </span>

            <strong>
                #<?= (int) $donHangId ?>
            </strong>

        </div>


        <!-- TRẠNG THÁI -->

        <div class="order-success-status">

            <span class="order-status-dot"></span>

            <p>
                Đơn hàng của bạn đã được ghi nhận
                và đang chờ xác nhận.
            </p>

        </div>


        <!-- NÚT -->

        <div class="order-success-actions">

            <a
                href="index.php?url=lich-su-don-hang"
                class="order-success-primary"
            >
                Xem lịch sử đơn hàng
            </a>

            <a
                href="index.php?url=san-pham"
                class="order-success-secondary"
            >
                ← Tiếp tục mua hàng
            </a>

        </div>

    </div>

</section>