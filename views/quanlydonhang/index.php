<?php

$title = 'Quản lý đơn hàng - ZAVYWEB';

require __DIR__ . '/../layouts/header.php';

?>

<style>
    .quan-ly-don-hang-page {
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 20px 50px;
    }

    /* TIÊU ĐỀ */

    .quan-ly-don-hang-title {
        text-align: center;
        margin-bottom: 30px;
    }

    .quan-ly-don-hang-title .subtitle {
        color: #6a1b9a;
        font-size: 14px;
        font-weight: bold;
        letter-spacing: 2px;
        margin-bottom: 8px;
    }

    .quan-ly-don-hang-title h1 {
        margin: 0 0 10px;
        color: #222;
        font-size: 30px;
    }

    .quan-ly-don-hang-title p {
        margin: 0;
        color: #666;
        font-size: 16px;
    }


    /* BỘ LỌC ĐƠN HÀNG */

    .don-hang-tabs {
        display: flex;
        justify-content: center;
        gap: 10px;
        flex-wrap: wrap;
        margin-bottom: 30px;
    }

    .don-hang-tab {
        display: inline-block;
        padding: 10px 22px;
        background: #fff;
        color: #444;
        border: 1px solid #ddd;
        border-radius: 20px;
        text-decoration: none;
        font-weight: bold;
        transition: 0.2s;
    }

    .don-hang-tab:hover {
        color: #6a1b9a;
        border-color: #6a1b9a;
    }

    .don-hang-tab.active {
        background: #6a1b9a;
        color: #fff;
        border-color: #6a1b9a;
    }


    /* DANH SÁCH ĐƠN HÀNG */

    .don-hang-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .don-hang-card {
        background: #fff;
        border: 1px solid #e5e5e5;
        border-left: 5px solid #6a1b9a;
        border-radius: 12px;
        padding: 22px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
    }


    /* HEADER ĐƠN */

    .don-hang-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        padding-bottom: 15px;
        margin-bottom: 15px;
        border-bottom: 1px solid #eee;
    }

    .don-hang-code {
        font-size: 18px;
        font-weight: bold;
        color: #222;
    }


    /* TRẠNG THÁI */

    .order-status {
        display: inline-block;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: bold;
    }

    .order-status.pending {
        background: #fff3cd;
        color: #856404;
    }

    .order-status.confirmed {
        background: #f3e5f5;
        color: #6a1b9a;
    }

    .order-status.shipping {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .order-status.delivered {
        background: #d1fae5;
        color: #047857;
    }

    .order-status.cancelled {
        background: #fee2e2;
        color: #b91c1c;
    }


    /* THÔNG TIN ĐƠN */

    .don-hang-info {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px 30px;
    }

    .don-hang-info p {
        margin: 0;
        color: #555;
        line-height: 1.6;
    }

    .don-hang-info strong {
        color: #222;
    }

    .don-hang-total {
        color: #6a1b9a;
        font-size: 17px;
        font-weight: bold;
    }

    .don-hang-address {
        word-break: break-word;
    }


    /* NÚT THAO TÁC */

    .don-hang-actions {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 10px;
        margin-top: 20px;
        padding-top: 15px;
        border-top: 1px solid #eee;
    }

    .don-hang-detail-button {
        display: inline-block;
        padding: 9px 18px;
        background: #6a1b9a;
        color: #fff;
        text-decoration: none;
        border-radius: 6px;
        font-weight: bold;
        transition: 0.2s;
    }

    .don-hang-detail-button:hover {
        background: #4a126d;
    }

    .don-hang-cancel-button {
        padding: 9px 18px;
        background: #fff;
        color: #d32f2f;
        border: 1px solid #d32f2f;
        border-radius: 6px;
        font-weight: bold;
        cursor: pointer;
        transition: 0.2s;
    }

    .don-hang-cancel-button:hover {
        background: #d32f2f;
        color: #fff;
    }


    /* KHÔNG CÓ ĐƠN */

    .don-hang-empty {
        background: #fff;
        border: 1px solid #e5e5e5;
        border-radius: 12px;
        padding: 55px 20px;
        text-align: center;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
    }

    .don-hang-empty-icon {
        font-size: 45px;
        margin-bottom: 10px;
    }

    .don-hang-empty h3 {
        margin: 0 0 8px;
        color: #555;
    }

    .don-hang-empty p {
        margin: 0 0 20px;
        color: #888;
    }

    .don-hang-shopping-button {
        display: inline-block;
        padding: 10px 22px;
        background: #6a1b9a;
        color: #fff;
        text-decoration: none;
        border-radius: 6px;
        font-weight: bold;
    }

    .don-hang-shopping-button:hover {
        background: #4a126d;
    }


    /* RESPONSIVE */

    @media (max-width: 700px) {

        .quan-ly-don-hang-page {
            margin-top: 25px;
        }

        .quan-ly-don-hang-title h1 {
            font-size: 26px;
        }

        .don-hang-card-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .don-hang-info {
            grid-template-columns: 1fr;
        }

        .don-hang-actions {
            justify-content: flex-start;
            flex-wrap: wrap;
        }
    }
</style>


<section class="quan-ly-don-hang-page">


    <!-- TIÊU ĐỀ -->



    <?php

    /*
     * Bộ lọc đơn hàng
     *
     * tat-ca      : Tất cả đơn hàng
     * dang-mua    : Đơn đang xử lý
     * da-giao     : Đơn đã giao
     * da-huy      : Đơn đã hủy
     */

    $boLoc = $_GET['bo-loc'] ?? 'tat-ca';

    $donHangsHienThi = [];

    foreach ($donHangs as $donHang) {

        $trangThai = $donHang['trang_thai'] ?? '';

        if ($boLoc === 'tat-ca') {

            $donHangsHienThi[] = $donHang;

        } elseif ($boLoc === 'dang-mua') {

            if (
                $trangThai === 'Chờ xác nhận' ||
                $trangThai === 'Đã xác nhận' ||
                $trangThai === 'Đang giao'
            ) {
                $donHangsHienThi[] = $donHang;
            }

        } elseif ($boLoc === 'da-giao') {

            if ($trangThai === 'Đã giao') {
                $donHangsHienThi[] = $donHang;
            }

        } elseif ($boLoc === 'da-huy') {

            if ($trangThai === 'Đã hủy') {
                $donHangsHienThi[] = $donHang;
            }
        }
    }

    ?>


    <!-- BỘ LỌC -->

    <div class="don-hang-tabs">

        <a
            href="index.php?url=quan-ly-don-hang&bo-loc=tat-ca"
            class="don-hang-tab <?= $boLoc === 'tat-ca' ? 'active' : '' ?>"
        >
            Tất cả
        </a>

        <a
            href="index.php?url=quan-ly-don-hang&bo-loc=dang-mua"
            class="don-hang-tab <?= $boLoc === 'dang-mua' ? 'active' : '' ?>"
        >
            Đang mua
        </a>

        <a
            href="index.php?url=quan-ly-don-hang&bo-loc=da-giao"
            class="don-hang-tab <?= $boLoc === 'da-giao' ? 'active' : '' ?>"
        >
            Đã giao
        </a>

        <a
            href="index.php?url=quan-ly-don-hang&bo-loc=da-huy"
            class="don-hang-tab <?= $boLoc === 'da-huy' ? 'active' : '' ?>"
        >
            Đã hủy
        </a>

    </div>


    <?php if (empty($donHangsHienThi)): ?>

        <!-- KHÔNG CÓ ĐƠN HÀNG -->

        <div class="don-hang-empty">

            <div class="don-hang-empty-icon">
                🛍
            </div>

            <h3>
                Không có đơn hàng
            </h3>

            <p>
                Hiện chưa có đơn hàng thuộc trạng thái này.
            </p>

            <a
                href="index.php?url=san-pham"
                class="don-hang-shopping-button"
            >
                Bắt đầu mua sắm
            </a>

        </div>


    <?php else: ?>


        <!-- DANH SÁCH ĐƠN HÀNG -->

        <div class="don-hang-list">


            <?php foreach ($donHangsHienThi as $donHang): ?>

                <?php

                $trangThai = $donHang['trang_thai'] ?? '';

                $classTrangThai = 'pending';

                if ($trangThai === 'Đã xác nhận') {

                    $classTrangThai = 'confirmed';

                } elseif ($trangThai === 'Đang giao') {

                    $classTrangThai = 'shipping';

                } elseif ($trangThai === 'Đã giao') {

                    $classTrangThai = 'delivered';

                } elseif ($trangThai === 'Đã hủy') {

                    $classTrangThai = 'cancelled';

                }

                ?>


                <div class="don-hang-card">


                    <!-- HEADER ĐƠN -->

                    <div class="don-hang-card-header">

                        <span class="don-hang-code">
                            Đơn hàng #<?= (int) $donHang['id'] ?>
                        </span>

                        <span class="order-status <?= $classTrangThai ?>">
                            <?= htmlspecialchars($trangThai) ?>
                        </span>

                    </div>


                    <!-- THÔNG TIN ĐƠN -->

                    <div class="don-hang-info">


                        <p>

                            <strong>
                                Tổng tiền:
                            </strong>

                            <span class="don-hang-total">

                                <?= number_format(
                                    (float) $donHang['tong_tien'],
                                    0,
                                    ',',
                                    '.'
                                ) ?>

                                VNĐ

                            </span>

                        </p>


                        <p>

                            <strong>
                                Ngày đặt:
                            </strong>

                            <?= htmlspecialchars(
                                $donHang['ngay_dat']
                            ) ?>

                        </p>


                        <p>

                            <strong>
                                Số điện thoại:
                            </strong>

                            <?= htmlspecialchars(
                                $donHang['so_dien_thoai']
                            ) ?>

                        </p>


                        <p class="don-hang-address">

                            <strong>
                                Địa chỉ giao hàng:
                            </strong>

                            <?= htmlspecialchars(
                                $donHang['dia_chi_giao_hang']
                            ) ?>

                        </p>


                    </div>


                    <!-- THAO TÁC -->

                    <div class="don-hang-actions">


                        <a
                            href="index.php?url=chi-tiet-don-hang&id=<?= (int) $donHang['id'] ?>"
                            class="don-hang-detail-button"
                        >
                            Xem chi tiết
                        </a>


                        <?php if ($trangThai === 'Chờ xác nhận'): ?>

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
                                    class="don-hang-cancel-button"
                                >
                                    Hủy đơn
                                </button>

                            </form>

                        <?php endif; ?>


                    </div>


                </div>


            <?php endforeach; ?>


        </div>


    <?php endif; ?>


</section>


<?php

require __DIR__ . '/../layouts/footer.php';

?>