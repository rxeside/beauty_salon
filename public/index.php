<?php
declare(strict_types=1);

require_once __DIR__ . '/../src/lib/database.php';
require_once __DIR__ . '/../src/lib/request.php';
require_once __DIR__ . '/../src/lib/response.php';
require_once __DIR__ . '/../src/controllers/masters.php';
require_once __DIR__ . '/../src/controllers/clients.php';


// Обработка маршрутов
if (isRequestHttpMethod(HTTP_METHOD_GET)) {
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    if ($uri === '/' || $uri === '/masters') {
        listMasters();
    } elseif (preg_match('~^/masters/(\d+)$~', $uri, $matches)) {
        $masterId = (int)$matches[1];
        viewMaster($masterId);
    } elseif ($uri === '/masters/new') {
        showNewMasterForm();
    } elseif (preg_match('~^/masters/(\d+)/edit$~', $uri, $matches)) {
        $masterId = (int)$matches[1];
        showEditMasterForm($masterId);
    } elseif ($uri === '/clients') {
        listClients();
    } elseif ($uri === '/clients/new') {
        createClientForm();
    } elseif (preg_match('~^/clients/(\d+)/edit$~', $uri, $matches)) {
        $clientId = (int)$matches[1];
        editClientForm($clientId);
    } else {
        writeErrorNotFound();
    }
} elseif (isRequestHttpMethod(HTTP_METHOD_POST)) {
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    if ($uri === '/masters') {
        createMaster();
    } elseif (preg_match('~^/masters/(\d+)/edit$~', $uri, $matches)) {
        $masterId = (int)$matches[1];
        updateMaster($masterId);
    } elseif (preg_match('~^/masters/(\d+)/delete$~', $uri, $matches)) {
        $masterId = (int)$matches[1];
        deleteMaster($masterId);
    } elseif ($uri === '/clients') {
        createClient();
    } elseif (preg_match('~^/clients/(\d+)/edit$~', $uri, $matches)) {
        $clientId = (int)$matches[1];
        updateClient($clientId);
    } elseif (preg_match('~^/clients/(\d+)/delete$~', $uri, $matches)) {
        $clientId = (int)$matches[1];
        deleteClient($clientId);
    } else {
        writeErrorNotFound();
    }
} else {
    writeErrorBadRequest();
}
?>