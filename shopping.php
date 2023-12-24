<?php   
    $currentPage = 'index';
    include('partials-front/menu.php');
?>
 <div class="follow">
    <a href="follow.php">Theo dõi đơn hàng</a>
</div>
<section class="categories">
    <link rel="stylesheet" href="./css/shopping.css">
    <form action="order-shopping.php" method="POST" id="checkout-form">
   
    <div class="container1">
    <?php
        if (!isset($_SESSION['loggedInUserID'])) {
            echo "Vui lòng đăng nhập để xem giỏ hàng.";
        } else {
            $loggedInUserID = $_SESSION['loggedInUserID'];

            $sql = "SELECT *, s.id AS shopping_id, s.user_id, s.thucan_id, a.username AS tenshop, t.image_name AS anh, t.title AS tensp, t.price AS gia
            FROM shopping s
            INNER JOIN thucan t ON s.thucan_id = t.id
            INNER JOIN danhmuc d ON t.danhmuc_id = d.id
            INNER JOIN admin a ON d.user_id = a.id
            WHERE s.user_id = '$loggedInUserID'"; 

            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) :
                while ($row = mysqli_fetch_assoc($result)) :
                    $id = $row['shopping_id'];
                    $user_id = $row['user_id'];
                    $title = $row['tenshop'];
                    $thucan_id = $row['thucan_id'];
                    $product_name = $row['tensp'];
                    $product_price = $row['gia'];
                    $product_image = $row['anh'];

                    // echo $product_image;
        ?>
                    <div class="cart-container">
                        <div class="header">
                            <!-- <input type="checkbox" class="checkbox-input" name="check-all" id="check-all"> -->
                            <input type="checkbox" class="checkbox-input" name="selected_products[]" value="<?php echo $thucan_id; ?>">
                            <div class="shop-name"><?= $title ?></div>
                            <a href="delete-product.php?id=<?php echo $id; ?>" class="delete-product">Xóa</a>
                        </div>
                        <div class="content">
                            <img src="./images/food/<?= $product_image; ?>" alt="Product Image" class="product-image">
                            <div class="product-info">
                                <div class="product-name"><?= $product_name ?></div>
                                <div class="product-price">Giá: <?= $product_price ?></div>
                                <div class="product-qty">
                                    Số lượng: <input class="qty" type="number" name="qty[<?php echo $thucan_id; ?>]" value="<?php echo isset($_POST['qty'][$thucan_id]) ? $_POST['qty'][$thucan_id] : 1; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
        <?php
                endwhile;
            else :
                echo "Không có sản phẩm trong giỏ hàng của bạn.";
            endif;

            mysqli_close($conn);
        }
        ?>


        </div>
        <div class="footer">
        <!-- <input type="checkbox" class="checkbox-input" name="check-total" id="check-total"> Tất cả -->
        <div class="checkout-amount">
            Thanh toán: <span class="total-amount">0đ</span>
        </div>
        <input type="submit" name="submit1" value="Đặt hàng">
        </form>
    </div>

        <div class="clearfix"></div>
    </div>
</section>
<script>
    document.addEventListener("DOMContentLoaded", function() {
    const checkboxes = document.querySelectorAll('.checkbox-input');
    const quantityInputs = document.querySelectorAll('.qty');
    const checkoutBtn = document.querySelector('.checkout-btn');
    const totalAmount = document.querySelector('.checkout-amount .total-amount'); 

    function calculateTotal() {
        let total = 0;

        checkboxes.forEach((checkbox, index) => {
            if (checkbox.checked) {
                const price = parseFloat(checkbox.parentElement.nextElementSibling.querySelector('.product-price').innerText.split(' ')[1]);
                const quantity = parseInt(quantityInputs[index].value) || 1; 
                total += price * quantity || 0;
            }
        });

        return total;
    }

    function updateTotal() {
        const total = calculateTotal();
        totalAmount.textContent = `${total}đ`;
    }

    checkboxes.forEach((checkbox, index) => {
        checkbox.addEventListener('change', () => {
            updateTotal();
        });

        quantityInputs[index].addEventListener('input', () => {
            updateTotal();
        });
    });

    checkoutBtn.addEventListener('click', () => {
        const total = calculateTotal();
        alert(`Tổng số tiền cần thanh toán: ${total}đ`);
    });

    // Cập nhật tổng số tiền mặc định ban đầu
    updateTotal();
});


const deleteButtons = document.querySelectorAll('.delete-product');

    deleteButtons.forEach((button) => {
        button.addEventListener('click', function() {
            const productId = button.getAttribute('data-product-id');

            fetch('delete-product.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ productId: productId }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const productContainer = button.closest('.cart-container');
                    productContainer.remove();
                    updateTotal();
                } else {
                    alert('Xóa sản phẩm không thành công');
                }
            })
            .catch((error) => {
                console.error('Error:', error);
            });
        });
    });

</script>
