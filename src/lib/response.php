<?php
declare(strict_types=1);

function writeRedirectSeeOther(string $location): void {
    header('HTTP/1.1 303 See Other');
    header('Location: ' . $location);
}

function writeErrorNotFound(): void {
    header('HTTP/1.1 404 Not Found');
    echo '404 Not Found';
}

function writeErrorBadRequest(): void {
    header('HTTP/1.1 400 Bad Request');
    echo '400 Bad Request';
}
?>
