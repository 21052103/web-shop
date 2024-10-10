<?php

require '../../config/database.php';

$productModel = new Product();

if (isset($_GET['id'])) {
    $productId = $_GET['id'];
    $productCart = $productModel->getProductById($productId);

    // Nếu giỏ hàng đã tồn tại trong session, thêm sản phẩm mới vào mảng giỏ hàng
    if (isset($_SESSION['cart'])) {
        $_SESSION['cart'][] = [
            'id' => $productCart['id'],
            'name' => $productCart['name'],
            'price' => $productCart['price'],
            'description' => $productCart['description'],
            'image' => $productCart['image']
        ];
    } else {
        // Nếu giỏ hàng chưa tồn tại, tạo giỏ hàng mới
        $_SESSION['cart'] = [
            [
                'id' => $productCart['id'],
                'name' => $productCart['name'],
                'price' => $productCart['price'],
                'description' => $productCart['description'],
                'image' => $productCart['image']
            ]
        ];
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../public/css/style.css">
</head>

<body>
    <div class="container text-light">
        <h1>Your cart</h1>
        <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) : ?>
            <?php foreach ($_SESSION['cart'] as $key => $product) : ?>
                <div class="row mt-3">
                    <div class="col-md-3">
                        <img class="img-fluid" src="../View/image/<?php echo $product['image']; ?>" alt="" style="width: 100px;">
                    </div>
                    <div class="col-md-3">
                        <p><?php echo $product['name']; ?></p>
                        <p class="fs-4"><?php echo $product['price']; ?></p>
                        <p class="fs-4"><?php echo $product['description']; ?></p>
                    </div>
                    <form action="../../cart/checkout-single.php" method="post">
                        <input type="hidden" name="product_id" value="<?php echo $key; ?>">
                        <button type="submit" name="checkout" class="btn btn-info px-5">Pay Now</button>
                    </form>

                    <div class="col-md-3">
                        <form action="../../cart/delete-cart.php" method="post">
                            <input type="hidden" name="product_id" value="<?php echo $key; ?>">
                            <button type="submit" name="delete_cart" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                    <hr>
                </div>
            <?php endforeach; ?>
            <form action="../../cart/checkout.php" method="post">
                <button type="submit" name="checkout" class="btn btn-info ms-5 me-3 px-5">Pay ALL</button>
            </form>
            <span class="fs-3">Total :</span>
        <?php else : ?>
            <p>Your cart is empty.</p>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
</body>

</html>