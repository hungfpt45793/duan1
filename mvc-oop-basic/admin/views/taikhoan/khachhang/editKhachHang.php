<?php require_once './views/layouts/header.php'; ?>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php require_once './views/layouts/sidebar.php'; ?>

        <div class="content-wrapper">

            <section class="content-header">
                <div class="container-fluid">
                    <h1>Sửa thông tin tài khoản khách hàng</h1>
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-12">
                            <div class="card">
                                <h3 class="card-title">Sửa thông tin tài khoản khách hàng: <?= $khachHang['ho_ten']; ?></h3>
                                <div class="card-body">

                                    <form action="<?= BASE_URL_ADMIN . '?act=sua-khach-hang' ?>" method="POST">
                                        <input type="hidden" name="khach_hang_id" value="<?= $khachHang['id'] ?>">
                                        <div class="form-group">
                                            <label>Họ tên</label>
                                            <input type="text"
                                                class="form-control"
                                                name="ho_ten"
                                                value="<?= $khachHang['ho_ten'] ?>">

                                            <?php if (isset($_SESSION['error']['ho_ten'])): ?>
                                                <p class="text-danger"><?= $_SESSION['error']['ho_ten'] ?></p>
                                            <?php endif; ?>
                                        </div>

                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email"
                                                class="form-control"
                                                name="email"
                                                value="<?= $khachHang['email'] ?>">

                                            <?php if (isset($_SESSION['error']['email'])): ?>
                                                <p class="text-danger"><?= $_SESSION['error']['email'] ?></p>
                                            <?php endif; ?>
                                        </div>


                                        <div class="form-group">
                                            <label>Số điện thoại</label>
                                            <input type="text"
                                                class="form-control"
                                                name="so_dien_thoai"
                                                value="<?= $khachHang['so_dien_thoai'] ?>">

                                            <?php if (isset($_SESSION['error']['so_dien_thoai'])): ?>
                                                <p class="text-danger"><?= $_SESSION['error']['so_dien_thoai'] ?></p>
                                            <?php endif; ?>
                                        </div>

                                        <div class="form-group">
                                            <label>Ngày sinh</label>
                                            <input type="date" class="form-control" name="ngay_sinh"
                                                value="<?= $khachHang['ngay_sinh'] ?>" placeholder="Nhập ngày sinh">
                                            <?php if (isset($_SESSION['error']['ngay_sinh'])) { ?>
                                                <p class="text-danger"><?= $_SESSION['error']['ngay_sinh'] ?></p>
                                            <?php } ?>
                                        </div>

                                        <div class="form-group">
                                            <label>Giới tính</label>
                                            <select id="inputStatus" name="gioi_tinh" class="form-control custom-select">
                                                <option value="1" <?= $khachHang['gioi_tinh'] == 1 ? 'selected' : '' ?>>Nam</option>
                                                <option value="2" <?= $khachHang['gioi_tinh'] == 2 ? 'selected' : '' ?>>Nữ</option>
                                            </select>
                                            <?php if (isset($_SESSION['error']['gioi_tinh'])) { ?>
                                                <p class="text-danger"><?= $_SESSION['error']['gioi_tinh'] ?></p>
                                            <?php } ?>
                                        </div>

                                        <div class="form-group">
                                            <label>Địa chỉ</label>
                                            <input type="text" class="form-control" name="dia_chi"
                                                value="<?= $khachHang['dia_chi'] ?>" placeholder="Nhập địa chỉ">
                                            <?php if (isset($_SESSION['error']['dia_chi'])) { ?>
                                                <p class="text-danger"><?= $_SESSION['error']['dia_chi'] ?></p>
                                            <?php } ?>
                                        </div>


                                        <div class="form-group">
                                            <label for="inputStatus">Trạng thái tài khoản</label>
                                            <select id="inputStatus" name="trang_thai" class="form-control custom-select">

                                                <option value="1" <?= $khachHang['trang_thai'] == 1 ? 'selected' : '' ?>>
                                                    Active
                                                </option>

                                                <option value="2" <?= $khachHang['trang_thai'] == 2 ? 'selected' : '' ?>>
                                                    Inactive
                                                </option>

                                            </select>
                                        </div>

                                        <?php
                                        // Xóa session lỗi sau khi hiển thị
                                        // if (isset($_SESSION['error'])) {
                                        //     unset($_SESSION['error']);
                                        // }
                                        ?>


                                        <button type="submit" class="btn btn-primary">Sửa tài khoản khách hàng</button>

                                    </form>

                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </section>

        </div>

        <?php require_once './views/layouts/footer.php'; ?>

    </div>
</body>

</html>