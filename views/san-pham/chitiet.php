<section class="product-detail-page">

    <!-- =========================
         THÔNG TIN SẢN PHẨM
         ========================= -->

    <div class="product-detail">

        <div class="product-detail-image">

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


        <div class="product-detail-info">

            <p class="product-category">
                <?= htmlspecialchars($sanPham['ten_danh_muc']) ?>
            </p>

            <h2>
                <?= htmlspecialchars($sanPham['ten_san_pham']) ?>
            </h2>

            <p class="product-detail-price">
                <?= number_format(
                    (float) $sanPham['gia'],
                    0,
                    ',',
                    '.'
                ) ?> ₫
            </p>

            <div class="product-description">

                <strong>Mô tả sản phẩm</strong>

                <p>
                    <?= nl2br(
                        htmlspecialchars($sanPham['mo_ta'])
                    ) ?>
                </p>

            </div>


            <?php if (!empty($bienThes)): ?>

                <form
                    method="POST"
                    action="index.php?url=them-gio-hang"
                    class="product-buy-form"
                >

                    <input
                        type="hidden"
                        name="san_pham_id"
                        value="<?= (int) $sanPham['id'] ?>"
                    >


                    <!-- SIZE -->

                    <div class="product-option">

                        <label>
                            <strong>Size:</strong>
                        </label>

                        <?php
                        $sizes = [];

                        foreach ($bienThes as $bienThe) {

                            if (
                                !in_array(
                                    $bienThe['size'],
                                    $sizes
                                )
                            ) {
                                $sizes[] = $bienThe['size'];
                            }
                        }
                        ?>

                        <div class="option-list">

                            <?php foreach ($sizes as $size): ?>

                                <label class="option-item">

                                    <input
                                        type="radio"
                                        name="size"
                                        value="<?= htmlspecialchars($size) ?>"
                                        required
                                    >

                                    <span>
                                        <?= htmlspecialchars($size) ?>
                                    </span>

                                </label>

                            <?php endforeach; ?>

                        </div>

                    </div>


                    <!-- MÀU SẮC -->

                    <div class="product-option">

                        <label>
                            <strong>Màu sắc:</strong>
                        </label>

                        <?php
                        $mauSacs = [];

                        foreach ($bienThes as $bienThe) {

                            if (
                                !in_array(
                                    $bienThe['mau_sac'],
                                    $mauSacs
                                )
                            ) {
                                $mauSacs[] = $bienThe['mau_sac'];
                            }
                        }
                        ?>

                        <div class="option-list">

                            <?php foreach ($mauSacs as $mauSac): ?>

                                <label class="option-item">

                                    <input
                                        type="radio"
                                        name="mau_sac"
                                        value="<?= htmlspecialchars($mauSac) ?>"
                                        required
                                    >

                                    <span>
                                        <?= htmlspecialchars($mauSac) ?>
                                    </span>

                                </label>

                            <?php endforeach; ?>

                        </div>

                    </div>


                    <!-- SỐ LƯỢNG -->

                    <div class="product-option quantity-option">

                        <label for="so_luong">
                            <strong>Số lượng:</strong>
                        </label>

                        <input
                            type="number"
                            id="so_luong"
                            name="so_luong"
                            value="1"
                            min="1"
                            required
                        >

                    </div>


                    <div class="product-action-buttons">

    <button
        type="submit"
        class="add-cart-button"
    >
        🛒 Thêm vào giỏ hàng
    </button>

    <button
        type="submit"
        class="buy-now-button"
        formaction="index.php?url=mua-ngay"
    >
        ⚡ Mua ngay
    </button>

