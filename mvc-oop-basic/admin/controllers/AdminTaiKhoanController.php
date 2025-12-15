<?php
class AdminTaiKhoanController
{
    public $modelTaiKhoan;
    public $modelDonHang;
    public $modelSanPham;

    public function __construct()
    {
        $this->modelTaiKhoan = new AdminTaiKhoan();
        $this->modelDonHang = new AdminDonHang();
        $this->modelSanPham = new AdminSanPham();
    }

    /* ================================
        QUẢN TRỊ VIÊN
    ================================= */

    public function danhSachQuanTri()
    {
        $listQuanTri = $this->modelTaiKhoan->getAllTaiKhoan(1);
        
        require_once './views/taikhoan/quantri/listQuanTri.php';
    }

    public function formAddQuanTri()
    {
        require_once './views/taikhoan/quantri/addQuanTri.php';
        deleteSessionError();
    }

    public function postAddQuanTri()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $ho_ten = trim($_POST['ho_ten'] ?? '');
            $email  = trim($_POST['email'] ?? '');

            $errors = [];

            if (empty($ho_ten)) $errors['ho_ten'] = "Tên không được để trống";
            if (empty($email))  $errors['email'] = "Email không được để trống";

            $_SESSION['error'] = $errors;

            if (empty($errors)) {

                // Password mặc định
                $password = password_hash('123@123ab', PASSWORD_BCRYPT);

                // 1 = quản trị viên
                $this->modelTaiKhoan->insertTaiKhoan($ho_ten, $email, $password, 1);

                header("Location: " . BASE_URL_ADMIN . "?act=list-tai-khoan-quan-tri");
                exit();
            }

