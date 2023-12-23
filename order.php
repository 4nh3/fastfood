<?php   
    $currentPage = 'index';
    include('partials-front/menu.php');
?>

<?php
    if(isset($_GET['food_id'])){
        $food_id = $_GET['food_id'];
        $sql = "SELECT * FROM thucan WHERE id = '$food_id' ";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
        if($count == 1){
            $row = mysqli_fetch_array($res);
            $user_id = $row['user_id'];
            $title = $row['title'];
            $price = $row['price'];
            $image_name = $row['image_name'];
        }else{
            header("location: index.php");
        }
    }else{
        header("location: index.php");
    }
?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container1">
            
            <h2 class="text-center text-white">Xác nhận đơn hàng</h2>

            <form action="" class="order" method="POST" >
                <fieldset>
                    <legend>Món ăn</legend>

                    <div class="food-menu-img">
                        <?php 
                            if($image_name!= ''){
                            ?>
                                <img src="images/food/<?php echo $image_name; ?>" alt="" class="img-responsive img-curve">
                            <?php
                                                        
                            } else{
                                echo 'Không có hình ảnh!!';
                            }
                        ?>
                    </div>
    
                    <div class="food-menu-desc">
                        <h3>
                            <?php echo $title; ?> </h3>
                            <input type="hidden" name="food" value="<?php echo $title; ?>" >
                        <p class="food-price"><?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>" >

                        <div class="order-label">Số lượng:</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>

                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Chi tiết thông tin khách hàng</legend>
                    <div class="order-label">Họ và tên</div>
                    <input type="text" name="name" placeholder="Họ và tên" class="input-responsive" required>

                    <div class="order-label">Số điện thoại</div>
                    <input type="tel" name="contact" placeholder="Số điện thoại" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="Email" class="input-responsive" required>

                    <div class="order-label">Địa chỉ</div>
                    <textarea name="address" rows="10" placeholder="Địa chỉ" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Đặt hàng" class="btn btn-primary">
                </fieldset>

            </form>
            <?php
                if(isset($_POST['submit'])){
                    // echo $_SESSION['loggedInUser'];
                    if (isset($_SESSION['loggedInUser'])) {
                    $food = $_POST['food'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];
                    $total = $price * $qty;
                    $order_date = date('Y-m-d H:i:s');
                    $status = "Ordered";
                    $customer_name = $_POST['name'];
                    $customer_contact = $_POST['contact'];
                    // $customer_email = $_POST['email'];
                    $customer_address = $_POST['address'];
                    $loggedInUserID = $_SESSION['loggedInUserID'];
                    

                    $sql2 = "INSERT INTO table_order SET
                        `user_id` = '$user_id',
                        `food` = '$food',
                        `price` = '$price',
                        `qty` = '$qty',
                        `total` = '$total',
                        `order_date` = '$order_date',
                        `status` = '$status',
                        `customer_name` = '$customer_name',
                        `customer_contact` = '$customer_contact',
                        --  `customer_email` = '$customer_email',
                        `customer_address` = '$customer_address',
                        `customer_id` = '$loggedInUserID'
                    ";

                    $res2 = mysqli_query($conn,$sql2);

                    if($res2==true) {
                        echo "<script>alert('Đặt hàng thành công!');</script>";
                        echo "<script>window.location.href='index.php';</script>";
                    }else{
                        echo "<script>alert('Có lỗi khi đặt hàng!');</script>";
                        echo "<script>window.location.href='index.php';</script>";
                    }
                }
                else{
                    echo "<script>alert('Bạn cần đăng nhập để đặt hàng!');</script>";
                    echo "<script>window.location.href='login.php';</script>";
                }
                }else {
                    
                }
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php   
    include('partials-front/footer.php');
?>