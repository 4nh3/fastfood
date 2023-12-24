<?php 
    include('./config/contants.php');
    // session_start(); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> 
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container" style="display: flex;flex-wrap: nowrap;" >
            <div class="logo">
                <a href="index.php" title="Logo">
                    <img src="../images/logo.jpg" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>
            <div class="<?php echo $currentPage !== 'index' ? 'filter' : 'hidden'; ?>">
            <?php
                // include('./config/contants.php');

                $currentPage = $_SERVER['REQUEST_URI'];

                // Lưu giá trị từ khóa tìm kiếm ban đầu vào session nếu có
                if(isset($_POST['search'])) {
                    $_SESSION['originalSearchTerm'] = $_POST['search'];
                }

                // Khởi tạo giá trị từ khóa tìm kiếm ban đầu từ session hoặc rỗng nếu chưa được thiết lập
                $originalSearchTerm = isset($_SESSION['originalSearchTerm']) ? $_SESSION['originalSearchTerm'] : '';

                $provinceOptions = '<option value="1">Tất cả</option>'; 

                $sql = "SELECT DISTINCT SUBSTRING_INDEX(address, ', ', -1) AS province FROM admin ORDER BY province ASC";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $province = $row['province'];
                        $provinceOptions .= "<option value='$province'>$province</option>";
                    }
                }

                if ($currentPage === '/categories.php') {
                    $formAction = 'categories.php';
                } elseif ($currentPage === '/food-search.php') {
                    $formAction = 'food-search.php';
                } elseif ($currentPage === '/category-foods.php') {
                    $formAction = 'category-foods.php';
                } else {
                    $formAction = 'foods.php';
                }

                // Tạo form HTML sử dụng $formAction
                $formHTML = '<form action="' . $formAction . '" method="POST">';
                $formHTML .= '<input type="text" name="search" value="' . $originalSearchTerm . '" placeholder="Nhập từ khóa tìm kiếm" style="visibility: hidden; " >';
                $formHTML .= '<select name="province" id="provinceSelect" class="selectfi">';
                $formHTML .= $provinceOptions;
                $formHTML .= '</select>';
                $formHTML .= '<input type="submit" name="submit_province" value="Lọc" class="filter-button" >';
                $formHTML .= '</form>';

                echo $formHTML;
            ?>
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
                    <li>
                        <?php
                        if (isset($_SESSION['loggedInUser'])) {
                            $loggedInUser = $_SESSION['loggedInUser'];
                            $displayContent = $loggedInUser['email'];
                            echo '<a href="./update-customer.php">' . $loggedInUser['email'] . '</a>';
                        } else {
                            echo '<a href="./login.php">Đăng nhập</a>';
                        }
                        ?>
                    </li>
                    <li>
                        <a style="color: black" href="./shopping.php"><i style="color: #ff6b81;" class="fas fa-shopping-cart fa-2x"></i></a>
                    </li>
                    
                </ul>
                
            </div>

            <div class="clearfix"></div>
        </div>
    </section>