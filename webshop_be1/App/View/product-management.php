<?php
require '../../config/database.php';

$productModel = new Product();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../View/css/form.css">

</head>

<body>
    <h1>Quản Lý Sản Phẩm</h1>

    <form action="./blocks/create-form.php" method="get">
        <button type="submit" class="addproduct">Thêm Sản Phẩm</button>
    </form>
    <form action="category-management.php" method="get">
        <button type="submit" class="management">trang quản lý danh mục</button>
    </form>

    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Mã SP</th>
                    <th scope="col">Tên SP</th>
                    <th scope="col">Giá SP</th>
                    <th scope="col">Mô tả</th>
                    <th scope="col">Hình</th>
                    <th scope="col">Thao Tác</th>
                </tr>
            </thead>
            <tbody>
                <?php $allProduct = $productModel->getAllProducts();
                foreach ($allProduct as $product) {
                ?>
                    <tr>
                        <td scope="col"><?php echo $product['id']; ?></td>
                        <td scope="col"><?php echo $product['name']; ?></td>
                        <td scope="col"><?php echo $product['price']; ?></td>
                        <td scope="col"><?php echo $product['description']; ?></td>
                        <td scope="col"><?php echo $product['image']; ?></td>
                        <td scope="col">
                            <form action="../../controller/delete-result.php" method="post" onsubmit="return confirm('Do you want to delete?')">
                                <button type="submit" class="btn btn-danger" name="productId" value="<?php echo $product['id'] ?>">Delete</button>
                            </form> 
                            <a href="../../App/View/blocks/edit-form.php?id=<?php echo $product['id'] ?>" class="btn btn-warning">Edit</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>

</html>