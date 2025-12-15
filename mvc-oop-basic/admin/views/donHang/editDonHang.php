<?php require_once './views/layouts/header.php'; 

?>

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
                            <h1>Quản lý thông tin đơn hàng: </h1>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-12">
                            <h3>Mã đơn hàng: <?= $donHang['ma_don_hang'] ?></h3>
                            <div class="card">
                                <div class="card-body">
                                    <form method="POST" action="<?= BASE_URL_ADMIN . '?act=post-edit-don-hang' ?>">
                                        <div class="form-group">
                                            <input type="text" name="don_hang_id" value="<?= $donHang['id'] ?>" hidden>
                                            <label>Tên người nhận: </label>
                                            <input type="text" name="ten_nguoi_nhan" class="form-control" placeholder="Nhập tên danh mục" value="<?= $donHang['ten_nguoi_nhan'] ?>">
                                            <?php if (isset($errors['ten_nguoi_nhan'])) { ?>
                                                <p class="text-danger"><?= $errors['ten_nguoi_nhan'] ?></p>
                                            <?php } ?>
                                        </div>

                                        <div class="form-group">
                                            <input type="text" name="id" value="<?= $donHang['id'] ?>" hidden>
                                            <label>Số điện thoại: </label>
                                            <input type="text" name="sdt_nguoi_nhan" class="form-control" placeholder="Nhập tên danh mục" value="<?= $donHang['sdt_nguoi_nhan'] ?>">
                                            <?php if (isset($errors['sdt_nguoi_nhan'])) { ?>
                                                <p class="text-danger"><?= $errors['sdt_nguoi_nhan'] ?></p>
                                            <?php } ?>
                                        </div>

                                        <div class="form-group">
                                            <input type="text" name="id" value="<?= $donHang['id'] ?>" hidden>
                                            <label>Emai: </label>
                                            <input type="text" name="email_nguoi_nhan" class="form-control" placeholder="Nhập tên danh mục" value="<?= $donHang['email_nguoi_nhan'] ?>">
                                            <?php if (isset($errors['email_nguoi_nhan'])) { ?>
                                                <p class="text-danger"><?= $errors['email_nguoi_nhan'] ?></p>
                                            <?php } ?>
                                        </div>

                                        <div class="form-group">
                                            <input type="text" name="id" value="<?= $donHang['id'] ?>" hidden>
                                            <label>Địa chỉ: </label>
                                            <input type="text" name="dia_chi_nguoi_nhan" class="form-control" placeholder="Nhập tên danh mục" value="<?= $donHang['dia_chi_nguoi_nhan'] ?>">
                                            <?php if (isset($errors['dia_chi_nguoi_nhan'])) { ?>
                                                <p class="text-danger"><?= $errors['dia_chi_nguoi_nhan'] ?></p>
                                            <?php } ?>
                                        </div>

                                        <div class="form-group">
                                            <input type="text" name="id" value="<?= $donHang['id'] ?>" hidden>
                                            <label>Ghi chú: </label>
                                            <input type="text" name="ghi_chu" class="form-control" placeholder="Nhập tên danh mục" value="<?= $donHang['ghi_chu'] ?>">
                                            <?php if (isset($errors['ghi_chu'])) { ?>
                                                <p class="text-danger"><?= $errors['ghi_chu'] ?></p>
                                            <?php } ?>
                                        </div>

                                        <hr>

                                        <div class="form-group">
                                            <label>Trạng thái đơn hàng: </label>
                                            <select name="trang_thai_id" class="form-control">
                                                <?php foreach ($listTrangThaiDonHang as $trangThai): ?>

                                                    <?php
                                                    // OPTION được chọn hiện tại
                                                    $selected = ($trangThai['id'] == $donHang['trang_thai_id']) ? "selected" : "";

                                                    // Mặc định không disabled
                                                    $disabled = "";

                                                    // Chỉ disable nếu KHÔNG PHẢI trạng thái đang chọn
                                                    if ($trangThai['id'] != $donHang['trang_thai_id']) {

                                                        // Không cho quay lại trạng thái trước đó
                                                        if ($trangThai['id'] < $donHang['trang_thai_id']) {
                                                            $disabled = "disabled";
                                                        }

                                                        // Không cho đổi nếu đã vào trạng thái khóa: 6,7,8
                                                        if (in_array($donHang['trang_thai_id'], [6, 7, 8])) {
                                                            $disabled = "disabled";
                                                        }
                                                    }
                                                    ?>

                                                    <option value="<?= $trangThai['id'] ?>" <?= $selected ?> <?= $disabled ?>>
                                                        <?= $trangThai['ten_trang_thai'] ?>
                                                    </option>

                                                <?php endforeach; ?>
                                            </select>
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