<?php

require '../config/database.php';


$username = '';
$password = '';

$userModel = new User();
$userTK = $userModel->dangnhap();
if (isset($_POST['username'])) {
    $username = $_POST['username'];
}
if (isset($_POST['password'])) {
    $password = $_POST['password'];
}



foreach ($userTK as $user) {
    if (!empty($username) && !empty($password)) {
        if ($username == $user['username'] && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username']; // Lưu tên người dùng vào phiên
            // Chuyển hướng dựa trên vai trò người dùng
            if ($user['role'] == 1) {
                header('location: ../App/View/product-management.php');
            } else {
                header('location: ../index.php');
            }
        }
    }
}
