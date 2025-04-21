
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ-сервис</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="d-flex flex-column min-vh-100">
<header>
    <div class="container_block">
        <header class="d-flex flex-wrap align-items-center justify-content-between py-1 border-bottom" style="background-color: white;">
            <h2 class="ms-5">ProFit</h2> 
            <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
            <div class="col-md-3 text-end">
            <button class="contentBTN me-3" onclick="window.location.href='../index.php';">Выход</button>
            </div>
        </header>
    </div>
       <h2>Сервисная панель</h2>
    <div class="d-flex justify-content-center mb-3">
    <button id="exitButton" class="contentBTN me-3" onclick="window.location.href='view_orders.php';">Заказы</button>
    <button id="exitButton" class="contentBTN me-3" onclick="window.location.href='add_product.php';">Добавление товара</button>
    <button id="exitButton" class="contentBTN me-3" onclick="window.location.href='delete_tovar.php';">Удаление товара</button>
</div>
</header>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
</body>
</html>
