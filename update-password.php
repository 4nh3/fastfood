<?php 
    $currentPage = 'index';
    include('partials-front/menu.php'); 
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Đổi mật khẩu</h1>
        <br />

        <?php
        $id = $_GET['id'];
        ?>
        <form class="mx-1 mx-md-4" method="POST" >
            <div class="divupdate" >
                <label for="exampleInputFullname" class="form-label">Nhập lại mật khẩu</label>
                <input type="password" name="current-password" class="form-control" id="exampleInputPassword1">
            </div>
            
            <div class="divupdate">
                <label for="exampleInputUsername" class="form-label">Nhập mật khẩu mới</label>
                <input type="password" name="new-password" class="form-control" id="exampleInputPassword2">
            </div>
            <div class="divupdate">
                <button type="submit" name="submit" class="btn btn-primary btn-lg">Cập nhật</button>
            </div>
            <div class="divupdate">
                <label for="exampleInputUsername" class="form-label">Nhập lại mật khẩu mới</label>
                <input type="password" name="confirm-password" class="form-control" id="exampleInputPassword3">
            </div>
            
            
        </form>

        <!-- <form action="" method="POST">
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Nhập lại mật khẩu cũ</label>
                <input type="password" name="current-password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword2" class="form-label">Nhập mật khẩu mới</label>
                <input type="password" name="new-password" class="form-control" id="exampleInputPassword2">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword3" class="form-label">Nhập lại mật khẩu mới</label>
                <input type="password" name="confirm-password" class="form-control" id="exampleInputPassword3">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Nhập</button>
        </form> -->

        <?php
        if(isset($_POST["submit"])) {
            $current_password = $_POST['current-password'];
            $new_password = $_POST['new-password'];
            $password_confirmation = $_POST['confirm-password'];

            if($new_password != $current_password) {
                $sql = "SELECT * FROM `customer` WHERE id = '$id' AND `password` = '$current_password'";
                $res = mysqli_query($conn, $sql);

                if($res == TRUE) {
                    $count = mysqli_num_rows($res);
                    if ($count == 1) {
                        if($new_password == $password_confirmation) {
                            $sql2 = "UPDATE `customer` SET `password` = '$new_password' WHERE id = '$id'";
                            $res2 = mysqli_query($conn, $sql2);
                            if ($res2 == TRUE) {
                                echo "<script>alert('Cập nhật thành công!');</script>";
                                echo "<script>window.location.href='index.php';</script>";
                            } else {
                                echo "<script>alert('Lỗi khi cập nhật');</script>";
                            }
                        } else {
                            echo "<script>alert('Mật khẩu mới không trùng khớp');</script>";
                        }
                    } else {
                        echo "<script>alert('Mật khẩu hiện tại không đúng');</script>";
                    }
                } else {
                    echo "<script>alert('Lỗi khi thực hiện truy vấn');</script>";
                }
            } else {
                echo "<script>alert('Mật khẩu mới không được trùng với mật khẩu cũ');</script>";
            }
        }
        ?>
        <div class="clearfix"></div>
    </div>
</div>
<?php include('partials-front/footer.php'); ?>
