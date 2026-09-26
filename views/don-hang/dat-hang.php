<style>

/* =========================================================
   ZAVY CHECKOUT
========================================================= */

.checkout-page {
    max-width: 1100px !important;

    margin: 0 auto !important;

    padding: 50px 30px 70px !important;

    box-sizing: border-box !important;
}


/* =========================================================
   HEADER
========================================================= */

.checkout-header {
    text-align: center !important;

    margin-bottom: 35px !important;
}

.checkout-header .section-subtitle {
    margin: 0 0 8px !important;

    color: #6a1b9a !important;

    font-size: 13px !important;

    font-weight: 700 !important;

    letter-spacing: 2px !important;
}

.checkout-header h2 {
    margin: 0 0 10px !important;

    color: #222222 !important;

    font-size: 30px !important;

    font-weight: 700 !important;
}

.checkout-header > p:last-child {
    margin: 0 !important;

    color: #777777 !important;

    font-size: 14px !important;
}


/* =========================================================
   BỐ CỤC
========================================================= */

.checkout-layout {
    display: grid !important;

    grid-template-columns: minmax(0, 1.35fr) minmax(330px, 0.65fr) !important;

    gap: 25px !important;

    align-items: start !important;
}


/* =========================================================
   KHUNG CHUNG
========================================================= */

.checkout-products,
.checkout-form-box {
    background: #ffffff !important;

    border: 1px solid #e5e5e5 !important;

    border-radius: 12px !important;

    box-sizing: border-box !important;

    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05) !important;
}


/* =========================================================
   HEADER CỦA KHUNG
========================================================= */

.checkout-box-header {
    display: flex !important;

    align-items: center !important;

    justify-content: space-between !important;

    gap: 15px !important;

    padding: 22px 25px !important;

    border-bottom: 1px solid #eeeeee !important;
}

.checkout-box-header h3 {
    margin: 0 !important;

    color: #222222 !important;

    font-size: 19px !important;

    font-weight: 700 !important;
}

.checkout-box-header span {
    color: #777777 !important;

    font-size: 13px !important;
}


/* =========================================================
   DANH SÁCH SẢN PHẨM
========================================================= */

.checkout-product-list {
    padding: 5px 25px !important;
}

.checkout-product-item {
    display: flex !important;

    gap: 18px !important;

    padding: 20px 0 !important;

    border-bottom: 1px solid #eeeeee !important;
}

.checkout-product-item:last-child {
    border-bottom: none !important;
}


/* ẢNH */

.checkout-product-image {
    width: 105px !important;

    height: 125px !important;

    flex: 0 0 105px !important;

    overflow: hidden !important;

    border-radius: 8px !important;

    background: #f5f5f5 !important;
}

.checkout-product-image img {
    width: 100% !important;

    height: 100% !important;

    display: block !important;

    object-fit: cover !important;
}

.checkout-no-image {
    width: 100% !important;

    height: 100% !important;

    display: flex !important;

    align-items: center !important;

    justify-content: center !important;

    color: #888888 !important;

    font-size: 12px !important;

    text-align: center !important;
}


/* THÔNG TIN */

.checkout-product-info {
    flex: 1 !important;

    min-width: 0 !important;
}

.checkout-product-info h4 {
    margin: 2px 0 10px !important;

    color: #222222 !important;

    font-size: 16px !important;

    font-weight: 700 !important;
}

.checkout-product-detail {
    display: flex !important;

    flex-wrap: wrap !important;

    gap: 18px !important;

    margin-bottom: 12px !important;

    color: #777777 !important;

    font-size: 13px !important;
}

.checkout-product-detail strong {
    color: #222222 !important;
}

.checkout-price-info {
    display: flex !important;

    flex-direction: column !important;

    gap: 5px !important;

    color: #777777 !important;

    font-size: 13px !important;
}

.checkout-price-info strong {
    color: #333333 !important;
}

.checkout-price-info .checkout-item-total {
    color: #6a1b9a !important;
}


/* =========================================================
   TỔNG TIỀN
========================================================= */

.checkout-total {
    display: flex !important;

    align-items: center !important;

    justify-content: space-between !important;

    gap: 20px !important;

    padding: 22px 25px !important;

    border-top: 1px solid #eeeeee !important;

    background: #fafafa !important;

    border-radius: 0 0 12px 12px !important;
}

.checkout-total span {
    color: #333333 !important;

    font-size: 15px !important;

    font-weight: 600 !important;
}

.checkout-total strong {
    color: #6a1b9a !important;

    font-size: 21px !important;

    font-weight: 700 !important;
}


/* =========================================================
   FORM GIAO HÀNG
========================================================= */

.checkout-form-box {
    overflow: hidden !important;
}

.checkout-form-box form {
    padding: 25px !important;
}

.checkout-form-group {
    margin-bottom: 18px !important;
}

.checkout-form-group label {
    display: block !important;

    margin-bottom: 7px !important;

    color: #222222 !important;

    font-size: 14px !important;

    font-weight: 600 !important;
}

.checkout-form-group input {
    display: block !important;

    width: 100% !important;

    height: 44px !important;

    box-sizing: border-box !important;

    padding: 0 13px !important;

    border: 1px solid #d5d5d5 !important;

    border-radius: 7px !important;

    background: #ffffff !important;

    color: #222222 !important;

    font-family: Arial, sans-serif !important;

    font-size: 13px !important;

    outline: none !important;
}

.checkout-form-group input:focus {
    border-color: #6a1b9a !important;

    box-shadow: 0 0 0 3px rgba(106, 27, 154, 0.10) !important;
}


/* =========================================================
   PHƯƠNG THỨC THANH TOÁN
========================================================= */

#phuong_thuc_thanh_toan {
    background: #f8f8f8 !important;

    color: #555555 !important;

    cursor: default !important;
}


