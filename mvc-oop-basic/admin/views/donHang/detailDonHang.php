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
                            <h1>
                                Quản lý danh sách đơn hàng —
                                Mã đơn hàng: <?= $donHang['ma_don_hang'] ?>
                            </h1>
                        </div>
                        <form action="" method="post">
                            <select name="trang_thai_id" class="form-control">

                                <option value="" disabled></option>
                                <?php foreach ($listTrangThaiDonHang as $key => $trangThai): ?>
                                    <option
                                        <?= $trangThai['id'] == $donHang['trang_thai_id'] ? 'selected' : '' ?>
                                        <?= $trangThai['id'] < $donHang['trang_thai_id'] ? 'disabled' : '' ?>
                                        value="<?= $trangThai['id']; ?>">
                                        <?= $trangThai['ten_trang_thai']; ?>
                                    </option>
                                <?php endforeach ?>

                            </select>

                            <!-- <button type="submit" class="btn btn-primary mt-2">Cập nhật trạng thái</button> -->
                        </form>

                    </div>
                </div>
            </section>

            <!-- Alert trạng thái đơn hàng -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">

                            <?php
                            if ($donHang['trang_thai_id'] == 1) {
                                $colorAlerts = 'primary';
                            } elseif ($donHang['trang_thai_id'] >= 2 && $donHang['trang_thai_id'] <= 9) {
                                $colorAlerts = 'warning';
                            } elseif ($donHang['trang_thai_id'] == 10) {
                                $colorAlerts = 'success';
                            } else {
                                $colorAlerts = 'danger';
                            }
                            ?>

                            <div class="alert alert-<?= $colorAlerts ?>" role="alert">
                                Trạng thái đơn hàng:
                                <b><?= $donHang['ten_trang_thai'] ?></b>
                            </div>

                        </div>
                    </div>
                </div>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-12">

                            <!-- Invoice -->
                            <div class="invoice p-3 mb-3">

                                <!-- Title row -->
                                <div class="row">
                                    <div class="col-12">
                                        <h4>
                                            <i class="fas fa-globe"></i> Shop điện thoại
                                            <small class="float-right">Ngày đặt:
                                                <?= formatDate($donHang['ngay_dat']); ?>
                                            </small>
                                        </h4>
                                    </div>
                                </div>

                                <!-- Info row -->
                                <div class="row invoice-info">

                                    <div class="col-sm-4 invoice-col">
                                        <strong>Thông tin người đặt</strong>
                                        <address>
                                            <?= $donHang['ho_ten'] ?><br>
                                            Email: <?= $donHang['email'] ?><br>
                                            SĐT: <?= $donHang['so_dien_thoai'] ?><br>
                                        </address>
                                    </div>

                                    <div class="col-sm-4 invoice-col">
                                        <strong>Thông tin người nhận</strong>
                                        <address>
                                            <?= $donHang['ten_nguoi_nhan'] ?><br>
                                            Email: <?= $donHang['email_nguoi_nhan'] ?><br>
                                            SĐT: <?= $donHang['sdt_nguoi_nhan'] ?><br>
                                            Địa chỉ: <?= $donHang['dia_chi_nguoi_nhan'] ?><br>
                                        </address>
                                    </div>

                                    <div class="col-sm-4 invoice-col">
                                        <b>Mã đơn hàng:</b> <?= $donHang['ma_don_hang'] ?><br><br>

                                        <b>Tổng tiền:</b> <?= number_format($donHang['tong_tien']) ?>đ<br>
                                        <b>Ghi chú:</b> <?= $donHang['ghi_chu'] ?><br>
                                        <b>Thanh toán:</b> <?= $donHang['ten_phuong_thuc'] ?>
                                    </div>

                                </div>

                                <!-- Table row -->
                                <div class="row mt-4">
                                    <div class="col-12 table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Tên sản phẩm</th>
                                                    <th>Đơn giá</th>
                                                    <th>Số lượng</th>
                                                    <th>Thành tiền</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $tong_tien = 0; ?>
                                                <?php foreach ($sanPhamDonHang as $key => $sp): ?>
                                                    <tr>
                                                        <td><?= $key + 1 ?></td>
                                                        <td><?= $sp['ten_san_pham'] ?></td>
                                                        <td><?= number_format($sp['don_gia']) ?>đ</td>
                                                        <td><?= $sp['so_luong'] ?></td>
                                                        <td><?= number_format($sp['thanh_tien']) ?>đ</td>
                                                    </tr>
                                                    <?php $tong_tien += $sp['thanh_tien']; ?>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Tổng tiền -->
                                <div class="row mt-4">

                                    <div class="col-6">
                                        <p class="lead">Ngày đặt hàng: <?= formatDate($donHang['ngay_dat']) ?></p>

                                        <div class="table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <th style="width:50%">Tạm tính:</th>
                                                    <td><?= number_format($tong_tien) ?>đ</td>
                                                </tr>
                                                <tr>
                                                    <th>Phí vận chuyển:</th>
                                                    <td>20.000đ</td>
                                                </tr>
                                                <tr>
                                                    <th>Tổng cộng:</th>
                                                    <td><?= number_format($tong_tien + 20000) ?>đ</td>
                                                </tr>
                                            </table>
                                        </div>

                                    </div>

                                </div>

                                <!-- Buttons -->
                              
                            <!-- /.invoice -->

                        </div>
                    </div>

                </div>
            </section>

        </div>

        <?php require_once './views/layouts/footer.php'; ?>
    </div>

</body>

</html>