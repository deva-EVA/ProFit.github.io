<?php
session_start();
include './admin/db.php';
if (isset($_POST['clear_cart'])) {
    unset($_SESSION['cart']);
}
if (isset($_POST['add_to_cart'])) {
    $productId = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId]['quantity'] += $quantity;
    } else {
        $stmt = $db->prepare("SELECT * FROM `katalog` WHERE product_id = :id");
        $stmt->execute(['id' => $productId]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($product) {
            $_SESSION['cart'][$productId] = [
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => $quantity,
                'img' => $product['img']
            ];
        }
    }
}
if (isset($_POST['update_quantity'])) {
    $productId = $_POST['product_id'];
    $change = ($_POST['update_quantity'] == '+1') ? 1 : -1;
    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId]['quantity'] += $change;
        if ($_SESSION['cart'][$productId]['quantity'] < 1) {
            unset($_SESSION['cart'][$productId]);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Корзина</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php require "./block/header.php"; ?>
<div class="container mt-1">
    <h2>Ваши заказы</h2>
    <?php if (empty($_SESSION['cart'])): ?>
        <div class="p-3" style="background-color: white; font-size: 20px;">
            <p>Ваша корзина пуста.</p>
        </div>
    <?php else: ?>
        <div class="border border-light p-3">
            <table class="table">
                <thead>
                    <tr>
                        <th>Товар</th>
                        <th>Количество</th>
                        <th>Цена</th>
                        <th>Итого</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                $totalAmount = 0;
                foreach ($_SESSION['cart'] as $productId => $item): 
                    $totalPrice = $item['price'] * $item['quantity'];
                    $totalAmount += $totalPrice;
                ?>
             <tr>
                 <td><?php echo htmlspecialchars($item["name"]); ?></td>
                 <td>
                     <form method="post" style="display: inline;">
                         <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($productId); ?>">
                         <button type="submit" name="update_quantity" value="-1" class="btn btn-outline-secondary btn-sm">-</button>
                         <input type="number" name="quantity" value="<?php echo htmlspecialchars($item["quantity"]); ?>" min="1" style="width: 40px; text-align: center;" readonly>
                         <button type="submit" name="update_quantity" value="+1" class="btn btn-outline-secondary btn-sm">+</button>
                     </form>
                 </td>
                 <td><?php echo htmlspecialchars($item["price"]); ?> ₽</td>
                 <td><?php echo htmlspecialchars($totalPrice); ?> ₽</td> <!-- Итоговая сумма для этого товара -->
             </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <div class="d-flex justify-content-between align-items-center">
                <h5>Общая сумма: <?php echo htmlspecialchars($totalAmount); ?> ₽</h5> 
            </div>
            <div class="d-flex justify-content-end mt-3">
                <button type="button" class="button" onclick="redirectToCheckout()">Перейти к оформлению заказа</button>
            </div>
        </div>
        <form method='post' style="margin-top: 20px;">
            <button type='submit' name='clear_cart' class='btn btn-danger'>Очистить корзину</button>
        </form>
    <?php endif; ?>
    <a href='./katalog.php' style='color: #8B4513;'>Вернуться к покупкам</a>
</div>
<?php require "./block/footer.php"; ?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
const productIds = [];
const productNames = [];
const productQuantities = [];
const totalPrices = [];
<?php if (isset($_SESSION['cart'])): ?>
    <?php foreach ($_SESSION['cart'] as $productId => $item): ?>
        productIds.push('<?php echo addslashes(htmlspecialchars(trim($productId))); ?>');
        productNames.push('<?php echo addslashes(htmlspecialchars(trim($item["name"]))); ?>');
        productQuantities.push('<?php echo (int)trim($item["quantity"]); ?>');
        totalPrices.push('<?php echo (float)trim($item["price"]) * (int)trim($item["quantity"]); ?>');
    <?php endforeach; ?>
<?php endif; ?>
function redirectToCheckout() {
    const url = new URL('../korzina/product.php', window.location.origin);
    url.searchParams.append('product_id', JSON.stringify(productIds));
    url.searchParams.append('product_name', JSON.stringify(productNames));
    url.searchParams.append('product_quantity', JSON.stringify(productQuantities));
    url.searchParams.append('total_price', JSON.stringify(totalPrices));
    window.location.href = url.toString();
}
</script>
</body>
</html>
