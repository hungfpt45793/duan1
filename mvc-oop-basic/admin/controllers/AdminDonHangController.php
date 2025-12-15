<?php

class AdminDonHangController
{
    public $modelDonHang;
    public function __construct()
    {
        $this->modelDonHang = new AdminDonHang();
    }

    public function danhSachDonHang()
    {
        $listDonHang = $this->modelDonHang->getAllDonHang();
        require_once './views/DonHang/listDonHang.php';
    }

    public function detailDonHang()
    {
        $don_hang_id = $_GET['id_don_hang'];
        // Lấy thông tin đơn hàng ở bảng don_hangs
        $donHang = $this->modelDonHang->getDetailDonHang($don_hang_id);
        // Lấy danh sách sản phẩm đã đặt của đơn hàng ở bảng chi_tiet_don_hangs
        $sanPhamDonHang = $this->modelDonHang->getListSpDonHang($don_hang_id);
        $listTrangThaiDonHang = $this->modelDonHang->getAllTrangThaiDonHang();
        require_once './views/donhang/detailDonHang.php';
    }

    public function formEditDonHang()
    {
        $id = $_GET['id_don_hang'];
        $donHang = $this->modelDonHang->getDetailDonHang($id);
        $listTrangThaiDonHang = $this->modelDonHang->getAllTrangThaiDonHang();
        if ($donHang) {
            require_once './views/donhang/editDonHang.php';
            deleteSessionError();
        } else {
            header("Location: " . BASE_URL_ADMIN . '?act=don-hang');
            exit();
        }
    }


