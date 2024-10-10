<?php
require '../../config/database.php';

$categoryModel = new Category();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../View/css/f.css">
    

</head>

<body>
    <h1>Quản Lý danh mục</h1>

    <form action="../View/blocks/category/create-form.php" method="get">
        <button type="submit" class="adddcategory">Thêm Danh Mục</button>
    </form>

    <form action="../../controller/logout.php"> 
        <button type="submit">logout</button>
    </form>

    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Mã danh mục</th>
                    <th scope="col">Tên danh mục</th>
                    <th scope="col">Ghi chú</th>
                    <th scope="col">Thao Tác</th>
                </tr>
            </thead>
            <tbody>
                <?php $dssp = $categoryModel->getAllCategories();
                foreach ($dssp as $category) {
                ?>
                    <tr>
                        <td scope="col"><?php echo $category['id']; ?></td>
                        <td scope="col"><?php echo $category['name']; ?></td>
                        <td scope="col"><?php echo $category['description']; ?></td>
                        <td scope="col">
                            <form action="../../controller/deletecategory.php" method="post" onsubmit="return confirm('Do you want to delete?')">
                                <button type="submit" class="btn btn-danger" name="id" value="<?php echo $category['id']  ?>">Delete</button>
                            </form>
                            <a href="../View/blocks/category/edit-form.php?id=<?php echo $category['id'] ?>" class="btn btn-warning">Edit</a>
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