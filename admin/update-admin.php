<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Hồ sơ</h1>
        <br />

        <?php
        if(isset($_SESSION['loggedInUser'])) {
            $userData = $_SESSION['loggedInUser'];
            $loggedInUserID = $_SESSION['loggedInUserID'];
       
            $sql = "SELECT * FROM admin WHERE `id` = '$loggedInUserID'";
            $res = mysqli_query($conn, $sql);
        
        if ($res == TRUE) {
            $count = mysqli_num_rows($res);
            if ($count == 1) {
                $row = mysqli_fetch_assoc($res);
                $id = $row['id'];
                $fullname = $row['full_name'];
                $username = $row['username'];
                $address = $row['address'];
                $email = $row['email'];
                $contact = $row['contact'];
            } else {
                header("location: index.php");
            }
        }
    }
        ?>
        <div class="card text-black" style="border-radius: 25px;">
        
        <form class="mx-1 mx-md-4" method="POST" >
            <div class="divupdate" >
                <label for="exampleInputFullname" class="form-label">Họ và tên</label>
                <input type="text" name="fullname" class="form-control" id="exampleInputFullname" value="<?php echo $fullname; ?>">
            </div>
            <div class="divupdate">
                <label for="exampleInputUsername" class="form-label">Tên người dùng</label>
                <input type="text" name="username" class="form-control" id="exampleInputUsername" value="<?php echo $username; ?>">
            </div>
            <div class="divupdate">
                <label for="exampleInputUsername" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="exampleInputUsername" value="<?php echo $email; ?>">
            </div>
            <div class="divupdate">
                <label for="exampleInputUsername" class="form-label">Địa chỉ</label>
                <input type="text" name="address" class="form-control" id="exampleInputUsername" value="<?php echo $address; ?>">
            </div>
            <div class="divupdate">
                <label for="exampleInputUsername" class="form-label">Số điện thoại</label>
                <input type="text" name="contact" class="form-control" id="exampleInputUsername" value="<?php echo $contact; ?>">
            </div>
            <div class="divupdate">
                <button type="submit" name="submit" class="btn btn-primary btn-lg">Cập nhật</button>
            </div>
            <div class="divupdate">
                <a class="btn btn-primary btn-lg" href="update-password.php?id=<?php echo $id; ?>">Đổi mật khẩu</a>
            </div>
        </form>
        
        </div>
        
        <?php
        if(isset($_POST["submit"])) {
            $fullname = $_POST['fullname'];
            $username = $_POST['username'];
            $address = $_POST['address'];
            $email = $_POST['email'];
            $contact = $_POST['contact'];

            $sql = "UPDATE `admin` SET 
                `full_name`='$fullname',
                `username`='$username',
                `address` = '$address',
                `email` = '$email',
                `contact` = '$contact'
            WHERE id = '$id'";
            $res = mysqli_query($conn, $sql);

            if($res) {
                echo "<script>alert('Cập nhật thành công!');</script>";
                echo "<script>window.location.href='index.php';</script>";
            } else {
                echo "<script>alert('Lỗi khi cập nhật');</script>";
            }
        }
        ?>
        <div class="clearfix"></div>
    </div>
</div>
<?php include('partials/footer.php'); ?>
