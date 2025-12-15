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
                            <h1>Danh sách sản phẩm</h1>
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
                                    <a href="<?= BASE_URL_ADMIN . '?act=form-them-san-pham' ?>" class="btn btn-primary">Thêm sản phẩm</a>
                                </div>
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Tên sản phẩm</th>
                                                <th>Hình ảnh</th>
                                                <th>Giá</th>
                                                <th>Số lượng</th>
                                                <th>Danh mục</th>
                                                <th>Trạng thái</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($listSanPham as $key => $sanPham): ?>
                                                <tr>
                                                    <td><?= $key + 1 ?></td>
                                                    <td><?= $sanPham['ten_san_pham'] ?></td>
                                                    <td>
                                                        <img src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" style="width: 100px"
                                                            onerror="this.onerror=null; this.src= 'https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcQJBnl2gcnIaPMidDJBtvwQ_Jj9YUW4iCkBoa5nuxQwPKs-QrHoqPG2bogeuh90rhH48hWCUjczH7Bf8inLkV8W2Rwr53sP4Bcr1BbwXpHYrzq1cHllCk7RlVOtbU6oKyUBCc2AjA&usqp=CAc'">
                                                    </td>
                                                    <td><?= number_format($sanPham['gia_san_pham']) ?>đ</td>
                                                    <td><?= $sanPham['so_luong'] ?></td>
                                                    <td><?= $sanPham['ten_danh_muc'] ?></td>
                                                    <td><?= $sanPham['trang_thai'] == 1 ? "Còn Hàng" : "Hết hàng" ?></td>
                                                    <td>
                                                        <a href="<?= BASE_URL_ADMIN . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>" class="btn btn-success"><i class="far fa-eye"></i></a>
                                                        <a href="<?= BASE_URL_ADMIN . '?act=form-sua-san-pham&id_san_pham=' . $sanPham['id'] ?>" class="btn btn-warning"><i class="far fa-edit"></i></a>
                                                        <a href="<?= BASE_URL_ADMIN . '?act=xoa-san-pham&id_san_pham=' . $sanPham['id'] ?>" class="btn btn-danger" onclick="return confirm('Bạn có đồng ý xoá không?')"><i class="far fa-trash-alt"></i></a>
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