<?php

require '../config/database.php';


$name = '';
$description = '';


if (isset($_POST['name'])) {
    $name = $_POST['name'];
}

if (isset($_POST['description'])) {
    $description = $_POST['description'];
}


/*

if (!empty($ten) && !empty($gia) && !empty($mota) && !empty($hinh)) {
    $sanpham_db = new Sanpham_db();
    $sanpham_db->themSanPham($ten, $gia, $mota, $hinh, $danhmucId);
    header('location:../View/quanlysanpham.php');
}
*/
if (isset($name) && isset($description)) {
    $categoryModel = new Category();
    $categoryModel->addCategory($name, $description);
    header('location:../App/View/category-management.php');
}
