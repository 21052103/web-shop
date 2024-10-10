<?php

require '../../config/database.php';
$productModel = new Product();
$categoryModel = new Category();
if (isset($_GET['q'])) {
    $q = $_GET['q'];
}
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}else {
    $page = 1;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Shop Homepage - Start Bootstrap Template</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <link href="./App/View/css/search.css" rel="stylesheet" />

</head>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="#!">Start Bootstrap</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="../../index.php" class="home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="../../index.php">All Products</a></li>
                            <?php
                            $allCategory = $categoryModel->getAllCategories();
                            foreach ($allCategory as $category) {

                            ?>
                                <li><a class="dropdown-item" href="./App/View/category.php?id=<?php echo $category['id'] ?>"><?php echo $category['name'] ?></a></li>
                            <?php
                            }
                            ?>
                        </ul>
                    </li>
                    <!-- Search Form -->    
                    <li>
                        <form action="product-search.php" class="d-flex" role="search" method='get'>
                            <input class="form-control me-2" type="search" name="q" placeholder="Search products.." aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </li>
                </ul>
                <form class="d-flex">
                    <button class="btn btn-outline-dark" type="submit">
                        <i class="bi-cart-fill me-1"></i>
                        Cart
                        <span class="badge bg-dark text-white ms-4 rounded-pill">0</span>
                    </button>
                </form>
            </div>
        </div>
    </nav>
    <!-- Header-->
    <header class="bg-info py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Store Lanh <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-calendar-heart" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4zM1 14V4h14v10a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1m7-6.507c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132" />
                </svg></h1>
                <p class="lead fw-normal text-white-50 mb-0">Lovely and friendly modern shop</p>
            </div>
        </div>
    </header>
    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php
                // Ktra nếu không tìm kiếm sẽ không có sản phẩm
                if ($q == '') {
                    echo 'Vui Lòng Nhập Vào Để Tìm Kiếm';
                }else {
                    
               
                $allProduct = $productModel->search($q);
                $allProductPage = $productModel->searchPaging($q,$page,PER_PAGE);
                //echo "<h3> tong san pham tim duoc". " " . sizeof($allSanPham2)." </h3>";
                foreach ($allProductPage as $product) {
                ?>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="./image/<?php echo $product['image'] ?>" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?php echo $product['name']  ?></h5>
                                    <!-- Product price-->
                                    <?php echo $product['price']  ?>
                                    <br>
                                    <label for="description">mô tả: <?php echo $product['description']  ?></label>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-primary mt-auto" href="../View/product-detail.php?id=<?php echo $product['id']  ?>">
                                        chi tiết sản phẩm</a></div>
                            </div>
                        </div>
                    </div>
                <?php
                 }
                }
                ?>
            </div>
            <?php
            //hiển thị thanh phân trang trang
            $total = sizeof($allProduct);
            $url= $_SERVER['PHP_SELF']."?q=".$q; //Lưu ý tìm kiem1 từ khóa và phân trang
            echo $productModel -> getPaginationBar($url, $total,PER_PAGE );
                
            ?>
        </div>
    </section>
    <!-- Footer-->
    <footer class="py-5 bg-info">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>