<?php include('./config/contants.php')?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="index.php" title="Logo">
                    <img src="../images/logo.jpg" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>
            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="./index.php">Trang chủ</a>
                    </li>
                    <li>
                        <a href="./categories.php">Danh mục</a>
                    </li>
                    <li>
                        <a href="./foods.php">Thực đơn</a>
                    </li>
                    <li>
                        <a href="admin/login.php">Người bán</a>
                    </li>
                    
                </ul>
                
            </div>

            <div class="clearfix"></div>
        </div>
    </section>