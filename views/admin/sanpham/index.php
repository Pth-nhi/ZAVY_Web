<?php

/*
|--------------------------------------------------------------------------
| Xử lý đường dẫn hình ảnh sản phẩm
|--------------------------------------------------------------------------
*/
function taoUrlHinhAnh(string $hinhAnh): string
{
    $hinhAnh = trim($hinhAnh);

    if ($hinhAnh === '') {
        return '';
    }

    /*
     * Nếu Database đang lưu URL đầy đủ:
     *
     * http://localhost/ZAVYWEB/san-pham/PHỤ KIỆN/Túi sách/tnu5.jpg
     *
     * thì thêm public/images vào.
     */
    if (filter_var($hinhAnh, FILTER_VALIDATE_URL)) {

        $path = parse_url($hinhAnh, PHP_URL_PATH);

        if (!$path) {
            return '';
        }

        if (strpos($path, '/ZAVYWEB/public/images/') === false) {

            $path = str_replace(
                '/ZAVYWEB/',
                '/ZAVYWEB/public/images/',
                $path
            );
        }

        /*
         * Encode khoảng trắng và ký tự Unicode
         * trong đường dẫn ảnh.
         */
        $segments = explode('/', $path);

        foreach ($segments as $key => $segment) {

            if ($segment !== '') {

                $segments[$key] = rawurlencode(
                    urldecode($segment)
                );
            }
        }

        return implode('/', $segments);
    }

    /*
     * Nếu Database lưu đường dẫn tương đối.
     */

    $hinhAnh = ltrim($hinhAnh, '/');

    if (strpos($hinhAnh, 'public/images/') === 0) {

        $path = $hinhAnh;

    } else {

        $path = 'public/images/' . $hinhAnh;
    }

    /*
     * Encode từng phần đường dẫn.
     */
    $segments = explode('/', $path);

    foreach ($segments as $key => $segment) {

        if ($segment !== '') {

            $segments[$key] = rawurlencode(
                urldecode($segment)
            );
        }
    }

    return '/ZAVYWEB/' . implode('/', $segments);
}

?>

<!DOCTYPE html>

