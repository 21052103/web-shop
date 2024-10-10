<?php
require '../../../../config/database.php';

$categoryModel = new Category();
//$alldanhmuc = $danhmuc_db->layTatCaDanhMuc();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $CategoryId = $categoryModel->getCategoryById($id);
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/admin-style.css">
    

</head>

<body>
    <div class="container">
        <h1>Update a Danh muc</h1>
        <form action="../../../../controller/editcategory-result.php" class="form" method="post" enctype="multipart/form-data">
            <div class="mb-3">

                <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $CategoryId['id']; ?>">
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Tên</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $CategoryId['name']; ?>">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Ghi Chu</label>
                <input type="text" class="form-control" id="description" name="description" value="<?php echo $CategoryId['description']; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>