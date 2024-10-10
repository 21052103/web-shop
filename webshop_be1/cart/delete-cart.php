<?php
session_start();

// Kiểm tra nếu yêu cầu xóa sản phẩm được gửi
if (isset($_POST['delete_cart'])) {
    $productId = $_POST['product_id'];

    // Xóa sản phẩm khỏi giỏ hàng
    if (isset($_SESSION['cart'][$productId])) {
        unset($_SESSION['cart'][$productId]);

        // Reset array keys after deletion
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }

    // Chuyển hướng về trang giỏ hàng sau khi xóa sản phẩm
    header('Location: ../App/View/product-cart.php');
    exit();
}
?>
