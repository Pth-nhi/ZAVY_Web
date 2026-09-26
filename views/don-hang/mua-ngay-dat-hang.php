<section class="order-page">

    <div class="order-header">
        <p class="section-subtitle">ZAVY ORDER</p>

        <h2>Đặt hàng</h2>

        <p>
            Kiểm tra thông tin sản phẩm trước khi xác nhận đơn hàng.
        </p>
    </div>


    <div class="order-layout">

        <!-- =========================
             THÔNG TIN SẢN PHẨM
             ========================= -->

        <div class="order-product">

            <h3>Sản phẩm mua ngay</h3>

            <div class="order-product-item">

                <div class="order-product-image">

                    <?php if (!empty($sanPham['hinh_anh'])): ?>

                        <img
                            src="public/images/<?= htmlspecialchars($sanPham['hinh_anh']) ?>"
                            alt="<?= htmlspecialchars($sanPham['ten_san_pham']) ?>"
                        >

                    <?php else: ?>

                        <div class="product-no-image">
                            Chưa có ảnh
                        </div>

                    <?php endif; ?>

                </div>


                <div class="order-product-info">

                    <p class="product-category">
                        Sản phẩm
                    </p>

                    <h3>
                        <?= htmlspecialchars($sanPham['ten_san_pham']) ?>
                    </h3>

                    <p>
                        Size:
                        <strong>
                            <?= htmlspecialchars($size) ?>
                        </strong>
                    </p>

                    <p>
                        Màu:
                        <strong>
                            <?= htmlspecialchars($mauSac) ?>
                        </strong>
                    </p>

                    <p>
                        Số lượng:
                        <strong>
                            <?= $soLuong ?>
                        </strong>
                    </p>

                    <p class="product-price">
                        <?= number_format(
                            (float) $sanPham['gia'],
                            0,
                            ',',
                            '.'
                        ) ?> ₫
                    </p>

                </div>

            </div>

        </div>


        <!-- =========================
             THÔNG TIN NHẬN HÀNG
             ========================= -->

        <div class="order-form-box">

            <h3>Thông tin nhận hàng</h3>

            <form
                method="POST"
                action="index.php?url=xu-ly-mua-ngay"
            >

                <div class="form-group">

                    <label for="dia_chi_giao_hang">
                        Địa chỉ giao hàng
                    </label>

                    <input
                        type="text"
                        id="dia_chi_giao_hang"
                        name="dia_chi_giao_hang"
                        placeholder="Nhập địa chỉ nhận hàng"
                        value="<?= htmlspecialchars(
                            $_SESSION['khach_hang']['dia_chi'] ?? ''
                        ) ?>"
                        required
                    >

                </div>


                <div class="form-group">

                    <label for="so_dien_thoai">
                        Số điện thoại
                    </label>

                    <input
                        type="text"
                        id="so_dien_thoai"
                        name="so_dien_thoai"
                        placeholder="Nhập số điện thoại"
                        value="<?= htmlspecialchars(
                            $_SESSION['khach_hang']['so_dien_thoai'] ?? ''
                        ) ?>"
                        required
                    >

                </div>


                <div class="form-group">

    <label for="phuong_thuc_thanh_toan">
        Phương thức thanh toán
    </label>

    <input
        type="text"
        id="phuong_thuc_thanh_toan"
        name="phuong_thuc_thanh_toan"
        value="COD - Thanh toán khi nhận hàng"
        readonly
    >

</div>


                <div class="order-total">

                    <span>Tổng tiền</span>

                    <strong>
                        <?= number_format(
                            $tongTien,
                            0,
                            ',',
                            '.'
                        ) ?> ₫
                    </strong>

                </div>


                <button
                    type="submit"
                    class="order-submit-button"
                >
                    Xác nhận đặt hàng
                </button>

            </form>

        </div>

    </div>

</section>