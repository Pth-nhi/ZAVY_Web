<style>

/* =========================================================
   TRANG LIÊN HỆ - ZAVYWEB
========================================================= */

.contact-page {
    max-width: 1100px !important;

    margin: 0 auto !important;

    padding: 55px 30px 70px !important;

    box-sizing: border-box !important;

    background: #f5f5f5 !important;
}


/* HEADER */

.contact-header {
    text-align: center !important;

    margin-bottom: 40px !important;
}

.contact-header .section-subtitle {
    margin: 0 0 8px !important;

    color: #6a1b9a !important;

    font-size: 13px !important;

    font-weight: 700 !important;

    letter-spacing: 2px !important;

    text-transform: uppercase !important;
}

.contact-header h2 {
    margin: 0 0 10px !important;

    color: #222222 !important;

    font-size: 32px !important;

    font-weight: 700 !important;
}

.contact-header > p:last-child {
    margin: 0 !important;

    color: #666666 !important;

    font-size: 15px !important;
}


/* KHUNG 2 CỘT */

.contact-layout {
    display: grid !important;

    grid-template-columns: 0.9fr 1.1fr !important;

    gap: 30px !important;

    align-items: stretch !important;
}


/* PHẦN GIỚI THIỆU */

.contact-intro {
    padding: 35px !important;

    box-sizing: border-box !important;

    background: #222222 !important;

    border-radius: 12px !important;

    color: #ffffff !important;

    min-height: 470px !important;

    display: flex !important;

    flex-direction: column !important;

    justify-content: center !important;
}

.contact-intro-icon {
    width: 52px !important;

    height: 52px !important;

    display: flex !important;

    align-items: center !important;

    justify-content: center !important;

    margin-bottom: 22px !important;

    background: #6a1b9a !important;

    border-radius: 50% !important;

    color: #ffffff !important;

    font-size: 23px !important;
}

.contact-intro h3 {
    margin: 0 0 15px !important;

    color: #ffffff !important;

    font-size: 23px !important;
}

.contact-intro > p {
    margin: 0 !important;

    color: #dddddd !important;

    font-size: 14px !important;

    line-height: 1.8 !important;
}


/* ZAVYWEB */

.contact-note {
    display: flex !important;

    flex-direction: column !important;

    gap: 5px !important;

    margin-top: 30px !important;

    padding-top: 22px !important;

    border-top: 1px solid #555555 !important;
}

.contact-note strong {
    color: #ffffff !important;

    font-size: 18px !important;
}

.contact-note span {
    color: #bbbbbb !important;

    font-size: 13px !important;
}


/* FORM */

.contact-form-box {
    padding: 35px !important;

    box-sizing: border-box !important;

    background: #ffffff !important;

    border: 1px solid #e4e4e4 !important;

    border-radius: 12px !important;

    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.06) !important;
}

.contact-form-box h3 {
    margin: 0 0 7px !important;

    color: #222222 !important;

    font-size: 23px !important;
}

.contact-form-description {
    margin: 0 0 25px !important;

    color: #777777 !important;

    font-size: 14px !important;
}


/* NHÓM FORM */

.contact-form-group {
    margin-bottom: 18px !important;
}

.contact-form-group label {
    display: block !important;

    margin-bottom: 7px !important;

    color: #222222 !important;

    font-size: 14px !important;

    font-weight: 600 !important;
}


/* INPUT */

.contact-form-group input,
.contact-form-group textarea {
    display: block !important;

    width: 100% !important;

    box-sizing: border-box !important;

    padding: 12px 14px !important;

    border: 1px solid #d8d8d8 !important;

    border-radius: 7px !important;

    background: #ffffff !important;

    color: #222222 !important;

    font-family: Arial, sans-serif !important;

    font-size: 14px !important;

    outline: none !important;
}

.contact-form-group input {
    height: 44px !important;
}

.contact-form-group textarea {
    min-height: 120px !important;

    resize: vertical !important;
}

