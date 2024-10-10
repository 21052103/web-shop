<?php

class Product extends Database{
    // lấy tất cả sản phẩm
    public function getAllProducts()
    {
        //2. tạo câu SQL
        $sql = parent::$connection->prepare('SELECT * FROM `products`');
        return parent::Select($sql);
    }

    // lấy sản phẩm theo danh mục id
    public function getProductByCategoryId($id)
    {
        $sql = parent::$connection->prepare('SELECT sp.id, sp.name, sp.price, sp.description, sp.image FROM `products` sp 
        INNER JOIN catrgory_product cp on sp.id=cp.product_id 
        INNER JOIN categories c on c.id=cp.category_id WHERE c.id=?');
        $sql->bind_param('i',$id);
        return parent::Select($sql);
    }

    // chi tiết sản phẩm
    public function getProductById($id)
    {
        // 2. Tạo câu SQL   
        $sql = parent::$connection->prepare('SELECT * FROM `products` WHERE `id` = ?');
        $sql->bind_param('i',$id);
        return parent::Select($sql)[0]; 
    }

    // tìm sản phẩm
    public function search($keyword)
    {
        $keyword = "%{$keyword}%";
        $sql = parent::$connection->prepare('SELECT * FROM `products` WHERE `name` like ?');
        $sql->bind_param('s',$keyword);
        return parent::Select($sql);
    }

    // thêm sản phẩm
    public function addProduct($name,$price,$description,$image,$caterogyId)
    {
        $sql = parent::$connection->prepare('INSERT INTO `products` (`name`,`price`,`description`,`image`) VALUES  (?,?,?,?)');
        $sql->bind_param('siss',$name,$price,$description,$image);
        $sql->execute();
        $Id = parent::$connection->insert_id;       
        $sql = self::$connection->prepare('INSERT INTO `catrgory_product` (`product_id`,`category_id`) VALUES (?,?)');
        $sql->bind_param('ii',$Id,$caterogyId); 
        $sql->execute();
    }

    // xóa sản phẩm
    public function deleteProduct($Id)
    {
        // xóa sản phẩm
        $sql = parent::$connection->prepare('DELETE FROM `products` WHERE `id` = ?');
        $sql->bind_param('i',$Id);
        $sql->execute();
    }

    // Sửa sản phẩm
    public function updateProduct($id,$name,$price,$description,$image,$caterogyId)
    {
        // 2. Tạo cau SQL
        $sql = parent::$connection->prepare('UPDATE `products` SET `name` = ? , `price` = ?, `description` = ?,`image` =? WHERE `id` = ?');
        $sql->bind_param('sissi',$name,$price,$description,$image,$id);
        $sql->execute();
        // xóa danh mục sp cũ
        $sql = parent::$connection->prepare('DELETE FROM `catrgory_product` WHERE product_id = ?');
        $sql->bind_param('i',$id);
        $sql->execute();
        // thêm danh mục mới
        foreach ($caterogyId as $category) {
            $sql = parent::$connection->prepare('INSERT INTO `catrgory_product`(`product_id`,`category_id`) VALUES (?,?)');
            $sql->bind_param('ii',$id,$category);
            $sql->execute();
        }
    }

    // like sản phẩm
    public function addlike($like)
    {
        $sql = parent::$connection->prepare('UPDATE `products` SET likes = likes + 1 WHERE id = ?');
        $sql->bind_param('i',$like);
        $sql->execute();
        $sql = parent::$connection->prepare('SELECT `likes` FROM `products` WHERE id = ?');
        $sql->bind_param('i',$like);
        return parent::Select($sql)[0];
    }

    // tìm kiếm phân trang
    public function searchPaging($keyword, $currentPage, $perPage)
    {
        $keyword = "%{$keyword}%";
        // tính số thức tự record bắt đầu
        $startRecord = ($currentPage - 1) * $perPage;
        // dùng LIMIT để giới hạn số lượng hiển thị 1 trang 
        $sql = parent::$connection->prepare('SELECT * FROM `products` WHERE `name` LIKE ? LIMIT ?, ?');
        $sql->bind_param('sii', $keyword, $startRecord, $perPage);
        return parent::select($sql);
    }

    // phương thuc viết phân trang 1 2 3
    public function getPaginationBar($url, $total, $perPage)
    {
        $totalLinks = ceil($total / $perPage);
        $link = "";
        for ($j = 1; $j <= $totalLinks; $j++) {
            $link = $link . "<a href='$url&page=$j'> $j </a>";
        }
        return $link;
    }


}



?>