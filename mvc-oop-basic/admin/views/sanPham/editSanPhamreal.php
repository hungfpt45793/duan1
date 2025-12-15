<?php require_once './views/layouts/header.php'; ?>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <?php require_once './views/layouts/sidebar.php'; ?>

    <div class="content-wrapper">

        <!-- Content Header -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Sửa sản phẩm</h1>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <div class="card">
                    <div class="card-body">

                        <form method="POST" action="<?= BASE_URL_ADMIN . '?act=post-edit-product' ?>" enctype="multipart/form-data">

                            <input type="hidden" name="id_san_pham" value="<?= $sanPham['id'] ?>">

                            <!-- Tên sản phẩm -->
                            <div class="form-group">
                                <label>Tên sản phẩm</label>
                                <input type="text" name="ten_san_pham" class="form-control"
                                       value="<?= $sanPham['ten_san_pham'] ?>" placeholder="Nhập tên sản phẩm">
                            </div>

                            <!-- Giá -->
                            <div class="form-group">
                                <label>Giá sản phẩm</label>
                                <input type="number" name="gia_san_pham" class="form-control"
                                       value="<?= $sanPham['gia_san_pham'] ?>">
                            </div>

                            <!-- Giá khuyến mãi -->
                            <div class="form-group">
                                <label>Giá khuyến mãi</label>
                                <input type="number" name="gia_khuyen_mai" class="form-control"
                                       value="<?= $sanPham['gia_khuyen_mai'] ?>">
                            </div>

                            <!-- Số lượng -->
                            <div class="form-group">
                                <label>Số lượng</label>
                                <input type="number" name="so_luong" class="form-control"
                                       value="<?= $sanPham['so_luong'] ?>">
                            </div>

                            <!-- Ngày nhập -->
                            <div class="form-group">
                                <label>Ngày nhập</label>
                                <input type="date" name="ngay_nhap" class="form-control"
                                       value="<?= $sanPham['ngay_nhap'] ?>">
                            </div>

                            <!-- Danh mục -->
                            <div class="form-group">
                                <label>Danh mục</label>
                                <select name="danh_muc_id" class="form-control">
                                    <?php foreach ($listDanhMuc as $dm): ?>
                                        <option value="<?= $dm['id'] ?>"
                                            <?= $sanPham['danh_muc_id'] == $dm['id'] ? "selected" : "" ?>>
                                            <?= $dm['ten_danh_muc'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Trạng thái -->
                            <div class="form-group">
                                <label>Trạng thái</label>
                                <select name="trang_thai" class="form-control">
                                    <option value="1" <?= $sanPham['trang_thai'] == 1 ? "selected" : "" ?>>Còn hàng</option>
                                    <option value="0" <?= $sanPham['trang_thai'] == 0 ? "selected" : "" ?>>Hết hàng</option>
                                </select>
                            </div>

                            <!-- Mô tả -->
                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea name="mo_ta" class="form-control"><?= $sanPham['mo_ta'] ?></textarea>
                            </div>

                            <!-- Ảnh đại diện -->
                            <div class="form-group">
                                <label>Ảnh đại diện hiện tại</label><br>
                                <img src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" style="width: 120px; border: 1px solid #ccc;">
                            </div>

                            <div class="form-group">
                                <label>Đổi ảnh đại diện</label>
                                <input type="file" name="hinh_anh" class="form-control-file">
                            </div>

                            <!-- Ảnh mô tả -->
                            <div class="form-group">
                                <label>Danh sách ảnh mô tả</label>
                                <div class="row">
                                    <?php foreach ($listAnhSanPham as $anh): ?>
                                        <div class="col-md-3 text-center mb-3">
                                            <img src="<?= BASE_URL . $anh['link_hinh_anh'] ?>" style="width: 100%; height: 120px; object-fit: cover; border:1px solid #ddd;">
                                            <br>
                                            <a class="btn btn-danger btn-sm mt-2"
                                               href="<?= BASE_URL_ADMIN . '?act=xoa-anh-san-pham&id=' . $anh['id'] . '&id_san_pham=' . $sanPham['id'] ?>"
                                               onclick="return confirm('Bạn có chắc muốn xoá ảnh này?')">
                                                Xoá ảnh
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <!-- Thêm ảnh mô tả mới -->
                            <div class="form-group">
                                <label>Thêm ảnh mô tả mới</label>
                                <input type="file" name="img_array[]" multiple class="form-control-file">
                            </div>

                            <button type="submit" class="btn btn-primary">Cập nhật</button>

                        </form>

                    </div>
                </div>

            </div>
        </section>

    </div>

    <?php require_once './views/layouts/footer.php'; ?>

</div>
</body>
</html>
