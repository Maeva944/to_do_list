<?php

require_once '../bdd/Database.php';
require_once '../controllers/UserController.php';

$pdo = new Database();
$controller = new UserController($pdo);

// Routeur simple
$page = isset($_GET['page']) ? $_GET['page'] : 'login';

switch ($page) {
    case 'login':
        $controller->login();
        break;

    case 'register':
        $controller->register();
        break;

    default:
        http_response_code(404);
        echo "Page non trouvée.";
        break;
}
