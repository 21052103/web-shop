        <?php

        require '../../config/database.php';
        $productModel = new Product();

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $productId = $productModel->getProductById($id);
        }

        ?>
        <!DOCTYPE html>
        <html>

        <head>
            <meta charset="utf-8">
            <title>Detail</title>
            <link rel="stylesheet" type="text/css" href="public/css/style.css">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        </head>

        <body>
            <div class='sanpham'>
                <img src='./image/<?php echo $productId['image'] ?> ' style ="width: 200px">
                <h2><?php echo $productId['name'] ?></h2>
                <b>Giá: </b> <span class='gia'><?php echo $productId['price'] ?></span><br>
                <p><?php echo $productId['description'] ?></p>
                
            <div class="col-md">
                <div class="d-grid gap-2 mt-5">
                    <a href="../../cart/checkout.php?id=<?php echo $productId['id'] ?>" class="btn btn-outline-dark" type="submit">Mua ngay</a>
                    <br>
                    <a href="product-cart.php?id=<?php echo $productId['id'] ?>" class="btn btn-outline-primary" type="submit">Thêm vào giỏ</a>
                </div>
            </div>
            <!-- Bootstrap core JS-->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
            <!-- Core theme JS-->
            <script src="js/scripts.js"></script>
        </body>

        </html>