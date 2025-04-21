<?php
session_start();
include '../admin/db.php'; 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['place_order'])) {
    $products = $_POST['product_id'];
    $quantities = $_POST['product_quantity'];
    $totalPrices = $_POST['total_price'];
    $customerName = $_POST['firstName'];
    $customerEmail = $_POST['email'];
    $customerPhone = $_POST['phone'];
    if (!empty($products)) {
        foreach ($products as $index => $productId) {
            $stmt = $db->prepare("INSERT INTO orders (product_id, quantity, total_price, customer_name, customer_email, customer_phone, order_date) VALUES (?, ?, ?, ?, ?, ?, NOW())");
            $stmt->execute([$productId, $quantities[$index], $totalPrices[$index], $customerName, $customerEmail, $customerPhone]);
        }
        unset($_SESSION['cart']);
        header("Location: order_success.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Оформление заказа</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<?php require "../block/header.php"; ?>
<h2>Оформление заказа</h2>
<div class="container">
    <form class="needs-validation" method="post">
        <div class="col-12">
            <label for="firstName" class="form-label">ФИО</label>
            <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Введите ваше ФИО" required>
            <div class="invalid-feedback">Требуется действительное имя.</div>
        </div>
        <div class="col-12">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Введите вашу электронную почту" required>
            <div class="invalid-feedback">Пожалуйста, введите действительный адрес электронной почты.</div>
        </div>
        <div class="col-12">
    <label for="phone" class="form-label">Телефон</label>
    <input type="text" class="form-control" id="phone" name="phone"  minlength="11" maxlength="11"
           placeholder="Введите ваш телефон" required>
    <div class="invalid-feedback">Пожалуйста, введите ваш телефон.</div>
</div>
<div class="my-3">
<label for="oplata" class="form-label">Оплата</label>
    <div class="form-check">
        <input id="credit" name="paymentMethod" type="radio" class="form-check-input" checked="" required>
        <label class="form-check-label" for="credit">Кредитная карта</label>
  </div>
     <div class="form-check">
        <input id="debit" name="paymentMethod" type="radio" class="form-check-input" required>
        <label class="form-check-label" for="debit">Дебетовая карта</label>
  </div>
     <div class="form-check">
        <input id="paypal" name="paymentMethod" type="radio" class="form-check-input" required>
        <label class="form-check-label" for="paypal">PayPal</label>
  </div>
</div>
    <div class="col-12">
        <label for="email" class="form-label">Номер карты</label>
        <input type="text" class="form-control" id="cc-number" minlength="16" maxlength="16"placeholder="0000 0000 0000 0000" required>
    <div class="invalid-feedback">Требуется номер кредитной карты </div>
</div>
     <div class="col-12">
    <label for="cc-expiration" class="form-label">Срок действия карты</label>
    <input type="text" class="form-control" id="cc-expiration" placeholder="ММ/ГГ" required>
    <div class="invalid-feedback">Требуется дата истечения срока действия</div>
    </div>
     <div class="col-12">
        <label for="cc-cvv" class="form-label">CVV</label>
        <input type="text" class="form-control" id="cc-cvv"name="CVV" minlength="3" maxlength="3"  placeholder="Введите CVV" required>
    <div class="invalid-feedback">
      Требуется код безопасности
    </div>
  </div>
</div>
<?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
    <?php foreach ($_SESSION['cart'] as $productId => $item): ?>
        <input type='hidden' name='product_id[]' value='<?php echo htmlspecialchars($productId); ?>'>
        <input type='hidden' name='product_name[]' value='<?php echo htmlspecialchars($item["name"]); ?>'>
        <input type='hidden' name='product_quantity[]' value='<?php echo htmlspecialchars($item["quantity"]); ?>'>
        <input type='hidden' name='total_price[]' value='<?php echo htmlspecialchars($item["price"] * $item["quantity"]); ?>'>
    <?php endforeach; ?>
<?php else: ?>
    <p>Корзина пуста. Пожалуйста, добавьте товары.</p>
<?php endif; ?>
<div class="text-center my-4">
    <button class='button' type='submit' name='place_order'>Оформить</button>
</div>
    </form>
</div>
<?php require "../block/footer.php"; ?>
<script src="../js/valid.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
