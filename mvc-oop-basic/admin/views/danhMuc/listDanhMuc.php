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
                        <h1>Danh sách danh mục</h1>
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
                                <a href="<?= BASE_URL_ADMIN . '?act=form-them-danh-muc' ?>" class="btn btn-primary">Thêm danh mục</a>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên danh mục</th>
                                            <th>Mô tả</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($listCategory as $key => $category): ?>
                                        <tr>
                                            <td><?= $key + 1 ?></td>
                                            <td><?= $category['ten_danh_muc'] ?></td>
                                            <td><?= $category['mo_ta'] ?></td>
                                            <td>
                                                <a href="<?= BASE_URL_ADMIN . '?act=form-sua-danh-muc&id_danh_muc=' . $category['id'] ?>" class="btn btn-warning">Sửa</a>
                                                <a href="<?= BASE_URL_ADMIN . '?act=xoa-danh-muc&id_danh_muc=' . $category['id'] ?>" class="btn btn-danger" onclick="return confirm('Bạn có đồng ý xoá không?')">Xoá</a>
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
    $(function () {
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
