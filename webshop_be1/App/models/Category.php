<?php

class Category extends Database{
    // lấy tất cả danh mục
    public function getAllCategories()
    {
        $sql = parent::$connection->prepare('SELECT * FROM `categories` ');
        return parent::Select($sql);
    }

    // lấy danh mục theo sản phẩm
    public function getCategoryByProductId($id)
    {
        $sql = parent::$connection->prepare('SELECT c.id FROM `categories` c 
        INNER JOIN catrgory_product cp ON c.id=cp.category_id 
        INNER JOIN products p ON p.id=cp.product_id WHERE p.id = ?');
        $sql->bind_param('i',$id);
        return parent::Select($sql);
    }

    // lấy tất cả danh mục của 1 sản phẩm
    public function getCategoryById($id)
    {
        $sql = parent::$connection->prepare('SELECT * FROM `categories` WHERE id = ?');
        $sql->bind_param('i',$id);
        return parent::Select($sql)[0];
    }

    // thêm danh mục
    public function addCategory($name,$description)
    {
        $sql = parent::$connection->prepare('INSERT INTO `categories` (`name`,`description`) VALUES (?,?)');
        $sql->bind_param('ss',$name,$description);
        $sql->execute();
    }

    // xóa danh mục
    public function deleteCategory($id)
    {
        $sql = parent::$connection->prepare('DELETE FROM `categories` WHERE id = ?');
        $sql->bind_param('i',$id);
        $sql->execute();
    }

    // sửa danh mục
    public function updateCategory($id,$name,$description)
    {
        $sql = parent::$connection->prepare('UPDATE `categories` Set `name` = ? , `description` = ? WHERE id = ?');
        $sql->bind_param('ssi',$name,$description,$id);
        $sql->execute();
    }
}




?>