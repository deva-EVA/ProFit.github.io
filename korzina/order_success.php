<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Заказ успешно оформлен</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<?php require "../block/header.php"?>
<div class="container text-center my-5">
    <h2>Заказ успешно оформлен!</h2>
    <p>Спасибо за вашу покупку. Мы обработаем ваш заказ в ближайшее время.</p>
    <button class="button mb-2" onclick="window.location.href='../index.php'">На главную</button><br>
    <button class="button" onclick="window.location.href='../katalog.php'">Вернуться к покупкам</button>
</div>
<?php require "../block/footer.php"?>
</body>
</html>