</div>

                </form>

            <?php else: ?>

                <p>
                    Sản phẩm hiện chưa có biến thể.
                </p>

            <?php endif; ?>

        </div>

    </div>


    <!-- =========================
         ĐÁNH GIÁ SẢN PHẨM
         ========================= -->

    <div class="product-reviews">

        <div class="reviews-header">

            <p class="section-subtitle">
                CUSTOMER REVIEWS
            </p>

            <h2>
                Đánh giá sản phẩm
            </h2>

        </div>


        <!-- FORM ĐÁNH GIÁ -->

        <?php if (
            isset($_SESSION['khach_hang'])
        ): ?>

            <div class="review-form-box">

                <h3>
                    Để lại đánh giá của bạn
                </h3>

                <form
                    method="POST"
                    action="index.php?url=them-danh-gia"
                >

                    <input
                        type="hidden"
                        name="san_pham_id"
                        value="<?= (int) $sanPham['id'] ?>"
                    >


                    <div class="review-stars">

                        <p>
                            <strong>Đánh giá:</strong>
                        </p>

                        <label>
                            <input
                                type="radio"
                                name="so_sao"
                                value="1"
                                required
                            >
                            ⭐
                        </label>

                        <label>
                            <input
                                type="radio"
                                name="so_sao"
                                value="2"
                            >
                            ⭐⭐
                        </label>

                        <label>
                            <input
                                type="radio"
                                name="so_sao"
                                value="3"
                            >
                            ⭐⭐⭐
                        </label>

                        <label>
                            <input
                                type="radio"
                                name="so_sao"
                                value="4"
                            >
                            ⭐⭐⭐⭐
                        </label>

                        <label>
                            <input
                                type="radio"
                                name="so_sao"
                                value="5"
                            >
                            ⭐⭐⭐⭐⭐
                        </label>

                    </div>


                    <div class="review-content">

                        <label for="noi_dung">
                            <strong>
                                Cảm nhận của bạn:
                            </strong>
                        </label>

                        <textarea
                            id="noi_dung"
                            name="noi_dung"
                            rows="5"
                            placeholder="Nhập cảm nhận của bạn về sản phẩm..."
                            required
                        ></textarea>

                    </div>


                    <button
                        type="submit"
                        class="review-submit-button"
                    >
                        Gửi đánh giá
                    </button>

                </form>

            </div>

        <?php else: ?>

            <div class="review-login-message">

                <p>
                    Vui lòng
                    <a href="index.php?url=dang-nhap">
                        đăng nhập
                    </a>
                    để đánh giá sản phẩm.
                </p>

            </div>

        <?php endif; ?>


        <!-- DANH SÁCH ĐÁNH GIÁ -->

        <div class="review-list">

            <h3>
                Đánh giá từ khách hàng
            </h3>


            <?php if (empty($danhGias)): ?>

                <p class="no-reviews">
                    Sản phẩm chưa có đánh giá nào.
                </p>

            <?php else: ?>

                <?php foreach ($danhGias as $danhGia): ?>

                    <div class="review-item">

                        <div class="review-item-header">

                            <strong>
                                <?= htmlspecialchars(
                                    $danhGia['ho_ten']
                                ) ?>
                            </strong>

                            <span class="review-rating">

                                <?php
                                $soSao = (int) $danhGia['so_sao'];

                                for ($i = 1; $i <= 5; $i++) {
                                    echo $i <= $soSao
                                        ? '⭐'
                                        : '☆';
                                }
                                ?>

                            </span>

                        </div>


                        <p class="review-date">

                            <?= date(
                                'd/m/Y H:i',
                                strtotime(
                                    $danhGia['ngay_tao']
                                )
                            ) ?>

                        </p>


                        <p class="review-text">

                            <?= nl2br(
                                htmlspecialchars(
                                    $danhGia['noi_dung']
                                )
                            ) ?>

                        </p>

                    </div>

                <?php endforeach; ?>

            <?php endif; ?>

        </div>

    </div>


    <!-- QUAY LẠI -->

    <div class="product-detail-back">

        <a href="index.php?url=san-pham">
            ← Quay lại danh sách sản phẩm
        </a>

    </div>

</section>