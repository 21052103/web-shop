<?php
require '../../../config/database.php';

$categoryModel = new Category();
$allCategory = $categoryModel->getAllCategories();

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
        <h1>Create a product</h1>
        <form action="../../../controller/create-result.php" class="form" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Tên</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Giá</label>
                <input type="text" class="form-control" id="price" name="price">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">mô tả</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">hình</label>
                <input type="text" class="form-control" id="image" name="image">
            </div>
            <div class="mb-3 text-light">
                <label for="productImage" class="form-label">Image</label>
                <input type="file" class="form-control" id="productImage" name="productImage[]" multiple>
            </div>
            <?php
            foreach ($allCategory as $category) :
            ?>
                <div class="form-check text-light ">
                    <input class="form-check-input" type="checkbox" value="<?php echo $category['id'] ?>" id="category_<?php echo $category['id'] ?>" name="categoryId">
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
    <script src="../js/scripts.js"></script> <!-- Chỉnh lại đường dẫn -->
</body>

</html>