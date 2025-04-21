<?php
session_start();
require 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productId = $_POST['product_id'];
    $orderId = $_POST['order_id']; 
    $stmt = $db->prepare("DELETE FROM orders WHERE id = :id AND product_id = :product_id");
    if ($stmt->execute(['id' => $orderId, 'product_id' => $productId])) {
        header("Location: view_orders.php?message=Товар удален");
    } else {
        header("Location: view_orders.php?error=Не удалось удалить товар");
    }
    exit;
    file_put_contents('log.txt', "Attempting to delete Order ID: $orderId, Product ID: $productId\n", FILE_APPEND);
}
?>
