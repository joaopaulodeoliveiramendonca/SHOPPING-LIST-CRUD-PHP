<?php
// Incluir a classe de banco de dados
require_once '../config/database.php';

// Incluir o controlador
require_once '../app/controllers/ListaController.php';

// Iniciar a sessão para exibir mensagens de sucesso e erro
session_start();

// Conectar ao banco de dados
$database = new Database();
$db = $database->getConnection();

// Obter a URL da requisição
$url = isset($_GET['url']) ? $_GET['url'] : '/';

// Definir o controlador e a ação padrão
$controller = new ListaController($db);

// Roteamento simples
switch ($url) {
    case '/':
        $controller->index();
        break;
    case 'add':
        $controller->create();
        break;
    case 'store':
        $controller->store();
        break;
    case 'edit':
        $controller->edit($_GET['id']);
        break;
    case 'update':
        $controller->update($_GET['id']);
        break;
    case 'delete':
        $controller->delete($_GET['id']);
        break;
    default:
        echo "Página não encontrada!";
        break;
}
