<?php   
$currentPage = 'categories';
include('partials-front/menu.php');
?>
<!-- Categories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Khám phá thức ăn</h2>
        <?php
        // Tạo truy vấn SQL ban đầu
        $sql = "SELECT danhmuc.id, danhmuc.title, danhmuc.image_name, danhmuc.title AS category_title 
                FROM danhmuc
                INNER JOIN admin ON danhmuc.user_id = admin.id
                WHERE danhmuc.active = 'Yes'";

        // Kiểm tra nếu không có $_POST['province']
        if (!isset($_POST['province'])) {
            // Thiết lập truy vấn SQL để không áp dụng điều kiện với tỉnh/thành phố
            $res = mysqli_query($conn, $sql);
        } else {
            $selectedProvince = $_POST['province'];
            
            // Thêm điều kiện cho truy vấn SQL nếu có tỉnh/thành phố được chọn
            if ($selectedProvince !== '1') {
                $sql .= " AND SUBSTRING_INDEX(admin.address, ', ', -1) = '$selectedProvince'";
            }

            $res = mysqli_query($conn, $sql);
        }

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
                        if ($image_name == "") {
                            echo "Không có hình ảnh";
                        } else {
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
        } else {
            echo "Không có danh mục thức ăn nào phù hợp.";
        }
        ?>
        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->

<?php   
include('partials-front/footer.php');
?>
