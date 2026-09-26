<style>

/* =========================================================
   ZAVY ACCOUNT - SỬA TÀI KHOẢN
========================================================= */

.account-edit-page {
    max-width: 720px !important;

    margin: 0 auto !important;

    padding: 55px 30px 70px !important;

    box-sizing: border-box !important;
}


/* HEADER */

.account-edit-header {
    text-align: center !important;

    margin-bottom: 30px !important;
}

.account-edit-header .section-subtitle {
    margin: 0 0 8px !important;

    color: #6a1b9a !important;

    font-size: 13px !important;

    font-weight: 700 !important;

    letter-spacing: 2px !important;
}

.account-edit-header h2 {
    margin: 0 0 10px !important;

    color: #222222 !important;

    font-size: 30px !important;
}

.account-edit-header p {
    margin: 0 !important;

    color: #777777 !important;

    font-size: 14px !important;
}


/* KHUNG FORM */

.account-edit-box {
    background: #ffffff !important;

    border: 1px solid #e5e5e5 !important;

    border-radius: 12px !important;

    padding: 35px !important;

    box-sizing: border-box !important;

    box-shadow: 0 5px 20px rgba(0,0,0,0.06) !important;
}


/* MÔ TẢ */

.account-edit-description {
    margin: 0 0 25px !important;

    padding-bottom: 18px !important;

    border-bottom: 1px solid #eeeeee !important;

    color: #777777 !important;

    font-size: 13px !important;
}


/* NHÓM FORM */

.account-edit-group {
    margin-bottom: 18px !important;
}

.account-edit-group label {
    display: block !important;

    margin-bottom: 7px !important;

    color: #222222 !important;

    font-size: 14px !important;

    font-weight: 600 !important;
}


/* INPUT */

.account-edit-group input {
    display: block !important;

    width: 100% !important;

    height: 44px !important;

    box-sizing: border-box !important;

    padding: 0 14px !important;

    border: 1px solid #d5d5d5 !important;

    border-radius: 7px !important;

    background: #ffffff !important;

    color: #222222 !important;

    font-family: Arial, sans-serif !important;

    font-size: 14px !important;

    outline: none !important;
}

.account-edit-group input:focus {
    border-color: #6a1b9a !important;

    box-shadow: 0 0 0 3px rgba(106,27,154,0.10) !important;
}


/* NÚT */

.account-edit-actions {
    display: flex !important;

    gap: 12px !important;

    margin-top: 25px !important;
}

.account-edit-submit {
    flex: 1 !important;

    height: 45px !important;

    border: none !important;

    border-radius: 7px !important;

    background: #6a1b9a !important;

    color: #ffffff !important;

    font-size: 14px !important;

    font-weight: 600 !important;

    cursor: pointer !important;
}

.account-edit-submit:hover {
    background: #521478 !important;
}

.account-edit-back {
    display: flex !important;

    flex: 1 !important;

    align-items: center !important;

    justify-content: center !important;

    height: 45px !important;

    box-sizing: border-box !important;

    border: 1px solid #d5d5d5 !important;

    border-radius: 7px !important;

    background: #ffffff !important;

    color: #333333 !important;

    text-decoration: none !important;

    font-size: 14px !important;

    font-weight: 600 !important;
}

.account-edit-back:hover {
    border-color: #6a1b9a !important;

    color: #6a1b9a !important;
}


/* MOBILE */

@media (max-width: 600px) {

    .account-edit-page {
        padding: 35px 18px 50px !important;
    }

    .account-edit-box {
        padding: 25px 20px !important;
    }

    .account-edit-actions {
        flex-direction: column !important;
    }

}

</style>


<section class="account-edit-page">


    <!-- HEADER -->

    <div class="account-edit-header">

        <p class="section-subtitle">
            ZAVY ACCOUNT
        </p>

        <h2>
            Sửa tài khoản
        </h2>

        <p>
            Cập nhật thông tin cá nhân của bạn.
        </p>

    </div>


    <!-- FORM -->

    <div class="account-edit-box">

        <p class="account-edit-description">
            Nhập thông tin mới và bấm cập nhật để lưu thay đổi.
        </p>


        <?php if (!empty($error)): ?>

            <div class="auth-message auth-error">
                <?= htmlspecialchars($error) ?>
            </div>

        <?php endif; ?>


        <form
            action="index.php?url=xu-ly-sua-tai-khoan"
            method="POST"
        >


            <div class="account-edit-group">

                <label for="ho_ten">
                    Họ và tên
                </label>

                <input
                    type="text"
                    id="ho_ten"
                    name="ho_ten"
                    value="<?= htmlspecialchars($khachHang['ho_ten'] ?? '') ?>"
                    required
                >

            </div>


            <div class="account-edit-group">

                <label for="email">
                    Email
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="<?= htmlspecialchars($khachHang['email'] ?? '') ?>"
                    required
                >

            </div>


            <div class="account-edit-group">

                <label for="so_dien_thoai">
                    Số điện thoại
                </label>

                <input
                    type="text"
                    id="so_dien_thoai"
                    name="so_dien_thoai"
                    value="<?= htmlspecialchars($khachHang['so_dien_thoai'] ?? '') ?>"
                    required
                >

            </div>


            <div class="account-edit-group">

                <label for="dia_chi">
                    Địa chỉ
                </label>

                <input
                    type="text"
                    id="dia_chi"
                    name="dia_chi"
                    value="<?= htmlspecialchars($khachHang['dia_chi'] ?? '') ?>"
                    required
                >

            </div>


            <div class="account-edit-actions">

                <a
                    href="index.php?url=thong-tin-tai-khoan"
                    class="account-edit-back"
                >
                    ← Quay lại
                </a>

                <button
                    type="submit"
                    class="account-edit-submit"
                >
                    Cập nhật
                </button>

            </div>


        </form>

    </div>

</section>