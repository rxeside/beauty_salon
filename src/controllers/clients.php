<?php

require_once __DIR__ . '/../lib/database.php';
require_once __DIR__ . '/../lib/views.php';

#TODO: удалить везде exit

/**
 * Отображает список клиентов.
 */
function listClients(): void {
    $pdo = connectDatabase();
    $stmt = $pdo->query('SELECT * FROM clients ORDER BY last_name, first_name');
    $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo renderView('clients/list.php', ['clients' => $clients]);
}

/**
 * Отображает форму создания нового клиента.
 */
function createClientForm(): void {
    echo renderView('clients/form.php', ['client' => null]);
}

/**
 * Создает нового клиента.
 */
function createClient(): void {
    $pdo = connectDatabase();

    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $phone = $_POST['phone'];

    $stmt = $pdo->prepare('INSERT INTO clients (first_name, last_name, phone) VALUES (:first_name, :last_name, :phone)');
    $stmt->execute([
        ':first_name' => $firstName,
        ':last_name' => $lastName,
        ':phone' => $phone
    ]);

    header('Location: /clients');
}

/**
 * Отображает форму редактирования клиента.
 */
function editClientForm(int $id): void {
    $pdo = connectDatabase();
    $stmt = $pdo->prepare('SELECT * FROM clients WHERE id = :id');
    $stmt->execute([':id' => $id]);
    $client = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$client) {
        throw new RuntimeException('Client not found');
    }

    echo renderView('clients/form.php', ['client' => $client]);
}

/**
 * Обновляет данные клиента.
 */
function updateClient(int $id): void {
    $pdo = connectDatabase();

    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $phone = $_POST['phone'];

    $stmt = $pdo->prepare('UPDATE clients SET first_name = :first_name, last_name = :last_name, phone = :phone WHERE id = :id');
    $stmt->execute([
        ':id' => $id,
        ':first_name' => $firstName,
        ':last_name' => $lastName,
        ':phone' => $phone
    ]);

    header('Location: /clients');
}

/**
 * Удаляет клиента.
 */
function deleteClient(int $id): void {
    $pdo = connectDatabase();

    $stmt = $pdo->prepare('DELETE FROM clients WHERE id = :id');
    $stmt->execute([':id' => $id]);

    header('Location: /clients');
}
