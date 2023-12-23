<?php   
    $currentPage = 'index';
    include('partials-front/menu.php');
?>

<?php
    if(isset($_GET['category_id'])){
        $category_id = $_GET['category_id'];
        $sql = "SELECT title FROM danhmuc WHERE `id` = '$category_id' ";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($res);
        $category_title = $row['title'];
    }
?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                $sql2 = "SELECT * FROM thucan WHERE `danhmuc_id` = '$category_id' ";
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

                                    <div class="button-container">
                                        <a href="order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Đặt hàng ngay</a>
                                    
                                        <form style="margin-left: 10px;" action="" method="POST">
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

    </section>
    <!-- fOOD Menu Section Ends Here -->
    <?php   
    include('partials-front/footer.php');
?>

<?php

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
?>
