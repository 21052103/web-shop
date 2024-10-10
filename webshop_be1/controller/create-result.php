<?php

require '../config/database.php';

$name = '';
$price = '';
$description = '';
$image = '';
$categoryId = [];

if (isset($_POST['name'])) {
    $name = $_POST['name'];
}

if (isset($_POST['price'])) {
    $price = $_POST['price'];
}

if (isset($_POST['description'])) {
    $description = $_POST['description'];
}

if (isset($_POST['image'])) {
    $image = $_POST['image'];
}

if (isset($_POST['categoryId'])) {
    $categoryId = $_POST['categoryId'];
}   


if (isset($name) && isset($price) && isset($description) && isset($image) && isset($categoryId)) {
    $productModel = new Product();
    $productModel->addProduct($name,$price,$description,$image,$categoryId);   
    header('location:../App/View/product-management.php');
}

?>