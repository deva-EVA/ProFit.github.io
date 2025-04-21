<?php
session_start();
require 'db.php'; 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $stmt = $db->prepare("SELECT * FROM admins WHERE login = :username");
    $stmt->execute(['username' => $username]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($admin && md5($password) === $admin['password']) {
        $_SESSION['admin'] = true;
        echo json_encode(['success' => true]); 
        exit();
    } else {
        echo json_encode(['success' => false, 'message' => 'Неверный логин или пароль.']); 
        exit();
    }
}
?>
