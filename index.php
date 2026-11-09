<?php
// Cargar la configuración y el controlador
require_once 'config/Database.php';
require_once 'controllers/DashboardController.php';

// Iniciar conexión a base de datos
$database = new Database();
$db = $database->getConnection();

// Iniciar controlador
$controller = new DashboardController($db);

$user_id = 1; 

// Llamar la función principal del controlador
$controller->showDashboard($user_id);
?>
