<?php

class AdminSanPhamController
{
    public $modelSanPham;
    public $modelDanhMuc;
    public $modelTaiKhoan;
    public function __construct()
    {
        $this->modelSanPham = new AdminSanPham();
        $this->modelDanhMuc = new AdminDanhMuc();
        $this->modelTaiKhoan = new AdminTaiKhoan();
    }

    public function danhSachSanPham()
    {
        $listSanPham = $this->modelSanPham->getAllProduct();
        require_once './views/sanPham/listSanPham.php';
    }

    public function formThemSanPham()
    {
        $listDanhMuc = $this->modelDanhMuc->getAllCategory();
        require_once './views/sanPham/formThemSanPham.php';
        // xoá lỗi session
        deleteSessionError();
    }

    public function postAddProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Lấy dữ liệu
            $ten_san_pham = $_POST['ten_san_pham'];
            $gia_san_pham = $_POST['gia_san_pham'];
            $gia_khuyen_mai = $_POST['gia_khuyen_mai'];
            $so_luong = $_POST['so_luong'];
            $ngay_nhap = $_POST['ngay_nhap'];
            $danh_muc_id = $_POST['danh_muc_id'] ?? null;
            $trang_thai = $_POST['trang_thai'] ?? null;
            $mo_ta = $_POST['mo_ta'] ?? null;
            $hinh_anh = $_FILES['hinh_anh'];

            $errors = [];

            // Validate dữ liệu
            if (empty($ten_san_pham)) $errors['ten_san_pham'] = 'Tên sản phẩm không được để trống';
            if (empty($gia_san_pham)) $errors['gia_san_pham'] = 'Giá sản phẩm không được để trống';
            if (empty($gia_khuyen_mai)) $errors['gia_khuyen_mai'] = 'Giá khuyến mãi không được để trống';
            if (empty($so_luong)) $errors['so_luong'] = 'Số lượng không được để trống';
            if (empty($ngay_nhap)) $errors['ngay_nhap'] = 'Ngày nhập không được để trống';
            if (empty($danh_muc_id)) $errors['danh_muc_id'] = 'Phải chọn danh mục';
            if (empty($trang_thai)) $errors['trang_thai'] = 'Phải chọn trạng thái';

            // Validate ảnh chính
            if ($hinh_anh['error'] !== 0) {
                $errors['hinh_anh'] = 'Vui lòng chọn ảnh sản phẩm';
            }

            $_SESSION['error'] = $errors;

            // Nếu có lỗi → trả về form
            if (!empty($errors)) {
                $_SESSION['flash'] = true;
                header("Location:" . BASE_URL_ADMIN . '?act=form-them-san-pham');
                exit();
            }

            // ======= VALIDATE OK → TIẾN HÀNH UPLOAD =========

            // Upload ảnh chính
            $file_thumb = uploadFile($hinh_anh, 'uploads/');

            // Insert sản phẩm
            $san_pham_id = $this->modelSanPham->insertSanPham(
                $ten_san_pham,
                $gia_san_pham,
                $gia_khuyen_mai,
                $so_luong,
                $ngay_nhap,
                $danh_muc_id,
                $trang_thai,
                $mo_ta,
                $file_thumb
            );

            // Xử lý ảnh phụ
            $img_array = $_FILES['img_array'];

            if (!empty($img_array['name'])) {
                foreach ($img_array['name'] as $key => $value) {

                    if ($img_array['error'][$key] !== 0) continue;

                    $file = [
                        'name' => $img_array['name'][$key],
                        'type' => $img_array['type'][$key],
                        'tmp_name' => $img_array['tmp_name'][$key],
                        'error' => $img_array['error'][$key],
                        'size' => $img_array['size'][$key]
                    ];

                    $link = uploadFile($file, 'uploads/');
                    if ($link) {
                        $this->modelSanPham->insertAlbumAnhSanPham($san_pham_id, $link);
                    }
                }
            }

