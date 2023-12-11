<?php
session_start(); // Bắt đầu session

if (isset($_POST["submit"])) {
    include('../config/contants.php');

    $emailOrContact = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM `admin` WHERE (`email` = ? OR `contact` = ?) AND `password` = ?";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("sss", $emailOrContact, $emailOrContact, $password);
    $stmt->execute();

    $res = $stmt->get_result();

    if ($res) {
        $count = $res->num_rows;
        if ($count == 1) {
            $userData = $res->fetch_assoc(); // Lấy dữ liệu người dùng từ kết quả truy vấn

            // Lưu thông tin người dùng vào session
            $_SESSION['loggedInUser'] = $userData;
            $_SESSION['loggedInUserID'] = $userData['id'];

            echo "<script>alert('Đăng nhập thành công!');</script>";
            echo "<script>window.location.href='index.php';</script>";
            exit(); // Thoát khỏi kịch bản sau khi chuyển hướng
        } else {
            echo "<script>alert('Đăng nhập không thành công!');</script>";
            echo "<script>window.location.href='login.php';</script>";
            exit(); // Thoát khỏi kịch bản sau khi chuyển hướng
        }
    } else {
        echo "Lỗi trong quá trình thực thi truy vấn: " . mysqli_error($conn);
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ĐĂNG NHẬP</title>
  <link rel="stylesheet" href="../css/login.css">
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>
    <div class="content">
 
      <div class="text">ĐĂNG NHẬP</div>
      <form action="#" method="POST" >
        <div class="field">
            <span class="fas fa-user"></span>
            <input type="text" required name="email" placeholder="Email hoặc Số điện thoại" >
            <!-- <label>Email hoặc Số điện thoại</label> -->
        </div>
        <div class="field">
            <span class="fas fa-lock"></span>
            <input type="password" name="password" placeholder="Mật khẩu" >
            <!-- <label>Mật khẩu</label> -->
        </div>
        <div class="forgot-pass"><a href="#">Quên mật khẩu?</a></div>
        <button type="submit" name="submit" value="login" >Đăng nhập</button>
        <div class="signup">Chưa có tài khoản ?
            <a href="add-admin.php">Đăng kí ngay</a>
        </div>
      </form>
  </div>
</body>
</html>
