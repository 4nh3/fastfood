<?php include('partials/menu.php') ?>
<div class="main-content">
        <div class="wrapper">
            <h1>Thêm danh mục</h1>

            <?php
                if(isset($_SESSION['upload'])) {
                    echo $_SESSION['upload'];
                    unset ($_SESSION['upload']);
                }
            ?>
            <br />
                <br /> <br /> <br />
                
                <form action="" method="POST" enctype="multipart/form-data" >
                    <table class="custom-table">
                        <tr>
                            <td>Tiêu đề:</td>
                            <td><input type="name" name="title" class="input-title" placeholder="Tiêu đề danh mục"></td>
                        </tr>

                        <tr>
                            <td>Hình ảnh</td>
                            <td><input type="file" name="image" class="input-title"></td>
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


                <?php
                    if(isset($_POST['submit'])) {
                        $title = $_POST['title'];

                        if(isset($_FILES['image']['name'])) {
                            $image_name = $_FILES['image']['name'];
                            $source_path = $_FILES['image']['tmp_name'];
                            $destination_path = "../images/category/" . $image_name;

                            $upload = move_uploaded_file($source_path, $destination_path);
                            if($upload == false) {
                                echo "<script>alert('Tải hình ảnh không thành công!');</script>";
                                echo "<script>window.location.href='add-category.php';</script>";
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

                        $sql = "INSERT INTO danhmuc SET 
                            `user_id` = '$loggedInUserID',
                            `title` = '$title',
                            `image_name` = '$image_name',
                            `featured` = '$featured',
                            `active` = '$active'
                        ";
                        $res = mysqli_query($conn, $sql);
                        if ($res == TRUE) {
                            echo "<script>alert('Thêm thành công!');</script>";
                            echo "<script>window.location.href='manage-category.php';</script>";
                        }
                    } 
                ?>

            <div class="clearfix"></div>
        </div>
    </div>
<?php include('partials/footer.php') ?>