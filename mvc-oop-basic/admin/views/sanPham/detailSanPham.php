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

                <!-- Default box -->
                <div class="card card-solid">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <h3 class="d-inline-block d-sm-none">LOWA Men’s Renegade GTX Mid Hiking Boots Review</h3>
                                <div class="col-12">
                                    <img src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" class="product-image" alt="Product Image">
                                </div>
                                <div class="col-12 product-image-thumbs">
                                    <?php foreach ($listAnhSanPham as $key => $anhSP): ?>
                                        <div class="product-image-thumb" <?= $key == 0 ? 'active' : '' ?>><img src="<?= BASE_URL . $anhSP['link_hinh_anh'] ?>" alt="Product Image"></div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <h3 class="my-3">Tên sản phẩm: <?= $sanPham['ten_san_pham'] ?></h3>
                                <hr>
                                <h4 class="mt-3">Giá tiền: <small><?= $sanPham['gia_san_pham'] ?></small></h4>
                                <h4 class="mt-3">Giá khuyến mãi: <small><?= $sanPham['gia_khuyen_mai'] ?></small></h4>
                                <h4 class="mt-3">Số lượng: <small><?= $sanPham['so_luong'] ?></small></h4>
                                <h4 class="mt-3">Lượt xem: <small><?= $sanPham['luot_xem'] ?></small></h4>
                                <h4 class="mt-3">Ngày nhập: <small><?= $sanPham['ngay_nhap'] ?></small></h4>
                                <h4 class="mt-3">Danh mục: <small><?= $sanPham['ten_danh_muc'] ?></small></h4>
                                <h4 class="mt-3">Trạng thái: <small><?= $sanPham['trang_thai'] == 1 ? 'Còn bán' : 'Dừng bán' ?></small></h4>
                                <h4 class="mt-3">Danh mục: <small><?= $sanPham['ten_danh_muc'] ?></small></h4>
                                <h4 class="mt-3">Mô tả: <small><?= $sanPham['mo_ta'] ?></small></h4>
                            </div>
                            <div class="row mt-4">
                                <nav class="w-100">
                                    <div class="nav nav-tabs" id="product-tab" role="tablist">
                                        <a class="nav-item nav-link active" id="product-desc-tab"
                                            data-toggle="tab" href="#binh-luan" role="tab"
                                            aria-controls="binh-luan" aria-selected="true">
                                            Bình luận
                                        </a>
                                    </div>
                                </nav>

                                <div class="tab-content p-3" id="nav-tabContent">

                                    <!-- TAB BÌNH LUẬN -->
                                    <div class="tab-pane fade show active" id="binh-luan"
                                        role="tabpanel" aria-labelledby="product-desc-tab">

                                        <div class="container-fluid">
                                            <h4 class="m-0">Danh sách bình luận</h4>
                                            <table id="example2" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th>STT</th>
                                                        <th>Tên khách hàng</th>
                                                        <th>Nội dung</th>
                                                        <th>Ngày bình luận</th>
                                                        <th>Trạng thái</th>
                                                        <th>Thao tác</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php foreach ($listBinhLuan as $key => $binhLuan): ?>
                                                        <tr>
                                                            <td><?= $key + 1 ?></td>
                                                            <td>
                                                            <a target="_blank" href="<?= BASE_URL_ADMIN . '?act=chi-tiet-khach-hang&id_khach_hang=' . $binhLuan['tai_khoan_id'] ?>">
                                                                <?= $binhLuan['ho_ten'] ?>
                                                            </a>
                                                            </td>
                                                            <td><?= $binhLuan['noi_dung'] ?></td>
                                                            <td><?= $binhLuan['ngay_dang'] ?></td>
                                                            <td><?= $binhLuan['trang_thai'] == 1 ? 'Hiển thị' : 'Bị ẩn' ?></td>
                                                            <td>
                                                                <form action="<?= BASE_URL_ADMIN . '?act=update-trang-thai-binh-luan' ?>" method="POST">
                                                                    <input type="hidden" name="id_binh_luan" value="<?= $binhLuan['id'] ?>">
                                                                    <input type="hidden" name="name_view" value="detail_sanpham">
                                                                    <input type="hidden" name="id_khach_hang" value="<?= $binhLuan['tai_khoan_id'] ?>">

                                                                    <button type="submit" onclick="return confirm('Bạn có muốn ẩn/bỏ ẩn bình luận này không?')" class="btn btn-warning">
                                                                        <?= $binhLuan['trang_thai'] == 1 ? 'Ẩn' : 'Bỏ ẩn' ?>
                                                                    </button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>


                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                    <!-- END TAB BÌNH LUẬN -->

                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

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

<script>
    $(document).ready(function() {
        $('.product-image-thumb').on('click', function() {
            var $image_element = $(this).find('img')
            $('.product-image').prop('src', $image_element.attr('src'))
            $('.product-image-thumb.active').removeClass('active')
            $(this).addClass('active')
        })
    })
</script>