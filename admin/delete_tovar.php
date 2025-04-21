<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Удаление курса</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
    <div class="container_block">
        <header class="d-flex flex-wrap align-items-center justify-content-between py-1 border-bottom" style="background-color: white;">
            <h2 class="ms-5">ProFit</h2> 
            <div class="col-md-3 text-end">
            <div>
            <button id="exitButton" class="contentBTN me-3" onclick="window.location.href='add_product.php';">Добавление товара</button>
            <button id="exitButton" class="contentBTN me-3" onclick="window.location.href='view_orders.php';">Заказы</button>
                <button id="exitButton" class="contentBTN me-3" onclick="window.location.href='../index.php';">Выход</button>
            </div>
            </div>
        </header>
    </div>
    </header>
    <div class="container mt-5">
        <h2>Удаление товара</h2>
        <form method="post" class="mb-3">
            <div class="mb-3">
                <label for="course_name" class="form-label">Название товара:</label>
                <input type="text" id="course_name" name="course_name" class="form-control" required>
            </div>
            <button type="submit" name="delete" class="contentBTN me-3" >Удалить</button>
        </form>
        <?php
        try {
            $db = new PDO("mysql:host=localhost;dbname=proFit", "root", "");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "<div class='alert alert-danger'>Ошибка подключения: " . $e->getMessage() . "</div>";
            exit(); 
        }
        if (isset($_POST['delete'])) {
            $course_name = $_POST['course_name'];
            $sql = "DELETE FROM katalog WHERE name = :course_name";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':course_name', $course_name);
            if ($stmt->execute()) {
                echo "<div class='alert alert-success'>Курс успешно удален!</div>";
            } else {
                echo "<div class='alert alert-danger'>Ошибка удаления курса.</div>";
            }
        }
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
