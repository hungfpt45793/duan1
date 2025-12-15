<?php require_once './views/layouts/header.php'; ?>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php require_once './views/layouts/sidebar.php'; ?>

        <div class="content-wrapper">

            <!-- Header -->
            <section class="content-header">
                <div class="container-fluid">
                    <h1>Thông tin chi tiết khách hàng</h1>
                </div>
            </section>

            <!-- Main Content -->
            <section class="content">
                <div class="container-fluid">

                    <div class="card shadow-sm">

                        <div class="card-header">
                            <h3 class="card-title">
                                Chi tiết khách hàng: <b><?= $khachHang['ho_ten']; ?></b>
                            </h3>
                        </div>

                        <div class="card-body">

                            <div class="row">

                                <!-- Avatar -->
                                <div class="col-md-4">
                                    <img src="<?= BASE_URL . $khachHang['anh_dai_dien'] ?>"
                                        class="img-fluid rounded shadow-sm"
                                        alt="Avatar"
                                        onerror="this.onerror=null; this.src='https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png'">
                                </div>

                                <!-- Thông tin khách hàng -->
                                <div class="col-md-8">

                                    <div class="card shadow-sm">
                                        <div class="card-header bg-primary text-white">
                                            <h4 class="m-0">Thông tin khách hàng</h4>
                                        </div>

                                        <div class="card-body">
                                            <table class="table table-borderless" style="font-size: 18px;">
                                                <tbody>
                                                    <tr>
                                                        <th style="width: 200px;">Họ tên:</th>
                                                        <td><?= $khachHang['ho_ten'] ?></td>
                                                    </tr>

                                                    <tr>
                                                        <th>Email:</th>
                                                        <td><?= $khachHang['email'] ?></td>
                                                    </tr>

                                                    <tr>
                                                        <th>Số điện thoại:</th>
                                                        <td><?= $khachHang['so_dien_thoai'] ?></td>
                                                    </tr>

                                                    <tr>
                                                        <th>Ngày sinh:</th>
                                                        <td><?= $khachHang['ngay_sinh'] ?></td>
                                                    </tr>

                                                    <tr>
                                                        <th>Giới tính:</th>
                                                        <td><?= $khachHang['gioi_tinh'] == 1 ? 'Nam' : 'Nữ' ?></td>
                                                    </tr>

                                                    <tr>
                                                        <th>Địa chỉ:</th>
                                                        <td><?= $khachHang['dia_chi'] ?></td>
                                                    </tr>

                                                    <tr>
                                                        <th>Trạng thái:</th>
                                                        <td>
                                                            <span class="badge <?= $khachHang['trang_thai'] == 1 ? 'badge-success' : 'badge-danger' ?>">
                                                                <?= $khachHang['trang_thai'] == 1 ? 'Active' : 'Inactive' ?>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- Danh sách đơn hàng -->
                            <div class="card mt-4 shadow-sm">
                                <div class="card-header ">
                                    <h4 class="m-0">Danh sách đơn hàng</h4>
                                    <div class="card-tools">
                                        <div class="input-group input-group-sm" style="width: 250px;">
                                            <input type="text" id="searchDonHang" class="form-control" placeholder="Tìm đơn hàng...">
                                            <div class="input-group-append">
                                                <button class="btn btn-default">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">

                                    <table class="table table-hover table-bordered" id="tableDonHang">

                                        <thead class="bg-light text-center">
                                            <tr>
                                                <th>#</th>
                                                <th>Mã đơn hàng</th>
                                                <th>Ngày đặt</th>
                                                <th>Tổng tiền</th>
                                                <th>Trạng thái</th>
                                                <th>Chi tiết</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php if (!empty($listDonHang)): ?>
                                                <?php foreach ($listDonHang as $key => $donHang): ?>
                                                    <tr class="text-center">

                                                        <td><?= $key + 1 ?></td>

                                                        <td><?= $donHang['ma_don_hang'] ?></td>

                                                        <td><?= $donHang['ngay_dat'] ?></td>

                                                        <td><?= number_format($donHang['tong_tien']) ?>₫</td>

                                                        <td>
                                                            <span class="badge 
                                                                <?= $donHang['ten_trang_thai'] == 'Hoàn thành' ? 'badge-success' : ($donHang['ten_trang_thai'] == 'Đang xử lý' ? 'badge-warning' : 'badge-secondary') ?>">
                                                                <?= $donHang['ten_trang_thai'] ?>
                                                            </span>
                                                        </td>

                                                        <td>
                                                            <a href="<?= BASE_URL_ADMIN . '?act=chi-tiet-don-hang&id_don_hang=' . $donHang['id'] ?>"
                                                                class="btn btn-primary btn-sm">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        </td>

                                                    </tr>
                                                <?php endforeach; ?>

                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="6" class="text-center text-muted">
                                                        Khách hàng chưa có đơn hàng nào.
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                            <h4 class="m-0">Danh sách bình luận</h4>
                            <table id="example2" class="table table-bordered table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th>STT</th>
                                        <th>Sản phẩm</th>
                                        <th>Nội dung</th>
                                        <th>Ngày bình luận</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($listBinhLuan as $key => $binhLuan): ?>
                                        <tr>
                                            <td class="text-center"><?= $key + 1 ?></td>

                                            <td>
                                                <a target="_blank" href="<?= BASE_URL_ADMIN . '?act=chi-tiet-san-pham&id_san_pham=' . $binhLuan['san_pham_id'] ?>">
                                                    <?= $binhLuan['ten_san_pham'] ?>
                                                </a>
                                            </td>


                                            <td><?= $binhLuan['noi_dung'] ?></td>

                                            <td class="text-center"><?= $binhLuan['ngay_dang'] ?></td>

                                            <td class="text-center">
                                                <?php if ($binhLuan['trang_thai'] == 1): ?>
                                                    <span class="badge badge-success">Hiển thị</span>
                                                <?php else: ?>
                                                    <span class="badge badge-secondary">Ẩn</span>
                                                <?php endif; ?>
                                            </td>

                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <form action="<?= BASE_URL_ADMIN . '?act=update-trang-thai-binh-luan' ?>" method="POST">
                                                        <input type="hidden" name="id_binh_luan" value="<?= $binhLuan['id'] ?>">
                                                        <input type="hidden" name="name_view" value="detail_khach">
                                                        <input type="hidden" name="id_khach_hang" value="<?= $binhLuan['tai_khoan_id'] ?>">

                                                        <button type="submit" onclick="return confirm('Bạn có muốn ẩn bình luận này không?')" class="btn btn-warning">
                                                            <?= $binhLuan['trang_thai'] == 1 ? 'Ẩn' : 'Bỏ ẩn' ?>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>

                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>


                            <a href="<?= BASE_URL_ADMIN . '?act=list-tai-khoan-khach-hang' ?>"
                                class="btn btn-secondary mt-3">
                                Quay lại danh sách
                            </a>

                        </div>
                    </div>

                </div>
            </section>

        </div>

        <?php require_once './views/layouts/footer.php'; ?>

    </div>
</body>

</html>

<script>
    document.getElementById('searchDonHang').addEventListener('keyup', function() {
        let keyword = this.value.toLowerCase();
        let rows = document.querySelectorAll('#tableDonHang tbody tr');

        rows.forEach(function(row) {
            let text = row.innerText.toLowerCase();
            row.style.display = text.includes(keyword) ? '' : 'none';
        });
    });
</script>