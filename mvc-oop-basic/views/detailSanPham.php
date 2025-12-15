<?php require_once __DIR__ . '/layout/header.php'; ?>
<?php require_once __DIR__ . '/layout/menu.php'; ?>


<main>

    <!-- page main wrapper start -->
    <div class="shop-main-wrapper section-padding pb-0">
        <div class="container">
            <div class="row">
                <!-- product details wrapper start -->
                <div class="col-lg-12 order-1 order-lg-2">
                    <!-- product details inner end -->
                    <div class="product-details-inner">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="product-large-slider">
                                    <?php foreach ($listAnhSanPham as $anhSanPham): ?>
                                        <div class="pro-large-img img-zoom">
                                            <img src="<?= BASE_URL . $anhSanPham['link_hinh_anh'] ?>" alt="product-details" />
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                                <div class="pro-nav slick-row-10 slick-arrow-style">
                                    <?php foreach ($listAnhSanPham as $anhSanPham): ?>
                                        <div class="pro-nav-thumb">
                                            <img src="<?= BASE_URL . $anhSanPham['link_hinh_anh'] ?>" alt="product-details" />
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <div class="col-lg-7">
                                <div class="product-details-des">
                                    <div class="manufacturer-name">
                                        <a href="#"><?= htmlspecialchars($sanPham['ten_danh_muc']) ?></a>
                                    </div>

                                    <h3 class="product-name">
                                        <?= htmlspecialchars($sanPham['ten_san_pham']) ?>
                                    </h3>

                                    <div class="ratings d-flex">
                                        <div class="pro-review">
                                            <?php $countComment = count($listBinhLuan); ?>
                                            <span><?= $countComment . ' bình luận' ?></span>
                                        </div>
                                    </div>

                                    <div class="price-box">
                                        <?php if (!empty($sanPham['gia_khuyen_mai'])): ?>
                                            <span class="price-regular"><?= formatPrice($sanPham['gia_khuyen_mai']) . 'đ' ?></span>
                                            <span class="price-old">
                                                <del><?= formatPrice($sanPham['gia_san_pham']) . 'đ' ?></del>
                                            </span>
                                        <?php else: ?>
                                            <span class="price-regular"><?= formatPrice($sanPham['gia_san_pham']) . 'đ' ?></span>
                                        <?php endif; ?>

                                        <div class="availability">
                                            <i class="fa fa-check-circle"></i>
                                            <span><?= $sanPham['so_luong'] . ' trong kho' ?></span>
                                        </div>
                                    </div>

                                    <p class="pro-desc"><?= nl2br(htmlspecialchars($sanPham['mo_ta'])) ?></p>

                                    <form action="<?= BASE_URL . '?act=them-gio-hang' ?>" method="post">
                                        <div class="quantity-cart-box d-flex align-items-center">

                                            <h6 class="option-title">Số lượng:</h6>

                                            <div class="quantity">
                                                <input type="hidden" name="san_pham_id" value="<?= $sanPham['id']; ?>">
                                                <div class="pro-qty">
                                                    <input type="text" name="so_luong" value="1">
                                                </div>
                                            </div>

                                            <div class="action_link">
                                                <button type="submit" class="btn btn-cart2">Thêm giỏ hàng</button>
                                            </div>

                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- product details inner end -->

                    <!-- product details reviews start -->
                    <div class="product-details-reviews section-padding pb-0">
                        <div class="row">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="product-review-info">

                                        <ul class="nav review-tab">
                                            <li>
                                                <a class="active" data-bs-toggle="tab" href="#tab_three">
                                                    Bình luận (<?= $countComment ?>)
                                                </a>
                                            </li>
                                        </ul>

                                        <div class="tab-content reviews-tab">
                                            <div class="tab-pane fade show active" id="tab_three">

                                                <?php foreach ($listBinhLuan as $binhLuan): ?>
                                                    <div class="total-reviews">
                                                        <div class="rev-avatar">
                                                            <img src="<?= htmlspecialchars($binhLuan['anh_dai_dien']) ?>" alt="">
                                                        </div>

                                                        <div class="review-box">
                                                            <div class="post-author">
                                                                <p>
                                                                    <span><?= $binhLuan['ho_ten'] ?> - </span>
                                                                    <?= htmlspecialchars($binhLuan['ngay_dang']) ?>
                                                                </p>
                                                            </div>

                                                            <p>
                                                                <?= nl2br(htmlspecialchars($binhLuan['noi_dung'])) ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>


                                                <!-- Form thêm bình luận -->
                                                <form action="#" class="review-form">
                                                    <div class="form-group row">
                                                        <div class="col">
                                                            <label class="col-form-label">
                                                                <span class="text-danger">*</span> Nội dung bình luận
                                                            </label>
                                                            <textarea class="form-control" name="noi_dung" required></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="buttons">
                                                        <button class="btn btn-sqr" type="submit">Bình luận</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- product details reviews end -->
                </div>
                <!-- product details wrapper end -->
            </div>
        </div>
    </div>
    <!-- page main wrapper end -->

    <!-- related products area start -->
    <section class="related-products section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- section title start -->
                    <div class="section-title text-center">
                        <h2 class="title">Sản phẩm liên quan</h2>
                    </div>
                    <!-- section title start -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-carousel-4 slick-row-10 slick-arrow-style">

                        <?php foreach ($listSanPhamCungDanhMuc as $sanPham): ?>

                            <div class="product-item">
                                <figure class="product-thumb">
                                    <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id']; ?>">
                                        <img class="pri-img" src="<?= BASE_URL . '/' . $sanPham['hinh_anh'] ?>" alt="product">
                                        <img class="sec-img" src="<?= BASE_URL . '/' . $sanPham['hinh_anh'] ?>" alt="product">
                                    </a>

                                    <div class="product-badge">
                                        <?php
                                        $ngayNhap = new DateTime($sanPham['ngay_nhap']);
                                        $ngayhienTai = new DateTime();
                                        $tinhNgay = $ngayhienTai->diff($ngayNhap);

                                        if ($tinhNgay->days <= 7): ?>
                                            <div class="product-label new">
                                                <span>Mới</span>
                                            </div>
                                        <?php endif; ?>

                                        <?php if (!empty($sanPham['gia_khuyen_mai'])): ?>
                                            <div class="product-label discount">
                                                <span>Giảm giá</span>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="cart-hover">
                                        <a class="btn btn-cart" href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id']; ?>">
                                            Xem chi tiết
                                        </a>
                                    </div>
                                </figure>

                                <div class="product-caption text-center">
                                    <h6 class="product-name">
                                        <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id']; ?>">
                                            <?= htmlspecialchars($sanPham['ten_san_pham']) ?>
                                        </a>
                                    </h6>

                                    <div class="price-box">
                                        <?php if (!empty($sanPham['gia_khuyen_mai'])): ?>
                                            <span class="price-regular">
                                                <?= formatPrice($sanPham['gia_khuyen_mai']) . 'đ' ?>
                                            </span>
                                            <span class="price-old">
                                                <del><?= formatPrice($sanPham['gia_san_pham']) . 'đ' ?></del>
                                            </span>
                                        <?php else: ?>
                                            <span class="price-regular">
                                                <?= formatPrice($sanPham['gia_san_pham']) . 'đ' ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach; ?>

                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- related products area end -->
</main>



<!-- offcanvas mini cart start -->

<!-- offcanvas mini cart end -->

<?php require_once __DIR__ . '/layout/footer.php'; ?>