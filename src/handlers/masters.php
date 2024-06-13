<?php
declare(strict_types=1);

# TODO: удалить ненужный код

require_once __DIR__ . '/../lib/database.php';
require_once __DIR__ . '/../lib/request.php';
require_once __DIR__ . '/../lib/response.php';
require_once __DIR__ . '/../lib/views.php';

function getMasters(): array {
    $pdo = connectDatabase();
    $query = "SELECT id, first_name, last_name, phone FROM masters";
    $statement = $pdo->query($query);
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function getMasterById(int $id): ?array {
    $pdo = connectDatabase();
    $query = "SELECT id, first_name, last_name, phone FROM masters WHERE id = :id";
    $statement = $pdo->prepare($query);
    $statement->execute([':id' => $id]);
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    return $result ?: null;
}

function saveMaster(array $masterData): void {
    $pdo = connectDatabase();
    if (isset($masterData['id'])) {
        $query = "UPDATE masters SET first_name = :first_name, last_name = :last_name, phone = :phone WHERE id = :id";
    } else {
        $query = "INSERT INTO masters (first_name, last_name, phone) VALUES (:first_name, :last_name, :phone)";
    }
    $statement = $pdo->prepare($query);
    $statement->execute($masterData);
}

function deleteMaster(int $id): void {
    $pdo = connectDatabase();
    $query = "DELETE FROM masters WHERE id = :id";
    $statement = $pdo->prepare($query);
    $statement->execute([':id' => $id]);
}

if (isRequestHttpMethod(HTTP_METHOD_POST)) {
    $action = $_POST['action'] ?? '';
    if ($action === 'save') {
        $masterData = [
            ':first_name' => $_POST['first_name'],
            ':last_name' => $_POST['last_name'],
            ':phone' => $_POST['phone']
        ];
        if (!empty($_POST['id'])) {
            $masterData[':id'] = (int)$_POST['id'];
        }
        saveMaster($masterData);
        writeRedirectSeeOther('/masters.php');
    } elseif ($action === 'delete') {
        $id = (int)$_POST['id'];
        deleteMaster($id);
        writeRedirectSeeOther('/masters.php');
    }
}

$masters = getMasters();
echo renderView('masters_list.php', ['masters' => $masters]);

if (isset($_GET['id'])) {
    $master = getMasterById((int)$_GET['id']);
    if ($master) {
        echo renderView('master_form.php', ['master' => $master]);
    } else {
        writeErrorNotFound();
    }
} else {
    echo renderView('master_form.php', ['master' => null]);
}
