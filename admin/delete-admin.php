<?php
    include('../config/contants.php') ;

    $id = $_GET['id'];
    $sql = "DELETE FROM admin WHERE `id` = '$id'";
    $res = mysqli_query($conn, $sql);

    if ($res == TRUE) {
        echo "<script>alert('Xóa thành công!');</script>";
        echo "<script>window.location.href='manage-admin.php';</script>";
    }
?>