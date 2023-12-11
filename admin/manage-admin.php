<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Thông tin cửa hàng</h1>
                <?php
        // if (isset($_SESSION['add'])) {
        //     echo $_SESSION['add'];
        //     unset($_SESSION['add']);
        // }
        ?>
        <!-- <a href="add-admin.php" class="btn-primary">Thêm người dùng</a> -->
        <br>

        <table class="tbl-full">
            <tr>
                <!-- <th>STT</th> -->
                <th>Họ và tên</th>
                <th>Tên người dùng</th>
                <th>Địa chỉ</th>
                <th>Email</th>
                <th>Số điện thoại</th>

            </tr>
            <?php
            $sql = "SELECT * FROM admin";
            $res = mysqli_query($conn, $sql);
            if ($res == TRUE) {
                $count = mysqli_num_rows($res);
           
                if ($count > 0) {
                    // $stt = 1; 
                    while ($rows = mysqli_fetch_array($res)) {
                        $id = $rows["id"];
                        $fullname = $rows["full_name"];
                        $username = $rows["username"];
                        $address = $rows["address"];
                        $email = $rows["email"];
                        $contact = $rows["contact"];
            ?>
                        <tr>
                            <!-- <td><?php //echo $stt++; ?></td> -->
                            <td><?php echo $fullname; ?></td>
                            <td><?php echo $username; ?></td>
                            <td><?php echo $address; ?></td>
                            <td><?php echo $email; ?></td>
                            <td><?php echo $contact; ?></td>
                            <td>
                                <a href="update-password.php?id=<?php echo $id; ?>" class="btn-primary">Đổi mật khẩu</a>
                                <a href="update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Sửa thông tin</a>
                                <a href="delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Xóa</a>
                            </td>
                        </tr>
            <?php
                    }
                }
            }
            ?>
            
        </table>

        <div class="clearfix"></div>
    </div>
</div>
<?php include('partials/footer.php'); ?>
