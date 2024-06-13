<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Список мастеров</title>
    <link rel="stylesheet" href="/styles.css">
</head>
<body>
<h1>Список мастеров</h1>
<a href="/masters/new">Добавить нового мастера</a>
<table border="1">
    <thead>
    <tr>
        <th>ID</th>
        <th>Имя</th>
        <th>Фамилия</th>
        <th>Телефон</th>
        <th>Действия</th>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($masters)): ?>
        <?php foreach ($masters as $master): ?>
            <tr>
                <td><?php echo htmlspecialchars($master['id']); ?></td>
                <td><?php echo htmlspecialchars($master['first_name']); ?></td>
                <td><?php echo htmlspecialchars($master['last_name']); ?></td>
                <td><?php echo htmlspecialchars($master['phone']); ?></td>
                <td>
                    <a href="/masters/<?php echo htmlspecialchars($master['id']); ?>">Редактировать</a>
                    <form action="/masters/<?php echo htmlspecialchars($master['id']); ?>/delete" method="post" style="display:inline;">
                        <button type="submit">Удалить</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="5">Нет мастеров</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>
<a href="/clients" class="btn btn-primary">Список клиентов</a>
</body>
</html>
