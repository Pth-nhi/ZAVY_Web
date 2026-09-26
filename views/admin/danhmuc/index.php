<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['admin'])) {
    header('Location: index.php?url=admin-dang-nhap');
    exit;
}

$admin = $_SESSION['admin'];

?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Quản lý danh mục - ZAVYWEB ADMIN</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f3f8;
            color: #222;
        }

        .admin-header {
            background: #5b2a86;
            color: white;
            height: 75px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 40px;
        }

        .admin-logo {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .admin-logo img {
            width: 48px;
            height: 48px;
            object-fit: cover;
            border-radius: 8px;
            background: white;
        }

        .admin-logo h2 {
            margin: 0;
            font-size: 22px;
        }

        .admin-header-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .admin-header-right span {
            font-size: 15px;
        }

        .logout-btn {
            text-decoration: none;
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.7);
            padding: 9px 16px;
            border-radius: 6px;
            transition: 0.2s;
        }

        .logout-btn:hover {
            background: white;
            color: #5b2a86;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 35px 25px 50px;
        }

        .page-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .page-title h1 {
            margin: 0 0 5px;
            color: #222;
            font-size: 28px;
        }

        .page-title p {
            margin: 0;
            color: #666;
        }

        .add-btn {
            display: inline-block;
            text-decoration: none;
            background: #5b2a86;
            color: white;
            padding: 12px 20px;
            border-radius: 7px;
            font-weight: bold;
            transition: 0.2s;
        }

        .add-btn:hover {
            background: #431f64;
        }

        .table-box {
            background: white;
            border-radius: 10px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #5b2a86;
            color: white;
        }

        th,
        td {
            padding: 15px 18px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            font-size: 15px;
        }

        td {
            font-size: 14px;
        }

        tbody tr:hover {
            background: #faf7fc;
        }

        .id-column {
            width: 80px;
            text-align: center;
        }

        .action-column {
            width: 180px;
            text-align: center;
        }

        .action-btn {
            display: inline-block;
            text-decoration: none;
            padding: 7px 12px;
            border-radius: 5px;
            font-size: 13px;
            margin: 2px;
        }

        .edit-btn {
            background: #eee4f7;
            color: #5b2a86;
        }

        .edit-btn:hover {
            background: #dfcff0;
        }

        .delete-btn {
            background: #222;
            color: white;
        }

        .delete-btn:hover {
            background: #000;
        }

        .empty-message {
            text-align: center;
            padding: 40px;
            color: #777;
        }

        .back-btn {
            display: inline-block;
            margin-top: 20px;
            color: #5b2a86;
            text-decoration: none;
            font-weight: bold;
        }

        .back-btn:hover {
            text-decoration: underline;
        }

        @media (max-width: 700px) {
            .admin-header {
                padding: 0 15px;
            }

            .admin-header-right span {
                display: none;
            }

            .container {
                padding: 25px 15px;
            }

            .page-top {
                align-items: flex-start;
                gap: 15px;
                flex-direction: column;
            }

            .table-box {
                overflow-x: auto;
            }

            table {
                min-width: 700px;
            }
        }
    </style>
</head>

<body>

<header class="admin-header">

    <div class="admin-logo">
        <img src="public/images/logo.jpg" alt="ZAVYWEB">
        <h2>ZAVYWEB ADMIN</h2>
    </div>

    <div class="admin-header-right">
        <span>
            Xin chào, <?= htmlspecialchars($admin['ho_ten']) ?>
        </span>

        <a
            href="index.php?url=dang-xuat-admin"
            class="logout-btn"
        >
            Đăng xuất
        </a>
    </div>

</header>

<div class="container">

    <div class="page-top">

        <div class="page-title">
            <h1>Quản lý danh mục</h1>
            <p>Quản lý các danh mục sản phẩm của ZAVYWEB.</p>
        </div>

        <a
            href="index.php?url=admin-them-danh-muc"
            class="add-btn"
        >
            + Thêm danh mục
        </a>

    </div>

    <div class="table-box">

        <?php if (empty($danhMucs)): ?>

            <div class="empty-message">
                Chưa có danh mục nào.
            </div>

        <?php else: ?>

            <table>

                <thead>
                    <tr>
                        <th class="id-column">ID</th>
                        <th>Tên danh mục</th>
                        <th>Mô tả</th>
                        <th>Ngày tạo</th>
                        <th class="action-column">Thao tác</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($danhMucs as $danhMuc): ?>

                        <tr>

                            <td class="id-column">
                                <?= (int) $danhMuc['id'] ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($danhMuc['ten_danh_muc']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($danhMuc['mo_ta'] ?? '') ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($danhMuc['ngay_tao'] ?? '') ?>
                            </td>

                            <td class="action-column">

                                <a
                                    href="index.php?url=admin-sua-danh-muc&id=<?= (int) $danhMuc['id'] ?>"
                                    class="action-btn edit-btn"
                                >
                                    Sửa
                                </a>

                                <a
                                    href="index.php?url=admin-xoa-danh-muc&id=<?= (int) $danhMuc['id'] ?>"
                                    class="action-btn delete-btn"
                                    onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?');"
                                >
                                    Xóa
                                </a>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        <?php endif; ?>

    </div>

    <a
        href="index.php?url=admin"
        class="back-btn"
    >
        ← Quay lại trang chủ Admin
    </a>

</div>

</body>

</html>