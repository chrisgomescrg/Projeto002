<?php
session_start();

// Autoload das classes via Composer
require_once __DIR__ . "/../vendor/autoload.php";

// Captura controller e action da URL
$controller = $_GET['controller'] ?? 'Auth';
$action     = $_GET['action'] ?? 'login';

// Monta o nome completo da classe do controller
$controllerClass = "App\\Controllers\\{$controller}Controller";

try {
    // Verifica se a classe existe
    if (!class_exists($controllerClass)) {
        throw new Exception("Controller não encontrado: {$controllerClass}");
    }

    // Instancia o controller
    $ctrl = new $controllerClass();

    // Verifica se o método existe
    if (!method_exists($ctrl, $action)) {
        throw new Exception("Ação não encontrada: {$action}");
    }

    // Executa a ação
    $ctrl->$action();

} catch (Exception $e) {
    // Exibe erro amigável
    echo "<h1>Erro</h1>";
    echo "<p>" . htmlspecialchars($e->getMessage()) . "</p>";
}