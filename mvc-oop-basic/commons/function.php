<?php

// Kết nối CSDL qua PDO
function connectDB()
{
    // Kết nối CSDL
    $host = DB_HOST;
    $port = DB_PORT;
    $dbname = DB_NAME;

    try {
        $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", DB_USERNAME, DB_PASSWORD);

        // cài đặt chế độ báo lỗi là xử lý ngoại lệ
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // cài đặt chế độ trả dữ liệu
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        return $conn;
    } catch (PDOException $e) {
        echo ("Connection failed: " . $e->getMessage());
    }
}

// thêm file 
function uploadFile($file, $folderUpload = 'uploads/')
{
    // Loại bỏ ký tự ./ nếu có
    $folderUpload = trim($folderUpload, './');

    // Đảm bảo có dấu / ở cuối
    if (substr($folderUpload, -1) !== '/') {
        $folderUpload .= '/';
    }

    // Đường dẫn tuyệt đối
    $uploadDir = PATH_ROOT . $folderUpload;

    // Tạo thư mục nếu chưa có
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Tạo tên file duy nhất
    $fileName = time() . '-' . basename($file['name']);
    $finalPath = $uploadDir . $fileName;

    // Xử lý upload
    if (move_uploaded_file($file['tmp_name'], $finalPath)) {
        return $folderUpload . $fileName; // đường dẫn tương đối để lưu vào DB
    }

    return null;
}


// Xóa file
function deleteFile($path) {
    // Nếu đường dẫn đã chứa 'uploads/'
    if (strpos($path, 'uploads/') !== false) {
        $fullPath = PATH_ROOT . $path;
    } else {
        $fullPath = PATH_ROOT . 'uploads/' . $path;
    }

    if (file_exists($fullPath)) {
        unlink($fullPath);
    }
}

// format date
function formatDate($date){
    return date("d-m-Y", strtotime($date));
    }


// xoá session sau khi load trang

function deleteSessionError(){
    if (isset($_SESSION['flash'])) {
        // Hủy session sau khi đã tải trang
        unset($_SESSION['flash']);
        session_unset();
        
        }

}

function checkLoginAdmin() {
    // Kiểm tra xem session 'user_admin' đã tồn tại chưa
    if (!isset($_SESSION['user_admin'])) {
        // Nếu chưa đăng nhập, chuyển hướng về trang login
        require_once './views/auth/formLogin.php';
        exit();
    }
}

function formatPrice($price)
{
    return number_format($price, 0, ',', '.');
}


