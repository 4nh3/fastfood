<?php include('../config/contants.php')?>
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

                                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Đăng kí</p>

                                <form class="mx-1 mx-md-4" method="POST" >

                                <div class="d-flex flex-row align-items-center mb-4">
                                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                    <div class="form-outline flex-fill mb-0">
                                    <input type="text" id="form3Example1c" class="form-control" name="fullname" />
                                    <label class="form-label" for="form3Example1c">Họ và tên</label>
                                    </div>
                                </div>

                                <div class="d-flex flex-row align-items-center mb-4">
                                    <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                    <div class="form-outline flex-fill mb-0">
                                    <input type="username" name="username" id="form3Example4cd" class="form-control" />
                                    <label class="form-label" for="form3Example4cd">Tên cửa hàng</label>
                                    </div>
                                </div>

                                <div class="d-flex flex-row align-items-center mb-4">
                                    <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                    <div class="form-outline flex-fill mb-0">
                                    <input type="text" name="address" id="form3Example4cd" class="form-control" />
                                    <label class="form-label" for="form3Example4cd">Địa chỉ cửa hàng</label>
                                    </div>
                                </div>

                                <div class="d-flex flex-row align-items-center mb-4">
                                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                    <div class="form-outline flex-fill mb-0">
                                    <input type="email" name="email" id="form3Example3c" class="form-control" />
                                    <label class="form-label" for="form3Example3c">Email</label>
                                    </div>
                                </div>

                                <div class="d-flex flex-row align-items-center mb-4">
                                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                    <div class="form-outline flex-fill mb-0">
                                    <input type="text" name="contact" id="form3Example3c" class="form-control" />
                                    <label class="form-label" for="form3Example3c">Số điện thoại</label>
                                    </div>
                                </div>

                                <div class="d-flex flex-row align-items-center mb-4">
                                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                    <div class="form-outline flex-fill mb-0">
                                    <input type="password" name="password"  id="form3Example4c" class="form-control" />
                                    <label class="form-label" for="form3Example4c">Mật khẩu</label>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                    <button type="submit" name="submit" class="btn btn-primary btn-lg">Đăng kí</button>
                                </div>

                                </form>

                            </div>
                            <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                                class="img-fluid" alt="Sample image">

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

<?php

if (isset($_POST['submit'])) {
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $checkQuery = "SELECT * FROM admin WHERE email = '$email' OR contact = '$contact'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
   
        echo "<script>alert('Email hoặc số điện thoại đã tồn tại. Vui lòng nhập thông tin khác.');</script>";
    } else {
   
        $insertQuery = "INSERT INTO admin (`full_name`, `username`, `address`, `email`, `contact`, `password`)
                        VALUES ('$fullname', '$username', '$address', '$email', '$contact', '$password')";
        $insertResult = mysqli_query($conn, $insertQuery) or die(mysqli_error($conn));

        if ($insertResult) {
            echo "<script>alert('Đăng kí thành công!');</script>";
            echo "<script>window.location.href='index.php';</script>";
        }
    }
}
?>

