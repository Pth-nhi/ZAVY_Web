<style>

/* =========================================================
   CHECKBOX CHỌN SẢN PHẨM
========================================================= */

.cart-item-select {
    width: 35px !important;

    display: flex !important;

    align-items: center !important;

    justify-content: center !important;

    flex-shrink: 0 !important;
}

.cart-select-checkbox {
    width: 19px !important;

    height: 19px !important;

    margin: 0 !important;

    accent-color: #6a1b9a !important;

    cursor: pointer !important;
}


/* =========================================================
   NÚT ĐẶT HÀNG KHI CHƯA CHỌN
========================================================= */

.cart-checkout-button.disabled {
    background: #cccccc !important;

    color: #ffffff !important;

    cursor: not-allowed !important;

    pointer-events: none !important;
}

.cart-select-note {
    margin: 10px 0 0 !important;

    color: #777777 !important;

    font-size: 12px !important;

    line-height: 1.5 !important;

    text-align: center !important;
}


/* =========================================================
   ITEM ĐƯỢC CHỌN
========================================================= */

.cart-item.cart-item-selected {
    border-color: #6a1b9a !important;

    background: #fcf9ff !important;
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 700px) {

    .cart-item-select {
        width: 25px !important;
    }

}

</style>


<section class="cart-page">

    


    <?php if (empty($chiTietGioHang)): ?>


        <!-- GIỎ HÀNG TRỐNG -->

        <div class="cart-empty">

            <div class="cart-empty-icon">
                🛒
            </div>

            <h3>
                Giỏ hàng đang trống
            </h3>

            <p>
                Hãy thêm sản phẩm yêu thích vào giỏ hàng
                để tiếp tục mua sắm.
            </p>

            <a
                href="index.php?url=san-pham"
                class="cart-shopping-button"
            >
                Tiếp tục mua sắm
            </a>

        </div>


    <?php else: ?>


        <!-- GIỎ HÀNG CÓ SẢN PHẨM -->

        <div class="cart-layout">


            <!-- DANH SÁCH SẢN PHẨM -->

            <div class="cart-list">


                <div class="cart-list-header">

                    <h3>
                        Sản phẩm trong giỏ hàng
                    </h3>

                    <span>
                        <?= count($chiTietGioHang) ?> sản phẩm
                    </span>

                </div>


                <?php foreach ($chiTietGioHang as $item): ?>

                    <div
                        class="cart-item"
                        data-cart-item-id="<?= (int) $item['id'] ?>"
                    >


                        <!-- CHECKBOX -->

                        <div class="cart-item-select">

                            <input
                                type="checkbox"
                                class="cart-select-checkbox"
                                value="<?= (int) $item['id'] ?>"
                                aria-label="Chọn <?= htmlspecialchars($item['ten_san_pham']) ?>"
                            >

                        </div>


                        <!-- ẢNH -->

                        <div class="cart-item-image">

                            <?php if (!empty($item['hinh_anh'])): ?>

                                <img
                                    src="public/images/<?= htmlspecialchars($item['hinh_anh']) ?>"
                                    alt="<?= htmlspecialchars($item['ten_san_pham']) ?>"
                                >

                            <?php else: ?>

                                <div class="cart-no-image">
                                    Chưa có ảnh
                                </div>

                            <?php endif; ?>

                        </div>


                        <!-- THÔNG TIN -->

                        <div class="cart-item-info">

                            <p class="cart-item-category">

                                <?= htmlspecialchars(
                                    $item['ten_danh_muc'] ?? 'Sản phẩm'
                                ) ?>

                            </p>

                            <h3>

                                <?= htmlspecialchars(
                                    $item['ten_san_pham']
                                ) ?>

                            </h3>


                            <div class="cart-item-options">

                                <span>

                                    Size:

                                    <strong>
                                        <?= htmlspecialchars($item['size']) ?>
                                    </strong>

                                </span>

                                <span>

                                    Màu:

                                    <strong>
                                        <?= htmlspecialchars($item['mau_sac']) ?>
                                    </strong>

                                </span>

                            </div>


                            <p class="cart-item-price">

                                <?= number_format(
                                    (float) $item['gia'],
                                    0,
                                    ',',
                                    '.'
                                ) ?> ₫

                            </p>

                        </div>


                        <!-- SỐ LƯỢNG -->

                        <div class="cart-item-quantity">

                            <span class="quantity-label">
                                Số lượng
                            </span>


                            <form
                                method="POST"
                                action="index.php?url=cap-nhat-gio-hang"
                                class="quantity-form"
                            >

                                <input
                                    type="hidden"
                                    name="id"
                                    value="<?= (int) $item['id'] ?>"
                                >

                                <input
                                    type="number"
                                    name="so_luong"
                                    value="<?= (int) $item['so_luong'] ?>"
                                    min="1"
                                    max="<?= (int) $item['ton_kho'] ?>"
                                >

                                <button
                                    type="submit"
                                    title="Cập nhật số lượng"
                                >
                                    ↻
                                </button>

                            </form>


                            <small>

                                Còn
                                <?= (int) $item['ton_kho'] ?>
                                sản phẩm

                            </small>

                        </div>


                        <!-- THÀNH TIỀN + XÓA -->

                        <div class="cart-item-total">

                            <span>
                                Thành tiền
                            </span>


                            <strong>

                                <?= number_format(
                                    (float) $item['gia']
                                    * (int) $item['so_luong'],
                                    0,
                                    ',',
                                    '.'
                                ) ?> ₫

                            </strong>


                            <form
                                method="POST"
                                action="index.php?url=xoa-gio-hang"
                            >

                                <input
                                    type="hidden"
                                    name="id"
                                    value="<?= (int) $item['id'] ?>"
                                >

                                <button
                                    type="submit"
                                    class="cart-delete-button"
                                    onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng?');"
                                >
                                    Xóa
                                </button>

                            </form>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>


            <!-- =====================================================
                 TỔNG ĐƠN HÀNG
                 ===================================================== -->

            <div class="cart-summary">

                <h3>
                    Tóm tắt đơn hàng
                </h3>


                <div class="cart-summary-row">

                    <span>
                        Số sản phẩm trong giỏ
                    </span>

                    <strong>
                        <?= count($chiTietGioHang) ?>
                    </strong>

                </div>


                <div class="cart-summary-row">

                    <span>
                        Đã chọn
                    </span>

                    <strong id="selected-count">
                        0
                    </strong>

                </div>


                <div class="cart-summary-divider"></div>


                <div class="cart-summary-total">

                    <span>
                        Tổng tiền giỏ hàng
                    </span>

                    <strong>

                        <?= number_format(
                            $tongTien,
                            0,
                            ',',
                            '.'
                        ) ?> ₫

                    </strong>

                </div>


                <!-- FORM GỬI SẢN PHẨM ĐƯỢC CHỌN -->

                <form
                    method="POST"
                    action="index.php?url=dat-hang"
                    id="checkout-selected-form"
                >

                    <div id="selected-products-container"></div>


                    <button
                        type="submit"
                        class="cart-checkout-button disabled"
                        id="checkout-button"
                        disabled
                    >
                        Tiến hành đặt hàng
                    </button>

                </form>


                <p class="cart-select-note">
                    Vui lòng chọn ít nhất một sản phẩm để đặt hàng.
                </p>


                <a
                    href="index.php?url=san-pham"
                    class="cart-continue-button"
                >
                    ← Tiếp tục mua sắm
                </a>

            </div>

        </div>

    <?php endif; ?>

