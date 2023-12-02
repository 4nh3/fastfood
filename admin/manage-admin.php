<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Người dùng</h1>
        <br />

        <?php
        // if (isset($_SESSION['add'])) {
        //     echo $_SESSION['add'];
        //     unset($_SESSION['add']);
        // }
        ?>
        <br><br>
        <a href="add-admin.php" class="btn-primary">Thêm người dùng</a>
        <br /> <br /> <br />

        <table class="tbl-full">
            <tr>
                <th>STT</th>
                <th>Họ và tên</th>
                <th>Tên người dùng</th>
                <th>Hành động</th>
            </tr>
            <?php
            $sql = "SELECT * FROM admin";
            $res = mysqli_query($conn, $sql);
            if ($res == TRUE) {
                $count = mysqli_num_rows($res);
           
                if ($count > 0) {
                    $stt = 1; 
                    while ($rows = mysqli_fetch_array($res)) {
                        $id = $rows["id"];
                        $fullname = $rows["full_name"];
                        $username = $rows["username"];
            ?>
                        <tr>
                            <td><?php echo $stt++; ?></td>
                            <td><?php echo $fullname; ?></td>
                            <td><?php echo $username; ?></td>
                            <td>
                                <a href="update-password.php?id=<?php echo $id; ?>" class="btn-primary">Đổi mật khẩu</a>
                                <a href="update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Sửa</a>
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
