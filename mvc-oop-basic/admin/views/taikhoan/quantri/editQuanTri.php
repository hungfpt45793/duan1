<?php require_once './views/layouts/header.php'; ?>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php require_once './views/layouts/sidebar.php'; ?>

        <div class="content-wrapper">

            <section class="content-header">
                <div class="container-fluid">
                    <h1>Sửa thông tin tài khaonr quản trị</h1>
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-12">
                            <div class="card">
                                <h3 class="card-title">Sửa thông tin tài khoản quản trị: <?= $quanTri['ho_ten']; ?></h3>
                                <div class="card-body">

                                    <form action="<?= BASE_URL_ADMIN . '?act=sua-quan-tri' ?>" method="POST">
                                        <input type="hidden" name="quan_tri_id" value="<?= $quanTri['id'] ?>">
                                        <div class="form-group">
                                            <label>Họ tên</label>
                                            <input type="text"
                                                class="form-control"
                                                name="ho_ten"
                                                value="<?= $quanTri['ho_ten'] ?>">

                                            <?php if (isset($_SESSION['error']['ho_ten'])): ?>
                                                <p class="text-danger"><?= $_SESSION['error']['ho_ten'] ?></p>
                                            <?php endif; ?>
                                        </div>

                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email"
                                                class="form-control"
                                                name="email"
                                                value="<?= $quanTri['email'] ?>">

                                            <?php if (isset($_SESSION['error']['email'])): ?>
                                                <p class="text-danger"><?= $_SESSION['error']['email'] ?></p>
                                            <?php endif; ?>
                                        </div>


                                        <div class="form-group">
                                            <label>Số điện thoại</label>
                                            <input type="text"
                                                class="form-control"
                                                name="so_dien_thoai"
                                                value="<?= $quanTri['so_dien_thoai'] ?>">

                                            <?php if (isset($_SESSION['error']['so_dien_thoai'])): ?>
                                                <p class="text-danger"><?= $_SESSION['error']['so_dien_thoai'] ?></p>
                                            <?php endif; ?>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputStatus">Trạng thái tài khoản</label>
                                            <select id="inputStatus" name="trang_thai" class="form-control custom-select">

                                                <option value="1" <?= $quanTri['trang_thai'] == 1 ? 'selected' : '' ?>>
                                                    Active
                                                </option>

                                                <option value="2" <?= $quanTri['trang_thai'] == 2 ? 'selected' : '' ?>>
                                                    Inactive
                                                </option>

                                            </select>
                                        </div>

                                        <?php
                                        // Xóa session lỗi sau khi hiển thị
                                        if (isset($_SESSION['error'])) {
                                            unset($_SESSION['error']);
                                        }
                                        ?>


                                        <button type="submit" class="btn btn-primary">Thêm quản trị</button>

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