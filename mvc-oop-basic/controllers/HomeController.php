<?php
class HomeController
{
    public $modelSanPham;
    public $modelTaiKhoan;
    public $modelGioHang;
    public $modelDonHang;

    public function __construct()
    {
        $this->modelSanPham = new SanPham();
        $this->modelTaiKhoan = new TaiKhoan();
        $this->modelGioHang = new GioHang();
        $this->modelDonHang = new DonHang();
    }

    // ------------------- TRANG CHỦ -------------------
    public function home()
    {
        $listSanPham = $this->modelSanPham->getAllSanPham();
        require_once './views/home.php';
    }

    // ------------------- CHI TIẾT SẢN PHẨM -------------------
    public function chiTietSanPham()
    {
        $id = $_GET['id_san_pham'] ?? null;

        if (!$id) {
            header("Location: " . BASE_URL);
            exit;
        }

        $sanPham = $this->modelSanPham->getDetailSanPham($id);
        $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);
        $listBinhLuan = $this->modelSanPham->getBinhLuanFromSanPham($id);
        $listSanPhamCungDanhMuc = $this->modelSanPham->getListSanPhamDanhMuc($sanPham['danh_muc_id']);

        require_once './views/detailSanPham.php';
    }

    // ------------------- FORM LOGIN -------------------
    public function formLogin()
    {
        require_once './views/auth/formLogin.php';
        deleteSessionError();
    }

    // ------------------- XỬ LÝ LOGIN -------------------
    public function postLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') return;

        $email = $_POST['email'];
        $password = $_POST['password'];
     

        $user = $this->modelTaiKhoan->checkLogin($email, $password);

        // var_dump($_SESSION);die;
        if ($user) {
            // LƯU ĐÚNG KIỂU USER VÀO SESSION
            $_SESSION['user_client'] = [
                'id'    => $user['id'],
                'email' => $user['email'],
                'name'  => $user['ho_ten']
            ];

            header("Location: " . BASE_URL);
            exit;
        }

        $_SESSION['error'] = "Sai tài khoản hoặc mật khẩu!";
        $_SESSION['flash'] = true;

        header("Location: " . BASE_URL . '?act=login');
        exit;
    }

    // ------------------- HIỂN THỊ GIỎ HÀNG -------------------
    public function gioHang()
    {
        if (isset($_SESSION['user_client'])) {



            $userId = $_SESSION['user_client']['id'];

            // Lấy giỏ hàng
            $gioHang = $this->modelGioHang->getGioHangFromUser($userId);

            if (!$gioHang) {
                $gioHangId = $this->modelGioHang->addGioHang($userId);
                $gioHang = ['id' => $gioHangId];
            }

            $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);

            require_once './views/gioHang.php';
        } else {
            header("Location: " . BASE_URL . "?act=login");
            exit();
        }
    }

    // ------------------- THÊM GIỎ HÀNG -------------------
    public function addGioHang()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') return;

        if (!isset($_SESSION['user_client'])) {
            header("Location: " . BASE_URL . "?act=login");
        }

        $userId = $_SESSION['user_client']['id'];

        // Lấy hoặc tạo giỏ hàng
        $gioHang = $this->modelGioHang->getGioHangFromUser($userId);

        if (!$gioHang) {
            $gioHangId = $this->modelGioHang->addGioHang($userId);
            $gioHang = ['id' => $gioHangId];
        }

        $gio_hang_id = $gioHang['id'];
        $san_pham_id = (int)$_POST['san_pham_id'];
        $so_luong    = (int)$_POST['so_luong'];

        // Lấy chi tiết giỏ hàng
        $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gio_hang_id);

        $isExist = false;

        foreach ($chiTietGioHang as $item) {
            if ($item['san_pham_id'] == $san_pham_id) {
                $newSL = $item['so_luong'] + $so_luong;
                $this->modelGioHang->updateSoLuong($gio_hang_id, $san_pham_id, $newSL);
                $isExist = true;
                break;
            }
        }

        if (!$isExist) {
            $this->modelGioHang->addDetailGioHang($gio_hang_id, $san_pham_id, $so_luong);
        }

        header("Location: " . BASE_URL . "?act=gio-hang");
        exit;
    }

    public function thanhToan()
    {
        // Kiểm tra đăng nhập
        if (!isset($_SESSION['user_client'])) {
            header("Location: " . BASE_URL . "?act=login");
            exit();
        }

        // Lấy thông tin user từ session
        $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']['email']);

        if (!$user) {
            die("Lỗi: Không tìm thấy thông tin người dùng");
        }

        // Lấy giỏ hàng của user
        $gioHang = $this->modelGioHang->getGioHangFromUser($user['id']);

        // Nếu người dùng chưa có giỏ hàng → tạo mới
        if (!$gioHang) {
            $gioHangId = $this->modelGioHang->addGioHang($user['id']);
            $gioHang = ['id' => $gioHangId];
        }

        // Lấy danh sách sản phẩm trong giỏ hàng
        $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);

        // Nếu giỏ trống → không cho checkout
        if (empty($chiTietGioHang)) {
            header("Location: " . BASE_URL . "?act=gio-hang&msg=empty");
            exit();
        }

        // Load view checkout
        require_once './views/thanhToan.php';
    }


    public function postThanhToan()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: " . BASE_URL . "?act=thanh-toan");
            exit();
        }

        // Validate session user
        if (!isset($_SESSION['user_client']) || empty($_SESSION['user_client']['email'])) {
            header("Location: " . BASE_URL . "?act=login");
        }

        // collect POST safely
        $ten_nguoi_nhan = trim($_POST['ten_nguoi_nhan'] ?? '');
        $email_nguoi_nhan = trim($_POST['email_nguoi_nhan'] ?? '');
        $sdt_nguoi_nhan = trim($_POST['sdt_nguoi_nhan'] ?? '');
        $dia_chi_nguoi_nhan = trim($_POST['dia_chi_nguoi_nhan'] ?? '');
        $ghi_chu = trim($_POST['ghi_chu'] ?? '');
        $phuong_thuc_thanh_toan_id = trim($_POST['phuong_thuc_thanh_toan_id'] ?? '');

        // basic validation (you can extend)
        $errors = [];
        if ($ten_nguoi_nhan === '') $errors[] = "Tên người nhận trống";
        if ($email_nguoi_nhan === '') $errors[] = "Email trống";
        if ($sdt_nguoi_nhan === '') $errors[] = "SĐT trống";
        if ($dia_chi_nguoi_nhan === '') $errors[] = "Địa chỉ trống";
        if ($phuong_thuc_thanh_toan_id === '') $errors[] = "Chưa chọn phương thức thanh toán";

        if (!empty($errors)) {
            echo "Validation errors: <pre>" . implode(", ", $errors) . "</pre>";
            exit();
        }

        // get user record from email in session
        $emailSession = $_SESSION['user_client']['email'];
        $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($emailSession);
        if (!$user) {
            echo "Lỗi: không tìm thấy user từ email session ($emailSession)";
            exit();
        }
        $tai_khoan_id = $user['id'];

        // get or create gio hang
        $gioHang = $this->modelGioHang->getGioHangFromUser($tai_khoan_id);
        if (!$gioHang) {
            $gioHangId = $this->modelGioHang->addGioHang($tai_khoan_id);
            if (!$gioHangId) {
                echo "Lỗi: không tạo được giỏ hàng mới";
                exit();
            }
            $gioHang = ['id' => $gioHangId];
        }

        $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
        if (empty($chiTietGioHang)) {
            echo "Giỏ hàng trống";
            exit();
        }

        // compute totals
        $tong_tien_san_pham = 0;
        foreach ($chiTietGioHang as $sp) {
            $don_gia = (!empty($sp['gia_khuyen_mai']) && $sp['gia_khuyen_mai'] > 0) ? $sp['gia_khuyen_mai'] : $sp['gia_san_pham'];
            $tong_tien_san_pham += $don_gia * $sp['so_luong'];
        }
        $phi_ship = 30000;
        $tong_tien = $tong_tien_san_pham + $phi_ship;

        $ma_don_hang = 'DH' . rand(1000, 9999);

        // create don hang
        $donHangId = $this->modelDonHang->addDonHang(
            $tai_khoan_id,
            $ten_nguoi_nhan,
            $email_nguoi_nhan,
            $sdt_nguoi_nhan,
            $dia_chi_nguoi_nhan,
            $ghi_chu,
            $tong_tien,
            $phuong_thuc_thanh_toan_id,
            date('Y-m-d'),
            1,
            $ma_don_hang
        );

        if (!$donHangId) {
            echo "Lỗi tạo đơn hàng: model trả về false. Hãy kiểm tra SQL/message trên màn hình phía trên.";
            exit();
        }

        // add chi tiet don hang
        foreach ($chiTietGioHang as $item) {
            $donGia = (!empty($item['gia_khuyen_mai']) && $item['gia_khuyen_mai'] > 0) ? $item['gia_khuyen_mai'] : $item['gia_san_pham'];
            $so_luong = (int)$item['so_luong'];
            $thanh_tien = $donGia * $so_luong;

            $ok = $this->modelDonHang->addChiTietDonHang(
                $donHangId,
                $item['san_pham_id'],
                $donGia,
                $so_luong,
                $thanh_tien
            );

            if (!$ok) {
                echo "Lỗi khi thêm chi tiết: sản phẩm id={$item['san_pham_id']}";
                // consider rollback if you want (not implemented)
                exit();
            }
        }

        // clear details then clear gio_hang
        $this->modelGioHang->clearDetailGioHang($gioHang['id']);
        $this->modelGioHang->clearGioHang($tai_khoan_id);

        // redirect to history
        header("Location: " . BASE_URL . "?act=lich-su-mua-hang");
        exit();
    }

    public function lichsuMuaHang()
    {
        if (isset($_SESSION['user_client'])) {

            // Lấy ra thông tin tài khoản đăng nhập
            $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']['email']);
            $tai_khoan_id = $user['id'];

            // Lấy ra danh sách trạng thái đơn hàng
            $arrTrangThaiDonHang = $this->modelDonHang->getTrangThaiDonHang();
            $trangThaiDonHang = array_column($arrTrangThaiDonHang, 'ten_trang_thai', 'id');

            // Lấy ra danh sách phương thức thanh toán
            $arrPhuongThucThanhToan = $this->modelDonHang->getPhuongThucThanhToan();
            $phuongThucThanhToan = array_column($arrPhuongThucThanhToan, 'ten_phuong_thuc', 'id');


            // Lấy ra danh sách tất cả đơn hàng của tài khoản
            $donHangs = $this->modelDonHang->getDonHangFromUser($tai_khoan_id);

            require_once "./views/lichSuMuaHang.php";
        } else {
            var_dump('Bạn chưa đăng nhập');
            die;
        }
    }

    public function huyDonHang()
    {
        if (isset($_SESSION['user_client'])) {

            // Lấy đúng email
            $email = $_SESSION['user_client']['email'];

            // Lấy đúng thông tin user
            $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($email);

            if (!$user) {
                echo "Lỗi: Không tìm thấy tài khoản!";
                exit;
            }

            $tai_khoan_id = $user['id'];

            // Lấy id đơn hàng
            $donHangId = $_GET['id'] ?? 0;

            // Lấy đơn hàng
            $donHang = $this->modelDonHang->getDonHangById($donHangId);

            if (!$donHang) {
                echo "Đơn hàng không tồn tại!";
                exit;
            }

            // KIỂM TRA QUYỀN
            if ($donHang['tai_khoan_id'] != $tai_khoan_id) {
                echo "Bạn không có quyền hủy đơn hàng này";
                exit;
            }

            // Chỉ được hủy khi trạng thái = 1
            if ($donHang['trang_thai_id'] != 1) {
                echo "Chỉ đơn hàng ở trạng thái 'Chưa xác nhận' mới có thể hủy";
                exit;
            }

            // Cập nhật trạng thái = 11 (Hủy)
            $this->modelDonHang->updateTrangThaiDonHang($donHangId, 11);

            header("Location: " . BASE_URL . "?act=lich-su-mua-hang");
            exit();
        } else {
            echo "Bạn chưa đăng nhập!";
            exit;
        }
    }
    public function chiTietMuaHang()
    {
        if (!isset($_SESSION['user_client'])) {
            echo "Bạn chưa đăng nhập!";
            exit;
        }

        // Lấy user từ session
        $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']['email']);
        $tai_khoan_id = $user['id'];

        // Lấy ID đơn hàng từ URL
        $donHangId = $_GET['id'] ?? null;

        if (!$donHangId) {
            echo "Không tìm thấy đơn hàng!";
            exit;
        }

        // Lấy danh sách trạng thái đơn hàng
        $arrTrangThai = $this->modelDonHang->getTrangThaiDonHang();
        $trangThaiDonHang = array_column($arrTrangThai, 'ten_trang_thai', 'id');

        // Lấy danh sách phương thức thanh toán
        $arrPhuongThuc = $this->modelDonHang->getPhuongThucThanhToan();
        $phuongThucThanhToan = array_column($arrPhuongThuc, 'ten_phuong_thuc', 'id');

        // Lấy thông tin đơn hàng theo ID
        $donHang = $this->modelDonHang->getDonHangById($donHangId);

        if (!$donHang) {
            echo "Đơn hàng không tồn tại!";
            exit;
        }

        // Kiểm tra quyền truy cập
        if ($donHang['tai_khoan_id'] != $tai_khoan_id) {
            echo "Bạn không có quyền truy cập đơn hàng này!";
            exit;
        }

        // Lấy chi tiết sản phẩm trong đơn hàng
        $chiTietDonHang = $this->modelDonHang->getChiTietDonHangByDonHangId($donHangId);

        // Hiển thị view
        require_once "./views/chiTietMuaHang.php";
    }

    public function logout()
    {
        unset($_SESSION['user_client']);
        header("Location:" . BASE_URL . "?act=login");
        exit();
    }
}
