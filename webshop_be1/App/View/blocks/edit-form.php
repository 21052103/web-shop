<?php
require '../../../config/database.php';

$categoryModel = new Category();
$allCategory = $categoryModel->getAllCategories();
$productModel = new Product();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $productId = $productModel->getProductById($id);
    $categoryId = $categoryModel->getCategoryByProductId($id);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/admin-style.css">

</head>

<body>
    <div class="container">
        <h1>Update a product</h1>
        <form action="../../../controller/edit-result.php" class="form" method="post" enctype="multipart/form-data">
            <div class="mb-3">

                <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $productId['id']; ?>">
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Tên</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $productId['name']; ?>">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Giá</label>
                <input type="text" class="form-control" id="price" name="price" value="<?php echo $productId['price']; ?>">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">mô tả</label>
                <textarea class="form-control" id="description" name="description"> <?php echo $productId['description']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">hình</label>
                <input type="text" class="form-control" id="image" name="image" value="<?php echo $productId['image']; ?>">
            </div>
            <?php
            foreach ($allCategory as $category) :

            ?>

                <div class="form-check text-light ">
                    <input class="form-check-input" type="checkbox" value="<?php echo $category['id'] ?>" id="category_<?php echo $category['id'] ?>" name="danhmucId[]" <?php foreach ($categoryId as $id) {
                                                                                                                                                                            if ($id['id'] == $category['id']) {

                                                                                                                                                                                echo 'checked';
                                                                                                                                                                            }
                                                                                                                                                                        } ?>>
                    <label class="form-check-label" for="category_<?php echo $category['id'] ?>">
                        <?php echo $category['name'] ?>
                    </label>
                </div>
            <?php

            endforeach;
            ?>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>