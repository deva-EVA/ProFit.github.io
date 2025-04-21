$(document).ready(function() {
    $("#openIMTModal").click(function() {
        console.log("Кнопка нажата!");
        $("#imtModal").fadeIn();
    });
    $("#closeIMTModal").click(function() {
        $("#imtModal").fadeOut();
    });
    $(window).click(function(event) {
        if ($(event.target).is("#imtModal")) {
            $("#imtModal").fadeOut();
        }
    });

    function calculateIMT() {
        let weight = document.getElementById('weight').value;
        let height = document.getElementById('height').value / 100;
        if (weight && height) {
            var imt = weight / (height * height);
            var resultText = 'Ваш ИМТ: ' + imt.toFixed(2) + '<br>';
            if (imt < 18.5) {
                resultText += 'Недостаточный вес.';
            } else if (imt >= 18.5 && imt <= 24.9) {
                resultText += 'Нормальный вес.';
            } else if (imt >= 25 && imt <= 29.9) {
                resultText += 'Избыточный вес.';
            } else {
                resultText += 'Ожирение.';
            }
            document.getElementById('imtResult').innerHTML = resultText;
        } else {
            document.getElementById('imtResult').innerHTML = 'Пожалуйста, заполните все поля!';
        }
    }
    window.calculateIMT = calculateIMT;
});