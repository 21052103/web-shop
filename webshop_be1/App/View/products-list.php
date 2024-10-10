<?php

require '../../config/database.php';
$productModel = new Product();
$allProduct = $productModel->getAllProducts();

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Trang chu</title>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
</head>

<body>
    <div class='sanpham'>
        <?php
        foreach ($allProduct as $product) {
            
        ?>
        <img src='./image/<?php echo $product['image'] ?>' style = "width: 200px;">
        <h2><a href='#'><?php echo $product['name'] ?></a></h2> 
        <b>Giá: </b> <span class='gia' style = "color: green"><?php echo $product['price'] ?></span><br>
        <p><?php echo $product['description'] ?></a></p>
        <?php
        }
        ?>
    </div>

</body>

</html>