</section>


<script>

/* =========================================================
   CHỌN SẢN PHẨM ĐẶT HÀNG
========================================================= */

document.addEventListener('DOMContentLoaded', function () {

    const checkboxes = document.querySelectorAll(
        '.cart-select-checkbox'
    );

    const checkoutButton = document.getElementById(
        'checkout-button'
    );

    const selectedCount = document.getElementById(
        'selected-count'
    );

    const selectedContainer = document.getElementById(
        'selected-products-container'
    );


    function capNhatSanPhamDaChon()
    {

        const selectedIds = [];


        checkboxes.forEach(function (checkbox) {

            const cartItem = checkbox.closest(
                '.cart-item'
            );


            if (checkbox.checked) {

                selectedIds.push(
                    checkbox.value
                );


                if (cartItem) {

                    cartItem.classList.add(
                        'cart-item-selected'
                    );

                }

            } else {

                if (cartItem) {

                    cartItem.classList.remove(
                        'cart-item-selected'
                    );

                }

            }

        });


        /* CẬP NHẬT SỐ LƯỢNG */

        if (selectedCount) {

            selectedCount.textContent =
                selectedIds.length;

        }


        /* XÓA INPUT CŨ */

        if (selectedContainer) {

            selectedContainer.innerHTML = '';

        }


        /* TẠO INPUT CHO TỪNG SẢN PHẨM */

        selectedIds.forEach(function (id) {

            const input =
                document.createElement('input');

            input.type = 'hidden';

            input.name = 'selected_ids[]';

            input.value = id;

            selectedContainer.appendChild(
                input
            );

        });


        /* BẬT / TẮT NÚT ĐẶT HÀNG */

        if (checkoutButton) {

            if (selectedIds.length > 0) {

                checkoutButton.disabled = false;

                checkoutButton.classList.remove(
                    'disabled'
                );

            } else {

                checkoutButton.disabled = true;

                checkoutButton.classList.add(
                    'disabled'
                );

            }

        }

    }


    /* THEO DÕI CHECKBOX */

    checkboxes.forEach(function (checkbox) {

        checkbox.addEventListener(
            'change',
            capNhatSanPhamDaChon
        );

    });


    /* KHỞI TẠO */

    capNhatSanPhamDaChon();

});

</script>