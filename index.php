<?php
$db = new PDO("mysql:host=localhost;dbname=proFit",
"root","");
$top_tovar = [];
if ($query = $db->query("SELECT * FROM `top_tovar`")) {
    $top_tovar = $query->fetchAll(PDO::FETCH_ASSOC);
} else {
    print_r($db->errorInfo());
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Спортивный сайт</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .header {
            display: flex;
            background-image: url('../img/sport.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            height: 580px;
        }
        .header-container {
            padding: 47px;
            width: 100%;
        }
        .header_text_container {
            height: auto;
            font-size: 10px;
            text-align: center;
            padding: 47px;
            width: 100%;
        } 
        .header_text {
            color: white;
            font-weight: bold;
            font-size: 16px;
            opacity: 0.7;
            text-align: center;
        }
            </style>
</head>
<body>
<?php require "./block/header.php"; ?>
<header class="header">
    <div class="header-container">
        <h1>ProFit</h1>
        <div class="header_text_container">
            <p class="header_text">Ваш идеальный помощник в мире фитнеса и питания!
Мы предлагаем женские тренировки для дома и разнообразные меню с учетом КБЖУ: вегетарианские, безглютеновые, безлактозные и для контроля сахара. Начните свой путь к здоровью уже сегодня!
<br>Пройдите наш тест, чтобы узнать, какое питание и какие тренировки подойдут именно вам. Откройте для себя индивидуальный подход к здоровому образу жизни! </p>
            <button class="testButton" id="openModal">Пройти тест</button><br>
            <button class="testButton" id="openIMTModal">Рассчитать ИМТ</button>
        </div>
    </div>
    <div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div class="TestForm">
            <h4>Тест на выбор питания и тренировок</h4>
            <form id="testForm">
               <b><h5>Какова ваша основная цель в питании?</h5></b>
                <label><input name="goal" type="radio" value="Похудение">Похудение</label><br>
                <label><input name="goal" type="radio" value="Набор мышечной массы">Набор мышечной массы</label><br>
                <label><input name="goal" type="radio" value="Поддержание текущего веса">Поддержание текущего веса</label><br>
                <b><h5>Есть ли у вас какие-либо ограничения в питании?</h5></b>
                <label><input name="diet_restriction" type="radio" value="Веган">Да, я веган</label><br>
                <label><input name="diet_restriction" type="radio" value="Глютен">Да, я избегаю глютена</label><br>
                <label><input name="diet_restriction" type="radio" value="Лактоза">Да, я избегаю лактозы</label><br>
                <label><input name="diet_restriction" type="radio" value="Сахар">Слежу за уровнем сахара</label><br>
                <label><input name="diet_restriction" type="radio" value="Нет ограничений">Нет, у меня нет ограничений</label><br>
                <b><h5>Есть ли у вас какие-либо ограничения по здоровью?</h5></b>
                <label><input name="health_restriction" type="radio" value="Да">Да, есть травмы или хронические заболевания</label><br>
                <label><input name="health_restriction" type="radio" value="Нет">Нет, у меня нет ограничений</label><br>
            </form>
            <button class="contentBTN" type='button' onclick='evaluateAnswers();' style="display: inline-block;">Отправить</button>
            <button class="contentBTN" type='button' onclick='clearForm();' style="display: inline-block;">Очистить поля</button>
            <hr>
            <div id="resultBlock">
                <p id="resultMessage"></p>

            </div>
        </div>
    </div>
</div>
    <div id="imtModal" class="modal">
    <div class="modal-background"></div>
        <div class="modal-content">
            <span class="close" id="closeIMTModal">&times;</span>
            <h4>Расчет ИМТ</h4>
            <form id="imtForm">
                <label for="weight">Вес (кг):</label>
                <input type="number" id="weight" name="weight"><br><br>
                <label for="height">Рост (см):</label>
                <input type="number" id="height" name="height"><br><br>
                <button  class="contentBTN" type="button" onclick="calculateIMT()">Рассчитать</button>
            </form>
            <p id="imtResult"></p>
        </div>
    </div>
</header>
    <main>
        <section class="secondBlock">
        <h2>СПОРТ - ЭТО ПО ЛЮБВИ!</h2>
            <div class="opisanieBlock">
                <div class="content">
                    <p class="opisanieText">Вовлеченность населения России в спорт и физкультуру растет с каждым годом, а главным трендом последних лет стали самостоятельные тренировки. Наша основная цель - донести в массы, что спорт — это занятия не только в зале и не только
                        с тренером - это могут быть домашние тренировки, главное регулярные. Спорт может быть доступен каждому. Существует множество эффективных упражнений, которые можно выполнять в домашних условиях, используя вес собственного тела или
                        простые спортивные аксессуары.</p>

                </div>
            </div>
        </section>
        <div class="marquee-container">
        <div class="marquee">ПОПУЛЯРНЫЕ КУРСЫ ПОПУЛЯРНЫЕ КУРСЫ ПОПУЛЯРНЫЕ КУРСЫ ПОПУЛЯРНЫЕ КУРСЫ ПОПУЛЯРНЫЕ КУРСЫ ПОПУЛЯРНЫЕ КУРСЫ</div>
    </div>
<h2>КУРСЫ</h2>
<section class="courses">
    <div class="course">
        <?php foreach($top_tovar as $data): ?>
            <?php if ($data['id_tovar'] == 1): ?>
            <div class="card"> 
                <img class="imgCourse" src="<?= $data['img'];?>" alt="Курс 1">
                <h3><?= $data['name'];?></h3>
                <button class="infoBTN" onclick="toggleInfo(this)">Читать подробнее</button>
                <p class="course-info" style="display: none;"><?= $data['text']; ?></p>
                <button class="contentBTN" onclick="window.location.href='katalog.php'">
<?= $data['button'];?>
</button>
            </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</section>
        <h2>ПИТАНИЕ</h2>
        <section class="courses">
            <div class="course">
            <?php  foreach($top_tovar as $data):
        ?>
         <?php if ($data['id_tovar'] == 2): ?>
                <div class="card">
                <img class="imgCourse" src="<?= $data['img'];?>" alt="Курс 1">
                <h3><?= $data['name'];?></h3>
                <button class="infoBTN" onclick="toggleInfo(this)">Читать подробнее</button>
                    <p class="course-info" style="display: none;"><?= $data['text']; ?></p>
                    <button class="contentBTN" onclick="window.location.href='katalog.php'">
                    <?= $data['button'];?>
                    </button>
                </div>
                <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </section>
    </main>
    <div class="scroll-top" id="scrollTopBtn">&#8679;</div>
    <?php require "./block/footer.php"; ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./js/modalIMT.js"></script>
    <script src="./js/main.js"></script>
</body>
</html>