            header("Location:" . BASE_URL_ADMIN . '?act=san-pham');
            exit();
        }
    }


    public function deleteSanPham()
    {
        $id = $_GET['id_san_pham'] ?? null;

        // Lấy thông tin sản phẩm
        $sanPham = $this->modelSanPham->getDetailSanPham($id);

        if (!$sanPham) {
            header("Location:" . BASE_URL_ADMIN . "?act=san-pham&msg=khong-tim-thay");
            exit();
        }

        // Lấy danh sách ảnh phụ
        $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);

        // Xoá ảnh chính
        if (!empty($sanPham['hinh_anh'])) {
            deleteFile($sanPham['hinh_anh']);
        }

        // Xoá ảnh phụ
        foreach ($listAnhSanPham as $anh) {
            deleteFile($anh['link_hinh_anh']);
            $this->modelSanPham->destroyAnhSanPham($anh['id']);
        }

        // Xoá sản phẩm
        $this->modelSanPham->destroySanPham($id);

        header("Location:" . BASE_URL_ADMIN . '?act=san-pham&msg=xoa-thanh-cong');
        exit();
    }


    public function editSanPham()
    {
        // Hàm này dùng để hiển thị form nhập
        // Lấy ra thông tin của sản phẩm cần sửa
        $id = $_GET['id_san_pham'];
        $sanPham = $this->modelSanPham->getDetailSanPham($id);
        $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);
        $listDanhMuc = $this->modelDanhMuc->getAllCategory();
        if ($sanPham) {
            require_once './views/sanpham/editSanPham.php';
        } else {
            header("Location:" . BASE_URL_ADMIN . '?act=san-pham');
            exit();
        }
    }
    public function postEditProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $id = $_POST['id_san_pham'];

            // Lấy dữ liệu POST
            $ten_san_pham   = $_POST['ten_san_pham'];
            $gia_san_pham   = $_POST['gia_san_pham'];
            $gia_khuyen_mai = $_POST['gia_khuyen_mai'];
            $so_luong       = $_POST['so_luong'];
            $ngay_nhap      = $_POST['ngay_nhap'];
            $danh_muc_id    = $_POST['danh_muc_id'];
            $trang_thai     = $_POST['trang_thai'];
            $mo_ta          = $_POST['mo_ta'];

            // Lấy dữ liệu cũ
            $sanPham = $this->modelSanPham->getDetailSanPham($id);
            $oldThumb = $sanPham['hinh_anh'];

            // Ảnh đại diện mới
            $thumb = $_FILES['hinh_anh'];

            if ($thumb && $thumb['error'] == 0) {
                // Upload ảnh mới
                $file_thumb = uploadFile($thumb, 'uploads/');

                // Xoá ảnh cũ
                if (!empty($oldThumb)) {
                    deleteFile($oldThumb);
                }
            } else {
                // Không upload giữ ảnh cũ
                $file_thumb = $oldThumb;
            }

            // Validate dữ liệu
            $errors = [];

            if (empty($ten_san_pham)) $errors['ten_san_pham'] = "Tên không được để trống";
            if (empty($gia_san_pham)) $errors['gia_san_pham'] = "Giá không được để trống";
            if (empty($so_luong))     $errors['so_luong'] = "Số lượng không được để trống";
            if (empty($ngay_nhap))    $errors['ngay_nhap'] = "Ngày nhập không được để trống";

            if (!empty($errors)) {
                $_SESSION['error'] = $errors;
                header("Location:" . BASE_URL_ADMIN . "?act=edit-san-pham&id_san_pham=$id");
                exit();
            }

            // Cập nhật vào DB
            $this->modelSanPham->updateSanPham(
                $id,
                $ten_san_pham,
                $gia_san_pham,
                $gia_khuyen_mai,
                $so_luong,
                $ngay_nhap,
                $danh_muc_id,
                $trang_thai,
                $mo_ta,
                $file_thumb
            );

            // Xử lý thêm ảnh album mới
            if (!empty($_FILES['img_array']['name'][0])) {

                foreach ($_FILES['img_array']['name'] as $index => $name) {

                    if ($_FILES['img_array']['error'][$index] == 0) {

                        $file = [
                            'name'      => $_FILES['img_array']['name'][$index],
                            'type'      => $_FILES['img_array']['type'][$index],
                            'tmp_name'  => $_FILES['img_array']['tmp_name'][$index],
                            'error'     => $_FILES['img_array']['error'][$index],
                            'size'      => $_FILES['img_array']['size'][$index]
                        ];

                        $link = uploadFile($file, 'uploads/');

                        $this->modelSanPham->insertAlbumAnhSanPham($id, $link);
                    }
                }
            }


            // Nếu có ảnh cần xoá
            if (!empty($_POST['delete_images'])) {

                foreach ($_POST['delete_images'] as $idAnh) {

                    // Lấy ảnh
                    $anh = $this->modelSanPham->getDetailAnhSanPham($idAnh);

                    // Xoá file
                    if (!empty($anh['link_hinh_anh'])) {
                        deleteFile($anh['link_hinh_anh']);
                    }

                    // Xoá khỏi DB
                    $this->modelSanPham->destroyAnhSanPham($idAnh);
                }
            }


            header("Location:" . BASE_URL_ADMIN . "?act=san-pham&msg=cap-nhat-thanh-cong");
            exit();
        }
    }

    public function detailSanPham()
    {
        $id = $_GET['id_san_pham'];
        $sanPham = $this->modelSanPham->getDetailSanPham($id);
        $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);

        $listBinhLuan = $this->modelSanPham->getBinhLuanFromSanPham($id);

        if ($sanPham) {
            require_once './views/sanpham/detailSanPham.php';
        } else
            header("Location:" . BASE_URL_ADMIN . '?act=san-pham');
        exit();
    }

    public function updateTrangThaiBinhLuan()
    {
        // Lấy dữ liệu từ POST
        $id_binh_luan = isset($_POST['id_binh_luan']) ? (int)$_POST['id_binh_luan'] : 0;
        $name_view = isset($_POST['name_view']) ? $_POST['name_view'] : '';
        $id_khach_hang = isset($_POST['id_khach_hang']) ? (int)$_POST['id_khach_hang'] : 0;
        $id_san_pham = isset($_POST['id_san_pham']) ? (int)$_POST['id_san_pham'] : 0;

        if ($id_binh_luan <= 0) {
            echo "ID bình luận không hợp lệ.";
            return;
        }

        // Lấy chi tiết bình luận
        $binhLuan = $this->modelSanPham->getDetailBinhLuan($id_binh_luan);
        if (!$binhLuan) {
            echo "Bình luận không tồn tại.";
            return;
        }

        // Xác định trạng thái mới
        $trang_thai_update = ($binhLuan['trang_thai'] == 1) ? 2 : 1;

        // Cập nhật trạng thái
        $status = $this->modelSanPham->updateTrangThaiBinhLuan($id_binh_luan, $trang_thai_update);

        if ($status) {
            // Điều hướng về route phù hợp
            if ($name_view == 'detail_khach') {
                header("Location: " . BASE_URL_ADMIN . '?act=chi-tiet-khach-hang&id_khach_hang=' . $id_khach_hang);
            } else {
                header("Location: " . BASE_URL_ADMIN . '?act=chi-tiet-san-pham&id_san_pham=' . $id_san_pham);
            }
            exit;
        } else {
            echo "Cập nhật trạng thái thất bại.";
        }
    }

   
}
