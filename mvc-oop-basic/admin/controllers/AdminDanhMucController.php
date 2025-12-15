<?php 
class AdminDanhMucController{
    public $modelSanPham;
    public $modelDanhMuc;

    public function __construct()
    {
        // Khởi tạo model
        $this->modelSanPham = new AdminSanPham();
        $this->modelDanhMuc = new AdminDanhMuc();
    }

    // Hiển thị danh sách danh mục
    public function danhSachDanhMuc(){
        $listCategory = $this->modelDanhMuc->getAllCategory();
        require_once './views/danhMuc/listDanhMuc.php';
    }

    // Hiển thị form thêm danh mục
    public function formThemDanhMuc(){
        require_once './views/danhMuc/formThemDanhMuc.php';
    }

    // Thêm danh mục
    public function postAddCategory(){
        // Kiểm tra xem dữ liệu có phải được submit lên không
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy ra dữ liệu
            $ten_danh_muc = $_POST['ten_danh_muc'] ?? '';
            $mo_ta = $_POST['mo_ta'] ?? '';

            // Tạo 1 mảng trống để chứa dữ liệu lỗi
            $errors = [];
            if (empty($ten_danh_muc)) {
                $errors['ten_danh_muc'] = 'Tên danh mục không được để trống';
            }

            // Nếu không có lỗi thì tiến hành thêm danh mục
            if (empty($errors)) {
                $this->modelDanhMuc->insertDanhMuc($ten_danh_muc, $mo_ta);
                // Redirect về danh sách danh mục
                header("Location: " . BASE_URL_ADMIN . "?act=danh-muc");
                exit();
            } else {
                // Trả về form và lỗi
                require_once './views/danhMuc/formThemDanhMuc.php';
            }
        }
    }

    // Hiển thị form sửa danh mục
    public function editDanhMuc(){
        $id = $_GET['id_danh_muc'] ?? 0;
        $danhMuc = $this->modelDanhMuc->getDetailDanhMuc($id);
        // Kiểm tra danh mục tồn tại
        if ($danhMuc) {
            require_once './views/danhMuc/editDanhMuc.php';
        } else {
            // Nếu không tồn tại, quay về danh sách
            header('Location: ' . BASE_URL_ADMIN . '?act=danh-muc');
            exit();
        }   
    }

    // Xử lý submit sửa danh mục
    public function postEditCategory(){
        // Kiểm tra xem dữ liệu có phải được submit lên không
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy ra dữ liệu
            $id = $_POST['id'] ?? 0;
            $ten_danh_muc = $_POST['ten_danh_muc'] ?? '';
            $mo_ta = $_POST['mo_ta'] ?? '';

            // Tạo 1 mảng trống để chứa dữ liệu lỗi
            $errors = [];
            if (empty($ten_danh_muc)) {
                $errors['ten_danh_muc'] = 'Tên danh mục không được để trống';
            }

            // Nếu không có lỗi thì tiến hành cập nhật danh mục
            if (empty($errors)) {
                $this->modelDanhMuc->postEditCategory($id, $ten_danh_muc, $mo_ta);
                // Redirect về danh sách danh mục
                header("Location: " . BASE_URL_ADMIN . "?act=danh-muc");
                exit();
            } else {
                // Trả về form và dữ liệu đã nhập + lỗi
                $danhMuc = ['id' => $id, 'ten_danh_muc' => $ten_danh_muc, 'mo_ta' => $mo_ta];
                require_once './views/danhMuc/editDanhMuc.php';
            }
        }
    }

    // Xóa danh mục
    public function deleteDanhMuc(){
        $id = $_GET['id_danh_muc'] ?? 0;
        $danhMuc = $this->modelDanhMuc->getDetailDanhMuc($id);
        // Kiểm tra danh mục tồn tại
        if ($danhMuc){
            $this->modelDanhMuc->destroyDanhMuc($id);
        }
        // Redirect về danh sách danh mục
        header("Location: " . BASE_URL_ADMIN . "?act=danh-muc");
        exit();
    }
}
