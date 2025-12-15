<?php
class AdminDonHang
{
    public $conn; // khai báo phương thức

    public function __construct()
    {
        $this->conn = connectDB();
    }

    // lấy toàn bộ danh sách sản phẩm
    public function getAllDonHang()
    {
        try {
            $sql = "SELECT don_hangs.*, trang_thai_don_hangs.ten_trang_thai
                FROM don_hangs
                INNER JOIN trang_thai_don_hangs 
                    ON don_hangs.trang_thai_id = trang_thai_don_hangs.id";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return [];
        }
    }

    public function getDetailDonHang($id)
    {
        try {
            $sql = "SELECT 
            don_hangs.*, 
            trang_thai_don_hangs.ten_trang_thai, 
            tai_khoans.ho_ten, 
            tai_khoans.email, 
            tai_khoans.so_dien_thoai, 
            phuong_thuc_thanh_toans.ten_phuong_thuc
        FROM don_hangs
        INNER JOIN trang_thai_don_hangs 
            ON don_hangs.trang_thai_id = trang_thai_don_hangs.id
        INNER JOIN tai_khoans
            ON don_hangs.tai_khoan_id = tai_khoans.id
        INNER JOIN phuong_thuc_thanh_toans
            ON don_hangs.phuong_thuc_thanh_toan_id = phuong_thuc_thanh_toans.id
        WHERE don_hangs.id = :id";




            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id
            ]);

            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }

    public function getListSpDonHang($don_hang_id)
    {
        try {
            $sql = "SELECT 
                    chi_tiet_don_hangs.*, 
                    san_phams.ten_san_pham
                FROM chi_tiet_don_hangs
                INNER JOIN san_phams 
                    ON chi_tiet_don_hangs.san_pham_id = san_phams.id
                WHERE chi_tiet_don_hangs.don_hang_id = :don_hang_id";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':don_hang_id' => $don_hang_id
            ]);

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi SQL: " . $e->getMessage();
            return [];
        }
    }

    public function getAllTrangThaiDonHang()
    {
        try {
            $sql = 'SELECT * FROM trang_thai_don_hangs';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }

    public function updateDonHang($id, $ten_nguoi_nhan, $email_nguoi_nhan, $sdt_nguoi_nhan, $dia_chi_nguoi_nhan, $ghi_chu, $trang_thai_id)
    {
        $sql = "UPDATE don_hangs 
            SET ten_nguoi_nhan = :ten,
                email_nguoi_nhan = :email,
                sdt_nguoi_nhan = :sdt,
                dia_chi_nguoi_nhan = :dia_chi,
                ghi_chu = :ghi_chu,
                trang_thai_id = :trang_thai
            WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            ':ten' => $ten_nguoi_nhan,
            ':email' => $email_nguoi_nhan,
            ':sdt' => $sdt_nguoi_nhan,
            ':dia_chi' => $dia_chi_nguoi_nhan,
            ':ghi_chu' => $ghi_chu,
            ':trang_thai' => $trang_thai_id,
            ':id' => $id
        ]);

        return true;
    }

    public function getDonHangFromKhachHang($id)
    {
        try {
            $sql = "SELECT don_hangs.*, trang_thai_don_hangs.ten_trang_thai
                FROM don_hangs
                INNER JOIN trang_thai_don_hangs 
                        ON don_hangs.trang_thai_id = trang_thai_don_hangs.id
                WHERE don_hangs.tai_khoan_id = :id";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id
            ]);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return [];
        }
    }







    //     public function getDetailSanPham($id)
    //     {
    //         try {
    //             $sql = "SELECT 
    //                     san_phams.*, 
    //                     danh_mucs.ten_danh_muc
    //                 FROM san_phams
    //                 INNER JOIN danh_mucs 
    //                     ON san_phams.danh_muc_id = danh_mucs.id
    //                 WHERE san_phams.id = :id";

    //             $stmt = $this->conn->prepare($sql);
    //             $stmt->execute([':id' => $id]);

    //             return $stmt->fetch();
    //         } catch (Exception $e) {
    //             echo "Lỗi SQL: " . $e->getMessage();
    //             return false;
    //         }
    //     }


    //     public function getListAnhSanPham($san_pham_id)
    //     {
    //         try {
    //             $sql = "SELECT * FROM hinh_anh_san_phams WHERE san_pham_id = :san_pham_id";
    //             $stmt = $this->conn->prepare($sql);
    //             $stmt->execute([
    //                 ':san_pham_id' => $san_pham_id
    //             ]);
    //             return $stmt->fetchAll();
    //         } catch (Exception $e) {
    //             echo "Lỗi: " . $e->getMessage();
    //             return [];
    //         }
    //     }

    //     public function getDetailAnhSanPham($id)
    //     {
    //         try {
    //             $sql = "SELECT * FROM hinh_anh_san_phams WHERE id = :id LIMIT 1";
    //             $stmt = $this->conn->prepare($sql);
    //             $stmt->execute([
    //                 ':id' => $id
    //             ]);

    //             return $stmt->fetch(); // Trả về 1 ảnh
    //         } catch (Exception $e) {
    //             echo "Lỗi SQL: " . $e->getMessage();
    //             return false;
    //         }
    //     }

    //     public function destroyAnhSanPham($id)
    //     {
    //         try {
    //             $sql = "DELETE FROM hinh_anh_san_phams WHERE id = :id";
    //             $stmt = $this->conn->prepare($sql);
    //             $stmt->execute([
    //                 ':id' => $id
    //             ]);
    //             return true;
    //         } catch (Exception $e) {
    //             echo "Lỗi: " . $e->getMessage();
    //             return false;
    //         }
    //     }


    //     public function insertSanPham($ten_san_pham, $gia_san_pham, $gia_khuyen_mai, $so_luong, $ngay_nhap, $danh_muc_id, $trang_thai, $mo_ta, $hinh_anh)
    //     {
    //         try {
    //             $sql = "INSERT INTO san_phams 
    //                 (ten_san_pham, gia_san_pham, gia_khuyen_mai, so_luong, ngay_nhap, danh_muc_id, trang_thai, mo_ta, hinh_anh)
    //                 VALUES 
    //                 (:ten_san_pham, :gia_san_pham, :gia_khuyen_mai, :so_luong, :ngay_nhap, :danh_muc_id, :trang_thai, :mo_ta, :hinh_anh)";

    //             $stmt = $this->conn->prepare($sql);

    //             $stmt->execute([
    //                 ':ten_san_pham'  => $ten_san_pham,
    //                 ':gia_san_pham'  => $gia_san_pham,
    //                 ':gia_khuyen_mai' => $gia_khuyen_mai,
    //                 ':so_luong'      => $so_luong,
    //                 ':ngay_nhap'     => $ngay_nhap,
    //                 ':danh_muc_id'   => $danh_muc_id,
    //                 ':trang_thai'    => $trang_thai,
    //                 ':mo_ta'         => $mo_ta,
    //                 ':hinh_anh'      => $hinh_anh
    //             ]);
    //             // lấy id sản phẩm vừa thêm
    //             return $this->conn->lastInsertId();
    //         } catch (Exception $e) {
    //             // In lỗi SQL
    //             echo "Lỗi SQL: " . $e->getMessage();
    //             return false;
    //         }
    //     }

    //     public function destroySanPham($id)
    //     {
    //         try {
    //             $sql = 'DELETE FROM san_phams WHERE id = :id';
    //             $stmt = $this->conn->prepare($sql);
    //             $stmt->execute([':id' => $id]);
    //             return true;
    //         } catch (Exception $e) {
    //             echo "Lỗi SQL: " . $e->getMessage();
    //             return false;
    //         }
    //     }

    //     public function insertAlbumAnhSanPham($san_pham_id, $link_hinh_anh)
    //     {
    //         try {
    //             $sql = 'INSERT INTO hinh_anh_san_phams (san_pham_id, link_hinh_anh)
    //             VALUES (:san_pham_id, :link_hinh_anh)';
    //             $stmt = $this->conn->prepare($sql);
    //             $stmt->execute([
    //                 ':san_pham_id' => $san_pham_id,
    //                 ':link_hinh_anh' => $link_hinh_anh,
    //             ]);
    //             // Lấy id sản phẩm vừa thêm
    //             return true;
    //         } catch (Exception $e) {
    //             echo "lỗi" . $e->getMessage();
    //         }
    //     }

    //     public function updateSanPham($id, $ten, $gia, $gia_km, $so_luong, $ngay_nhap, $danh_muc_id, $trang_thai, $mo_ta, $hinh_anh)
    //     {
    //         try {
    //             $sql = "UPDATE san_phams SET
    //                 ten_san_pham = :ten,
    //                 gia_san_pham = :gia,
    //                 gia_khuyen_mai = :gia_km,
    //                 so_luong = :so_luong,
    //                 ngay_nhap = :ngay_nhap,
    //                 danh_muc_id = :danh_muc_id,
    //                 trang_thai = :trang_thai,
    //                 mo_ta = :mo_ta,
    //                 hinh_anh = :hinh_anh
    //                 WHERE id = :id";

    //             $stmt = $this->conn->prepare($sql);

    //             return $stmt->execute([
    //                 ':ten'         => $ten,
    //                 ':gia'         => $gia,
    //                 ':gia_km'      => $gia_km,
    //                 ':so_luong'    => $so_luong,
    //                 ':ngay_nhap'   => $ngay_nhap,
    //                 ':danh_muc_id' => $danh_muc_id,
    //                 ':trang_thai'  => $trang_thai,
    //                 ':mo_ta'       => $mo_ta,
    //                 ':hinh_anh'    => $hinh_anh,
    //                 ':id'          => $id
    //             ]);
    //         } catch (Exception $e) {
    //             echo "Lỗi SQL: " . $e->getMessage();
    //             return false;
    //         }
    //     }

}
