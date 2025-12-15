<?php
class AdminSanPham
{
    public $conn; // khai báo phương thức

    public function __construct()
    {
        $this->conn = connectDB();
    }

    // lấy toàn bộ danh sách sản phẩm
    public function getAllProduct()
    {
        try {
            $sql = 'SELECT san_phams.*, danh_mucs.ten_danh_muc 
            FROM san_phams
            INNER JOIN danh_mucs ON san_phams.danh_muc_id = danh_mucs.id
            ';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getDetailSanPham($id)
    {
        try {
            $sql = "SELECT 
                    san_phams.*, 
                    danh_mucs.ten_danh_muc
                FROM san_phams
                INNER JOIN danh_mucs 
                    ON san_phams.danh_muc_id = danh_mucs.id
                WHERE san_phams.id = :id";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);

            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Lỗi SQL: " . $e->getMessage();
            return false;
        }
    }


    public function getListAnhSanPham($san_pham_id)
    {
        try {
            $sql = "SELECT * FROM hinh_anh_san_phams WHERE san_pham_id = :san_pham_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':san_pham_id' => $san_pham_id
            ]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return [];
        }
    }

    public function getDetailAnhSanPham($id)
    {
        try {
            $sql = "SELECT * FROM hinh_anh_san_phams WHERE id = :id LIMIT 1";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id
            ]);

            return $stmt->fetch(); // Trả về 1 ảnh
        } catch (Exception $e) {
            echo "Lỗi SQL: " . $e->getMessage();
            return false;
        }
    }

    public function destroyAnhSanPham($id)
    {
        try {
            $sql = "DELETE FROM hinh_anh_san_phams WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id
            ]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }


    public function insertSanPham($ten_san_pham, $gia_san_pham, $gia_khuyen_mai, $so_luong, $ngay_nhap, $danh_muc_id, $trang_thai, $mo_ta, $hinh_anh)
    {
        try {
            $sql = "INSERT INTO san_phams 
                (ten_san_pham, gia_san_pham, gia_khuyen_mai, so_luong, ngay_nhap, danh_muc_id, trang_thai, mo_ta, hinh_anh)
                VALUES 
                (:ten_san_pham, :gia_san_pham, :gia_khuyen_mai, :so_luong, :ngay_nhap, :danh_muc_id, :trang_thai, :mo_ta, :hinh_anh)";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':ten_san_pham'  => $ten_san_pham,
                ':gia_san_pham'  => $gia_san_pham,
                ':gia_khuyen_mai' => $gia_khuyen_mai,
                ':so_luong'      => $so_luong,
                ':ngay_nhap'     => $ngay_nhap,
                ':danh_muc_id'   => $danh_muc_id,
                ':trang_thai'    => $trang_thai,
                ':mo_ta'         => $mo_ta,
                ':hinh_anh'      => $hinh_anh
            ]);
            // lấy id sản phẩm vừa thêm
            return $this->conn->lastInsertId();
        } catch (Exception $e) {
            // In lỗi SQL
            echo "Lỗi SQL: " . $e->getMessage();
            return false;
        }
    }

    public function destroySanPham($id)
    {
        try {
            $sql = 'DELETE FROM san_phams WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi SQL: " . $e->getMessage();
            return false;
        }
    }

    public function insertAlbumAnhSanPham($san_pham_id, $link_hinh_anh)
    {
        try {
            $sql = 'INSERT INTO hinh_anh_san_phams (san_pham_id, link_hinh_anh)
            VALUES (:san_pham_id, :link_hinh_anh)';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':san_pham_id' => $san_pham_id,
                ':link_hinh_anh' => $link_hinh_anh,
            ]);
            // Lấy id sản phẩm vừa thêm
            return true;
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }

    public function updateSanPham($id, $ten, $gia, $gia_km, $so_luong, $ngay_nhap, $danh_muc_id, $trang_thai, $mo_ta, $hinh_anh)
    {
        try {
            $sql = "UPDATE san_phams SET
                ten_san_pham = :ten,
                gia_san_pham = :gia,
                gia_khuyen_mai = :gia_km,
                so_luong = :so_luong,
                ngay_nhap = :ngay_nhap,
                danh_muc_id = :danh_muc_id,
                trang_thai = :trang_thai,
                mo_ta = :mo_ta,
                hinh_anh = :hinh_anh
                WHERE id = :id";

            $stmt = $this->conn->prepare($sql);

            return $stmt->execute([
                ':ten'         => $ten,
                ':gia'         => $gia,
                ':gia_km'      => $gia_km,
                ':so_luong'    => $so_luong,
                ':ngay_nhap'   => $ngay_nhap,
                ':danh_muc_id' => $danh_muc_id,
                ':trang_thai'  => $trang_thai,
                ':mo_ta'       => $mo_ta,
                ':hinh_anh'    => $hinh_anh,
                ':id'          => $id
            ]);
        } catch (Exception $e) {
            echo "Lỗi SQL: " . $e->getMessage();
            return false;
        }
    }

    // Bình luận
    public function getBinhLuanFromKhachHang($id)
    {
        try {
            $sql = 'SELECT binh_luans.*, san_phams.ten_san_pham
                FROM binh_luans
                LEFT JOIN san_phams ON binh_luans.san_pham_id = san_phams.id
                WHERE binh_luans.tai_khoan_id = :id';

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }

    public function getDetailBinhLuan($id)
    {
        try {
            $sql = 'SELECT * FROM binh_luans WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC); // fetch 1 row
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }

    public function updateTrangThaiBinhLuan($id_binh_luan, $trang_thai_moi) {
        try {
            $sql = "UPDATE binh_luans SET trang_thai = :trang_thai WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                ':trang_thai' => $trang_thai_moi,
                ':id' => $id_binh_luan
            ]);
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }

    public function getBinhLuanFromSanPham($id) {
        try {
            $sql = 'SELECT binh_luans.*, tai_khoans.ho_ten
                    FROM binh_luans
                    INNER JOIN tai_khoans ON binh_luans.tai_khoan_id = tai_khoans.id
                    WHERE binh_luans.san_pham_id = :id';
            
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }
    
}
