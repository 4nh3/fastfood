<?php   
$currentPage = 'food';
include('partials-front/menu.php');
?>
<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">
        <form action="food-search.php" method="POST">
            <input type="search" name="search" placeholder="Tìm kiếm" required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>
    </div>
</section>

<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php
        // Tạo truy vấn SQL ban đầu
        $sql = "SELECT `thucan`.*, `admin`.`username`, `admin`.`address`
                FROM `thucan`
                INNER JOIN admin ON `thucan`.`user_id` = `admin`.`id`
                WHERE `thucan`.`active` = 'Yes'";
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['province'])) {
            $selectedProvince = $_POST['province'];

         
            if ($selectedProvince !== '1') {
                $sql .= " AND SUBSTRING_INDEX(admin.address, ', ', -1) = '$selectedProvince'";
            }
        }

        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);

        if ($count > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $id = $row['id'];
                $title = $row['title'];
                $price = $row['price'];
                $description = $row['description'];
                $image_name = $row['image_name'];
                $username = $row['username'];
                $address = $row['address'];
                ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php
                        if ($image_name == "") {
                            echo "Không có hình ảnh";
                        } else {
                            ?>
                            <img src="../images/food/<?php echo $image_name; ?>" alt="Pizza"
                                 class="img-responsive img-curve">
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
                        
                        <p class="food-detail"><i class="fas fa-store"></i><?php echo " ". $username; ?></p>
                        
                        <p class="food-detail"> <i class="fas fa-map-marker"></i><?php echo " ".$address; ?></p>
                                    
                        <br>
                        <a href="order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Đặt hàng ngay</a>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "Không có danh mục thức ăn nào phù hợp.";
        }
        ?>

        <div class="clearfix"></div>
    </div>
</section>
<!-- fOOD Menu Section Ends Here -->
<?php   
include('partials-front/footer.php');
?>
