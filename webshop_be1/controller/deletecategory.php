<?php

require '../config/database.php';


if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $categoryModel = new Category();
    if ($categoryModel->deleteCategory($id)) {
        $_SESSION['alert'] = 'Deleted successfully!!!';
    } else {
        $_SESSION['alert'] = 'Deleted failed!!!';
    }
    header('location:../App/View/category-management');
}
