<?php   
    $currentPage = 'index';
    include('partials-front/menu.php');
?>

    <link rel="stylesheet" href="./css/follow.css">

<div class="main-content">
<div class="head" style=" font-weight: 30px;">Đã đặt hàng</div>
    <div class="container1">
       
       
        <?php
        if (!isset($_SESSION['loggedInUserID'])) {
            echo "Vui lòng đăng nhập để xem giỏ hàng.";
        } else {
            $loggedInUserID = $_SESSION['loggedInUserID'];

            $sql = "SELECT *, a.username AS tenshop, t.image_name AS anh
            FROM table_order tbo
            JOIN admin a ON a.id = tbo.user_id
            JOIN thucan t ON tbo.food = t.title
            JOIN danhmuc d ON t.danhmuc_id = d.id
            WHERE tbo.customer_id = '$loggedInUserID' AND tbo.status = 'Ordered'";
    


            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) :
                while ($row = mysqli_fetch_assoc($result)) :
                    
                    $user_id = $row['user_id'];
                    $title = $row['tenshop'];
                    $product_name = $row['food'];
                    $product_price = $row['price'];
                    $product_image = $row['anh'];
                    $product_qty = $row['qty'];

                    // echo $product_image;
        ?>
                    <div class="cart-container">
                        <div class="header">
                            <!-- <input type="checkbox" class="checkbox-input" name="check-all" id="check-all"> -->
                            <!-- <input type="checkbox" class="checkbox-input" name="selected_products[]" value="<?php //echo $thucan_id; ?>"> -->
                            <div class="shop-name"><?= $title ?></div>
                            <!-- <a href="delete-product.php?id=<?php //echo $id; ?>" class="delete-product">Xóa</a> -->
                        </div>
                        <div class="content">
                            <img src="./images/food/<?= $product_image; ?>" alt="Product Image" class="product-image">
                            <div class="product-info">
                                <div class="product-name"><?= $product_name ?></div>
                                <div class="product-price">Giá: <?= $product_price ?></div>
                                <div class="product-qty">
                                    Số lượng: <?= $product_qty;?>
                                </div>
                            </div>
                        </div>
                    </div>
        <?php
                endwhile;
            else :
                echo "Không có sản phẩm.";
            endif;

            // mysqli_close($conn);
        }
        ?>
    </div>
    <div class="head" style=" font-weight: 30px;">Đơn hàng đang được giao</div>
    <div class="container1">
        
        <?php
        
        if (!isset($_SESSION['loggedInUserID'])) {
            echo "Vui lòng đăng nhập để xem giỏ hàng.";
        } else {
            $loggedInUserID = $_SESSION['loggedInUserID'];

            $sql2 = "SELECT *, a.username AS tenshop, t.image_name AS anh
            FROM table_order tbo
            JOIN admin a ON a.id = tbo.user_id
            JOIN thucan t ON tbo.food = t.title
            JOIN danhmuc d ON t.danhmuc_id = d.id
            WHERE tbo.customer_id = '$loggedInUserID' AND status = 'On Delivery'"; 

            $result2 = mysqli_query($conn, $sql2);

            if (mysqli_num_rows($result2) > 0) :
                while ($row = mysqli_fetch_assoc($result2)) :
                    
                    $user_id = $row['user_id'];
                    $title = $row['tenshop'];
                    $product_name = $row['food'];
                    $product_price = $row['price'];
                    $product_image = $row['anh'];
                    $product_qty = $row['qty'];


                    // echo $product_image;
        ?>
                    <div class="cart-container">
                        <div class="header">
                            <!-- <input type="checkbox" class="checkbox-input" name="check-all" id="check-all"> -->
                            <!-- <input type="checkbox" class="checkbox-input" name="selected_products[]" value="<?php //echo $thucan_id; ?>"> -->
                            <div class="shop-name"><?= $title ?></div>
                            <!-- <a href="delete-product.php?id=<?php //echo $id; ?>" class="delete-product">Xóa</a> -->
                        </div>
                        <div class="content">
                            <img src="./images/food/<?= $product_image; ?>" alt="Product Image" class="product-image">
                            <div class="product-info">
                                <div class="product-name"><?= $product_name ?></div>
                                <div class="product-price">Giá: <?= $product_price ?></div>
                                <div class="product-qty">
                                    Số lượng: <?= $product_qty;?>
                                </div>
                            </div>
                        </div>
                    </div>
        <?php
                endwhile;
            else :
                echo "Không có sản phẩm.";
            endif;

            // mysqli_close($conn);
        }
        ?>
        </div>
        <div class="head" style=" font-weight: 30px;">Đơn hàng đã được giao</div>
        <div class="container1">
       
        <?php
        if (!isset($_SESSION['loggedInUserID'])) {
            echo "Vui lòng đăng nhập để xem giỏ hàng.";
        } else {
            $loggedInUserID = $_SESSION['loggedInUserID'];

            $sql3 = "SELECT *, a.username AS tenshop, t.image_name AS anh
            FROM table_order tbo
            JOIN admin a ON a.id = tbo.user_id
            JOIN thucan t ON tbo.food = t.title
            JOIN danhmuc d ON t.danhmuc_id = d.id
            WHERE tbo.customer_id = '$loggedInUserID' AND status = 'Delivered'"; 

            $result3 = mysqli_query($conn, $sql3);

            if (mysqli_num_rows($result3) > 0) :
                while ($row = mysqli_fetch_assoc($result3)) :
                    $user_id = $row['user_id'];
                    $title = $row['tenshop'];
                    $product_name = $row['food'];
                    $product_price = $row['price'];
                    $product_image = $row['anh'];
                    $product_qty = $row['qty'];


                    // echo $product_image;
        ?>
                    <div class="cart-container">
                        <div class="header">
                            <!-- <input type="checkbox" class="checkbox-input" name="check-all" id="check-all"> -->
                            <!-- <input type="checkbox" class="checkbox-input" name="selected_products[]" value="<?php //echo $thucan_id; ?>"> -->
                            <div class="shop-name"><?= $title ?></div>
                            <!-- <a href="delete-product.php?id=<?php //echo $id; ?>" class="delete-product">Xóa</a> -->
                        </div>
                        <div class="content">
                            <img src="./images/food/<?= $product_image; ?>" alt="Product Image" class="product-image">
                            <div class="product-info">
                                <div class="product-name"><?= $product_name ?></div>
                                <div class="product-price">Giá: <?= $product_price ?></div>
                                <div class="product-qty">
                                    Số lượng: <?= $product_qty;?>
                                </div>
                            </div>
                        </div>
                    </div>
        <?php
                endwhile;
            else :
                echo "Không có sản phẩm.";
            endif;

            // mysqli_close($conn);
        }
        ?>
        </div>
        <div class="head" style=" font-weight: 30px;" >Đơn hàng bị hủy</div>
        <div class="container1">
        
        <?php
        if (!isset($_SESSION['loggedInUserID'])) {
            echo "Vui lòng đăng nhập để xem giỏ hàng.";
        } else {
            $loggedInUserID = $_SESSION['loggedInUserID'];

            $sql4 = "SELECT *, a.username AS tenshop, t.image_name AS anh
            FROM table_order tbo
            JOIN admin a ON a.id = tbo.user_id
            JOIN thucan t ON tbo.food = t.title
            JOIN danhmuc d ON t.danhmuc_id = d.id
            WHERE tbo.customer_id = '$loggedInUserID' AND status = 'Cancelled'"; 

            $result4 = mysqli_query($conn, $sql4);

            if (mysqli_num_rows($result4) > 0) :
                while ($row = mysqli_fetch_assoc($result4)) :
                    
                    $user_id = $row['user_id'];
                    $title = $row['tenshop'];
                    $product_name = $row['food'];
                    $product_price = $row['price'];
                    $product_image = $row['anh'];
                    $product_qty = $row['qty'];

                    // echo $product_image;
        ?>
                    <div class="cart-container">
                        <div class="header">
                            <!-- <input type="checkbox" class="checkbox-input" name="check-all" id="check-all"> -->
                            <!-- <input type="checkbox" class="checkbox-input" name="selected_products[]" value="<?php //echo $thucan_id; ?>"> -->
                            <div class="shop-name"><?= $title ?></div>
                            <!-- <a href="delete-product.php?id=<?php // echo $id; ?>" class="delete-product">Xóa</a> -->
                        </div>
                        <div class="content">
                            <img src="./images/food/<?= $product_image; ?>" alt="Product Image" class="product-image">
                            <div class="product-info">
                                <div class="product-name"><?= $product_name ?></div>
                                <div class="product-price">Giá: <?= $product_price ?></div>
                                <div class="product-qty">
                                    Số lượng: <?= $product_qty;?>
                                </div>
                            </div>
                        </div>
                    </div>
        <?php
                endwhile;
            else :
                echo "Không có sản phẩm.";
            endif;

            mysqli_close($conn);
        }
        ?>
        

       

        <div class="clearfix"></div>
    </div>
</div>

<?php   
    include('partials-front/footer.php');
?>
