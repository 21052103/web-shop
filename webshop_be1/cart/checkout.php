<?php

require '../config/database.php';

$conn = Database::getConnection();

// Kiểm tra giỏ hàng
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $totalAmount = 0;

    foreach ($_SESSION['cart'] as $product) {
        $totalAmount += $product['price'];
    }

    // Lưu thông tin đơn hàng vào cơ sở dữ liệu
    try {
        // Bắt đầu giao dịch
        $conn->begin_transaction();

        // Lưu thông tin đơn hàng
        $sqlOrder = "INSERT INTO orders (user_id, total_amount) VALUES (?, ?)";
        $stmtOrder = $conn->prepare($sqlOrder);
        $userId = $_SESSION['user_id'];
        $stmtOrder->bind_param('id', $userId, $totalAmount);
        $stmtOrder->execute();
        $orderId = $stmtOrder->insert_id;

        // Lưu thông tin sản phẩm trong đơn hàng
        $sqlOrderProduct = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
        $stmtOrderProduct = $conn->prepare($sqlOrderProduct);

        foreach ($_SESSION['cart'] as $product) {
            $productId = $product['id'];
            $quantity = 1; // Giả định mỗi sản phẩm có số lượng là 1
            $price = $product['price'];
            $stmtOrderProduct->bind_param('iiid', $orderId, $productId, $quantity, $price);
            $stmtOrderProduct->execute();
        }

        // Hoàn tất giao dịch
        $conn->commit();

        // Hiển thị thông báo thanh toán thành công
        $message = "Tổng số tiền thanh toán: " . number_format($totalAmount, 0, ',', '.') . " VND";
        $alertType = "success";

        // Xóa giỏ hàng sau khi thanh toán
        unset($_SESSION['cart']);
    } catch (Exception $e) {
        // Hủy giao dịch nếu có lỗi xảy ra
        $conn->rollback();
        $message = "Có lỗi xảy ra trong quá trình thanh toán. Vui lòng thử lại.";
        $alertType = "danger";
    }
} else {
    $message = "Giỏ hàng của bạn trống.";
    $alertType = "warning";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="alert alert-<?php echo $alertType; ?>" role="alert">
        <?php echo $message; ?>
    </div>
    <a href="../index.php" class="btn btn-primary">Quay lại trang chủ</a>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
