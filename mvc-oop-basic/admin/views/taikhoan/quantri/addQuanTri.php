<?php require_once './views/layouts/header.php'; ?>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php require_once './views/layouts/sidebar.php'; ?>

        <div class="content-wrapper">

            <section class="content-header">
                <div class="container-fluid">
                    <h1>Quản lý tài khoản quản trị viên</h1>
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-12">
                            <div class="card">

                                <div class="card-body">

                                    <form action="<?= BASE_URL_ADMIN . '?act=them-quan-tri' ?>" method="POST">

                                        <div class="form-group">
                                            <label>Họ tên</label>
                                            <input type="text" class="form-control" name="ho_ten" placeholder="Nhập họ tên">

                                            <?php if (isset($_SESSION['error']['ho_ten'])): ?>
                                                <p class="text-danger"><?= $_SESSION['error']['ho_ten'] ?></p>
                                            <?php endif; ?>
                                        </div>

                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email" placeholder="Nhập email">

                                            <?php if (isset($_SESSION['error']['email'])): ?>
                                                <p class="text-danger"><?= $_SESSION['error']['email'] ?></p>
                                            <?php endif; ?>
                                        </div>

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
