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
                            <h1>Quản lý tài khoản quản trị viên</h1>
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
                                    <a href="<?= BASE_URL_ADMIN . '?act=form-them-quan-tri' ?>" class="btn btn-primary">Thêm tài khoản</a>
                                </div>
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Họ tên</th>
                                                <th>Email</th>
                                                <th>Số điện thoại</th>
                                                <th>Trạng thái</th>
                                                <th>Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($listQuanTri as $key => $quanTri): ?>
                                                <tr>
                                                    <td><?= $key + 1 ?></td>
                                                    <td><?= $quanTri['ho_ten'] ?></td>
                                                    <td><?= $quanTri['email'] ?></td>
                                                    <td><?= $quanTri['so_dien_thoai'] ?></td>
                                                    <td><?= $quanTri['trang_thai'] == 1 ? 'Active' : 'Inactive' ?></td>

                                                    <td>
                                                        <a href="<?= BASE_URL_ADMIN . '?act=form-sua-quan-tri&id_quan_tri=' . $quanTri['id'] ?>">
                                                            <button class="btn btn-warning">Sửa</button>
                                                        </a>



                                                        <a href="<?= BASE_URL_ADMIN . '?act=reset-password&quan_tri_id=' . $quanTri['id'] ?>"
                                                            onclick="return confirm('Bạn có muốn reset password của tài khoản này không?')"
                                                            class="btn btn-danger">
                                                            Reset
                                                        </a>


                                                    </td>
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
    ```

</body>

</html>