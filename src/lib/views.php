<?php
declare(strict_types=1);

function renderView(string $template, array $data = []): string {
    extract($data);
    ob_start();
    include __DIR__ . '/../templates/' . $template;
    return ob_get_clean();
}
?>
