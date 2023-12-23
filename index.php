<?php   
    $currentPage = 'index';
    include('partials-front/menu.php');
?>

    <section class="food-search text-center">
        <div class="container">
            
            <form action="food-search.php" method="POST">
                <input type="search" name="search" placeholder="Tìm kiếm" required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
   
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Khám phá thức ăn</h2>

            <?php
                $sql = "SELECT * FROM danhmuc WHERE active = 'Yes' AND featured = 'Yes' LIMIT 3 ";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                if ($count > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>
                            <a href="category-foods.php?category_id=<?php echo $id;?>">
                                <div class="box-3 float-container">
                                    <?php
                                        if($image_name == ""){
                                            echo "Không có hình ảnh";
                                        }else{
                                            ?>
                                                <img src="../images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                                            <?php
                                        }
                                    ?>
                                    <h3 class="float-text text-white"><?php echo $title; ?></h3>
                                </div>
                            </a>
                        <?php
                    }
                }
            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Thực đơn</h2>
            <?php
                $sql2 = "SELECT `thucan`.*, `admin`.`username`, `admin`.`address`, `admin`.`id` AS id_admin
                        FROM thucan 
                        INNER JOIN admin ON `thucan`.`user_id` = `admin`.`id`
                        WHERE active = 'Yes' AND featured = 'Yes' ";
                $sql2 .= " LIMIT 6";
                $res2 = mysqli_query($conn, $sql2);
                $count2 = mysqli_num_rows($res2);
                if ($count2 > 0) {
                    while ($row2 = mysqli_fetch_assoc($res2)) {
                        $id = $row2['id'];
                        $title = $row2['title'];
                        $price = $row2['price'];
                        $description = $row2['description'];
                        $username = $row2['username'];
                        $address = $row2['address'];
                        $id_admin = $row2['id_admin'];


                        $image_name = $row2['image_name'];
                        ?>
                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <?php
                                        if($image_name == ""){
                                            echo "Không có hình ảnh";
                                        }else{
                                            ?>
                                                <img src="../images/food/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                                            <?php
                                        }
                                    ?>                                
                                </div>
                                <div class="food-menu-desc">
                                    <h4><?php echo $title; ?></h4>
                                    <p class="food-price"><?php echo $price; ?></p>
                                    <p class="food-detail">
                                        <?php echo $description; ?>
                                    </p>

                                    <a href="user.php?id_admin=<?php echo $id_admin; ?>" class="food-detail"><i class="fas fa-store"></i><?php echo " ". $username; ?></a>
                        
                                    <p class="food-detail"> <i class="fas fa-map-marker"></i><?php echo " ".$address; ?></p>
                              
                                    <br>
                                    <div class="button-container">
                                        <a href="order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Đặt hàng ngay</a>
                                    
                                        <form style="margin-left: 10px;" action="" method="POST">
                                        <input type="hidden" name="add_to_cart_clicked" value="true">
                                            <input type="hidden" name="food_id" value="<?php echo $id; ?>">
                                            <form action="xu-ly-them-du-lieu.php" method="POST">
                                                <input type="hidden" name="user_id" value="ID_KHACH_HANG">
                                                <input type="hidden" name="thucan_id" value="ID_THUC_AN">
                                                <button type="submit" class="no-border" name="add_to_cart">
                                                    <i class="fas fa-shopping-cart fa-2x" style="color: #ff6b81;" ></i>
                                                </button>
                                        </form> 
                                    </form>
                                    </div>
                                </div>
                            </div>
                        <?php
                    }
                }
            ?>

            <div class="clearfix"></div>
        </div>

        <p class="text-center">
            <a href="foods.php">Nhiều hơn</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <!-- social Section Starts Here -->
<?php   
    include('partials-front/footer.php');
?> 

<?php
if (isset($_POST['add_to_cart_clicked'])) {
if (!isset($_SESSION['loggedInUserID'])) {
    echo "<script>alert('Đăng nhập để thêm vào giỏ hàng!');</script>";
    // echo "<script>window.location.href='login.php';</script>";
} else {
    
    if (isset($_POST['add_to_cart'])) {
        $user_id = $_SESSION['loggedInUserID'];
        $thucan_id = $_POST['food_id'];

        $sql = "INSERT INTO shopping (user_id, thucan_id) VALUES ('$user_id', '$thucan_id')";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Đã thêm vào giỏ hàng!');</script>";
            // echo "<script>window.location.href='login.php';</script>";
        } else {
            echo 'Lỗi khi thêm vào giỏ hàng: ' . mysqli_error($conn);
        }

        mysqli_close($conn);
    } else {
        // echo 'Không có dữ liệu được gửi từ form';
    }
}
}
?>
