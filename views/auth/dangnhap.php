<section class="auth-page">

    <div class="auth-box">

        <div class="auth-header">

            <h2>
                Đăng nhập tài khoản ZAVYWEB
            </h2>

            <p>
                Vui lòng đăng nhập
            </p>

        </div>


        <!-- CHỌN ĐĂNG NHẬP KHÁCH HÀNG -->

        <!-- ĐĂNG NHẬP ADMIN -->

        <a
            href="index.php?url=admin-dang-nhap"
            class="login-choice"
        >
            Đăng nhập bằng tài khoản Admin
        </a>


        <!-- FORM KHÁCH HÀNG -->

        <div
            id="form-khach-hang"
            class="customer-login-form"
        >

            <?php if (!empty($error)): ?>

                <div class="auth-message auth-error">
                    <?= htmlspecialchars($error) ?>
                </div>

            <?php endif; ?>


            <?php if (!empty($success)): ?>

                <div class="auth-message auth-success">
                    <?= htmlspecialchars($success) ?>
                </div>

            <?php endif; ?>


            <form
                action="index.php?url=xu-ly-dang-nhap"
                method="POST"
                class="auth-form"
            >

                <div class="form-group">

                    <label for="email">
                        Email
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Nhập email của bạn"
                        required
                    >

                </div>


                <div class="form-group">

                    <label for="mat_khau">
                        Mật khẩu
                    </label>

                    <input
                        type="password"
                        id="mat_khau"
                        name="mat_khau"
                        placeholder="Nhập mật khẩu"
                        required
                    >

                </div>


                <button
                    type="submit"
                    class="auth-button"
                >
                    Đăng nhập
                </button>

            </form>


            <div class="auth-register">

                Chưa có tài khoản?

                <a href="index.php?url=dang-ky">
                    Đăng ký
                </a>

            </div>

        </div>

    </div>

</section>


<script>

function hienFormKhachHang()
{
    const form = document.getElementById('form-khach-hang');

    if (form) {

        form.style.display = 'block';

        form.scrollIntoView({
            behavior: 'smooth',
            block: 'nearest'
        });

    }
}

</script>