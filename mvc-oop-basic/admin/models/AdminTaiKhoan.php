<?php
class AdminTaiKhoan
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function getAllTaiKhoan($chuc_vu_id)
    {
        try {
            $sql = 'SELECT * FROM tai_khoans WHERE chuc_vu_id = :chuc_vu_id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':chuc_vu_id' => $chuc_vu_id]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }

    public function insertTaiKhoan($ho_ten, $email, $password, $chuc_vu_id)
    {
        try {
            $sql = 'INSERT INTO tai_khoans (ho_ten, email, mat_khau, chuc_vu_id)
                VALUES (:ho_ten, :email, :password, :chuc_vu_id)';

            $stmt = $this->conn->prepare($sql);

            $check = $stmt->execute([
                ':ho_ten' => $ho_ten,
                ':email' => $email,
                ':password' => $password,
                ':chuc_vu_id' => $chuc_vu_id,
            ]);

            var_dump("Kết quả execute: ", $check);
            return $check;
        } catch (Exception $e) {
            var_dump("SQL ERROR: ", $e->getMessage());
            die;
            return false;
        }
    }

    public function getDetailTaiKhoan($id)
    {
        try {
            $sql = 'SELECT * FROM tai_khoans WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function updateTaiKhoan($id, $ho_ten, $email, $so_dien_thoai, $trang_thai)
    {
        try {
            $sql = "UPDATE tai_khoans 
                SET ho_ten = :ho_ten, 
                    email = :email, 
                    so_dien_thoai = :so_dien_thoai,
                    trang_thai = :trang_thai
                WHERE id = :id";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':ho_ten'        => $ho_ten,
                ':email'         => $email,
                ':so_dien_thoai' => $so_dien_thoai,
                ':trang_thai'    => $trang_thai,
                ':id'            => $id
            ]);

            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }

    public function resetPassword($id, $password)
    {
        try {
            $sql = "UPDATE tai_khoans 
                SET mat_khau = :password
                WHERE id = :id";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':password' => $password,
                ':id'       => $id
            ]);

            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }

    public function updateKhachHang(
        $id,
        $ho_ten,
        $email,
        $ngay_sinh,
        $gioi_tinh,
        $dia_chi,
        $so_dien_thoai,
        $trang_thai
    ) {
        try {
            $sql = "UPDATE tai_khoans 
                    SET ho_ten        = :ho_ten,
                        email         = :email,
                        ngay_sinh     = :ngay_sinh,
                        gioi_tinh     = :gioi_tinh,
                        dia_chi       = :dia_chi,
                        so_dien_thoai = :so_dien_thoai,
                        trang_thai    = :trang_thai
                    WHERE id = :id";

            $stmt = $this->conn->prepare($sql);

            return $stmt->execute([
                ':ho_ten'        => $ho_ten,
                ':email'         => $email,
                ':ngay_sinh'     => $ngay_sinh,
                ':gioi_tinh'     => $gioi_tinh,
                ':dia_chi'       => $dia_chi,
                ':so_dien_thoai' => $so_dien_thoai,
                ':trang_thai'    => $trang_thai,
                ':id'            => $id
            ]);
        } catch (Exception $e) {
            echo "Lỗi UPDATE khách hàng: " . $e->getMessage();
            return false;
        }
    }

    public function checkLogin($email, $mat_khau)
    {
        try {
            // Câu lệnh SQL đúng cú pháp với placeholder :
            $sql = "SELECT * FROM tai_khoans WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':email' => $email]);

            // Lấy thông tin user dưới dạng mảng liên kết
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($mat_khau, $user['mat_khau'])) {
                if ($user['chuc_vu_id'] == 1) {
                    if ($user['trang_thai'] == 1) {
                        return $user['email']; // Trường hợp đăng nhập thành công
                    } else {
                        return "Tài khoản bị cấm";
                    }
                } else {
                    return "Tài khoản không có quyền đăng nhập";
                }
            } else {
                return "Bạn nhập sai thông tin mật khẩu hoặc tài khoản";
            }
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }

    public function getTaiKhoanFormEmail($email) {
        try {
            $sql = 'SELECT * FROM tai_khoans WHERE email = :email';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':email' => $email
            ]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }

    
}
