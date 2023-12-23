<?php include('./config/contants.php')?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>FOOD ORDER WEBSITE</title>
</head>
<body>
    <div class="main-content">
        <div class="wrapper">
            <!-- <h1>Đăng kí người bán</h1> -->
            <section class="vh-100" style="background-color: #eee;">
                <div class="container h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-lg-12 col-xl-11">
                        <div class="card text-black" style="border-radius: 25px;">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Đặt lại mật khẩu</p>

                                <form class="mx-1 mx-md-4" method="POST" >

                                <div class="d-flex flex-row align-items-center mb-4">
                                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                    <div class="form-outline flex-fill mb-0">
                                    <input type="email" name="email" placeholder="Nhập email" id="form3Example4c" class="form-control" required>
                                    <label class="form-label" for="form3Example4c">Email</label>
                                    </div>
                                </div>
                                <div class="d-flex flex-row align-items-center mb-4">
                                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                    <div class="form-outline flex-fill mb-0">
                                    <input type="text" name="phone" placeholder="Nhập số điện thoại" id="form3Example4c" class="form-control" required>
                                    <label class="form-label" for="form3Example4c">Số điện thoại</label>
                                    </div>
                                </div>
                                <div class="d-flex flex-row align-items-center mb-4">
                                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                    <div class="form-outline flex-fill mb-0">
                                    <input type="password" name="new_password" id="form3Example4c" class="form-control" placeholder="Nhập mật khẩu mới" required>
                                    <label class="form-label" for="form3Example4c">Nhập mật khẩu mới</label>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                    <button type="submit" name="submit" class="btn btn-primary btn-lg">Đặt lại mật khẩu</button>
                                </div>

                                </form>

                            </div>
                            
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </section>
            <br><br><br>
        </div>
    </div>
</body>

<!-- 
<form action="" method="POST">
    <input type="email" name="email" placeholder="Nhập email" required>
    <input type="tel" name="phone" placeholder="Nhập số điện thoại" required>
    <input type="password" name="new_password" placeholder="Nhập mật khẩu mới" required>
    <input type="submit" name="submit" value="Đặt lại mật khẩu">
</form> -->
<?php
// Kết nối đến cơ sở dữ liệu

// Kiểm tra nút submit đã được nhấn chưa
if (isset($_POST['submit'])) {
    // Nhận dữ liệu từ form
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $newPassword = $_POST['new_password'];

    // Thực hiện xác thực thông tin email và số điện thoại trong cơ sở dữ liệu
    $sql = "SELECT * FROM `customer` WHERE email = '$email' AND contact = '$phone'";
    
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $count = mysqli_num_rows($result);
        if ($count == 1) {
            // Xác thực thành công, cập nhật mật khẩu mới
            $hashedPassword = $newPassword;
            $updateSql = "UPDATE `customer` SET `password` = '$hashedPassword' WHERE email = '$email' AND contact = '$phone'";
            $updateResult = mysqli_query($conn, $updateSql);

            if ($updateResult) {
                echo '<script>alert("Đặt lại mật khẩu thành công!"); window.location.href = "login.php";</script>';
                // Có thể chuyển hướng hoặc thực hiện hành động khác ở đây
            } else {
                echo '<script>alert("Đặt lại mật khẩu thất bại!"); window.location.href = "reset_password.php";</script>';
            }
        } else {
            echo '<script>alert("Thông tin xác thực không đúng!"); window.location.href = "reset_password.php";</script>';
        }
    } else {
        echo "Đã xảy ra lỗi trong việc thực hiện truy vấn!";
    }
}
?>
