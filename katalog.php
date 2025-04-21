<?php
session_start();
include './admin/db.php';
$katalog = [];
if ($query = $db->query("SELECT * FROM `katalog`")) {
    $katalog = $query->fetchAll(PDO::FETCH_ASSOC);
} else {
    print_r($db->errorInfo());
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
    echo json_encode(['success' => true]);
    exit; 
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Курсы</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<?php require "./block/header.php"; ?>
<h2>КУРСЫ</h2>
<section class="courses">
    <div class="course">
        <?php foreach($katalog as $data): ?>
            <?php if ($data['id_tovar'] == 1): ?>
                <div class="card"> 
                    <img class="imgCourse" src="<?= htmlspecialchars($data['img']); ?>" alt="<?= htmlspecialchars($data['name']); ?>">
                    <h3><?= htmlspecialchars($data['name']); ?></h3>
                    <button class="infoBTN" onclick="toggleInfo(this)">Читать подробнее</button>
                    <p class="course-info" style="display: none;"><?= htmlspecialchars($data['text']); ?></p>
                    <p class="price"><?= htmlspecialchars($data['price']); ?> ₽</p>
                    <form method="post" class="add-to-cart-form" onsubmit="return false;">
                        <input type="hidden" name="product_id" value="<?= htmlspecialchars($data['product_id']); ?>">
                        <input type="number" name="quantity" value="1" min="1" style="width: 60px;">
                        <button type="button" name="add_to_cart" class="contentBTN"
                                onclick="addToCart('<?= htmlspecialchars($data['product_id']); ?>', '<?= htmlspecialchars($data['name']); ?>')">
                            <?= htmlspecialchars($data['button']); ?>  
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart2" viewBox="0 0 16 16">
                                <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l1.25 5h8.22l1.25-5zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0"/>
                            </svg> 
                        </button>
                    </form>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</section>
<h2>ПИТАНИЕ</h2>
<section class="courses">
    <div class="course">
        <?php foreach($katalog as $data): ?>
            <?php if ($data['id_tovar'] == 2): ?>
                <div class="card"> 
                    <img class="imgCourse" src="<?= htmlspecialchars($data['img']); ?>" alt="<?= htmlspecialchars($data['name']); ?>">
                    <h3><?= htmlspecialchars($data['name']); ?></h3>
                    <button class="infoBTN" onclick="toggleInfo(this)">Читать подробнее</button>
                    <p class="course-info" style="display: none;"><?= htmlspecialchars($data['text']); ?></p>
                    <p class="price"><?= htmlspecialchars($data['price']); ?> ₽</p>
                   <form method="post">
                        <input type="hidden" name="product_id" value="<?= htmlspecialchars($data['product_id']); ?>">
                        <input type="number" name="quantity" value="1" min="1" style="width:60px;">
                        <button type="button" name="add_to_cart" class="contentBTN"
                                onclick="addToCart('<?= htmlspecialchars($data['product_id']); ?>', '<?= htmlspecialchars($data['name']); ?>')">
                            <?= htmlspecialchars($data['button']); ?>  
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart2" viewBox="0 0 16 16">
                                <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l1.25 5h8.22l1.25-5zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0"/>
                            </svg> 
                        </button>
                    </form>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</section>
<div class='scroll-top' id='scrollTopBtn'>&#8679;</div>
<div class='modal fade' id='buyModal' tabindex='-1' aria-labelledby='buyModalLabel' aria-hidden='true'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title'>Товар добавлен в корзину</h5>
                <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
            </div>
            <div class='modal-body'>
                <p id='productMessage'></p>
            </div>
            <div class='modal-footer d-flex flex-column align-items-center'>
    <button type='button' class='button' data-bs-dismiss='modal' onclick="window.location.href='./orders.php'">Перейти к корзине</button>
    <button type='button' class='button' data-bs-dismiss='modal'>Продолжить покупки</button>
</div>
        </div>
    </div>
</div>
<?php require './block/footer.php'; ?>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js'></script>
<script src="./js/main.js"></script>
<script>
function addToCart(productId, productName) {
    const quantity = $('input[name=quantity]').val(); 
    $.ajax({
        url: '', 
        type: 'POST',
        data: {
            product_id: productId,
            quantity: quantity,
            add_to_cart: true 
        },
        success: function(response) {
            const data = JSON.parse(response); 
            if (data.success) {
                $('#productMessage').text(`Товар "${productName}" добавлен в корзину!`);
                $('#buyModal').modal('show'); 
            } else {
                alert('Ошибка при добавлении товара.');
            }
        },
        error: function() {
            alert('Ошибка при выполнении запроса.');
        }
    });
}
</script>
</body>
</html>
