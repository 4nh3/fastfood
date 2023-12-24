<?php include('partials/menu.php') ?>
<?php //include('../config/contants.php')?>
    <div class="main-content">
        <div class="wrapper">
            <h1>Thêm món ăn</h1>
            <form action="" method="POST" enctype="multipart/form-data">
            <table class="custom-table">
                        <tr>
                            <td>Tiêu đề:</td>
                            <td><input type="text" name="title" class="input-title" placeholder="Tên món ăn"></td>
                        </tr>

                        <tr>
                            <td>Mô tả</td>
                            <td><textarea name="description" id="" cols="40" rows="5"></textarea></td>
                        </tr>

                        <tr>
                            <td>Giá: </td>
                            <td><input type="number" name="price" class="input-title"></td>
                        </tr>

                        <tr>
                            <td>Hình ảnh</td>
                            <td><input type="file" name="image" class="input-title"></td>
                        </tr>

                        <tr>
                            <td>Danh mục</td>
                            <td>
                                <select name="category" >
                                    <?php
                                        $loggedInUserID = $_SESSION['loggedInUserID']; 
                                        $sql = "SELECT * FROM danhmuc WHERE active ='Yes' AND user_id = $loggedInUserID ";
                                        $res = mysqli_query($conn, $sql);
                                        $count = mysqli_num_rows($res);
                                        if ($count > 0) {
                                            while ($row = mysqli_fetch_array($res)) {
                                                $id = $row["id"];
                                                $title = $row["title"];
                                                ?>
                                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                                <?php
                                            }
                                        }else{
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
                                <input type="radio" name="featured" class="radio-input" value="Yes"> <label class="radio-label">Yes</label>
                                <input type="radio" name="featured" class="radio-input" value="No"> <label class="radio-label">No</label>
                            </td>
                        </tr>

                        <tr>
                            <td class="label-cell">Hoạt động</td>
                            <td class="radio-cell">
                                <input type="radio" name="active" class="radio-input" value="Yes"> <label class="radio-label">Yes</label>
                                <input type="radio" name="active" class="radio-input" value="No"> <label class="radio-label">No</label>
                            </td>
                        </tr>
                        <tr>
                            <td><button type="submit" name="submit" class="btn btn-primary">Thêm danh mục</button></td>
                        </tr>
                    </table>
            </form>
            
            <div class="clearfix"></div>
        </div>
    </div>
<?php include('partials/footer.php') ?>

<?php

    if(isset($_POST['submit'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category = $_POST['category'];

        if(isset($_FILES['image']['name'])) {
            $image_name = $_FILES['image']['name'];
            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/food/" . $image_name;

            $upload = move_uploaded_file($source_path, $destination_path);
            if($upload == false) {
                echo "<script>alert('Tải hình ảnh không thành công!');</script>";
                echo "<script>window.location.href='add-food.php';</script>";
            }
        }else{
            $image_name = "";  
        }


        if(isset($_POST['featured'])) {
            $featured = $_POST['featured'];
        }else{
            $featured = 'No';
        }
        
        if(isset($_POST['active'])) {
            $active = $_POST['active'];
        }else{
            $active = 'No';
        }
        $loggedInUserID = $_SESSION['loggedInUserID']; 
        $sql = "INSERT INTO thucan SET
            `user_id` = '$loggedInUserID',
            `title` = '$title',
            `description` = '$description',
            `price` = '$price',
            `danhmuc_id` = '$category',
            `image_name` = '$image_name',
            `featured` = '$featured',
            `active` = '$active'
        ";
        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        if ($res == TRUE) {
            echo "<script>alert('Thêm thành công!');</script>";
            echo "<script>window.location.href='manage-food.php';</script>";
        }
    }
?>
