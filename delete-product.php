<?php
    include('./config/contants.php') ;

    $id = $_GET['id'];
    echo $id;
    $sql = "DELETE FROM shopping WHERE `id` = '$id'";
    $res = mysqli_query($conn, $sql);

    if ($res == TRUE) {
        echo "<script>alert('Xóa thành công!');</script>";
        echo "<script>window.location.href='shopping.php';</script>";
    }
?>