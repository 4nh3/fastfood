<?php 
      $currentPage = 'index';
    include('partials-front/menu.php'); 
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Hồ sơ</h1>
        <br />

        <?php
        if(isset($_SESSION['loggedInUser'])) {
            $userData = $_SESSION['loggedInUser'];
            $loggedInUserID = $_SESSION['loggedInUserID'];
       
            $sql = "SELECT * FROM customer WHERE `id` = '$loggedInUserID'";
            $res = mysqli_query($conn, $sql);
        
        if ($res == TRUE) {
            $count = mysqli_num_rows($res);
            if ($count == 1) {
                $row = mysqli_fetch_assoc($res);
                $id = $row['id'];
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
            <div class="divupdate">
                <label for="exampleInputUsername" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="exampleInputUsername" value="<?php echo $email; ?>">
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
            <div class="divupdate">
                <a class="btn btn-primary btn-lg" href="logout.php">Đăng xuất</a>
            </div>
        </form>
        
        </div>
        
        <?php
        if(isset($_POST["submit"])) {
            $email = $_POST['email'];
            $contact = $_POST['contact'];

            $sql = "UPDATE `customer` SET 
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
<?php include('partials-front/footer.php'); ?>
