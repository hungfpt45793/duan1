<?php
class GioHang
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getGioHangFromUser($tai_khoan_id)
    {
        try {
            $sql = "SELECT * FROM gio_hangs WHERE tai_khoan_id = :tai_khoan_id LIMIT 1";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':tai_khoan_id' => $tai_khoan_id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Lỗi getGioHangFromUser: " . $e->getMessage();
            return false;
        }
    }

    public function getDetailGioHang($gio_hang_id)
    {
        try {
            $sql = 'SELECT 
                    c.*, 
                    s.ten_san_pham, 
                    s.hinh_anh,
                    s.gia_san_pham,
                    s.gia_khuyen_mai
                FROM chi_tiet_gio_hangs c
                INNER JOIN san_phams s ON c.san_pham_id = s.id
                WHERE c.gio_hang_id = :gio_hang_id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':gio_hang_id' => $gio_hang_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Lỗi getDetailGioHang: " . $e->getMessage();
            return [];
        }
    }

    public function addGioHang($tai_khoan_id)
    {
        try {
            $sql = "INSERT INTO gio_hangs (tai_khoan_id) VALUES (:tai_khoan_id)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':tai_khoan_id' => $tai_khoan_id]);
            return $this->conn->lastInsertId();
        } catch (Exception $e) {
            echo "Lỗi addGioHang: " . $e->getMessage();
            return false;
        }
    }

    public function checkSanPhamInGioHang($gio_hang_id, $san_pham_id)
    {
        try {
            $sql = "SELECT * FROM chi_tiet_gio_hangs 
                    WHERE gio_hang_id = :gio_hang_id AND san_pham_id = :san_pham_id LIMIT 1";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':gio_hang_id' => $gio_hang_id, ':san_pham_id' => $san_pham_id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Lỗi checkSanPhamInGioHang: " . $e->getMessage();
            return false;
        }
    }

    public function updateSoLuong($gio_hang_id, $san_pham_id, $so_luong)
    {
        try {
            $sql = "UPDATE chi_tiet_gio_hangs
                    SET so_luong = :so_luong
                    WHERE gio_hang_id = :gio_hang_id AND san_pham_id = :san_pham_id";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                ':so_luong'    => $so_luong,
                ':gio_hang_id' => $gio_hang_id,
                ':san_pham_id' => $san_pham_id
            ]);
        } catch (Exception $e) {
            echo "Lỗi updateSoLuong: " . $e->getMessage();
            return false;
        }
    }

    public function addDetailGioHang($gio_hang_id, $san_pham_id, $so_luong)
    {
        try {
            $sql = "INSERT INTO chi_tiet_gio_hangs (gio_hang_id, san_pham_id, so_luong)
                    VALUES (:gio_hang_id, :san_pham_id, :so_luong)";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                ':gio_hang_id' => $gio_hang_id,
                ':san_pham_id' => $san_pham_id,
                ':so_luong'    => $so_luong
            ]);
        } catch (Exception $e) {
            echo "Lỗi addDetailGioHang: " . $e->getMessage();
            return false;
        }
    }

    // Xoá chi tiết giỏ hàng (theo id giỏ hàng)
    public function clearDetailGioHang($gio_hang_id)
    {
        try {
            $sql = "DELETE FROM chi_tiet_gio_hangs WHERE gio_hang_id = :gio_hang_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':gio_hang_id' => $gio_hang_id]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi clearDetailGioHang: " . $e->getMessage();
            return false;
        }
    }

    // Xoá giỏ hàng (bản ghi gio_hangs) theo id tài khoản
    public function clearGioHang($tai_khoan_id)
    {
        try {
            $sql = "DELETE FROM gio_hangs WHERE tai_khoan_id = :tai_khoan_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':tai_khoan_id' => $tai_khoan_id]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi clearGioHang: " . $e->getMessage();
            return false;
        }
    }
}
