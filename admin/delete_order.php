<?php
session_start();
require 'db.php'; 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $orderDate = $_POST['order_date'];
    $stmt = $db->prepare("DELETE FROM orders WHERE order_date = :order_date");
    if ($stmt->execute(['order_date' => $orderDate])) {
        header("Location: view_orders.php?message=Все заказы на это время удалены");
    } else {
        header("Location: view_orders.php?error=Не удалось удалить заказы");
    }
    exit;
}
?>
