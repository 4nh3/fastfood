<?php
    include('../config/contants.php') ;

    if(isset($_GET['id']) && isset($_GET['image_name'])) {
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        if($image_name !='') {
            $path = "../images/food/" . $image_name;
            $remove = unlink($path);

            if($remove == false) {
                echo "<script>alert('Có lỗi khi xóa món ăn!');</script>";
                echo "<script>window.location.href='manage-food.php';</script>";
            }
        }
        $sql = "DELETE FROM thucan WHERE `id` = '$id'";
        $res = mysqli_query($conn, $sql);

        if ($res == TRUE) {
            echo "<script>alert('Xóa thành công!');</script>";
            echo "<script>window.location.href='manage-food.php';</script>";
        }
    }
?>