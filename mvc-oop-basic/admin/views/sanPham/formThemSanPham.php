<?php require_once './views/layouts/header.php'; ?>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <?php require_once './views/layouts/sidebar.php'; ?>

    <!-- Content Wrapper -->
    <div class="content-wrapper">

        <!-- Content Header -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Thêm mới sản phẩm</h1>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-body">

                                <form method="POST" enctype="multipart/form-data" action="<?= BASE_URL_ADMIN . '?act=post-add-product' ?>" >

                                    <div class="row">

                                        <!-- Tên sản phẩm -->
                                        <div class="form-group col-md-12">
                                            <label>Tên sản phẩm</label>
                                            <input type="text" class="form-control" name="ten_san_pham" placeholder="Nhập tên sản phẩm">
                                            <?php if (isset($_SESSION['error']['ten_san_pham'])): ?>
                                                <p class="text-danger"><?= $_SESSION['error']['ten_san_pham'] ?></p>
                                            <?php endif; ?>
                                        </div>

                                        <!-- Giá sản phẩm -->
                                        <div class="form-group col-md-6">
                                            <label>Giá sản phẩm</label>
                                            <input type="text" class="form-control" name="gia_san_pham" placeholder="Nhập giá sản phẩm">
                                            <?php if (isset($_SESSION['error']['gia_san_pham'])): ?>
                                                <p class="text-danger"><?= $_SESSION['error']['gia_san_pham'] ?></p>
                                            <?php endif; ?>
                                        </div>

                                        <!-- Giá khuyến mãi -->
                                        <div class="form-group col-md-6">
                                            <label>Giá khuyến mãi</label>
                                            <input type="number" class="form-control" name="gia_khuyen_mai" placeholder="Nhập giá khuyến mãi">
                                            <?php if (isset($_SESSION['error']['gia_khuyen_mai'])): ?>
                                                <p class="text-danger"><?= $_SESSION['error']['gia_khuyen_mai'] ?></p>
                                            <?php endif; ?>
                                        </div>

                                        <!-- Hình ảnh -->
                                        <div class="form-group col-md-6">
                                            <label>Hình ảnh</label>
                                            <input type="file" class="form-control" name="hinh_anh">
                                            <?php if (isset($_SESSION['error']['hinh_anh'])): ?>
                                                <p class="text-danger"><?= $_SESSION['error']['hinh_anh'] ?></p>
                                            <?php endif; ?>
                                        </div>

                                        <div class="form-group col-6">
                                            <label>Album ảnh</label>
                                            <input type="file" class="form-control" name="img_array[]" multiple>
                                        </div>

                                        <!-- Số lượng -->
                                        <div class="form-group col-md-6">
                                            <label>Số lượng</label>
                                            <input type="number" class="form-control" name="so_luong" placeholder="Nhập số lượng">
                                            <?php if (isset($_SESSION['error']['so_luong'])): ?>
                                                <p class="text-danger"><?= $_SESSION['error']['so_luong'] ?></p>
                                            <?php endif; ?>
                                        </div>

                                        <!-- Ngày nhập -->
                                        <div class="form-group col-md-6">
                                            <label>Ngày nhập</label>
                                            <input type="date" class="form-control" name="ngay_nhap">
                                            <?php if (isset($_SESSION['error']['ngay_nhap'])): ?>
                                                <p class="text-danger"><?= $_SESSION['error']['ngay_nhap'] ?></p>
                                            <?php endif; ?>
                                        </div>

                                        <!-- Danh mục -->
                                        <div class="form-group col-md-6">
                                            <label>Danh mục</label>
                                            <select class="form-control" name="danh_muc_id">
                                                <option selected disabled>Chọn danh mục sản phẩm</option>
                                                <?php foreach ($listDanhMuc as $danhMuc): ?>
                                                    <option value="<?= $danhMuc['id'] ?>">
                                                        <?= $danhMuc['ten_danh_muc'] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                            <?php if (isset($_SESSION['error']['danh_muc_id'])): ?>
                                                <p class="text-danger"><?= $_SESSION['error']['danh_muc_id'] ?></p>
                                            <?php endif; ?>
                                        </div>

                                        <!-- Trạng thái -->
                                        <div class="form-group col-md-12">
                                            <label>Trạng thái</label>
                                            <select class="form-control" name="trang_thai">
                                                <option selected disabled>Chọn trạng thái</option>
                                                <option value="1">Còn bán</option>
                                                <option value="2">Dừng bán</option>
                                            </select>
                                            <?php if (isset($_SESSION['error']['trang_thai'])): ?>
                                                <p class="text-danger"><?= $_SESSION['error']['trang_thai'] ?></p>
                                            <?php endif; ?>
                                        </div>

                                        <div class="form-group col-12">
                                            <label>Mô tả</label>
                                            <textarea name="mo_ta" id="" class="form-control" placeholder="Nhập mô tả"></textarea>
                                        </div>


                                        <!-- Submit -->
                                        <div class="form-group col-md-12">
                                            <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
                                        </div>

                                    </div> <!-- row -->

                                </form>

                            </div>
                        </div> <!-- card -->

                    </div>
                </div>
            </div>
        </section>

    </div> <!-- content-wrapper -->

    <?php require_once './views/layouts/footer.php'; ?>
<?php var_dump($_FILES) ?>
</div> <!-- wrapper -->
</body>
</html>
