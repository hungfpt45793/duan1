<?php
session_start();
// Require file Common
require_once '../commons/env.php'; // Khai báo biến môi trường
require_once '../commons/function.php'; // Hàm hỗ trợ


// Require toàn bộ file Controllers
require_once './controllers/AdminDanhMucController.php';
require_once './controllers/AdminSanPhamController.php';
require_once './controllers/AdminDonHangController.php';
require_once './controllers/AdminBaoCaoThongKe.php';
require_once './controllers/AdminTaiKhoanController.php';
// Require toàn bộ file Models
require_once './models/AdminDanhMuc.php';
require_once './models/AdminSanPham.php';
require_once './models/AdminDonHang.php';
require_once './models/AdminTaiKhoan.php';

// Route
$act = $_GET['act'] ?? '/';

if ($act !== 'login-admin' && $act !== 'check-login-admin' && $act !== 'logout-admin') {
    checkLoginAdmin();
}
//  if($_GET['act']){
//     $act = $_GET['act'];
//  }else{
//     $act = '/';
//  }
// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {


    '/' => (new BaoCaoThongKeConTroller())->home(),

    //route sản phẩm
    'san-pham' => (new AdminSanPhamController())->danhSachSanPham(),
    'form-them-san-pham' => (new AdminSanPhamController())->formThemSanPham(),
    'post-add-product' => (new AdminSanPhamController())->postAddProduct(),
    'form-sua-san-pham' => (new AdminSanPhamController())->editSanPham(),
    'post-edit-product' => (new AdminSanPhamController())->postEditProduct(),
    'xoa-san-pham' => (new AdminSanPhamController())->deleteSanPham(),
    'chi-tiet-san-pham' => (new AdminSanPhamController())->detailSanPham(),
    // 'xoa-anh-san-pham' => (new AdminSanPhamController())->deleteAnhTungCaiSanPham(),
    // route binh luận

    'update-trang-thai-binh-luan' => (new AdminSanPhamController())->updateTrangThaiBinhLuan(),

    // route danh mục 
    'danh-muc' => (new AdminDanhMucController())->danhSachDanhMuc(),
    'form-them-danh-muc' => (new AdminDanhMucController())->formThemDanhMuc(),
    'post-add-category' => (new AdminDanhMucController())->postAddCategory(),
    'form-sua-danh-muc' => (new AdminDanhMucController())->editDanhMuc(),
    'post-edit-category' => (new AdminDanhMucController())->postEditCategory(),
    'xoa-danh-muc' => (new AdminDanhMucController())->deleteDanhMuc(),

    //route đơn hàng
    'don-hang' => (new AdminDonHangController())->danhSachDonHang(),
    'form-sua-don-hang' => (new AdminDonHangController())->formEditDonHang(),
    'post-edit-don-hang' => (new AdminDonHangController())->postEditDonHang(),
    'chi-tiet-don-hang' => (new AdminDonHangController())->detailDonHang(),

    //route tai khoan 
    'list-tai-khoan-quan-tri' => (new AdminTaiKhoanController())->danhSachQuanTri(),
    'form-them-quan-tri' => (new AdminTaiKhoanController())->formAddQuanTri(),
    'them-quan-tri' => (new AdminTaiKhoanController())->postAddQuanTri(),
    'form-sua-quan-tri' => (new AdminTaiKhoanController())->formEditQuanTri(),
    'sua-quan-tri' => (new AdminTaiKhoanController())->postEditQuanTri(),


    // Route quản lý tài khoản cá nhân (quản trị)
    // Route quản lý tài khoản cá nhân (quản trị)
    'form-sua-thong-tin-ca-nhan-quan-tri' => (new AdminTaiKhoanController())->formEditCaNhanQuanTri(),
    'sua-thong-tin-ca-nhan-quan-tri' => (new AdminTaiKhoanController())->postEditCaNhanQuanTri(),
    'sua-mat-khau-ca-nhan-quan-tri' => (new AdminTaiKhoanController())->postEditMatKhauCaNhan(),



    'reset-password' => (new AdminTaiKhoanController())->resetPassword(),

    // Quản lý tài khoản khách hàng
    'list-tai-khoan-khach-hang' => (new AdminTaiKhoanController())->danhSachKhachHang(),
    'form-sua-khach-hang' => (new AdminTaiKhoanController())->formEditKhachHang(),
    'sua-khach-hang' => (new AdminTaiKhoanController())->postEditKhachHang(),
    'chi-tiet-khach-hang' => (new AdminTaiKhoanController())->deltailKhachHang(),

    //login
    'login-admin' => (new AdminTaiKhoanController())->formLogin(),
    'check-login-admin' => (new AdminTaiKhoanController())->login(),
    'logout-admin' => (new AdminTaiKhoanController())->logout(),
    
};
