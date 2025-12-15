<?php 
class AdminDanhMuc {
    public $conn;// khai báo phương thức

    public function __construct(){
        $this->conn = connectDB();
    }

    // lấy toàn bộ danh sách sản phẩm
    public function getAllCategory(){
        try{
            $sql = 'SELECT * FROM danh_mucs';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public function insertDanhMuc($ten_danh_muc, $mo_ta){
        try {
        $sql = 'INSERT INTO danh_mucs (ten_danh_muc, mo_ta) VALUES (:ten_danh_muc, :mo_ta)';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
        ':ten_danh_muc' => $ten_danh_muc,
        ':mo_ta' => $mo_ta
        ]);
        return true;
        } catch (Exception $e) {
        echo "lỗi" . $e->getMessage();
        }}
    // cập nhật danh mục
    public function postEditCategory($id, $ten_danh_muc, $mo_ta){
       
            try {
            $sql = 'UPDATE danh_mucs SET ten_danh_muc = :ten_danh_muc, mo_ta = :mo_ta WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
            ':ten_danh_muc' => $ten_danh_muc,
            ':mo_ta' => $mo_ta,
            ':id' => $id
            ]);
            return true;
            } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();}
        }

    public function getDetailDanhMuc($id) {
        try{
        $sql = 'SELECT * FROM danh_mucs WHERE id = :id';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
        ':id' => $id
        ]);
        return $stmt->fetch();
        } catch (Exception $e) {
        echo "lỗi" . $e->getMessage();
        }
        }

        public function destroyDanhMuc ($id) {
            try {
            $sql = 'DELETE FROM danh_mucs WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
            ':id' => $id
            ]);
            return true;
            } catch (Exception $e) {
            
             echo "lỗi" . $e->getMessage();
            }
            }
}
?>