    public function postEditDonHang()
    {   
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Lấy dữ liệu từ form
            $id = $_POST['don_hang_id'] ?? null;
            $ten_nguoi_nhan = $_POST['ten_nguoi_nhan'] ?? '';
            $email_nguoi_nhan = $_POST['email_nguoi_nhan'] ?? '';
            $sdt_nguoi_nhan = $_POST['sdt_nguoi_nhan'] ?? '';
            $dia_chi_nguoi_nhan = $_POST['dia_chi_nguoi_nhan'] ?? '';
            $ghi_chu = $_POST['ghi_chu'] ?? '';
            $trang_thai_id = $_POST['trang_thai_id'] ?? '';

            // Validate cơ bản
            $errors = [];
            if (empty($ten_nguoi_nhan)) $errors['ten_nguoi_nhan'] = "Không được để trống";
            if (empty($email_nguoi_nhan)) $errors['email_nguoi_nhan'] = "Không được để trống";
            if (empty($sdt_nguoi_nhan)) $errors['sdt_nguoi_nhan'] = "Không được để trống";
            if (empty($dia_chi_nguoi_nhan)) $errors['dia_chi_nguoi_nhan'] = "Không được để trống";

            if (!empty($errors)) {
                $_SESSION['error'] = $errors;
                header("Location: " . BASE_URL_ADMIN . "?act=form-sua-don-hang&id_don_hang=$id");
                exit();
            }

            // GỌI MODEL UPDATE
            $this->modelDonHang->updateDonHang(
                $id,
                $ten_nguoi_nhan,
                $email_nguoi_nhan,
                $sdt_nguoi_nhan,
                $dia_chi_nguoi_nhan,
                $ghi_chu,
                $trang_thai_id
            );

            header("Location: " . BASE_URL_ADMIN . "?act=don-hang&msg=success");
            exit();
        }
    }


    //     public function postEditProduct()
    //     {
    //         if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //             $id = $_POST['id_san_pham'];

    //             // Lấy dữ liệu POST
    //             $ten_san_pham   = $_POST['ten_san_pham'];
    //             $gia_san_pham   = $_POST['gia_san_pham'];
    //             $gia_khuyen_mai = $_POST['gia_khuyen_mai'];
    //             $so_luong       = $_POST['so_luong'];
    //             $ngay_nhap      = $_POST['ngay_nhap'];
    //             $danh_muc_id    = $_POST['danh_muc_id'];
    //             $trang_thai     = $_POST['trang_thai'];
    //             $mo_ta          = $_POST['mo_ta'];

    //             // Lấy dữ liệu cũ
    //             $sanPham = $this->modelSanPham->getDetailSanPham($id);
    //             $oldThumb = $sanPham['hinh_anh'];

    //             // Ảnh đại diện mới
    //             $thumb = $_FILES['hinh_anh'];

    //             if ($thumb && $thumb['error'] == 0) {
    //                 // Upload ảnh mới
    //                 $file_thumb = uploadFile($thumb, 'uploads/');

    //                 // Xoá ảnh cũ
    //                 if (!empty($oldThumb)) {
    //                     deleteFile($oldThumb);
    //                 }
    //             } else {
    //                 // Không upload giữ ảnh cũ
    //                 $file_thumb = $oldThumb;
    //             }

    //             // Validate dữ liệu
    //             $errors = [];

    //             if (empty($ten_san_pham)) $errors['ten_san_pham'] = "Tên không được để trống";
    //             if (empty($gia_san_pham)) $errors['gia_san_pham'] = "Giá không được để trống";
    //             if (empty($so_luong))     $errors['so_luong'] = "Số lượng không được để trống";
    //             if (empty($ngay_nhap))    $errors['ngay_nhap'] = "Ngày nhập không được để trống";

    //             if (!empty($errors)) {
    //                 $_SESSION['error'] = $errors;
    //                 header("Location:" . BASE_URL_ADMIN . "?act=edit-san-pham&id_san_pham=$id");
    //                 exit();
    //             }

    //             // Cập nhật vào DB
    //             $this->modelSanPham->updateSanPham(
    //                 $id,
    //                 $ten_san_pham,
    //                 $gia_san_pham,
    //                 $gia_khuyen_mai,
    //                 $so_luong,
    //                 $ngay_nhap,
    //                 $danh_muc_id,
    //                 $trang_thai,
    //                 $mo_ta,
    //                 $file_thumb
    //             );

    //             // Xử lý thêm ảnh album mới
    //             if (!empty($_FILES['img_array']['name'][0])) {

    //                 foreach ($_FILES['img_array']['name'] as $index => $name) {

    //                     if ($_FILES['img_array']['error'][$index] == 0) {

    //                         $file = [
    //                             'name'      => $_FILES['img_array']['name'][$index],
    //                             'type'      => $_FILES['img_array']['type'][$index],
    //                             'tmp_name'  => $_FILES['img_array']['tmp_name'][$index],
    //                             'error'     => $_FILES['img_array']['error'][$index],
    //                             'size'      => $_FILES['img_array']['size'][$index]
    //                         ];

    //                         $link = uploadFile($file, 'uploads/');

    //                         $this->modelSanPham->insertAlbumAnhSanPham($id, $link);
    //                     }
    //                 }
    //             }


    //             // Nếu có ảnh cần xoá
    //             if (!empty($_POST['delete_images'])) {

    //                 foreach ($_POST['delete_images'] as $idAnh) {

    //                     // Lấy ảnh
    //                     $anh = $this->modelSanPham->getDetailAnhSanPham($idAnh);

    //                     // Xoá file
    //                     if (!empty($anh['link_hinh_anh'])) {
    //                         deleteFile($anh['link_hinh_anh']);
    //                     }

    //                     // Xoá khỏi DB
    //                     $this->modelSanPham->destroyAnhSanPham($idAnh);
    //                 }
    //             }


    //             header("Location:" . BASE_URL_ADMIN . "?act=san-pham&msg=cap-nhat-thanh-cong");
    //             exit();
    //         }
    //     }

    //     public function detailSanPham()
    //     {
    //         $id = $_GET['id_san_pham'];
    //         $sanPham = $this->modelSanPham->getDetailSanPham($id);
    //         $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);
    //         if ($sanPham) {
    //             require_once './views/sanpham/detailSanPham.php';
    //         } else
    //             header("Location:" . BASE_URL_ADMIN . '?act=san-pham');
    //         exit();
    //     }
}
