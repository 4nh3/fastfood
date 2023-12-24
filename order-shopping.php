<?php
    $currentPage = 'index';
    include('partials-front/menu.php');
?>

<section class="food-search">
    <div class="container1">
        <h2 style="margin-right: auto;" class="text-center text-white">Xác nhận đơn hàng</h2>

        <form action="" class="order" method="POST">
            <fieldset>
                <?php
        $totalAmount = 0;
                if (isset($_POST['submit1'])) {
                    if (isset($_POST['selected_products']) && !empty($_POST['selected_products'])) {
                        $selectedProducts = $_POST['selected_products'];
                        foreach ($selectedProducts as $selectedProductID) {
                            $sql = "SELECT * FROM thucan WHERE id = '$selectedProductID'";
                            $res = mysqli_query($conn, $sql);

                            if ($res) {
                                $row = mysqli_fetch_array($res);
                                $user_id = $row['user_id'];
                                $title = $row['title'];
                                $price = $row['price'];
                                $image_name = $row['image_name'];
                                if (isset($_POST['qty'][$selectedProductID])) {
                                    $quantity = $_POST['qty'][$selectedProductID];
                                } else {
                                    $quantity = 1;
                                }
                                $totalAmount += $price * $quantity;
                                ?>
                                <input type="hidden" name="selected_products[]" value="<?php echo $selectedProductID; ?>">
                                <input type="hidden" name="price[]" value="<?php echo $price; ?>">
                                <input type="hidden" name="quantity[]" value="<?php echo $quantity; ?>">
                                <legend>Món ăn</legend>
                                <div class="food-menu-img">
                                    <?php
                                    if ($image_name != '') {
                                    ?>
                                        <img src="images/food/<?php echo $image_name; ?>" alt="" class="img-responsive img-curve">
                                    <?php
                                    } else {
                                        echo 'Không có hình ảnh!!';
                                    }
                                    ?>
                                </div>
                                <div class="food-menu-desc">
                                    <h3><?php echo $title; ?> </h3>
                                    <input type="hidden" name="food" value="<?php echo $title; ?>">
                                    <p class="food-price">Giá: <?php echo $price; ?></p>
                                    <input type="hidden" name="price" value="<?php echo $price; ?>">
                                    <div class="order-label">Số lượng:   
                                        <div class="quantity"><?php echo $quantity; ?></div>
                                    </div>
                                 
                                    <!-- <input type="text" name="qty[<?php //echo $selectedProductID; ?>]" class="input-responsive" value="<?php //echo $quantity; ?>" required> -->
                                </div>
                            <?php
                            } else {
                                echo "Lỗi truy vấn: " . mysqli_error($conn);
                            }
                            
                        }
                    } else {
                        echo "<script>alert('Không có mục nào được chọn !');</script>";
                        echo "<script>window.location.href='order-shopping.php';</script>";
                    }
                }
                ?>
            </fieldset>
                <div class="total-amount">
                    <p>Tổng số tiền: <?php echo $totalAmount; ?> VNĐ</p>
                </div>
            <fieldset>
                <!-- Trong vòng lặp hiển thị các sản phẩm trong giỏ hàng -->
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
        if (isset($_POST['submit'])) {
            if (isset($_POST['selected_products']) && isset($_POST['price']) && isset($_POST['quantity'])) {
                $productID = $_POST['selected_products'];
                $quantity = $_POST['quantity'];
                $order_date = date('Y-m-d H:i:s');
                $status = "Ordered";
                $customer_name = $_POST['name'];
                $customer_contact = $_POST['contact'];
                $customer_address = $_POST['address'];
                $loggedInUserID = $_SESSION['loggedInUserID'];
    
                foreach ($productID as $key => $id) {
                    $currentProductID = $productID[$key];
                    $currentQuantity = $quantity[$key];
    
                    // Lấy thông tin sản phẩm từ cơ sở dữ liệu
                    $sql = "SELECT * FROM thucan WHERE id = '$currentProductID'";
                    $res = mysqli_query($conn, $sql);
    
                    if ($res) {
                        $row = mysqli_fetch_array($res);
                        $currentPrice = $row['price'];
                        $title = $row['title'];
                        $user_id = $row['user_id'];
                        $total = $currentPrice * $currentQuantity;
                        $totalAmount += $total;
    
                        // Thực hiện câu lệnh SQL để lưu trữ thông tin đơn hàng vào cơ sở dữ liệu
                        $sql_insert = "INSERT INTO table_order (user_id, food, price, qty, total, order_date, status, customer_name, customer_contact, customer_address, customer_id)
                                    VALUES ('$user_id', '$title', '$currentPrice', '$currentQuantity', '$total', '$order_date', '$status', '$customer_name', '$customer_contact', '$customer_address', '$loggedInUserID')";
    
                        $result = mysqli_query($conn, $sql_insert);
                        if ($result) {
                            echo "<script>alert('Đã đặt hàng thành công!');</script>";
                            echo "<script>window.location.href='index.php';</script>";
                        } else {
                            echo "<script>alert('Có lỗi khi đặt hàng!');</script>";
                            echo "<script>window.location.href='index.php';</script>";
                        }
                    } else {
                        echo "Lỗi truy vấn: " . mysqli_error($conn);
                    }
                }
            } else {
                echo "<script>alert('Không có sản phẩm nào được chọn!');</script>";
                echo "<script>window.location.href='shopping.php';</script>";
            }
        }
        ?>
    </div>
</section>

<?php
include('partials-front/footer.php');
?>
