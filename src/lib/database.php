<?php
declare(strict_types=1);

# TODO: переименовать конфиг

require_once __DIR__ . '/paths.php';

const DATABASE_CONFIG_NAME = 'catboard.db.ini';

/**
 * Создаёт объект класса PDO, представляющий подключение к MySQL.
 */
function connectDatabase(): PDO
{
    $configPath = getConfigPath(DATABASE_CONFIG_NAME);
    if (!file_exists($configPath))
    {
        throw new RuntimeException("Could not find database configuration at '$configPath'");
    }
    $config = parse_ini_file($configPath);
    if (!$config)
    {
        throw new RuntimeException("Failed to parse database configuration from '$configPath'");
    }

    // Проверяем наличие всех ключей конфигурации.
    $expectedKeys = ['dsn', 'user', 'password'];
    $missingKeys = array_diff($expectedKeys, array_keys($config));
    if ($missingKeys)
    {
        throw new RuntimeException('Wrong database configuration: missing options ' . implode(' ', $missingKeys));
    }

    return new PDO($config['dsn'], $config['user'], $config['password']);
}


/*function getAllMasters(): array
{
    $pdo = connectDatabase();
    $stmt = $pdo->query('SELECT id, first_name, last_name, phone FROM masters');
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getMasterById(int $masterId): ?array
{
    $pdo = connectDatabase();
    $stmt = $pdo->prepare('SELECT id, first_name, last_name, phone FROM masters WHERE id = :id');
    $stmt->execute([':id' => $masterId]);
    $master = $stmt->fetch(PDO::FETCH_ASSOC);
    return $master !== false ? $master : null;
}

function insertMaster(string $firstName, string $lastName, string $phone): void
{
    $pdo = connectDatabase();
    $stmt = $pdo->prepare('INSERT INTO masters (first_name, last_name, phone) VALUES (:first_name, :last_name, :phone)');
    $stmt->execute([
        ':first_name' => $firstName,
        ':last_name' => $lastName,
        ':phone' => $phone
    ]);
}

function updateMasterById(int $masterId, string $firstName, string $lastName, string $phone): void
{
    $pdo = connectDatabase();
    $stmt = $pdo->prepare('UPDATE masters SET first_name = :first_name, last_name = :last_name, phone = :phone WHERE id = :id');
    $stmt->execute([
        ':first_name' => $firstName,
        ':last_name' => $lastName,
        ':phone' => $phone,
        ':id' => $masterId
    ]);
}

function deleteMasterById(int $masterId): void
{
    $pdo = connectDatabase();
    $stmt = $pdo->prepare('DELETE FROM masters WHERE id = :id');
    $stmt->execute([':id' => $masterId]);
}
*/
