<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Добавить нового мастера</title>
    <link rel="stylesheet" href="/styles.css">
</head>
<body>
<h1>Добавить нового мастера</h1>
<form action="/masters" method="post">
    <label for="first_name">Имя:</label>
    <input type="text" id="first_name" name="first_name" required>
    <label for="last_name">Фамилия:</label>
    <input type="text" id="last_name" name="last_name" required>
    <label for="phone">Телефон:</label>
    <input type="text" id="phone" name="phone">
    <button type="submit">Сохранить</button>
</form>
<a href="/masters">Назад к списку мастеров</a>
</body>
</html>
