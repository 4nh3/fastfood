<?php include('partials/menu.php') ?>
<?php //include('../config/contants.php')?>
    <div class="main-content">
        <div class="wrapper">
            <h1>Thêm Người dùng</h1>
            <form action="" method="POST" >
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Họ và tên</label>
                    <input type="fullname" name="fullname" class="form-control" id="exampleInputFullname">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Tên người dùng</label>
                    <input type="username" name="username" class="form-control" id="exampleInputUsername">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Mật khẩu</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Nhập</button>
            </form>
            
            <div class="clearfix"></div>
        </div>
    </div>
<?php include('partials/footer.php') ?>

<?php

    if(isset($_POST['submit'])) {
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "INSERT INTO admin SET
            full_name = '$fullname',
            username = '$username',
            password = '$password'
        ";
        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        if ($res == TRUE) {
            echo "<script>alert('Thêm thành công!');</script>";
            echo "<script>window.location.href='manage-admin.php';</script>";
        }
    }
?>
