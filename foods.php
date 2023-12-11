<?php   
    include('partials-front/menu.php');
?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="food-search.html" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                // $sql2 = "SELECT * FROM thucan WHERE active = 'Yes'";
                $sql2 = "SELECT thucan.*, `admin`.`username`, `admin`.`address` FROM `thucan` 
                        JOIN `admin` ON `thucan`.`user_id` = `admin`.`id` WHERE `thucan`.`active` = 'Yes'";
                $res2 = mysqli_query($conn, $sql2);
                $count2 = mysqli_num_rows($res2);
                if ($count2 > 0) {
                    while ($row2 = mysqli_fetch_assoc($res2)) {
                        $id = $row2['id'];
                        $title = $row2['title'];
                        $price = $row2['price'];
                        $description = $row2['description'];
                        $username = $row2['username'];
                        $address = $row2['address'];
                        $image_name = $row2['image_name'];
                        ?>
                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <?php
                                        if($image_name == ""){
                                            echo "Không có hình ảnh";
                                        }else{
                                            ?>
                                                <img src="../images/food/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                                            <?php
                                        }
                                    ?>                                
                                </div>
                                <div class="food-menu-desc">
                                    <h4><?php echo $title; ?></h4>
                                    <p class="food-price"><?php echo $price; ?></p>
                                    <p class="food-detail">
                                        <?php echo $description; ?>
                                    </p>
                                    <p class="food-detail"><i class="fas fa-store"></i><?php echo " ". $username; ?></p>

                                    <p class="food-detail"> <i class="fas fa-map-marker"></i><?php echo " ".$address; ?></p>
                                    
                                    <br>

                                    <a href="order.php?food_id=<?php echo "$id"; ?>" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>
                        <?php
                    }
                }
            ?>


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->
    <?php   
    include('partials-front/footer.php');
?>