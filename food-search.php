<?php
    $currentPage = 'food-search';
    include('partials-front/menu.php');
    $originalSearchTerm = isset($_POST['search']) ? mysqli_real_escape_string($conn, $_POST['search']) : '';

    // Lưu từ khóa tìm kiếm vào biến $searchTerm để sử dụng cho việc lọc
    $searchTerm = isset($_POST['search']) ? mysqli_real_escape_string($conn, $_POST['search']) : '';

    // Kiểm tra nếu có lựa chọn lọc theo tỉnh được gửi đi
    $selectedProvince = isset($_POST['province']) ? $_POST['province'] : '1';
?>
<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">
        <h2>Tìm kiếm <a href="#" class="text-white">"<?php echo $originalSearchTerm; ?>"</a></h2>
    </div>
</section>

<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Thực đơn</h2>

        <?php
            // Truy vấn SQL và xử lý dữ liệu
            $sql = "SELECT thucan.*, `admin`.`username`, `admin`.`address`
                    FROM `thucan`
                    JOIN `admin` ON `thucan`.`user_id` = `admin`.`id`
                    WHERE `thucan`.`active` = 'Yes'";

            // Thêm điều kiện tìm kiếm từ khóa vào truy vấn SQL
            if (!empty($searchTerm)) {
                $sql .= " AND (`thucan`.`title` LIKE '%$searchTerm%' OR `thucan`.`description` LIKE '%$searchTerm%')";
            }

            // Xử lý lọc theo tỉnh
            $selectedProvince = isset($_POST['province']) ? $_POST['province'] : '1';
            if ($selectedProvince !== '1') {
                $sql .= " AND SUBSTRING_INDEX(admin.address, ', ', -1) = '$selectedProvince'";
            }

            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);

            if ($count > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $username = $row['username'];
                        $address = $row['address'];

                        $image_name = $row['image_name'];
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
                                    <p class="food-detail"><i class="fas fa-store"></i><?php echo " ". $username; ?></p>

                                    <p class="food-detail"> <i class="fas fa-map-marker"></i><?php echo " ".$address; ?></p>
                                    
                                    <br>

                                    <a href="order.php?food_id=<?php echo "$id"; ?>" class="btn btn-primary">Đặt hàng ngay</a>
                                </div>
                            </div>
                        <?php
                        }
                } else {
                    echo "Không có dữ liệu";
                }
            ?>
            <div class="clearfix"></div>
        </div>
    </section>
    
    <?php
        include('partials-front/footer.php');
    ?>

<script>
    window.addEventListener('popstate', function(event) {
        window.location.href = 'foods.php'; 
    });
</script>
