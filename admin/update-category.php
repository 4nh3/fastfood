<?php include('partials/menu.php') ?>
<div class="main-content">
        <div class="wrapper">
            <h1>Chỉnh sửa danh mục</h1>

            <?php
                if(isset($_GET['id'])) {
                    $id = $_GET['id'];
                    // echo $id;
                    $sql = "SELECT * FROM `danhmuc` WHERE `id` = '$id'";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);
                    if($count == 1) {
                        $row = mysqli_fetch_array($res);
                        $title = $row['title'];
                        $current_image = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];
                    }else{
                        echo "Không tìm thấy danh mục";
                        header("location: manage-category.php");
                    }
                }
            ?>
            <br />
                <br /> <br /> <br />
                
                <form action="" method="POST" enctype="multipart/form-data" >
                    <table class="custom-table">
                        <tr>
                            <td>Tiêu đề:</td>
                            <td><input type="name" name="title" class="input-title" value="<?php echo $title; ?>"></td>
                        </tr>

                        <tr>
                            <td>Hình ảnh hiện tại</td>
                            <td><img src="../images/category/<?php echo $current_image;?>" alt="" width="150px"></td>
                        </tr>

                        <tr>
                            <td>Hình ảnh</td>
                            <td><input type="file" name="image" class="input-title"></td>
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
                    if(isset($_POST["submit"])) {
                        $id = $_POST["id"];
                        $title = $_POST['title'];
                        $current_image = $_POST['current_image'];
                        $featured = $_POST['featured'];
                        $active = $_POST['active'];

                        if(isset($_FILES['image']['name'])){
                            $image_name = $_FILES['image']['name'];
                            if($image_name != ''){
                                $image_name = $_FILES['image']['name'];
                                $source_path = $_FILES['image']['tmp_name'];
                                $destination_path = "../images/category/" . $image_name;

                                $upload = move_uploaded_file($source_path, $destination_path);
                                if($upload == false) {
                                    echo "<script>alert('Tải hình ảnh không thành công!');</script>";
                                    echo "<script>window.location.href='manage-category.php';</script>";
                                }
                                if($current_image != ""){
                                    $remove_path = "../images/category/" .$current_image;
                                    $remove = unlink($remove_path);

                                    if($remove == false) {
                                        echo "<script>alert('Không thể xóa hình ảnh hiện tại!');</script>";
                                        echo "<script>window.location.href='manage-category.php';</script>";
                                    }
                                }
                                
                                }else{
                                    $image_name = $current_image;
                                }
                        }else{
                            $image_name = $current_image;
                        }

                        $sql2 = "UPDATE danhmuc SET
                            title = '$title',
                            image_name = '$image_name',
                            featured = '$featured',
                            active = '$active'
                            WHERE id = '$id'
                        ";

                        $res2 = mysqli_query($conn, $sql2);

                        if($res2 == true) {
                            echo "<script>alert('Cập nhật thành công!');</script>";
                            echo "<script>window.location.href='manage-category.php';</script>";
                        }else{
                            echo "<script>alert('Cập nhật không thành công!');</script>";
                            echo "<script>window.location.href='manage-category.php';</script>";
                        }
                    }
                ?>

            <div class="clearfix"></div>
        </div>
    </div>
<?php include('partials/footer.php') ?>