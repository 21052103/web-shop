<?php

require_once '../config/database.php';

if (isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];

    // Lấy thông tin sản phẩm từ giỏ hàng
    if (isset($_SESSION['cart'][$productId])) {
        $product = $_SESSION['cart'][$productId];

        try {
            $db = new Database(); // Khởi tạo đối tượng Database
            $db->beginTransaction(); // Bắt đầu giao dịch

            // Lưu thông tin đơn hàng
            $sqlOrder = "INSERT INTO orders (user_id, total_amount) VALUES (?, ?)";
            $stmtOrder = $db->prepare($sqlOrder);
            $userId = $_SESSION['user_id']; // Lấy user_id từ session
            $totalAmount = $product['price']; // Giá sản phẩm
            $stmtOrder->bind_param('id', $userId, $totalAmount);
            $stmtOrder->execute();
            $orderId = $stmtOrder->insert_id;

            // Lưu thông tin sản phẩm trong đơn hàng
            $sqlOrderProduct = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
            $stmtOrderProduct = $db->prepare($sqlOrderProduct);
            $quantity = 1; // Giả sử mỗi sản phẩm có số lượng là 1
            $stmtOrderProduct->bind_param('iiid', $orderId, $product['id'], $quantity, $product['price']);
            $stmtOrderProduct->execute();

            // Hoàn tất giao dịch
            $db->commit();

            // Hiển thị thông báo thanh toán thành công
            echo "<div class='container text-light'>";
            echo "<h1>Your cart</h1>";
            echo "<div class='row mt-3'>";
            echo "<div class='col-md-3'>";
            echo "<img class='img-fluid' src='../App/View/image/" . $product['image'] . "' alt='' style='width: 100px;'>";
            echo "</div>";
            echo "<div class='col-md-6'>";
            echo "<p><strong>" . $product['name'] . "</strong></p>";
            echo "<p class='fs-4'><strong>Price:</strong> " . $product['price'] . " VND</p>";
            echo "<p class='fs-4'><strong>Description:</strong> " . $product['description'] . "</p>";
            echo "</div>";
            echo "</div>";
            echo "<hr>";
            echo "<p class='text-success'>Thanh toán thành công. Tổng cộng: " . $totalAmount . " VND</p>";
            echo "</div>";
            echo '<a href="../index.php" class="btn btn-primary">Quay lại trang chủ</a>';

            // Xóa sản phẩm khỏi giỏ hàng sau khi thanh toán
            unset($_SESSION['cart'][$productId]);

        } catch (Exception $e) {
            // Hủy giao dịch nếu có lỗi xảy ra
            $db->rollback();
            echo "There was an error processing your payment. Please try again.";
        }
    } else {
        echo "<p>Product not found in your cart.</p>";
    }
} else {
    echo "<p>Invalid request.</p>";
}
?>

