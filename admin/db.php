<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=proFit", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Ошибка подключения: " . $e->getMessage();
    exit(); 
}
?>

