<section class="auth-page">

    <div class="auth-box register-box">

        <div class="auth-header">

            <h2>
                Đăng ký tài khoản
            </h2>

            <p>
                Tạo tài khoản ZAVYWEB để mua sắm
            </p>

        </div>


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
            action="index.php?url=xu-ly-dang-ky"
            method="POST"
            class="auth-form"
        >

            <div class="form-group">

                <label for="ho_ten">
                    Họ tên
                </label>

                <input
                    type="text"
                    id="ho_ten"
                    name="ho_ten"
                    placeholder="Nhập họ tên"
                    required
                >

            </div>


            <div class="form-group">

                <label for="email">
                    Email
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Nhập email"
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


            <div class="form-group">

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


            <div class="form-group">

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


            <button
                type="submit"
                class="auth-button"
            >
                Đăng ký
            </button>

        </form>


        <div class="auth-register">

            <span>
                Đã có tài khoản?
            </span>

            <a href="index.php?url=dang-nhap">
                Đăng nhập
            </a>

        </div>

    </div>

</section>