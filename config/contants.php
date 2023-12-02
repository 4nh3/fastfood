<?php
    session_start();

    $LOCALHOST = 'localhost';
    $DB_USERNAME = 'root';
    $DB_PASSWORD = ''; 
    $DB_NAME = 'fast_foood'; 

    $conn = mysqli_connect($LOCALHOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME) ;
    
    if (!$conn) {
        die("Kết nối không thành công: " . mysqli_connect_error());
    }

    $db_select = mysqli_select_db($conn, $DB_NAME);
    if (!$db_select) {
        die("Lỗi chọn cơ sở dữ liệu: " . mysqli_error($conn));
    }
?>
