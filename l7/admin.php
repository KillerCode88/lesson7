
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">

    <title>Загрузка тестов</title>
    <style>
        form {
            text-align: left;
            width: 30%;
            margin: 5% auto;
        }

        input {
            display: block;
            margin-bottom: 10px;
        }

        a {
            margin-left: 35%;
            font-size: 26px;
        }
    </style>
</head>
<body>
<form action="" enctype="multipart/form-data" method="post">
    <p>Загрузите файл в формате json:</p>
    <input type="hidden" name="MAX_FILE_SIZE" value="10000">
    <input type="file" name="testFile">
    <input type="submit" value="Загрузить тест" name="submit">
</form>

<a href="list.php">Перейти к тестам</a><br>


<?php
if (isset($_FILES['testFile'])) {
    if (is_uploaded_file($_FILES['testFile']['tmp_name'])) {
        $upLoadDir = 'tests/';
        $upLoadFile = $upLoadDir . basename($_FILES['testFile']['name']);
        if (end(explode('.' , $_FILES['testFile']['name'])) !== 'json') {
            echo 'Принимаются файлы только в формате json!';
            exit;
        }
        if ($_FILES['testFile']['error'] === UPLOAD_ERR_OK && move_uploaded_file($_FILES['testFile']['tmp_name'] , $upLoadFile)) {
            header('Location: list.php');
            echo "<h3>Файл успешно загружен на сервер</h3>";
            exit;
        } else {
            echo "<h3>Ошибка! Не удалось загрузить файл</h3>";
            exit;
        }
    }
}
?>
</body>
</html>