/* =========================================================
   NÚT XÁC NHẬN
========================================================= */

.checkout-submit-button {
    display: block !important;

    width: 100% !important;

    height: 46px !important;

    margin-top: 25px !important;

    border: none !important;

    border-radius: 7px !important;

    background: #6a1b9a !important;

    color: #ffffff !important;

    font-family: Arial, sans-serif !important;

    font-size: 14px !important;

    font-weight: 600 !important;

    cursor: pointer !important;

    transition: 0.2s ease !important;
}

.checkout-submit-button:hover {
    background: #521478 !important;
}


/* =========================================================
   QUAY LẠI
========================================================= */

.checkout-back-button {
    display: flex !important;

    align-items: center !important;

    justify-content: center !important;

    width: 100% !important;

    height: 44px !important;

    box-sizing: border-box !important;

    margin-top: 10px !important;

    border: 1px solid #d5d5d5 !important;

    border-radius: 7px !important;

    background: #ffffff !important;

    color: #444444 !important;

    text-decoration: none !important;

    font-size: 13px !important;

    font-weight: 600 !important;

    transition: 0.2s ease !important;
}

.checkout-back-button:hover {
    border-color: #6a1b9a !important;

    color: #6a1b9a !important;
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 800px) {

    .checkout-page {
        padding: 35px 18px 50px !important;
    }

    .checkout-layout {
        grid-template-columns: 1fr !important;
    }

}

@media (max-width: 550px) {

    .checkout-product-item {
        gap: 12px !important;
    }

    .checkout-product-image {
        width: 80px !important;

        height: 100px !important;

        flex-basis: 80px !important;
    }

    .checkout-product-detail {
        flex-direction: column !important;

        gap: 4px !important;
    }

    .checkout-total {
        align-items: flex-start !important;

        flex-direction: column !important;

        gap: 7px !important;
    }

    .checkout-box-header,
    .checkout-product-list,
    .checkout-form-box form {
        padding-left: 18px !important;

        padding-right: 18px !important;
    }

}

</style>


<section class="checkout-page">

    


    <div class="checkout-layout">


        <!-- =========================
             THÔNG TIN ĐƠN HÀNG
             ========================= -->

        <div class="checkout-products">

            <div class="checkout-box-header">

                <h3>
                    Thông tin đơn hàng
                </h3>

                <span>
                    <?= count($chiTietGioHang) ?> sản phẩm
                </span>

            </div>


            <div class="checkout-product-list">

                <?php foreach ($chiTietGioHang as $item): ?>

                    <div class="checkout-product-item">


                        <!-- ẢNH -->

                        <div class="checkout-product-image">

                            <?php if (!empty($item['hinh_anh'])): ?>

                                <img
                                    src="public/images/<?= htmlspecialchars($item['hinh_anh']) ?>"
                                    alt="<?= htmlspecialchars($item['ten_san_pham']) ?>"
                                >

                            <?php else: ?>

                                <div class="checkout-no-image">
                                    Chưa có ảnh
                                </div>

                            <?php endif; ?>

                        </div>


                        <!-- THÔNG TIN -->

                        <div class="checkout-product-info">

                            <h4>
                                <?= htmlspecialchars(
                                    $item['ten_san_pham']
                                ) ?>
                            </h4>


                            <div class="checkout-product-detail">

                                <span>
                                    Size:
                                    <strong>
                                        <?= htmlspecialchars($item['size']) ?>
                                    </strong>
                                </span>

                                <span>
                                    Màu sắc:
                                    <strong>
                                        <?= htmlspecialchars($item['mau_sac']) ?>
                                    </strong>
                                </span>

                            </div>


                            <div class="checkout-price-info">

                                <span>
                                    Đơn giá:
                                    <strong>
                                        <?= number_format(
                                            (float) $item['gia'],
                                            0,
                                            ',',
                                            '.'
                                        ) ?> VNĐ
                                    </strong>
                                </span>

                                <span>
                                    Số lượng:
                                    <strong>
                                        <?= (int) $item['so_luong'] ?>
                                    </strong>
                                </span>

                                <span>
                                    Thành tiền:
                                    <strong class="checkout-item-total">
                                        <?= number_format(
                                            (float) $item['gia']
                                            * (int) $item['so_luong'],
                                            0,
                                            ',',
                                            '.'
                                        ) ?> VNĐ
                                    </strong>
                                </span>

                            </div>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>


            <!-- TỔNG TIỀN -->

            <div class="checkout-total">

                <span>
                    Tổng tiền
                </span>

                <strong>
                    <?= number_format(
                        $tongTien,
                        0,
                        ',',
                        '.'
                    ) ?> VNĐ
                </strong>

            </div>

        </div>


        <!-- =========================
             THÔNG TIN GIAO HÀNG
             ========================= -->

        <div class="checkout-form-box">

            <div class="checkout-box-header">

                <h3>
                    Thông tin giao hàng
                </h3>

            </div>


            <form
                method="POST"
                action="index.php?url=xu-ly-dat-hang"
            >


                <!-- ĐỊA CHỈ -->

                <div class="checkout-form-group">

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


                <!-- SỐ ĐIỆN THOẠI -->

                <div class="checkout-form-group">

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


                <!-- PHƯƠNG THỨC THANH TOÁN -->

                <div class="checkout-form-group">

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


                <!-- NÚT XÁC NHẬN -->

                <button
                    type="submit"
                    class="checkout-submit-button"
                >
                    Xác nhận đặt hàng
                </button>


                <!-- QUAY LẠI -->

                <a
                    href="index.php?url=gio-hang"
                    class="checkout-back-button"
                >
                    ← Quay lại giỏ hàng
                </a>

            </form>

        </div>

    </div>

</section>