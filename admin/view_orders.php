<?php
session_start();
require 'db.php'; 
$query = "
SELECT 
    o.order_date,
    SUM(o.quantity) AS total_quantity,
    GROUP_CONCAT(k.name SEPARATOR ', ') AS product_names,
    GROUP_CONCAT(k.id SEPARATOR ', ') AS product_ids,  -- Получаем product_id
    GROUP_CONCAT(DISTINCT o.customer_name SEPARATOR ', ') AS customer_names
FROM orders o
JOIN katalog k ON o.product_id = k.product_id
GROUP BY o.order_date
ORDER BY o.order_date DESC
";
$stmt = $db->prepare($query);
$stmt->execute();
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ-сервис</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>
<header>
    <div class="container_block">
        <header class="d-flex flex-wrap align-items-center justify-content-between py-1 border-bottom" style="background-color: white;">
            <h2 class="ms-5">ProFit</h2> 
            <div>
                <button id="exitButton" class="contentBTN me-3" onclick="window.location.href='add_product.php';">Добавление товара</button>
                <button id="exitButton" class="contentBTN me-3" onclick="window.location.href='delete_tovar.php';">Удаление товара</button>
                <button id="exitButton" class="contentBTN me-3" onclick="window.location.href='../index.php';">Выход</button>
            </div>
        </header>
    </div>
</header>
<div class="container">
    <h2>Все Заказы</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Товары</th>
                <th>Количество купленных товаров</th>
                <th>Заказчики</th>
                <th>Время заказа</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
        <?php if (count($orders) > 0): ?>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?= htmlspecialchars($order['product_names']); ?></td>
                    <td><?= htmlspecialchars($order['total_quantity']); ?></td> 
                    <td><?= htmlspecialchars($order['customer_names']); ?></td>
                    <td><?= htmlspecialchars($order['order_date']); ?></td>
                    <td>
                        <form method="POST" action="delete_order.php" style="display:inline;">
                            <input type="hidden" name="order_date" value="<?= htmlspecialchars($order['order_date']); ?>">
                            <button class="btn btn-danger btn-sm">Удалить этот заказ</button>
                        </form>
                        <!-- <?php 
                        $productNames = explode(', ', $order['product_names']);
                        $productIds = explode(', ', $order['product_ids']); // Получаем массив product_ids
                        foreach ($productNames as $index => $productName): ?>
                            <form method="POST" action="delete_order_item.php" style="display:inline;">
                                <input type="hidden" name="order_id" value="<?= htmlspecialchars($order['id']); ?>" 
                                <input type="hidden" name="product_id" value="<?= htmlspecialchars($productIds[$index]); ?>">
                                <input type="hidden" name="product_name" value="<?= htmlspecialchars($productName); ?>">
                                <button class="btn btn-warning btn-sm">Удалить <?= htmlspecialchars($productName); ?></button>
                            </form><br/>
                        <?php endforeach; ?> -->
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">Нет заказов.</td> 
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
