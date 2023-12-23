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
        <?php
// Kiểm tra xem id_admin đã được truyền qua URL chưa
            if (isset($_GET['id_admin'])) {
                $requestedUserId = $_GET['id_admin'];

                // Truy vấn SQL để lấy tên người dùng từ bảng admin dựa trên user_id từ bảng danhmuc
                $sql = "SELECT admin.username 
                        FROM admin 
                        INNER JOIN danhmuc ON danhmuc.user_id = admin.id 
                        WHERE danhmuc.active = 'Yes' 
                        AND danhmuc.featured = 'Yes' 
                        AND danhmuc.user_id = '$requestedUserId' 
                        ORDER BY danhmuc.id DESC";
                $result = mysqli_query($conn, $sql);

                if ($result) {
                    $row = mysqli_fetch_assoc($result);
                    $username = $row['username'];
                    echo "<h2 class='text-center'>Khám phá thức ăn của $username</h2>";

                } else {
                    echo "Lỗi trong truy vấn SQL: " . mysqli_error($conn);
                }
            } else {
                echo "Không có id_admin được chỉ định trong URL.";
            }
            ?>

            <?php
            // echo $_GET['id_admin'];
            if (isset($_GET['id_admin'])) {
                $requestedUsername = $_GET['id_admin'];
                // echo $requestedUsername;
                $sql = "SELECT * FROM danhmuc 
                WHERE active = 'Yes' AND featured = 'Yes' AND user_id = '$requestedUsername' 
                ORDER BY id DESC";
       
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
            }else{
                echo "không có";
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
                $sql2 = "SELECT * FROM thucan 
                WHERE active = 'Yes' AND featured = 'Yes' AND user_id = '$requestedUsername' 
                ORDER BY id DESC";
                $res2 = mysqli_query($conn, $sql2);
                $count2 = mysqli_num_rows($res2);
                if ($count2 > 0) {
                    while ($row2 = mysqli_fetch_assoc($res2)) {
                        $id = $row2['id'];
                        $title = $row2['title'];
                        $price = $row2['price'];
                        $description = $row2['description'];

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
                                    <br>

                                    <a href="order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Đặt hàng ngay</a>
                                </div>
                            </div>
                        <?php
                    }
                }
            ?>

            <div class="clearfix"></div>
        </div>

        <p class="text-center">
            <!-- <a href="foods.php">Nhiều hơn</a> -->
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <!-- social Section Starts Here -->
<?php   
    include('partials-front/footer.php');
?> 