<html lang="vi">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Quản lý sản phẩm - ZAVYWEB</title>


    <style>

        * {
            box-sizing: border-box;
        }


        body {
            margin: 0;
            padding: 0;

            font-family: Arial, sans-serif;

            background: #f5f3f8;

            color: #222;
        }


        /* =====================================================
           HEADER
        ===================================================== */

        .admin-header {

            height: 75px;

            background: #6a1b9a;

            color: white;

            display: flex;

            align-items: center;

            justify-content: space-between;

            padding: 0 40px;

            box-shadow:
                0 2px 8px rgba(0, 0, 0, 0.15);
        }


        .admin-header-left {

            display: flex;

            align-items: center;

            gap: 15px;
        }


        .admin-header-left img {

            width: 50px;
            height: 50px;

            object-fit: cover;

            border-radius: 8px;

            background: white;
        }


        .admin-title {

            font-size: 23px;

            font-weight: bold;
        }


        .admin-header-right {

            display: flex;

            align-items: center;

            gap: 10px;
        }


        .admin-header-right a {

            color: white;

            text-decoration: none;

            padding: 10px 18px;

            border:
                1px solid rgba(255, 255, 255, 0.6);

            border-radius: 6px;

            transition: 0.2s;
        }


        .admin-header-right a:hover {

            background: white;

            color: #6a1b9a;
        }


        /* =====================================================
           CONTAINER
        ===================================================== */

        .container {

            width: 95%;

            max-width: 1400px;

            margin: 35px auto;
        }


        /* =====================================================
           PAGE TOP
        ===================================================== */

        .page-top {

            display: flex;

            align-items: center;

            justify-content: space-between;

            margin-bottom: 25px;
        }


        .page-top h1 {

            margin: 0;

            font-size: 28px;

            color: #333;
        }


        .btn-add {

            display: inline-block;

            background: #6a1b9a;

            color: white;

            text-decoration: none;

            padding: 11px 20px;

            border-radius: 6px;

            font-weight: bold;

            transition: 0.2s;
        }


        .btn-add:hover {

            background: #4a126d;
        }


        /* =====================================================
           TABLE
        ===================================================== */

        .table-wrapper {

            background: white;

            border-radius: 10px;

            box-shadow:
                0 2px 12px rgba(0, 0, 0, 0.08);

            overflow-x: auto;
        }


        table {

            width: 100%;

            min-width: 1100px;

            border-collapse: collapse;
        }


        thead {

            background: #6a1b9a;

            color: white;
        }


        th {

            padding: 15px 12px;

            text-align: center;

            font-size: 14px;

            white-space: nowrap;
        }


        td {

            padding: 13px 12px;

            border-bottom:
                1px solid #eeeeee;

            font-size: 14px;

            vertical-align: middle;
        }


        tbody tr:hover {

            background: #faf7fc;
        }


        /* =====================================================
           CỘT
        ===================================================== */

        .col-id {

            width: 60px;

            text-align: center;
        }


        .col-image {

            width: 120px;

            text-align: center;
        }


        .col-name {

            min-width: 180px;
        }


        .col-category {

            width: 130px;
        }


        .col-price {

            width: 130px;

            text-align: right;

            white-space: nowrap;
        }


        .col-description {

            min-width: 220px;
        }


        .col-date {

            width: 150px;

            white-space: nowrap;
        }


        .col-action {

            width: 140px;

            text-align: center;

            white-space: nowrap;
        }


        /* =====================================================
           HÌNH ẢNH
        ===================================================== */

        .product-image {

            width: 85px;

            height: 85px;

            object-fit: cover;

            display: block;

            margin: 0 auto;

            border-radius: 8px;

            border:
                1px solid #ddd;

            background: #f8f8f8;
        }


        .no-image {

            width: 85px;

            height: 85px;

            margin: 0 auto;

            display: flex;

            align-items: center;

            justify-content: center;

            text-align: center;

            border-radius: 8px;

            border:
                1px dashed #bbb;

            background: #f5f5f5;

            color: #888;

            font-size: 12px;
        }


        /* =====================================================
           GIÁ
        ===================================================== */

        .price {

            color: #6a1b9a;

            font-weight: bold;
        }


        /* =====================================================
           BUTTON
        ===================================================== */

        .btn-edit,
        .btn-delete {

            display: inline-block;

            text-decoration: none;

            padding: 7px 11px;

            border-radius: 5px;

            font-size: 13px;

            font-weight: bold;

            margin: 2px;
        }


        .btn-edit {

            background: #eeeeee;

            color: #333;
        }


        .btn-edit:hover {

            background: #dddddd;
        }


        .btn-delete {

            background: #222222;

            color: white;
        }


        .btn-delete:hover {

            background: #000000;
        }


        /* =====================================================
           EMPTY
        ===================================================== */

        .empty {

            text-align: center;

            padding: 40px;

            color: #777;
        }


        /* =====================================================
           FOOTER
        ===================================================== */

        .admin-footer {

            margin-top: 40px;

            padding: 20px;

            text-align: center;

            background: #222222;

            color: white;

            font-size: 14px;
        }

    </style>

</head>


<body>


<!-- =========================================================
     HEADER ADMIN
========================================================= -->

<header class="admin-header">


    <div class="admin-header-left">

        <img
            src="public/images/logo.jpg"
            alt="ZAVYWEB"
        >

        <div class="admin-title">

            ZAVYWEB ADMIN

        </div>

    </div>


    <div class="admin-header-right">

        <a href="index.php?url=admin">

            Trang chủ Admin

        </a>


        <a href="index.php?url=dang-xuat-admin">

            Đăng xuất

        </a>

    </div>


</header>



<!-- =========================================================
     NỘI DUNG
========================================================= -->

