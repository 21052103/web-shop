<?php

require '../config/database.php';

$id = '';
$name = '';
$description = '';


if (isset($_POST['name'])) {
    $name = $_POST['name'];
}
if (isset($_POST['id'])) {
    $id = $_POST['id'];
}
if (isset($_POST['description'])) {
    $description = $_POST['description'];
}

if (isset($name) && isset($description)) {
    $categoryModel = new Category();
    $categoryModel->updateCategory($id, $name, $description);
    header('location:../App/View/category-management');
}