            $_SESSION['flash'] = true;
            header("Location:" . BASE_URL_ADMIN . "?act=form-them-quan-tri");
            exit();
        }
    }

    public function formEditQuanTri()
    {
        $id = $_GET['id_quan_tri'] ?? null;

        if (!$id) {
            header("Location:" . BASE_URL_ADMIN . "?act=list-tai-khoan-quan-tri&msg=missing_id");
            exit();
        }

        $quanTri = $this->modelTaiKhoan->getDetailTaiKhoan($id);
        if (!$quanTri) {
            header("Location:" . BASE_URL_ADMIN . "?act=list-tai-khoan-quan-tri&msg=not_found");
            exit();
        }

        require_once './views/taikhoan/quantri/editQuanTri.php';
        deleteSessionError();
    }

    public function postEditQuanTri()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id            = $_POST['quan_tri_id'] ?? '';
            $ho_ten        = trim($_POST['ho_ten'] ?? '');
            $email         = trim($_POST['email'] ?? '');
            $so_dien_thoai = trim($_POST['so_dien_thoai'] ?? '');
            $trang_thai    = trim($_POST['trang_thai'] ?? '');

            $errors = [];

            if (empty($ho_ten))        $errors['ho_ten'] = "Họ tên không được để trống";
            if (empty($email))         $errors['email'] = "Email không được để trống";
            if (empty($so_dien_thoai)) $errors['so_dien_thoai'] = "Số điện thoại không được để trống";
            if (empty($trang_thai))    $errors['trang_thai'] = "Phải chọn trạng thái";

            if (!empty($errors)) {
                $_SESSION['error'] = $errors;
                header("Location:" . BASE_URL_ADMIN . "?act=form-sua-quan-tri&id_quan_tri=$id");
                exit();
            }

            $this->modelTaiKhoan->updateTaiKhoan(
                $id,
                $ho_ten,
                $email,
                $so_dien_thoai,
                $trang_thai
            );

            header("Location:" . BASE_URL_ADMIN . "?act=list-tai-khoan-quan-tri&msg=success");
            exit();
        }
    }

    public function resetPassword()
    {
        $id = $_GET['quan_tri_id'] ?? null;

        if (!$id) die("Lỗi: Không tìm thấy ID tài khoản");

        $user = $this->modelTaiKhoan->getDetailTaiKhoan($id);
        if (!$user) die("Lỗi: Tài khoản không tồn tại");

        $password = password_hash("123@123ab", PASSWORD_BCRYPT);
        $status = $this->modelTaiKhoan->resetPassword($id, $password);

        if ($status) {
            if ($user['chuc_vu_id'] == 1) {
                header("Location:" . BASE_URL_ADMIN . "?act=list-tai-khoan-quan-tri&msg=reset-success");
            } else {
                header("Location:" . BASE_URL_ADMIN . "?act=list-tai-khoan-khach-hang&msg=reset-success");
            }
            exit();
        }

        die("Lỗi khi reset mật khẩu");
    }

    /* ================================
        KHÁCH HÀNG
    ================================= */

    public function danhSachKhachHang()
    {
        $listKhachHang = $this->modelTaiKhoan->getAllTaiKhoan(3);
        require_once './views/taikhoan/khachhang/listKhachHang.php';
    }

    public function formEditKhachHang()
    {
        $id = $_GET['id_khach_hang'] ?? null;

        if (!$id) die("Lỗi: Thiếu ID khách hàng");

        $khachHang = $this->modelTaiKhoan->getDetailTaiKhoan($id);
        if (!$khachHang) die("Không tìm thấy khách hàng");

        require_once './views/taikhoan/khachhang/editKhachHang.php';
        deleteSessionError();
    }

    public function postEditKhachHang()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id            = $_POST['khach_hang_id'] ?? '';
            $ho_ten        = trim($_POST['ho_ten'] ?? '');
            $email         = trim($_POST['email'] ?? '');
            $ngay_sinh     = trim($_POST['ngay_sinh'] ?? '');
            $gioi_tinh     = trim($_POST['gioi_tinh'] ?? '');
            $dia_chi       = trim($_POST['dia_chi'] ?? '');
            $so_dien_thoai = trim($_POST['so_dien_thoai'] ?? '');
            $trang_thai    = trim($_POST['trang_thai'] ?? '');

            $errors = [];

            if (empty($ho_ten))        $errors['ho_ten'] = "Họ tên không được để trống";
            if (empty($email))         $errors['email'] = "Email không được để trống";
            if (empty($ngay_sinh))     $errors['ngay_sinh'] = "Ngày sinh không được để trống";
            if (empty($gioi_tinh))     $errors['gioi_tinh'] = "Giới tính không được để trống";
            if (empty($dia_chi))       $errors['dia_chi'] = "Địa chỉ không được để trống";
            if (empty($so_dien_thoai)) $errors['so_dien_thoai'] = "Số điện thoại không được để trống";

            if (!empty($errors)) {
                $_SESSION['error'] = $errors;
                $_SESSION['flash'] = true;
                header("Location:" . BASE_URL_ADMIN . "?act=form-sua-khach-hang&id_khach_hang=$id");
                exit();
            }

            $this->modelTaiKhoan->updateKhachHang(
                $id,
                $ho_ten,
                $email,
                $ngay_sinh,
                $gioi_tinh,
                $dia_chi,
                $so_dien_thoai,
                $trang_thai
            );

            header("Location:" . BASE_URL_ADMIN . "?act=list-tai-khoan-khach-hang");
            exit();
        }
    }

    public function deltailKhachHang()
    {
        $id = $_GET['id_khach_hang'];

        $khachHang    = $this->modelTaiKhoan->getDetailTaiKhoan($id);
        $listDonHang  = $this->modelDonHang->getDonHangFromKhachHang($id);
        $listBinhLuan = $this->modelSanPham->getBinhLuanFromKhachHang($id);

        require_once './views/taikhoan/khachhang/detailKhachHang.php';
    }

    /* ================================
        LOGIN / LOGOUT
    ================================= */

    public function formLogin()
    {
        require_once './views/auth/formLogin.php';
        deleteSessionError();
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email    = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            $result = $this->modelTaiKhoan->checkLogin($email, $password);

            if ($result === $email) {

                $_SESSION['user_admin'] = $email;

                header("Location:" . BASE_URL_ADMIN);
                exit();
            }

            $_SESSION['error'] = $result;
            $_SESSION['flash'] = true;
            header("Location:" . BASE_URL_ADMIN . "?act=login-admin");
            exit();
        }

        header("Location:" . BASE_URL_ADMIN . "?act=login-admin");
        exit();
    }

    public function logout()
    {
        unset($_SESSION['user_admin']);
        header("Location:" . BASE_URL_ADMIN . "?act=login-admin");
        exit();
    }

    /* ================================
        THÔNG TIN CÁ NHÂN ADMIN
    ================================= */

    public function formEditCaNhanQuanTri()
    {
        $email = $_SESSION['user_admin'] ?? null;
        // var_dump($_SESSION['user_admin']);die;

        if (!$email) {
            header("Location:" . BASE_URL_ADMIN . "?act=login-admin");
            exit();
        }

        $thongTin = $this->modelTaiKhoan->getTaiKhoanFormEmail($email);

        require_once './views/taikhoan/canhan/editCaNhan.php';
        deleteSessionError();
    }

    public function postEditCaNhanQuanTri()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $emailSession = $_SESSION['user_admin'];
            $user = $this->modelTaiKhoan->getTaiKhoanFormEmail($emailSession);

            $ho_ten = trim($_POST['ho_ten'] ?? '');
            $email  = trim($_POST['email'] ?? '');

            $errors = [];

            if (empty($ho_ten)) $errors['ho_ten'] = "Vui lòng nhập họ tên";
            if (empty($email))  $errors['email'] = "Vui lòng nhập email";

            if (!empty($errors)) {
                $_SESSION['error'] = $errors;
                $_SESSION['flash'] = true;
                header("Location:" . BASE_URL_ADMIN . "?act=form-sua-thong-tin-ca-nhan-quan-tri");
                exit();
            }

            // Xử lý upload avatar
            if (!empty($_FILES['anh_dai_dien']['name'])) {
                $file = uploadFile($_FILES['anh_dai_dien'], "./uploads/");
                $anh = $file;
            } else {
                $anh = $user['anh_dai_dien'];
            }

            // Cập nhật
            $sql = "UPDATE tai_khoans 
                    SET ho_ten = :ho_ten, 
                        email = :email, 
                        anh_dai_dien = :anh  
                    WHERE id = :id";

            $stmt = $this->modelTaiKhoan->conn->prepare($sql);
            $stmt->execute([
                ':ho_ten' => $ho_ten,
                ':email'  => $email,
                ':anh'    => $anh,
                ':id'     => $user['id']
            ]);

            header("Location:" . BASE_URL_ADMIN . "?act=form-sua-thong-tin-ca-nhan-quan-tri&msg=success");
            exit();
        }
    }

    public function postEditMatKhauCaNhan()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $old_pass     = $_POST['mat_khau_cu'] ?? '';
        $new_pass     = $_POST['mat_khau_moi'] ?? '';
        $confirm_pass = $_POST['nhap_lai_mat_khau_moi'] ?? '';

        // Lấy thông tin user đang đăng nhập
        $user = $this->modelTaiKhoan->getTaiKhoanFormEmail($_SESSION['user_admin']);

        $errors = [];

        // Validate
        if (empty($old_pass))        $errors['old_pass'] = "Không được để trống";
        if (empty($new_pass))        $errors['new_pass'] = "Không được để trống";
        if (empty($confirm_pass))    $errors['confirm_pass'] = "Không được để trống";

        if (!password_verify($old_pass, $user['mat_khau'])) {
            $errors['old_pass'] = "Mật khẩu cũ không đúng";
        }

        if ($new_pass !== $confirm_pass) {
            $errors['confirm_pass'] = "Mật khẩu nhập lại không khớp";
        }

        if (!empty($errors)) {
            $_SESSION['error'] = $errors;
            $_SESSION['flash'] = true;

            header("Location: " . BASE_URL_ADMIN . "?act=form-sua-thong-tin-ca-nhan-quan-tri");
            exit();
        }

        // Mã hóa mật khẩu mới
        $hash = password_hash($new_pass, PASSWORD_BCRYPT);

        // Cập nhật vào DB
        $this->modelTaiKhoan->resetPassword($user['id'], $hash);

        // Thông báo thành công
        $_SESSION['success'] = "Đã đổi mật khẩu thành công";

        header("Location: " . BASE_URL_ADMIN . "?act=form-sua-thong-tin-ca-nhan-quan-tri");
        exit();
    }
}

}
