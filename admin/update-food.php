<?php include('partials/menu.php') ?>
<div class="main-content">
        <div class="wrapper">
            <h1>Chỉnh sửa thức ăn</h1>

            <?php
                if(isset($_GET['id'])) {
                    $id = $_GET['id'];
                    // echo $id;
                    $sql2 = "SELECT * FROM `thucan` WHERE `id` = '$id'";
                    $res2 = mysqli_query($conn, $sql2);
                    $count2 = mysqli_num_rows($res2);
                    if($count2 == 1) {
                        $row2 = mysqli_fetch_array($res2);
                        $title = $row2['title'];
                        $description = $row2['description'];
                        $price = $row2['price'];
                        $current_category = $row2['danhmuc_id'];
                        $current_image = $row2['image_name'];
                        $featured = $row2['featured'];
                        $active = $row2['active'];
                    }else{
                        echo "Không tìm thấy danh mục";
                        header("location: manage-food.php");
                    }
                }
            ?>
            <br />
                <br /> <br /> <br />
                
                <form action="" method="POST" enctype="multipart/form-data">
            <table class="custom-table">
                        <tr>
                            <td>Tiêu đề:</td>
                            <td><input type="text" name="title" class="input-title" value="<?php echo $title; ?>" ></td>
                        </tr>

                        <tr>
                            <td>Mô tả</td>
                            <td><textarea name="description" id="" cols="40" rows="5"><?php echo $description; ?></textarea></td>
                        </tr>

                        <tr>
                            <td>Giá: </td>
                            <td><input type="number" name="price" class="input-title" value="<?php echo $price; ?>"></td>
                        </tr>

                        <tr>
                            <td>Hình ảnh hiện tại</td>
                            <td><img src="../images/food/<?php echo $current_image;?>" alt="" width="150px"></td>
                        </tr>

                        <tr>
                            <td>Hình ảnh</td>
                            <td><input type="file" name="image" class="input-title"></td>
                        </tr>

                        <tr>
                            <td>Danh mục</td>
                            <td>
                                <select name="category">
                                    <?php
                                        $sql = "SELECT * FROM `danhmuc` WHERE `active` ='Yes' ";  
                                        $res = mysqli_query($conn, $sql);
                                        $count = mysqli_num_rows($res);
                                        if ($count > 0) {
                                            while ($row = mysqli_fetch_array($res)) {
                                                $category_id = $row['id'];
                                                $category_title = $row['title'];
                                                ?>
                                                    <option <?php if( $current_category == $category_id){ echo "selected"; } ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                                <option value="0">Không tìm thấy danh mục</option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td class="label-cell">Sản phẩm nổi bậc</td>
                            <td class="radio-cell">
                                <input <?php if($featured == "Yes"){ echo "checked";} ?> type="radio" name="featured" class="radio-input" value="Yes"> <label class="radio-label">Yes</label>
                                <input <?php if($featured == "No"){ echo "checked";} ?>  type="radio" name="featured" class="radio-input" value="No"> <label class="radio-label">No</label>
                            </td>
                        </tr>

                        <tr>
                            <td class="label-cell">Hoạt động</td>
                            <td class="radio-cell">
                                <input <?php if($featured == "Yes"){ echo "checked";} ?> type="radio" name="active" class="radio-input" value="Yes"> <label class="radio-label">Yes</label>
                                <input <?php if($featured == "No"){ echo "checked";} ?> type="radio" name="active" class="radio-input" value="No"> <label class="radio-label">No</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="hidden" name="current_image" value="<?php echo $current_image; ?>" >
                                <input type="hidden" name="id" value="<?php echo $id; ?>" >
                                <button type="submit" name="submit" class="btn btn-primary">Cập nhật</button>
                            </td>
                        </tr>
                    </table>
            </form>
                <?php
                    if (isset($_POST["submit"])) {
                        $id = $_GET['id']; 
                        $title = $_POST['title'];
                        $description = $_POST['description'];
                        $price = $_POST['price'];
                        $category = $_POST['category'];
                        $current_image = $_POST['current_image'];
                        $featured = isset($_POST['featured']) ? $_POST['featured'] : 'No';
                        $active = isset($_POST['active']) ? $_POST['active'] : 'No';
                    
                        if (isset($_FILES['image']['name'])) {
                            $image_name = $_FILES['image']['name'];
                            if ($image_name != '') {
                                $source_path = $_FILES['image']['tmp_name'];
                                $destination_path = "../images/food/" . $image_name;
                    
                                $upload = move_uploaded_file($source_path, $destination_path);
                                if ($upload == false) {
                                    echo "<script>alert('Tải hình ảnh không thành công!');</script>";
                                    echo "<script>window.location.href='manage-food.php';</script>";
                                }
                    
                                if ($current_image != "") {
                                    $remove_path = "../images/food/" . $current_image;
                                    $remove = unlink($remove_path);
                    
                                    if ($remove == false) {
                                        echo "<script>alert('Không thể xóa hình ảnh hiện tại!');</script>";
                                        echo "<script>window.location.href='manage-food.php';</script>";
                                    }
                                }
                            } else {
                                $image_name = $current_image;
                            }
                        } else {
                            $image_name = $current_image;
                        }
                    
                        $sql3 = "UPDATE thucan SET
                            `title` = '$title',
                            `description` = '$description',
                            `price` = '$price',
                            `image_name` = '$image_name',
                            `danhmuc_id` = '$category',
                            `featured` = '$featured',
                            `active` = '$active'
                            WHERE `id` = '$id'
                        ";
                    
                        $res3 = mysqli_query($conn, $sql3);
                    
                        if ($res3 == true) {
                            echo "<script>alert('Cập nhật thành công!');</script>";
                            echo "<script>window.location.href='manage-food.php';</script>";
                        } else {
                            echo "<script>alert('Cập nhật không thành công!');</script>";
                            echo "<script>window.location.href='manage-food.php';</script>";
                        }
                    }
                    
                ?>

            <div class="clearfix"></div>
        </div>
    </div>
<?php include('partials/footer.php') ?>