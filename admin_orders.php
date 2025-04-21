<?php
session_start();
include  '../admin/db.php';
$stmt = $db->query("SELECT * FROM orders ORDER BY order_date DESC");
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Заказы</title>
</head>
<body>
<h2>Список заказов</h2>
<table styleborder="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Товар ID</th>
            <th>Количество</th>
            <th>Итого</th>
            <th>Имя клиента</th>
            <th>Email клиента</th>
            <th>Телефон клиента</th>
            <th>Адрес</th>
            <th>Дата заказа</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($orders as $order): ?>
            <tr>
                <td><?php echo htmlspecialchars($order['id']); ?></td>
                <td><?php echo htmlspecialchars($order['product_id']); ?></td>
                <td><?php echo htmlspecialchars($order['quantity']); ?></td>
                <td><?php echo htmlspecialchars($order['total_price']); ?> ₽</td>
                <td><?php echo htmlspecialchars($order['customer_name']); ?></td>
                <td><?php echo htmlspecialchars($order['customer_email']); ?></td>
                <td><?php echo htmlspecialchars($order['customer_phone']); ?></td>
                <td><?php echo htmlspecialchars($order['address']); ?></td>
                <td><?php echo htmlspecialchars($order['order_date']); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</body>
</html> 
