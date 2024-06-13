<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Список клиентов</title>
    <link rel="stylesheet" href="/styles.css">
</head>
<body>
<h1>Список клиентов</h1>
<a href="/clients/new">Добавить нового клиента</a>
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
    <?php if (!empty($clients)): ?>
        <?php foreach ($clients as $client): ?>
            <tr>
                <td><?php echo htmlspecialchars($client['id']); ?></td>
                <td><?php echo htmlspecialchars($client['first_name']); ?></td>
                <td><?php echo htmlspecialchars($client['last_name']); ?></td>
                <td><?php echo htmlspecialchars($client['phone']); ?></td>
                <td>
                    <a href="/clients/<?php echo htmlspecialchars($client['id']); ?>/edit">Редактировать</a>
                    <form action="/clients/<?php echo htmlspecialchars($client['id']); ?>/delete" method="post" style="display:inline;">
                        <button type="submit">Удалить</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="5">Нет клиентов</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>
<a href="/masters">Назад к списку мастеров</a>
</body>
</html>
