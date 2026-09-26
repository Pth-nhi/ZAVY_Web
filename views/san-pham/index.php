<section class="product-page">

    <div class="product-header">

        <p class="section-subtitle">
            ZAVY COLLECTION
        </p>

        <?php if (!empty($tuKhoa)): ?>

            <h2>
                Kết quả tìm kiếm
            </h2>

            <p>
                Kết quả tìm kiếm cho từ khóa:
                <strong>
                    "<?= htmlspecialchars($tuKhoa) ?>"
                </strong>
            </p>

        <?php elseif ($danhMuc !== null): ?>

            <h2>
                <?= htmlspecialchars($danhMuc['ten_danh_muc']) ?>
            </h2>

            <p>
                <?= htmlspecialchars($danhMuc['mo_ta'] ?? '') ?>
            </p>

        <?php else: ?>

            <h2>
                Sản phẩm
            </h2>

            <p>
                Vui lòng chọn một danh mục sản phẩm để xem các sản phẩm.
            </p>

        <?php endif; ?>

    </div>


    <?php if (!empty($tuKhoa)): ?>

        <?php if (empty($sanPhams)): ?>

            <div class="product-empty">

                <p>
                    Không tìm thấy sản phẩm phù hợp với từ khóa
                    <strong>
                        "<?= htmlspecialchars($tuKhoa) ?>"
                    </strong>.
                </p>

            </div>

        <?php else: ?>

            <div class="product-grid">

                <?php foreach ($sanPhams as $sanPham): ?>

                    <div class="product-card">

                        <div class="product-image">

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


                        <div class="product-info">

                            <p class="product-category">
                                <?= htmlspecialchars($sanPham['ten_danh_muc']) ?>
                            </p>

                            <h3>
                                <?= htmlspecialchars($sanPham['ten_san_pham']) ?>
                            </h3>

                            <p class="product-price">
                                <?= number_format(
                                    (float) $sanPham['gia'],
                                    0,
                                    ',',
                                    '.'
                                ) ?> ₫
                            </p>

                            <a
                                class="product-detail-button"
                                href="index.php?url=chi-tiet-san-pham&id=<?= (int) $sanPham['id'] ?>"
                            >
                                Xem chi tiết
                            </a>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>

        <?php endif; ?>


    <?php elseif ($danhMuc === null): ?>

        <div class="product-empty">

            <p>
                Hãy di chuột vào mục
                <strong>Sản phẩm ▼</strong>
                trên thanh menu và chọn danh mục bạn muốn xem.
            </p>

        </div>


    <?php elseif (empty($sanPhams)): ?>

        <div class="product-empty">

            <p>
                Danh mục này hiện chưa có sản phẩm.
            </p>

        </div>


    <?php else: ?>

        <div class="product-grid">

            <?php foreach ($sanPhams as $sanPham): ?>

                <div class="product-card">

                    <div class="product-image">

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


                    <div class="product-info">

                        <p class="product-category">
                            <?= htmlspecialchars($sanPham['ten_danh_muc']) ?>
                        </p>

                        <h3>
                            <?= htmlspecialchars($sanPham['ten_san_pham']) ?>
                        </h3>

                        <p class="product-price">
                            <?= number_format(
                                (float) $sanPham['gia'],
                                0,
                                ',',
                                '.'
                            ) ?> ₫
                        </p>

                        <a
                            class="product-detail-button"
                            href="index.php?url=chi-tiet-san-pham&id=<?= (int) $sanPham['id'] ?>"
                        >
                            Xem chi tiết
                        </a>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    <?php endif; ?>

</section>