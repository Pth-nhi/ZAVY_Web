<style>

/* =========================================================
   ZAVY ACCOUNT - THÔNG TIN CÁ NHÂN
========================================================= */

.account-page {
    max-width: 1000px !important;
    margin: 0 auto !important;
    padding: 55px 30px 70px !important;
    box-sizing: border-box !important;
}


/* HEADER */

.account-header {
    text-align: center !important;
    margin-bottom: 35px !important;
}

.account-header .section-subtitle {
    margin: 0 0 8px !important;
    color: #6a1b9a !important;
    font-size: 13px !important;
    font-weight: 700 !important;
    letter-spacing: 2px !important;
}

.account-header h2 {
    margin: 0 0 10px !important;
    color: #222222 !important;
    font-size: 30px !important;
}

.account-header p {
    margin: 0 !important;
    color: #777777 !important;
    font-size: 14px !important;
}


/* KHUNG */

.account-box {
    background: #ffffff !important;

    border: 1px solid #e5e5e5 !important;

    border-radius: 12px !important;

    padding: 35px !important;

    box-sizing: border-box !important;

    box-shadow: 0 5px 20px rgba(0,0,0,0.06) !important;
}


/* TIÊU ĐỀ */

.account-box-header {
    margin-bottom: 28px !important;

    padding-bottom: 18px !important;

    border-bottom: 1px solid #eeeeee !important;
}

.account-box-header h3 {
    margin: 0 0 5px !important;

    color: #222222 !important;

    font-size: 21px !important;
}

.account-box-header p {
    margin: 0 !important;

    color: #777777 !important;

    font-size: 13px !important;
}


/* AVATAR */

.account-avatar-large {
    width: 70px !important;

    height: 70px !important;

    display: flex !important;

    align-items: center !important;

    justify-content: center !important;

    margin: 0 auto 25px !important;

    border-radius: 50% !important;

    background: #f1e5f7 !important;

    color: #6a1b9a !important;

    font-size: 28px !important;

    font-weight: 700 !important;
}


/* THÔNG TIN */

.account-info-list {
    max-width: 650px !important;

    margin: 0 auto !important;
}

.account-info-row {
    display: flex !important;

    justify-content: space-between !important;

    gap: 25px !important;

    padding: 15px 0 !important;

    border-bottom: 1px solid #eeeeee !important;
}

.account-info-label {
    color: #777777 !important;

    font-size: 14px !important;
}

.account-info-value {
    color: #222222 !important;

    font-size: 14px !important;

    font-weight: 600 !important;

    text-align: right !important;
}


/* NÚT */

.account-actions {
    display: flex !important;

    justify-content: center !important;

    gap: 12px !important;

    margin-top: 30px !important;
}

.account-button {
    display: inline-block !important;

    padding: 11px 20px !important;

    border-radius: 7px !important;

    text-decoration: none !important;

    font-size: 13px !important;

    font-weight: 600 !important;
}

.account-edit-button {
    background: #6a1b9a !important;

    color: #ffffff !important;
}

.account-edit-button:hover {
    background: #521478 !important;
}

.account-delete-button {
    background: #ffffff !important;

    color: #c62828 !important;

    border: 1px solid #c62828 !important;
}

.account-delete-button:hover {
    background: #c62828 !important;

    color: #ffffff !important;
}


/* MOBILE */

@media (max-width: 600px) {

    .account-page {
        padding: 35px 18px 50px !important;
    }

    .account-box {
        padding: 25px 20px !important;
    }

    .account-info-row {
        flex-direction: column !important;

        gap: 5px !important;
    }

    .account-info-value {
        text-align: left !important;
    }

    .account-actions {
        flex-direction: column !important;
    }

    .account-button {
        text-align: center !important;
    }

}

</style>


<section class="account-page">


    <!-- HEADER -->

    <div class="account-header">

        <p class="section-subtitle">
            ZAVY ACCOUNT
        </p>

        <h2>
            Quản lý thông tin cá nhân
        </h2>

        <p>
            Xem và quản lý thông tin tài khoản của bạn.
        </p>

    </div>


    <!-- KHUNG THÔNG TIN -->

    <div class="account-box">

        <div class="account-box-header">

            <h3>
                Thông tin cá nhân
            </h3>

            <p>
                Thông tin tài khoản hiện tại
            </p>

        </div>


        <div class="account-avatar-large">

            <?= htmlspecialchars(
                mb_substr(
                    $khachHang['ho_ten'] ?? 'N',
                    0,
                    1
                )
            ) ?>

        </div>


        <div class="account-info-list">


            <div class="account-info-row">

                <span class="account-info-label">
                    Họ và tên
                </span>

                <span class="account-info-value">
                    <?= htmlspecialchars($khachHang['ho_ten'] ?? '') ?>
                </span>

            </div>


            <div class="account-info-row">

                <span class="account-info-label">
                    Email
                </span>

                <span class="account-info-value">
                    <?= htmlspecialchars($khachHang['email'] ?? '') ?>
                </span>

            </div>


            <div class="account-info-row">

                <span class="account-info-label">
                    Số điện thoại
                </span>

                <span class="account-info-value">
                    <?= htmlspecialchars(
                        $khachHang['so_dien_thoai'] ?? 'Chưa cập nhật'
                    ) ?>
                </span>

            </div>


            <div class="account-info-row">

                <span class="account-info-label">
                    Địa chỉ
                </span>

                <span class="account-info-value">
                    <?= htmlspecialchars(
                        $khachHang['dia_chi'] ?? 'Chưa cập nhật'
                    ) ?>
                </span>

            </div>


            <div class="account-info-row">

                <span class="account-info-label">
                    Ngày tạo tài khoản
                </span>

                <span class="account-info-value">
                    <?= htmlspecialchars(
                        $khachHang['ngay_tao'] ?? 'Chưa cập nhật'
                    ) ?>
                </span>

            </div>


        </div>


        <div class="account-actions">

            <a
                href="index.php?url=sua-tai-khoan"
                class="account-button account-edit-button"
            >
                Sửa tài khoản
            </a>

            <a
                href="index.php?url=xoa-tai-khoan"
                class="account-button account-delete-button"
                onclick="return confirm('Bạn có chắc muốn xóa tài khoản không?');"
            >
                Xóa tài khoản
            </a>

        </div>

    </div>

</section>