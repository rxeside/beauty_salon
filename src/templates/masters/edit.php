<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Редактировать мастера</title>
    <link rel="stylesheet" href="/styles.css">
</head>
<body>
<h1>Редактировать мастера</h1>
<form action="/masters/<?= htmlspecialchars($master['id']) ?>/edit" method="post">
    <label for="first_name">Имя:</label>
    <input type="text" id="first_name" name="first_name" value="<?= htmlspecialchars($master['first_name']) ?>" required>
    <label for="last_name">Фамилия:</label>
    <input type="text" id="last_name" name="last_name" value="<?= htmlspecialchars($master['last_name']) ?>" required>
    <label for="phone">Телефон:</label>
    <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($master['phone']) ?>">
    <button type="submit">Сохранить</button>
</form>
<a href="/masters/<?= htmlspecialchars($master['id']) ?>">Отмена</a>
</body>
</html>