.contact-form-group input:focus,
.contact-form-group textarea:focus {
    border-color: #6a1b9a !important;

    box-shadow: 0 0 0 3px rgba(106, 27, 154, 0.10) !important;
}


/* NÚT GỬI */

.contact-submit-button {
    display: block !important;

    width: 100% !important;

    height: 45px !important;

    margin-top: 5px !important;

    padding: 0 20px !important;

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

.contact-submit-button:hover {
    background: #521478 !important;
}


/* THÔNG BÁO */

.contact-error {
    margin-bottom: 18px !important;

    padding: 10px 12px !important;

    border-radius: 6px !important;

    background: #ffe8e8 !important;

    color: #c62828 !important;

    font-size: 13px !important;
}


/* MOBILE */

@media (max-width: 768px) {

    .contact-page {
        padding: 35px 18px 50px !important;
    }

    .contact-layout {
        grid-template-columns: 1fr !important;
    }

    .contact-intro {
        min-height: auto !important;
    }

    .contact-header h2 {
        font-size: 27px !important;
    }

}

</style>


<section class="contact-page">


    <!-- HEADER -->

    <div class="contact-header">

        <p class="section-subtitle">
            ZAVY CONTACT
        </p>

        <h2>
            Liên hệ
        </h2>

        <p>
            Hãy để lại thông tin, ZAVYWEB sẽ tiếp nhận và phản hồi đến bạn.
        </p>

    </div>


    <!-- 2 CỘT -->

    <div class="contact-layout">


        <!-- GIỚI THIỆU -->

        <div class="contact-intro">

            <div class="contact-intro-icon">
                ✉
            </div>

            <h3>
                Bạn cần hỗ trợ?
            </h3>

            <p>
                Nếu bạn có câu hỏi, góp ý hoặc cần hỗ trợ
                về sản phẩm và đơn hàng, hãy gửi thông tin
                cho chúng tôi qua biểu mẫu bên cạnh.
            </p>

            <div class="contact-note">

                <strong>
                    ZAVYWEB
                </strong>

                <span>
                    Website bán quần áo trực tuyến
                </span>

            </div>

        </div>


        <!-- FORM -->

        <div class="contact-form-box">

            <h3>
                Gửi liên hệ
            </h3>

            <p class="contact-form-description">
                Vui lòng nhập đầy đủ thông tin bên dưới.
            </p>


            <?php if (!empty($error)): ?>

                <div class="contact-error">
                    <?= htmlspecialchars($error) ?>
                </div>

            <?php endif; ?>


            <form
                action="index.php?url=xu-ly-lien-he"
                method="POST"
            >

                <div class="contact-form-group">

                    <label for="ho_ten">
                        Họ và tên
                    </label>

                    <input
                        type="text"
                        id="ho_ten"
                        name="ho_ten"
                        placeholder="Nhập họ và tên"
                        required
                    >

                </div>


                <div class="contact-form-group">

                    <label for="so_dien_thoai">
                        Số điện thoại
                    </label>

                    <input
                        type="text"
                        id="so_dien_thoai"
                        name="so_dien_thoai"
                        placeholder="Nhập số điện thoại"
                        required
                    >

                </div>


                <div class="contact-form-group">

                    <label for="dia_chi">
                        Địa chỉ
                    </label>

                    <input
                        type="text"
                        id="dia_chi"
                        name="dia_chi"
                        placeholder="Nhập địa chỉ"
                        required
                    >

                </div>


                <div class="contact-form-group">

                    <label for="noi_dung">
                        Nội dung liên hệ
                    </label>

                    <textarea
                        id="noi_dung"
                        name="noi_dung"
                        placeholder="Nhập nội dung bạn muốn liên hệ..."
                        required
                    ></textarea>

                </div>


                <button
                    type="submit"
                    class="contact-submit-button"
                >
                    Gửi liên hệ
                </button>

            </form>

        </div>

    </div>

</section>