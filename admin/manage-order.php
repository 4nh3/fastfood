<?php include('partials/menu.php') ?>
<div class="main-content">
        <div class="wrapper">
            <h1>Order</h1>
            
                <table class="tbl-full" >
                    <tr>
                        <th>STT</th>
                        <th>Tên món ăn</th>
                        <th>Giá món ăn</th>
                        <th>Số lượng</th>
                        <th>Tổng thanh toán</th>
                        <th>Ngày đặt hàng</th>
                        <th>Trạng thái</th>
                        <th>Khách hàng</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        <th>Địa chỉ</th>    
                    </tr>
                    <?php
                        $user_id = $_SESSION['loggedInUserID'];
                        $sql = "SELECT * FROM table_order WHERE `user_id` = '$user_id' ORDER BY id DESC ";
                        $res = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($res);
                        $stt = 1;
                        if ($count > 0) {
                            while ($row = mysqli_fetch_array($res)) {
                                $id = $row['id'];
                                $food = $row['food'];
                                $price = $row['price'];
                                $qty = $row['qty'];
                                $total = $row['total'];
                                $order_date = $row['order_date'];
                                $status = $row['status'];
                                $customer_name = $row['customer_name'];
                                $customer_contact = $row['customer_contact'];
                                $customer_email = $row['customer_email'];
                                $customer_address = $row['customer_address'];

                                ?>
                                    <tr>
                                        <td><?php echo $stt++; ?></td>
                                        <td><?php echo $food; ?></td>
                                        <td><?php echo $price; ?></td>
                                        <td><?php echo $qty; ?></td>
                                        <td><?php echo $total; ?></td>
                                        <td><?php echo $order_date; ?></td>
                                        <td>
                                            <?php 
                                                if ($status == "Ordered") {
                                                    echo "<label> Đặt hàng </label>";
                                                }elseif ($status == 'On Delivery') {
                                                    echo "<label style = 'color: orange;' > Đang giao hàng </label>";
                                                }elseif ($status == 'Delivered') {
                                                    echo "<label style = 'color: green;'> Đã giao hàng </label>";
                                                }elseif( $status == "Cancelled") {
                                                    echo "<label style = 'color: red;'> Hủy </label>";
                                                }
                                            ?>
                                        </td>
                                        <td><?php echo $customer_name; ?></td>
                                        <td><?php echo $customer_contact; ?></td>
                                        <td><?php echo $customer_email; ?></td>
                                        <td><?php echo $customer_address; ?></td>
                                        <td>
                                            <a href="update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Sửa</a>
                                            <!-- <a href="" class="btn-danger">Xóa</a> -->
                                        </td>    
                                    </tr>
                                <?php
                            }
                        }
                    ?>

                </table>
            
            <div class="clearfix"></div>
        </div>
    </div>
<?php include('partials/footer.php') ?>