<?php

require '../config/database.php';



// Hàm xóa giỏ hàng
function deleteCart() {
    if (isset($_SESSION['cart'])) {
        unset($_SESSION['cart']);
    }
}

// Gọi hàm deleteCart khi người dùng yêu cầu
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete-cart'])) {
    deleteCart();
    header("Location:../App/View/product-cart.php"); // Điều hướng lại trang giỏ hàng
    exit();
   
}

?>