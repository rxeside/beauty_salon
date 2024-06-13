<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo isset($client) ? 'Редактирование клиента' : 'Создание клиента'; ?></title>
    <link rel="stylesheet" href="/styles.css">
</head>
<body>
<h1><?php echo isset($client) ? 'Редактирование клиента' : 'Создание клиента'; ?></h1>
<form action="<?php echo isset($client) ? '/clients/' . htmlspecialchars($client['id']) . '/edit' : '/clients'; ?>" method="post">
    <div>
        <label for="first_name">Имя</label>
        <input type="text" id="first_name" name="first_name" value="<?php echo isset($client) ? htmlspecialchars($client['first_name']) : ''; ?>" required>
    </div>
    <div>
        <label for="last_name">Фамилия</label>
        <input type="text" id="last_name" name="last_name" value="<?php echo isset($client) ? htmlspecialchars($client['last_name']) : ''; ?>" required>
    </div>
    <div>
        <label for="phone">Телефон</label>
        <input type="text" id="phone" name="phone" value="<?php echo isset($client) ? htmlspecialchars($client['phone']) : ''; ?>" required>
    </div>
    <div>
        <button type="submit"><?php echo isset($client) ? 'Сохранить изменения' : 'Создать клиента'; ?></button>
    </div>
</form>
<a href="/clients">Вернуться к списку клиентов</a>
</body>
</html>
