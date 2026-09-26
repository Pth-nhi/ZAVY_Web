<?php

function taoUrlHinhAnh(string $hinhAnh): string
{
    $hinhAnh = trim($hinhAnh);

    if ($hinhAnh === '') {
        return '';
    }

    // Nếu là URL đầy đủ
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

    // Nếu là đường dẫn tương đối
    $hinhAnh = ltrim($hinhAnh, '/');

    if (strpos($hinhAnh, 'public/images/') === 0) {
        $path = $hinhAnh;
    } else {
        $path = 'public/images/' . $hinhAnh;
    }

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


$hinhAnh = trim($sanPham['hinh_anh'] ?? '');

$urlHinhAnh = taoUrlHinhAnh($hinhAnh);

?>

<!DOCTYPE html>
<html lang="vi">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Sửa sản phẩm - ZAVYWEB ADMIN</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            color: #222;
        }

        .admin-header {
            background: #6a1b9a;
            color: white;
            padding: 18px 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .admin-header h1 {
            margin: 0;
            font-size: 24px;
        }

        .admin-header a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        .container {
            width: 900px;
            max-width: calc(100% - 40px);
            margin: 40px auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .title {
            margin-top: 0;
            margin-bottom: 25px;
            color: #6a1b9a;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
        }

        input[type="file"] {
            background: #fff;
            cursor: pointer;
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        .image-preview {
            margin-top: 12px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background: #fafafa;
        }

        .image-preview img {
            width: 180px;
            height: 180px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #ddd;
            display: block;
        }

        .no-image {
            width: 180px;
            height: 180px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #eee;
            color: #777;
            border-radius: 8px;
        }

        .image-note {
            display: block;
            margin-top: 8px;
            color: #777;
            font-size: 13px;
        }

        .buttons {
            display: flex;
            gap: 12px;
            margin-top: 25px;
        }

        .btn {
            padding: 12px 22px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            font-size: 15px;
            font-weight: bold;
        }

        .btn-save {
            background: #6a1b9a;
            color: white;
        }

        .btn-save:hover {
            background: #4a148c;
        }

        .btn-back {
            background: #ddd;
            color: #222;
        }

        .btn-back:hover {
            background: #ccc;
        }

    </style>

</head>

<body>

<header class="admin-header">

    <h1>ZAVYWEB ADMIN</h1>

    <a href="index.php?url=admin-san-pham">
        Quay lại quản lý sản phẩm
    </a>

</header>


<div class="container">

    <h2 class="title">
        Sửa sản phẩm
    </h2>


    <form
        method="POST"
        action="index.php?url=admin-xu-ly-sua-san-pham"
        enctype="multipart/form-data"
    >

        <input
            type="hidden"
            name="id"
            value="<?= (int) $sanPham['id'] ?>"
        >


        <!-- TÊN SẢN PHẨM -->

        <div class="form-group">

            <label for="ten_san_pham">
                Tên sản phẩm
            </label>

            <input
                type="text"
                id="ten_san_pham"
                name="ten_san_pham"
                value="<?= htmlspecialchars($sanPham['ten_san_pham']) ?>"
                required
            >

        </div>


        <!-- DANH MỤC -->

        <div class="form-group">

            <label for="danh_muc_id">
                Danh mục
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
                        <?= ((int) $sanPham['danh_muc_id'] === (int) $danhMuc['id']) ? 'selected' : '' ?>
                    >

                        <?= htmlspecialchars($danhMuc['ten_danh_muc']) ?>

                    </option>

                <?php endforeach; ?>

            </select>

        </div>


        <!-- GIÁ -->

        <div class="form-group">

            <label for="gia">
                Giá sản phẩm
            </label>

            <input
                type="number"
                id="gia"
                name="gia"
                value="<?= htmlspecialchars($sanPham['gia']) ?>"
                min="0"
                step="0.01"
                required
            >

        </div>


        <!-- MÔ TẢ -->

        <div class="form-group">

            <label for="mo_ta">
                Mô tả
            </label>

            <textarea
                id="mo_ta"
                name="mo_ta"
            ><?= htmlspecialchars($sanPham['mo_ta'] ?? '') ?></textarea>

        </div>


        <!-- ẢNH HIỆN TẠI -->

        <div class="form-group">

            <label>
                Hình ảnh hiện tại
            </label>

            <div class="image-preview">

                <?php if ($urlHinhAnh !== ''): ?>

                    <img
                        src="<?= htmlspecialchars($urlHinhAnh, ENT_QUOTES, 'UTF-8') ?>"
                        alt="Ảnh sản phẩm"
                        onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
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

            </div>

        </div>


        <!-- CHỌN ẢNH MỚI -->

        <div class="form-group">

            <label for="hinh_anh">
                Chọn ảnh mới
            </label>

            <input
                type="file"
                id="hinh_anh"
                name="hinh_anh"
                accept="image/jpeg,image/png,image/webp"
            >

            <small class="image-note">
                Để trống nếu muốn giữ nguyên ảnh hiện tại.
                Dung lượng tối đa 5MB.
            </small>

        </div>


        <!-- NÚT -->

        <div class="buttons">

            <button
                type="submit"
                class="btn btn-save"
            >
                Lưu thay đổi
            </button>

            <a
                href="index.php?url=admin-san-pham"
                class="btn btn-back"
            >
                Hủy
            </a>

        </div>

    </form>

</div>

</body>

</html>