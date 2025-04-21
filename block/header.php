<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Спортивный сайт</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
    background-color: #f0f0f0;
    font-family: 'Times New Roman', Times, serif;
    height: 100%;
}
        .container_block {
            width: 100%;
        }
        .contentBTN {
    width: auto;
    height: auto;
    padding: 5px 5px;
    color: white;
    background-color: #8B4513;
    border-color: #8B4513;
    border-radius: 10px;
    cursor: pointer;
    margin-top: 5px;
}
.contentBTN:hover {
    background-color: #c4b583;
}
        h2 {
    margin-top: 15px;
    margin-bottom: 10px;
    text-align: center;
    color: #8B4513;
    font-family: 'Merriweather', serif;
    font-size: 35px;
    font-weight: 700;
}
        .modal {
            display: none;
            position: fixed;
            justify-content: center;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            border-radius: 15px;
        }
        .nav a {
    z-index: 900;
    color: black;
    padding: 10px 15px;
    font-size: 17px;
    text-decoration: none;
    font-weight: bold;
    transition: color 0.3s ease;
}
.nav a:hover {
    color: #007bff;
}
        .modal-content {
            background-color: #fefefe;
            margin: 41px auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
            border-radius: 8px;
            position: relative;
            text-align: center;
        }
        .close {
            color: #aaa;
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
<header>
    <div class="container_block">
        <header class="d-flex flex-wrap align-items-center justify-content-between py-1 border-bottom" style="background-color: white;">
            <h2 class="ms-5">ProFit</h2> 
            <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"></svg>
            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0"> 
                <li><a href="../index.php">Главная</a></li>
                <li><a href="../katalog.php">Каталог</a></li>
                <li><a href="../orders.php">Корзина</a></li>
                <li><a href="../contacts.php">Контакты</a></li>
            </ul>
            <div class="col-md-3 text-end">
                <button type="button" class="contentBTN me-3" data-bs-toggle="modal" data-bs-target="#signupModal">Админ панель</button> 
            </div>
            <div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content rounded-4 shadow">
                        <div class="modal-header pb-4 border-bottom-0">
                            <h5 class="fw-bold">Вход для администратора</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body pt-0">
                            <div id="error-message" class="alert alert-danger d-none" role="alert"></div>
                            <form id="login-form"> 
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control rounded-3" id="floatingInput" name="username" placeholder="Login" required>
                                    <label for="floatingInput">Логин</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control rounded-3" id="floatingPassword" name="password" placeholder="Password" required>
                                    <label for="floatingPassword">Пароль</label>
                                </div>
                                <button type="submit" class="button w-100">Войти</button> 
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    </div>
</header>
<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js'></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
<script>
$(document).ready(function() {
    $('#login-form').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: './admin/login.php', 
            data: $(this).serialize(), 
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    window.location.href = './admin/servis_admin.php'; 
                } else {
                    $('#error-message').removeClass('d-none').text(response.message); 
                }
            },
            error: function() {
                $('#error-message').removeClass('d-none').text('Произошла ошибка при обработке запроса.');
            }
        });
    });
});
</script>
</body>
</html>
