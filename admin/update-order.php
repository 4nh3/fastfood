<?php
    include('partials/menu.php') ;
?>

<div class="main-content">
        <div class="wrapper">
            <h1>Chỉnh sửa order</h1>

            <?php
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    $sql = "SELECT * FROM table_order WHERE `id` = '$id' ";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);
                    if ($count == 1) {
                        while ($row = mysqli_fetch_array($res)) {
                            // $id = $row['id'];
                            $food = $row['food'];
                            $price = $row['price'];
                            $qty = $row['qty'];
                            // $total = $row['total'];
                            // $order_date = $row['order_date'];
                            $status = $row['status'];
                            $customer_name = $row['customer_name'];
                            $customer_contact = $row['customer_contact'];
                            // $customer_email = $row['customer_email'];
                            $customer_address = $row['customer_address'];
                        }
                    }else{
                        header('location: manage-order.php');
                    }
                }else{
                    header('location: manage-order.php');
                }
            ?>

            <form action="" method="POST" >
                <table class="custom-table" >
                    <tr>
                        <td class="label-cell">Tên món ăn</td>
                        <td class="label-cell"><b><?php echo $food; ?></b></td>
                    </tr>

                    <tr>
                        <td class="label-cell">Giá</td>
                        <td class="label-cell"><b><?php echo $price; ?></b></td>
                    </tr>

                    <tr>
                        <td class="label-cell">Số lượng</td>
                        <td class="label-cell">
                            <input type="number" name="qty" value="<?php echo $qty; ?>"  >
                        </td>
                    </tr>

                    <tr>
                        <td class="label-cell">Trạng thái</td>
                        <td class="label-cell">
                            <select name="status">
                                <option <?php if($status=="Ordered"){echo "selected";} ?> value="Ordered">Đặt hàng</option>
                                <option <?php if($status=="On Delivery"){echo "selected";} ?> value="On Delivery">Đang giao hàng</option>
                                <option <?php if($status=="Delivered"){echo "selected";} ?> value="Delivered">Đã giao hàng</option>
                                <option <?php if($status=="Cancelled"){echo "selected";} ?> value="Cancelled">Hủy bỏ</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td class="label-cell">Tên khách hàng</td>
                        <td class="label-cell">
                            <input type="text" name="customer_name" value="<?php echo $customer_name; ?>" >
                        </td>
                    </tr>

                    <tr>
                        <td class="label-cell">Số điện thoại</td>
                        <td class="label-cell">
                            <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>" >
                        </td>
                    </tr>

                    <!-- <tr>
                        <td class="label-cell">Email</td>
                        <td class="label-cell">
                            <input type="email" name="customer_email" value="<?php //echo $customer_email; ?>">
                        </td>
                    </tr> -->

                    <tr>
                        <td class="label-cell">Địa chỉ</td>
                        <td class="label-cell">
                            <textarea type="text" name="customer_address" cols="30" rows="5"><?php echo $customer_address; ?></textarea>
                        </td>
                    </tr>

                    <tr> 
                        <td>
                            <input type="hidden" name="id" value="<?php echo $id ?>" >
                            <input type="hidden" name="price" value="<?php echo $price ?>" >
                            <button type="submit" name="submit" class="btn btn-primary">Cập nhật</button>  
                        </td>
                    </tr>
                </table>
            </form>
                    <?php
                        if(isset($_POST["submit"])){
                            // $id = $_POST["id"];
                            // $food = $_POST['food'];
                            $price = $_POST['price'];
                            $qty = $_POST['qty'];
                            $total = $price * $qty;
                            // $order_date = $_POST['order_date'];
                            $status = $_POST['status'];
                            $customer_name = $_POST['customer_name'];
                            $customer_contact = $_POST['customer_contact'];
                            // $customer_email = $_POST['customer_email'];
                            $customer_address = $_POST['customer_address'];

                            $sql2 = " UPDATE table_order SET
                                `qty` = '$qty',
                                `total` = '$total',
                                `status` = '$status',
                                `customer_name` = '$customer_name',
                                `customer_contact` = '$customer_contact',
                                -- `customer_email` = '$customer_email',
                                `customer_address` = '$customer_address'
                                WHERE `id` = $id
                            ";

                            $res2 = mysqli_query($conn, $sql2);
                            if($res2 == true){
                                echo "<script>alert('Cập nhật thành công!');</script>";
                                echo "<script>window.location.href='manage-order.php';</script>";
                            }else{
                                echo "<script>alert('Cập nhật không thành công!');</script>";
                                echo "<script>window.location.href='manage-order.php';</script>";
                            }
                        }
                    ?>

                
            
            <div class="clearfix"></div>
        </div>
    </div>
<?php include('partials/footer.php') ?>
