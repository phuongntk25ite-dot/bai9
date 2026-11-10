<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Kỹ thuật Upload hình ảnh trong PHP</title>
</head>
<body>

    <!-- Form Upload file theo chuẩn HTML -->
    <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
        <!-- Giới hạn dung lượng file upload (đơn vị: byte) -->
        <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
        
        <label>Upload</label>
        <input type="file" name="ufile" id="ufile" />
        <br/><br/>
        <input type="submit" name="upload" id="upload" value="Up load" />
    </form>

<?php
// Folder dùng để lưu file tải lên
$target_path = "uploads/";

// Kiểm tra xem người dùng đã chọn file và bấm nút Up load chưa
if (isset($_FILES['ufile']) && $_FILES['ufile']['error'] == 0) {
    
    // Nối đường dẫn lưu file
    $target_file = $target_path . basename($_FILES['ufile']['name']);

    // Kiểm tra định dạng file (Chỉ chấp nhận đuôi jpg, jpeg, gif)
    if (!preg_match('/\.(jpg|jpeg|gif)$/i', basename($_FILES['ufile']['name']))) {
        echo "<p style='color:red;'>Khong phai file anh!</p>";
    } 
    // Kiểm tra file đã tồn tại trên server chưa
    else if (file_exists($target_file)) {
        echo "<p style='color:orange;'>" . basename($_FILES['ufile']['name']) . " already exists.</p>";
    } 
    // Tiến hành di chuyển file từ thư mục tạm lưu vào thư mục uploads/
    else {
        if (move_uploaded_file($_FILES['ufile']['tmp_name'], $target_file)) {
            echo "<p style='color:green;'>The file " . basename($_FILES['ufile']['name']) . " has been uploaded</p>";
        } else {
            echo "<p style='color:red;'>There was an error uploading the file, please try again!</p>";
        }
    }
}
?>

</body>
</html>