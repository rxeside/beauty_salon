<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Карточка мастера</title>
    <link rel="stylesheet" href="/styles.css">
</head>
<body>
<h1>Карточка мастера</h1>
<p>Имя: <?= htmlspecialchars($master['first_name']) ?></p>
<p>Фамилия: <?= htmlspecialchars($master['last_name']) ?></p>
<p>Телефон: <?= htmlspecialchars($master['phone']) ?></p>
<a href="/masters/<?= htmlspecialchars($master['id']) ?>/edit">Редактировать</a>
<a href="/masters">Назад к списку мастеров</a>
</body>
</html>
