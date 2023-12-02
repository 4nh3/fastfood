<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Chỉnh sửa</h1>
        <br />

        <?php
        $id = $_GET['id'];
        $sql = "SELECT * FROM admin WHERE `id` = '$id'";
        $res = mysqli_query($conn, $sql);

        if ($res == TRUE) {
            $count = mysqli_num_rows($res);
            if ($count == 1) {
                $row = mysqli_fetch_assoc($res);
                $fullname = $row['full_name'];
                $username = $row['username'];
            } else {
                header("location: manage-admin.php");
            }
        }
        ?>

        <form action="" method="POST">
            <div class="mb-3">
                <label for="exampleInputFullname" class="form-label">Họ và tên</label>
                <input type="text" name="fullname" class="form-control" id="exampleInputFullname" value="<?php echo $fullname; ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputUsername" class="form-label">Tên người dùng</label>
                <input type="text" name="username" class="form-control" id="exampleInputUsername" value="<?php echo $username; ?>">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Nhập</button>
        </form>

        <?php
        if(isset($_POST["submit"])) {
            $fullname = $_POST['fullname'];
            $username = $_POST['username'];

            $sql = "UPDATE admin SET `full_name`='$fullname',`username`='$username' WHERE id = '$id'";
            $res = mysqli_query($conn, $sql);

            if($res) {
                echo "<script>alert('Cập nhật thành công!');</script>";
                echo "<script>window.location.href='manage-admin.php';</script>";
            } else {
                echo "<script>alert('Lỗi khi cập nhật');</script>";
            }
        }
        ?>
        <div class="clearfix"></div>
    </div>
</div>
<?php include('partials/footer.php'); ?>
