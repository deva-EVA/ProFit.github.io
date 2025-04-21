<?php
session_start();
require 'db.php'; 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST['product_id'];
    $name = $_POST['name'];
    $id_tovar = $_POST['id_tovar'];
    try {
        if (isset($_FILES['img']) && $_FILES['img']['error'] == UPLOAD_ERR_OK) {
            $img = $_FILES['img']['name'];
            $target_dir = "../img/"; 
            $target_file = $target_dir . basename($img);
            if (!move_uploaded_file($_FILES['img']['tmp_name'], $target_file)) {
                throw new Exception("Ошибка при загрузке файла.");
            }
        } else {
            throw new Exception("Ошибка при загрузке изображения.");
        }
        $text = $_POST['text'];
        $button = $_POST['button'];
        $price = $_POST['price'];
        $stmt = $db->prepare("INSERT INTO katalog (product_id, name, id_tovar, img, text, button, price) VALUES (:product_id, :name, :id_tovar, :img, :text, :button, :price)");
        if (!$stmt->execute([
            'product_id' => $product_id,
            'name' => $name,
            'id_tovar' => $id_tovar,
            'img' => $target_file,
            'text' => $text,
            'button' => $button,
            'price' => $price,
        ])) {
            $errorInfo = $db->errorInfo();
            throw new Exception("Ошибка при добавлении товара: " . $errorInfo[2]);
        }
        $_SESSION['success_message'] = "Товар успешно добавлен!";
    } catch (Exception $e) {
        $_SESSION['success_message'] = "Не удалось добавить товар.";
    }
    header("Location: add_product.php"); 
    exit();
}
?>
