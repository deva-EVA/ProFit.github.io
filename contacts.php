<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
$message = '';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $message = $_POST['message'];
    if (trim($email) == '') {
        $error = 'Введите ваш email';
    } else if (trim($message) == '') {
        $error = 'Введите само сообщение';
    } 
    if ($error != '') {
        $_SESSION['responseMessage'] = $error; 
    } else {
     
        $subject = "=?utf-8?B?" . base64_encode($email) . "?=";
        $headers = "From: $email\r\nReply-to: $email\r\nContent-type: text/html;charset=utf-8\r\n";

        if (mail('diplom_ks5@mail.ru', $subject, $message, $headers)) {
            $_SESSION['responseMessage'] = "Письмо успешно отправлено"; 
        } else {
            $_SESSION['responseMessage'] = "Ошибка при отправке письма"; 
        }
    }
}
if (isset($_SESSION['responseMessage'])) {
    $message = $_SESSION['responseMessage'];
    unset($_SESSION['responseMessage']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Спортивный сайт</title>
    <link rel="stylesheet" href="./css/styleContacts.css"> 
</head>
<body>
    <?php require "./block/header.php"; ?>
    <div class="container conta">
        <h3>Контактная форма</h3>
        <form action="" method="post">
            <input type="email" name="email" placeholder="Введите Email" required><br>
            <textarea name="message" placeholder="Введите ваше сообщение" required></textarea><br>
            <button type="submit"class="contentBTN me-3" name="send">Отправить</button>
        </form>     
        <input type="hidden" id="responseMessage" value="<?= htmlspecialchars($message); ?>">
    </div>
    <div class="modal" id="responseModal">
        <div class="modal-block">
            <div class="modal-header">
                <h5>Результат отправки</h5>
                <span type="button" id="closeModal" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></span>
            </div>
            <div class="modal-body">
                <?= htmlspecialchars($message); ?>
            </div>    
        </div>
    </div>
    <?php require "./block/footer.php"; ?>
    <script src="./js/main.js"></script>
</body>
</html>
