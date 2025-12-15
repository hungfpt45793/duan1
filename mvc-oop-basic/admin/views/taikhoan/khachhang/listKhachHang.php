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
                            <h1>Quản lý tài khoản quản khách hàng</h1>
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
                                <div class="card-header">

                                </div>
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Họ tên</th>
                                                <th>Avatar</th>
                                                <th>Email</th>
                                                <th>Số điện thoại</th>
                                                <th>Trạng thái</th>
                                                <th>Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <tbody>
                                            <?php foreach ($listKhachHang as $key => $khachHang): ?>
                                                <tr>
                                                    <td><?= $key + 1 ?></td>

                                                    <td><?= $khachHang['ho_ten'] ?></td>

                                                    <td>
                                                        <img
                                                            src="<?= BASE_URL . $khachHang['anh_dai_dien'] ?>"
                                                            style="width: 80px; border-radius: 5px;"
                                                            alt="avatar"
                                                            onerror="this.onerror=null; this.src='https://cutepetshop.vn/wp-content/uploads/2023/05/11-buc-hinh-cho-cute-de-thuong-1.jpg';">
                                                    </td>

                                                    <td><?= $khachHang['email'] ?></td>
                                                    <td><?= $khachHang['so_dien_thoai'] ?></td>

                                                    <td>
                                                        <?= $khachHang['trang_thai'] == 1 ? '<span class="text-success">Active</span>'
                                                            : '<span class="text-danger">Inactive</span>' ?>
                                                    </td>

                                                    <td>
                                                        <div class="btn-group">

                                                            <!-- Xem chi tiết -->
                                                            <a href="<?= BASE_URL_ADMIN . '?act=chi-tiet-khach-hang&id_khach_hang=' . $khachHang['id'] ?>">
                                                                <button class="btn btn-primary"><i class="far fa-eye"></i></button>
                                                            </a>

                                                            <!-- Sửa thông tin khách hàng -->
                                                            <a href="<?= BASE_URL_ADMIN . '?act=form-sua-khach-hang&id_khach_hang=' . $khachHang['id'] ?>">
                                                                <button class="btn btn-warning"><i class="fas fa-cogs"></i></button>
                                                            </a>

                                                            <!-- Reset password -->
                                                            <a href="<?= BASE_URL_ADMIN . '?act=reset-password&quan_tri_id=' . $khachHang['id'] ?>"
                                                                onclick="return confirm('Bạn có muốn reset password của tài khoản này không?')">
                                                                <button class="btn btn-danger"><i class="fas fa-circle-notch"></i></button>
                                                            </a>

                                                        </div>

                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>

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
    ```

</body>

</html>