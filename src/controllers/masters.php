<?php
declare(strict_types=1);

require_once __DIR__ . '/../lib/database.php';
require_once __DIR__ . '/../lib/views.php';
require_once __DIR__ . '/../lib/response.php';

function listMasters(): void {
    $pdo = connectDatabase();
    $stmt = $pdo->query('SELECT id, first_name, last_name, phone FROM masters');
    $masters = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo renderView('masters/list.php', ['masters' => $masters]);
}

# TODO: Разделить функцию для работы с базой данных и контроллера
function viewMaster(int $masterId): void {
    $pdo = connectDatabase();
    $stmt = $pdo->prepare('SELECT id, first_name, last_name, phone FROM masters WHERE id = :id');
    $stmt->execute([':id' => $masterId]);
    $master = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($master === false) {
        writeErrorNotFound();
        return;
    }

    echo renderView('masters/view.php', ['master' => $master]);
}

function showNewMasterForm(): void {
    echo renderView('masters/new.php');
}

function createMaster(): void {
    $pdo = connectDatabase();
    $stmt = $pdo->prepare('INSERT INTO masters (first_name, last_name, phone) VALUES (:first_name, :last_name, :phone)');
    $stmt->execute([
        ':first_name' => $_POST['first_name'],
        ':last_name' => $_POST['last_name'],
        ':phone' => $_POST['phone']
    ]);

    writeRedirectSeeOther('/masters');
}

function showEditMasterForm(int $masterId): void {
    $pdo = connectDatabase();
    $stmt = $pdo->prepare('SELECT id, first_name, last_name, phone FROM masters WHERE id = :id');
    $stmt->execute([':id' => $masterId]);
    $master = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($master === false) {
        writeErrorNotFound();
        return;
    }

    echo renderView('masters/edit.php', ['master' => $master]);
}

function updateMaster(int $masterId): void {
    $pdo = connectDatabase();
    $stmt = $pdo->prepare('UPDATE masters SET first_name = :first_name, last_name = :last_name, phone = :phone WHERE id = :id');
    $stmt->execute([
        ':first_name' => $_POST['first_name'],
        ':last_name' => $_POST['last_name'],
        ':phone' => $_POST['phone'],
        ':id' => $masterId
    ]);

    writeRedirectSeeOther('/masters');
}

function deleteMaster(int $masterId): void {
    $pdo = connectDatabase();
    $stmt = $pdo->prepare('DELETE FROM masters WHERE id = :id');
    $stmt->execute([':id' => $masterId]);

    writeRedirectSeeOther('/masters');
}
?>
