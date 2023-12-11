<?php include('partials/menu.php') ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Thống kê</h1>

            <?php
               $sql = "SELECT * FROM danhmuc";
               $res = mysqli_query($conn, $sql);
               $count = mysqli_num_rows($res);
            ?>

            <div class="col4 text-center">
                 <h1><?php echo $count ?> </h1>
                 <br/>
                 Danh mục
            </div>

            <?php
               $sql2 = "SELECT * FROM thucan";
               $res2 = mysqli_query($conn, $sql2);
               $count2 = mysqli_num_rows($res2);
            ?>

            <div class="col4 text-center">
                 <h1><?php echo $count2 ?></h1>
                 <br/>
                 Món ăn
            </div>

            <?php
               $sql3 = "SELECT * FROM table_order";
               $res3 = mysqli_query($conn, $sql3);
               $count3 = mysqli_num_rows($res3);
            ?>

            <div class="col4 text-center">
                 <h1><?php echo $count ?></h1>
                 <br/>
                 Tổng số lược order 
            </div>

            <?php
               $sql4 = "SELECT SUM(total) AS total  FROM table_order WHERE status = 'Delivered' ";
               $res4 = mysqli_query($conn, $sql4);
               $row4 = mysqli_fetch_array($res4);

               $total_tong = $row4["total"];
            ?>

            <div class="col4 text-center">
                 <h1><?php echo $total_tong ?></h1>
                 <br/>
                 Doanh thu
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
<?php include('partials/footer.php') ?>