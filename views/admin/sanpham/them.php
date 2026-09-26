<?php

/*
|--------------------------------------------------------------------------
| Trang thêm sản phẩm
|--------------------------------------------------------------------------
| Dữ liệu nhận từ AdminSanPhamController:
| - $danhMucs
|--------------------------------------------------------------------------
*/

?>

<!DOCTYPE html>

<html lang="vi">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Thêm sản phẩm - ZAVYWEB</title>


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

            gap: 10px;
        }


        .admin-header-right a {

            color: white;

            text-decoration: none;

            padding: 10px 18px;

            border:
                1px solid rgba(255,255,255,0.6);

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

            width: 90%;

            max-width: 850px;

            margin: 35px auto;
        }


        /* =====================================================
           TITLE
        ===================================================== */

        .page-title {

            margin-bottom: 25px;
        }


        .page-title h1 {

            margin: 0;

            font-size: 28px;

            color: #333;
        }


        /* =====================================================
           FORM
        ===================================================== */

        .form-box {

            background: white;

            padding: 30px 35px;

            border-radius: 10px;

            box-shadow:
                0 2px 12px rgba(0,0,0,0.08);
        }


        .form-group {

            margin-bottom: 20px;
        }


        .form-group label {

            display: block;

            margin-bottom: 8px;

            font-weight: bold;

            color: #333;
        }


        .required {

            color: #d00000;
        }


        .form-group input,
        .form-group select,
        .form-group textarea {

            width: 100%;

            padding: 11px 12px;

            border:
                1px solid #cccccc;

            border-radius: 6px;

            font-family: Arial, sans-serif;

            font-size: 14px;

            outline: none;

            transition: 0.2s;
        }


        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {

            border-color: #6a1b9a;

            box-shadow:
                0 0 0 2px rgba(106, 27, 154, 0.1);
        }


        .form-group textarea {

            min-height: 120px;

            resize: vertical;
        }


        /* =====================================================
           GỢI Ý HÌNH ẢNH
        ===================================================== */

        .image-note {

            margin-top: 7px;

            font-size: 13px;

            color: #777;

            line-height: 1.5;
        }


        .image-note strong {

            color: #6a1b9a;
        }


        /* =====================================================
           BUTTON
        ===================================================== */

        .form-actions {

            display: flex;

            justify-content: flex-end;

            gap: 10px;

            margin-top: 25px;

            padding-top: 20px;

            border-top:
                1px solid #eeeeee;
        }


        .btn {

            display: inline-block;

            padding: 11px 20px;

            border-radius: 6px;

            text-decoration: none;

            border: none;

            cursor: pointer;

            font-size: 14px;

            font-weight: bold;
        }


        .btn-cancel {

            background: #eeeeee;

            color: #333;
        }


        .btn-cancel:hover {

            background: #dddddd;
        }


        .btn-save {

            background: #6a1b9a;

            color: white;
        }


        .btn-save:hover {

            background: #4a126d;
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


    <div class="page-title">

        <h1>
            Thêm sản phẩm
        </h1>

    </div>



    <!-- =====================================================
         FORM THÊM SẢN PHẨM
    ====================================================== -->

    <div class="form-box">


        <form
    method="POST"
    action="index.php?url=admin-xu-ly-them-san-pham"
    enctype="multipart/form-data"
>


            <!-- TÊN SẢN PHẨM -->

            <div class="form-group">

                <label for="ten_san_pham">

                    Tên sản phẩm
                    <span class="required">*</span>

                </label>


                <input
                    type="text"
                    id="ten_san_pham"
                    name="ten_san_pham"
                    placeholder="Nhập tên sản phẩm"
                    required
                >

            </div>



            <!-- DANH MỤC -->

            <div class="form-group">

                <label for="danh_muc_id">

                    Danh mục
                    <span class="required">*</span>

                </label>


                <select
                    id="danh_muc_id"
                    name="danh_muc_id"
                    required
                >

                    <option value="">

                        -- Chọn danh mục --

                    </option>


                    <?php foreach ($danhMucs as $danhMuc): ?>

                        <option
                            value="<?= (int) $danhMuc['id'] ?>"
                        >

                            <?= htmlspecialchars(
                                $danhMuc['ten_danh_muc'],
                                ENT_QUOTES,
                                'UTF-8'
                            ) ?>

                        </option>

                    <?php endforeach; ?>


                </select>

            </div>



            <!-- GIÁ -->

            <div class="form-group">

                <label for="gia">

                    Giá sản phẩm
                    <span class="required">*</span>

                </label>


                <input
                    type="number"
                    id="gia"
                    name="gia"
                    min="0"
                    step="1000"
                    placeholder="Nhập giá sản phẩm"
                    required
                >

            </div>



            <!-- MÔ TẢ -->

            <div class="form-group">

                <label for="mo_ta">

                    Mô tả sản phẩm

                </label>


                <textarea
                    id="mo_ta"
                    name="mo_ta"
                    placeholder="Nhập mô tả sản phẩm"
                ></textarea>

            </div>



            <!-- HÌNH ẢNH -->

<div class="form-group">

    <label for="hinh_anh">

        Hình ảnh sản phẩm

    </label>


    <input
        type="file"
        id="hinh_anh"
        name="hinh_anh"
        accept="image/*"
    >


    <div class="image-note">

        Chọn hình ảnh sản phẩm từ máy tính.

        <br>

        Định dạng hỗ trợ:
        JPG, JPEG, PNG, WEBP.

    </div>

</div>



            <!-- BUTTON -->

            <div class="form-actions">


                <a
                    href="index.php?url=admin-san-pham"
                    class="btn btn-cancel"
                >

                    Hủy

                </a>


                <button
                    type="submit"
                    class="btn btn-save"
                >

                    Thêm sản phẩm

                </button>


            </div>


        </form>


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