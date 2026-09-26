<?php

$title = 'Đăng nhập Admin - ZAVYWEB';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= htmlspecialchars($title) ?></title>

    <link rel="stylesheet" href="/ZAVYWEB/public/css/style.css?v=4">

    <style>
        .admin-login-page {
            min-height: 100vh;
            background: #f5f5f5;

            display: flex;
            justify-content: center;
            align-items: center;

            padding: 40px 20px;
            box-sizing: border-box;
        }

        .admin-login-box {
            width: 100%;
            max-width: 430px;

            background: #ffffff;

            padding: 40px;

            border-radius: 12px;

            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.12);

            box-sizing: border-box;
        }

        .admin-login-logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .admin-login-logo img {
            width: 100px;
            height: 100px;

            object-fit: cover;

            border-radius: 10px;
        }

        .admin-login-box h1 {
            text-align: center;

            color: #6a1b9a;

            margin: 10px 0 5px;

            font-size: 28px;
        }

        .admin-login-subtitle {
            text-align: center;

            color: #666666;

            margin-bottom: 30px;
        }

        .admin-login-error {
            background: #ffe6e6;

            color: #c62828;

            padding: 12px 15px;

            border-radius: 6px;

            margin-bottom: 20px;

            text-align: center;
        }

        .admin-form-group {
            margin-bottom: 20px;
        }

        .admin-form-group label {
            display: block;

            margin-bottom: 8px;

            font-weight: bold;

            color: #222222;
        }

        .admin-form-group input {
            width: 100%;

            padding: 12px 14px;

            border: 1px solid #cccccc;

            border-radius: 6px;

            font-size: 15px;

            box-sizing: border-box;

            outline: none;
        }

        .admin-form-group input:focus {
            border-color: #6a1b9a;
        }

        .admin-login-button {
            width: 100%;

            padding: 13px;

            border: none;

            border-radius: 6px;

            background: #6a1b9a;

            color: #ffffff;

            font-size: 16px;

            font-weight: bold;

            cursor: pointer;
        }

        .admin-login-button:hover {
            background: #4a126b;
        }

        .admin-login-back {
            text-align: center;

            margin-top: 25px;
        }

        .admin-login-back a {
            color: #6a1b9a;

            text-decoration: none;

            font-weight: bold;
        }

        .admin-login-back a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

<div class="admin-login-page">

    <div class="admin-login-box">

        <div class="admin-login-logo">
            <img src="public/images/logo.jpg" alt="ZAVYWEB">
        </div>

        <h1>Đăng nhập Admin</h1>

        <p class="admin-login-subtitle">
            Quản lý hệ thống ZAVYWEB
        </p>

        <?php if (!empty($error)): ?>
            <div class="admin-login-error">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="index.php?url=admin-dang-nhap">

            <div class="admin-form-group">
                <label for="email">Email</label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Nhập email Admin"
                    value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                    required
                >
            </div>

            <div class="admin-form-group">
                <label for="mat_khau">Mật khẩu</label>

                <input
                    type="password"
                    id="mat_khau"
                    name="mat_khau"
                    placeholder="Nhập mật khẩu"
                    required
                >
            </div>

            <button type="submit" class="admin-login-button">
                Đăng nhập
            </button>

        </form>

        <div class="admin-login-back">
            <a href="index.php?url=home">
                ← Quay lại website
            </a>
        </div>

    </div>

</div>

</body>
</html>