<?php require_once './views/layouts/header.php'; ?>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php require_once './views/layouts/sidebar.php'; ?>

        ```
        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <!-- Content Header -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Danh sách đơn hàng</h1>
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
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Mã đơn hàng</th>
                                            <th>Tên người nhận</th>
                                            <th>Số điện thoại</th>
                                            <th>Ngày đặt</th>
                                            <th>Tổng tiền</th>
                                            <th>Trạng thái</th>
                                            <th>Thao tác</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($listDonHang as $key => $donHang): ?>
                                                <tr>
                                                    <td><?= $key + 1 ?></td>
                                                    <td><?= $donHang['ma_don_hang'] ?></td>
                                                    <td><?= $donHang['ten_nguoi_nhan'] ?></td>
                                                    <td><?= $donHang['sdt_nguoi_nhan'] ?></td>
                                                    <td><?= $donHang['ngay_dat'] ?></td>
                                                    <td><?= $donHang['tong_tien'] ?></td>                                                  
                                                    <td><?= $donHang['ten_trang_thai'] ?></td>
                                                    <td>
                                                        <a href="<?= BASE_URL_ADMIN . '?act=chi-tiet-don-hang&id_don_hang=' . $donHang['id'] ?>" class="btn btn-success"><i class="far fa-eye"></i></a>
                                                        <a href="<?= BASE_URL_ADMIN . '?act=form-sua-don-hang&id_don_hang=' . $donHang['id'] ?>" class="btn btn-warning"><i class="far fa-edit"></i></a>                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <?php require_once './views/layouts/footer.php'; ?>
    </div>

    <!-- DataTables Script -->
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
    

</body>

</html>