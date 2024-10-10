<?php
require_once '../config/database.php';


$userModel = new User();

if (isset($_POST['username'])) {
    $username = $_POST['username'];
}
if (isset($_POST['password'])) {
    $password = $_POST['password'];
}
if (isset($_POST['email'])) {
    $email = $_POST['email'];
}
var_dump($userModel);
if (!empty($username) && !empty($password) && !empty($email)) {
    $encryp = password_hash($password, PASSWORD_DEFAULT);
    if ($userModel->dangky($username,  $encryp, $email)) {
        header('location: ../Login/login.php');
    }
}
