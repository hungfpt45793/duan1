<?php
class TaiKhoan
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function checkLogin($email, $mat_khau)
    {
        try {
            // 1. Tìm theo email
            $sql = "SELECT * FROM tai_khoans WHERE email = :email LIMIT 1";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch();

            // Email không tồn tại
            if (!$user) {
                return false;
            }

            // Kiểm tra mật khẩu (bcrypt)
            if (!password_verify($mat_khau, $user['mat_khau'])) {
                return false;
            }

            // Kiểm tra trạng thái tài khoản
            if ($user['trang_thai'] != 1) {
                return false;
            }

            // CHO PHÉP đăng nhập CLIENT → theo dữ liệu bạn tạo: 
            // 1 = admin, 2 = nhân viên, 3 = khách hàng
            if ($user['chuc_vu_id'] != 3) {
                return false;
            }

            // Tất cả hợp lệ
            return $user;
        } catch (Exception $e) {
            return false; // Không trả về chuỗi lỗi — để controller xử lý
        }
    }



    public function getTaiKhoanFromEmail($email)
    {
        try {
            $sql = "SELECT * FROM tai_khoans WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['email' => $email]);
            return $stmt->fetch();   // trả về mảng hoặc false
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }
}