<div class="container">


    <div class="page-top">


        <h1>

            Quản lý sản phẩm

        </h1>


        <a
            href="index.php?url=admin-them-san-pham"
            class="btn-add"
        >

            + Thêm sản phẩm

        </a>


    </div>



    <!-- =====================================================
         DANH SÁCH SẢN PHẨM
    ====================================================== -->

    <div class="table-wrapper">


        <table>


            <thead>

                <tr>

                    <th class="col-id">
                        ID
                    </th>

                    <th class="col-image">
                        Hình ảnh
                    </th>

                    <th class="col-name">
                        Tên sản phẩm
                    </th>

                    <th class="col-category">
                        Danh mục
                    </th>

                    <th class="col-price">
                        Giá
                    </th>

                    <th class="col-description">
                        Mô tả
                    </th>

                    <th class="col-date">
                        Ngày tạo
                    </th>

                    <th class="col-action">
                        Thao tác
                    </th>

                </tr>

            </thead>



            <tbody>


                <?php if (empty($sanPhams)): ?>


                    <tr>

                        <td
                            colspan="8"
                            class="empty"
                        >

                            Chưa có sản phẩm nào.

                        </td>

                    </tr>


                <?php else: ?>


                    <?php foreach ($sanPhams as $sanPham): ?>


                        <?php

                        $hinhAnh = trim(
                            $sanPham['hinh_anh'] ?? ''
                        );

                        $urlHinhAnh = taoUrlHinhAnh(
                            $hinhAnh
                        );

                        ?>


                        <tr>


                            <!-- ID -->

                            <td class="col-id">

                                <?= (int) $sanPham['id'] ?>

                            </td>



                            <!-- HÌNH ẢNH -->

                            <td class="col-image">


                                <?php if ($urlHinhAnh !== ''): ?>


                                    <img
                                        src="<?= htmlspecialchars(
                                            $urlHinhAnh,
                                            ENT_QUOTES,
                                            'UTF-8'
                                        ) ?>"
                                        alt="<?= htmlspecialchars(
                                            $sanPham['ten_san_pham'],
                                            ENT_QUOTES,
                                            'UTF-8'
                                        ) ?>"
                                        class="product-image"
                                        onerror="
                                            this.style.display='none';
                                            this.nextElementSibling.style.display='flex';
                                        "
                                    >


                                    <div
                                        class="no-image"
                                        style="display:none;"
                                    >

                                        Không tải được ảnh

                                    </div>


                                <?php else: ?>


                                    <div class="no-image">

                                        Chưa có ảnh

                                    </div>


                                <?php endif; ?>


                            </td>



                            <!-- TÊN SẢN PHẨM -->

                            <td class="col-name">

                                <strong>

                                    <?= htmlspecialchars(
                                        $sanPham['ten_san_pham'],
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ) ?>

                                </strong>

                            </td>



                            <!-- DANH MỤC -->

                            <td class="col-category">

                                <?= htmlspecialchars(
                                    $sanPham['ten_danh_muc'] ?? '',
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>

                            </td>



                            <!-- GIÁ -->

                            <td class="col-price">

                                <span class="price">

                                    <?= number_format(
                                        (float) $sanPham['gia'],
                                        0,
                                        ',',
                                        '.'
                                    ) ?>

                                    đ

                                </span>

                            </td>



                            <!-- MÔ TẢ -->

                            <td class="col-description">

                                <?= htmlspecialchars(
                                    $sanPham['mo_ta'] ?? '',
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>

                            </td>



                            <!-- NGÀY TẠO -->

                            <td class="col-date">

                                <?= htmlspecialchars(
                                    $sanPham['ngay_tao'] ?? '',
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>

                            </td>



                            <!-- THAO TÁC -->

                            <td class="col-action">


                                <a
                                    href="index.php?url=admin-sua-san-pham&id=<?= (int) $sanPham['id'] ?>"
                                    class="btn-edit"
                                >

                                    Sửa

                                </a>


                                <a
                                    href="index.php?url=admin-xoa-san-pham&id=<?= (int) $sanPham['id'] ?>"
                                    class="btn-delete"
                                    onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này không?');"
                                >

                                    Xóa

                                </a>


                            </td>


                        </tr>


                    <?php endforeach; ?>


                <?php endif; ?>


            </tbody>


        </table>


    </div>


</div>



<!-- =========================================================
     FOOTER
========================================================= -->

<footer class="admin-footer">

    © <?= date('Y') ?> ZAVYWEB -
    Quản trị hệ thống

</footer>


</body>

</html>