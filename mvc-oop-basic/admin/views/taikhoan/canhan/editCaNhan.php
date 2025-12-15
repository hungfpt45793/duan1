<?php require_once './views/layouts/header.php'; ?>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php require_once './views/layouts/sidebar.php'; ?>

        <div class="content-wrapper">

            <section class="content-header">
                <div class="container-fluid">
                    <h1>Sửa thông tin cá nhân</h1>
                </div>
            </section>

            <section class="content">
                <div class="container">

                    <!-- FORM THÔNG TIN CÁ NHÂN -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Thông tin cá nhân</h3>
                        </div>

                        <div class="card-body">

                            <form action="<?= BASE_URL_ADMIN . '?act=sua-thong-tin-ca-nhan-quan-tri' ?>"
                                method="post"
                                enctype="multipart/form-data">

                                <div class="text-center mb-3">
                                    <!-- Ảnh đại diện -->
                                    <img src="<?= BASE_URL . $thongTin['anh_dai_dien']; ?>"
                                        style="width: 100px; height: 100px; object-fit: cover;"
                                        class="avatar img-circle"
                                        alt="avatar">
                                </div>

                                <div class="form-group">
                                    <label>Đổi ảnh đại diện:</label>
                                    <input type="file" name="anh_dai_dien" class="form-control">
                                </div>

                                <div class="info-user mb-3">
                                    <h6>Họ tên: <?= $thongTin['ho_ten'] ?></h6>
                                    <h6>Chức vụ:
                                        <?= $thongTin['chuc_vu_id'] == 1 ? "Quản trị viên" : "Khách hàng" ?>
                                    </h6>
                                </div>

                                <!-- Họ tên -->
                                <div class="form-group">
                                    <label>Họ tên:</label>
                                    <input type="text" name="ho_ten" class="form-control"
                                        value="<?= $thongTin['ho_ten'] ?? '' ?>">

                                    <?php if (!empty($_SESSION['error']['ho_ten'])): ?>
                                        <span class="text-danger"><?= $_SESSION['error']['ho_ten'] ?></span>
                                    <?php endif; ?>
                                </div>

                                <!-- Email -->
                                <div class="form-group">
                                    <label>Email:</label>
                                    <input type="email" name="email" class="form-control"
                                        value="<?= $thongTin['email'] ?? '' ?>">

                                    <?php if (!empty($_SESSION['error']['email'])): ?>
                                        <span class="text-danger"><?= $_SESSION['error']['email'] ?></span>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Lưu thông tin</button>
                                </div>

                            </form>
                        </div>
                    </div>

                    <!-- FORM ĐỔI MẬT KHẨU -->
                    <?php if (isset($_SESSION['success'])): ?>
                        <div class="alert alert-success">
                            <?= $_SESSION['success'];
                            unset($_SESSION['success']); ?>
                        </div>
                    <?php endif; ?>

                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Đổi mật khẩu</h3>
                        </div>

                        <div class="card-body">

                            <form action="<?= BASE_URL_ADMIN . '?act=sua-mat-khau-ca-nhan-quan-tri' ?>"
                                method="post">

                                <div class="form-group">
                                    <label>Mật khẩu cũ:</label>
                                    <input type="password" name="mat_khau_cu" class="form-control"
                                        placeholder="Nhập mật khẩu cũ">

                                    <?php if (!empty($_SESSION['error']['old_pass'])): ?>
                                        <span class="text-danger"><?= $_SESSION['error']['old_pass'] ?></span>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group">
                                    <label>Mật khẩu mới:</label>
                                    <input type="password" name="mat_khau_moi" class="form-control"
                                        placeholder="Nhập mật khẩu mới">

                                    <?php if (!empty($_SESSION['error']['new_pass'])): ?>
                                        <span class="text-danger"><?= $_SESSION['error']['new_pass'] ?></span>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group">
                                    <label>Nhập lại mật khẩu mới:</label>
                                    <input type="password" name="nhap_lai_mat_khau_moi" class="form-control"
                                        placeholder="Nhập lại mật khẩu mới">

                                    <?php if (!empty($_SESSION['error']['confirm_pass'])): ?>
                                        <span class="text-danger"><?= $_SESSION['error']['confirm_pass'] ?></span>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
                                </div>
                            </form>

                        </div>
                    </div>

                    <?php deleteSessionError(); ?>

                </div>
            </section>

        </div>

        <?php require_once './views/layouts/footer.php'; ?>

    </div>
</body>

</html>