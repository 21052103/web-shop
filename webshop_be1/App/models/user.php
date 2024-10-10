<?php

class User extends DataBase
{
    public function dangnhap()
    {
        $sql = parent::$connection->prepare('SELECT * FROM `users` ');
        return parent::select($sql);
    }
    public function logout()
    {
    }
    public function phanquyen($id)
    {
        $sql = parent::$connection->prepare('SELECT r.id FROM `roles` r 
        INNER JOIN `user_role` ur ON r.id=ur.role_id 
        JOIN `products` p WHERE p.id=ur.user_id AND p.id = ?');
        $sql->bind_param('i', $id);
        return parent::select($sql)['id'];
    }
    /*
    public function dangky($taikhoan, $matkhau, $email)
    {
        $sql = parent::$connection->prepare('INSERT INTO `nguoidung` (`taikhoan`,`matkhau`,`email`) VALUES (?,?,?)');
        $sql->bind_param('sss', $taikhoan, $matkhau, $email);
        $sql->execute();
        $insertedUser = parent::$connection->insert_id;
        $phanquyen_ma = 2;
        $sql = parent::$connection->prepare('INSERT INTO `nguoidung_phanquyen` (`nguoidung_ma`,`phanquyen_ma`) VALUES (?, ?) ');
        $sql->bind_param('ii', $insertedUser, $phanquyen_ma);
        return $sql->execute();
    }
    */


    public function dangky($username, $password, $email)
    {
        $sql = parent::$connection->prepare('INSERT INTO `users`(`username`, `password`, `email`) VALUES (?,?,?)');
        $sql->bind_param('sss', $username, $password, $email);
        $sql->execute();
        $insertedUser = parent::$connection->insert_id;
        $role_id = 2;
        $sql = parent::$connection->prepare('INSERT INTO `user_role` (`user_id`,`role_id`) VALUES (?, ?) ');
        $sql->bind_param('ii', $insertedUser, $role_id);
        return $sql->execute();
    }

    /*
    public function login($username, $password)
    {
        $sql = parent::$connection->prepare('SELECT * FROM `nguoidung` WHERE taikhoan = ?');
        $sql->bind_param('s', $username);
        $user = parent::select($sql)[0];
        if (password_verify($password, $user['matkhau'])) {
            return $user;
        }
        return false;
    }
    */
}
