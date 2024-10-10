<?php

require '../config/database.php';

if (isset($_POST['productId'])) {
    $id = $_POST['productId'];
    $productModel = new Product();
    if ($productModel->deleteProduct($id)) {
        $_SESSION['alert'] = 'Deleted successfully!!!';
    }else {
        $_SESSION['alert'] = 'Deleted failed!!!';
    }
    header('location:../App/View/product-management.php');
}


?>