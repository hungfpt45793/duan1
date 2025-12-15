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
                            <h1>Thêm mới danh mục</h1>
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
                                    <form method="POST" action="<?= BASE_URL_ADMIN . '?act=post-add-category' ?>">
                                        <div class="form-group">
                                            <label>Tên danh mục</label>
                                            <input type="text" name="ten_danh_muc" class="form-control" placeholder="Nhập tên danh mục">
                                            <?php  if(isset($errors['ten_danh_muc'])) { ?>
                                                <p class="text-danger"><?= $errors['ten_danh_muc'] ?></p>
                                            <?php } ?>
                                        </div>

                                        <div class="form-group">
                                            <label>Mô tả</label>
                                            <textarea name="mo_ta" class="form-control" placeholder="Nhập mô tả"></textarea>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>

                                </div>

                            </div> <!-- card -->

                        </div>
                    </div>
                </div>
            </section>

        </div> <!-- content-wrapper -->

        <?php require_once './views/layouts/footer.php'; ?>

    </div> <!-- wrapper -->
</body>

</html>