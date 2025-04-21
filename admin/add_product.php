<?php
session_start();
$message = isset($_SESSION['success_message']) ? $_SESSION['success_message'] : ''; 
if (!empty($message)) {
    unset($_SESSION['success_message']); 
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавление товара</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="d-flex flex-column min-vh-100">
<header>
    <div class="container_block">
        <header class="d-flex flex-wrap align-items-center justify-content-between py-1 border-bottom" style="background-color: white;">
            <h2 class="ms-5">ProFit</h2> 
            <div class="col-md-3 text-end">
            <div>
            <button id="exitButton" class="contentBTN me-3" onclick="window.location.href='view_orders.php';">Заказы</button>
            <button id="exitButton" class="contentBTN me-3" onclick="window.location.href='delete_tovar.php';">Удаление товара</button>
                <button id="exitButton" class="contentBTN me-3" onclick="window.location.href='../index.php';">Выход</button>
            </div>
            </div>
        </header>
    </div>
    <div class="container mt-5">
        <h2>Добавление товара</h2>
        <form id="addProductForm" method="POST" action="process_add_product.php" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="product_id" class="form-label">Product ID</label>
                <input type="number" class="form-control" id="product_id" name="product_id" required>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Название товара</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="id_tovar" class="form-label">ID Товара</label>
                <input type="number" class="form-control" id="id_tovar" placeholder="введите 1 или 2" name="id_tovar" required>
            </div>
            <div class="mb-3">
                <label for="img" class="form-label">Изображение товара</label>
                <input type="file" class="form-control" id="img" name="img" accept=".jpg,.jpeg,.png,.gif" required>
            </div>
            <div class="mb-3">
                <label for="text" class="form-label">Описание товара</label>
                <textarea class="form-control" id="text" name="text" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="button" class="form-label">Кнопка</label>
                <input type="text" class="form-control" id="button" name="button" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Цена</label>
                <input type="number" step=".01" class="form-control" id="price" name="price" required>
            </div>

            <div class="container text-center">
            <button type='submit' class='contentBTN me-3 mb-3'>Добавить товар</button>
</div>
        </form>
        <div class='modal' id='responseModal'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h5>Результат отправки</h5>
                    <span type="button" id="closeModal" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></span>
                    </div>
                    <div class='modal-body text-center'>
                        <?= htmlspecialchars($message); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js'></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    <?php if (!empty($message)): ?>
        let modal = new bootstrap.Modal(document.getElementById('responseModal'));
        modal.show();
    <?php endif; ?>
});
</script>
</body>
</html>
