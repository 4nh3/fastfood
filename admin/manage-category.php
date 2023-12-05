<?php include('partials/menu.php') ?>
<div class="main-content">
        <div class="wrapper">
            <h1>Danh mục</h1>
            <br />
                    <a href="add-category.php" class="btn-primary">Thêm danh mục</a>
                <br /> <br /> <br />
                <table class="tbl-full" >
                    <tr>
                        <th>STT</th>
                        <th>Tiêu đề</th>
                        <th>Hình ảnh</th>
                        <th>Sản phẩm nổi bậc</th>    
                        <th>Hoạt động</th>    
                    </tr>
                        <?php
                            $sql = "SELECT * FROM danhmuc";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);
                            $stt = 1;
                            if ($count > 0) {
                                while ($row = mysqli_fetch_array($res)) {
                                    $id = $row["id"];
                                    $title = $row["title"];
                                    $image_name = $row['image_name'];
                                    $featured = $row['featured'];
                                    $active = $row['active'];
                                    ?>
                                        <tr>
                                            <td><?php echo $stt++; ?></td>
                                            <td><?php echo $title; ?></td>
                                            <td>
                                                <?php 
                                                    if($image_name!= ''){
                                                        // echo''.$image_name.'';
                                                        ?>
                                                            <img src="../images/category/<?php echo $image_name; ?>" alt="" width="100px" >
                                                        <?php
                                                        
                                                    } else{
                                                        echo 'Không có hình ảnh!!';
                                                    }
                                                ?>
                                            </td>
                                            <td><?php echo $featured; ?></td>
                                            <td><?php echo $active; ?></td>
                                            <td>
                                                <a href="update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Sửa</a>
                                                <a href="delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Xóa</a>
                                            </td>    
                                        </tr>
                                    <?php
                                }
                            }
                            else {
                                echo "Không có danh mục nào hết!!!";
                            }
                        ?>
                    
                </table>
            
            <div class="clearfix"></div>
        </div>
    </div>
<?php include('partials/footer.php') ?>