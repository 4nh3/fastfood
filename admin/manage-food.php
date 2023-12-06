<?php include('partials/menu.php') ?>
<div class="main-content">
        <div class="wrapper">
            <h1>Thức ăn</h1>
            <br />
                    <a href="add-food.php" class="btn-primary">Thêm món</a>
                <br /> <br /> <br />
                <table class="tbl-full" >
                    <tr>
                        <th>STT</th>
                        <th>Tên món</th>
                        <th>Mô tả</th>
                        <th>Giá</th> 
                        <th>Hình ảnh</th>    
                        <th>Danh mục</th>    
                        <th>Sản phẩm nổi bậc</th>    
                        <th>Hoạt động</th>    
                    </tr>
                    <?php
                        $sql = "SELECT * FROM thucan";
                        $res = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($res);
                        $stt = 1;
                        if($count > 0){
                            while($row = mysqli_fetch_array($res)){
                                $id = $row["id"];
                                $title = $row["title"];
                                $description = $row["description"];
                                $price = $row["price"];
                                $image_name = $row['image_name'];
                                $category = $row['danhmuc_id'];
                                $featured = $row['featured'];
                                $active = $row['active'];
                                ?>
                                    <tr>
                                        <td><?php echo $stt++; ?></td>
                                        <td><?php echo $title; ?></td>
                                        <td><?php echo $description; ?></td>
                                        <td><?php echo $price; ?></td>
                                        <td>
                                                <?php 
                                                    if($image_name!= ''){
                                                        // echo''.$image_name.'';
                                                        ?>
                                                            <img src="../images/food/<?php echo $image_name; ?>" alt="" width="100px" >
                                                        <?php
                                                        
                                                    } else{
                                                        echo 'Không có hình ảnh!!';
                                                    }
                                                ?>
                                        </td>
                                        <td><?php echo $category; ?></td>
                                        <td><?php echo $featured; ?></td>
                                        <td><?php echo $active; ?></td>
                                        <td>
                                            <a href="update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Sửa</a>
                                            <a href="delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Xóa</a>
                                        </td>    
                                    </tr>
                                <?php
                            }
                        }else{
                            echo "Không có món nào!!";
                        }
                    ?>
                </table>
            
            <div class="clearfix"></div>
        </div>
    </div>
<?php include('partials/footer.php') ?>