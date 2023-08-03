<?php
require('controllers/imagenesController.php');
require('controllers/gatosController.php');
// Obtener la URL solicitada
$url = $_SERVER['REQUEST_URI'];

$archivo = basename($url);

// Eliminar cualquier query string de la URL (si existe)

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        switch ($action) {
            case 'imagenFavorita':
                require_once 'controllers/imagenesController.php';
                $controller = new imagenesController();
                $controller->imagenFavorita();
                break;

            case 'gatoCrear':
                require_once 'controllers/gatosController.php';
                $controller = new GatoController();
                $controller->agregarGato();
                break;
        }
    }
}

switch ($archivo) {
   case 'ImagenesFavoritasGatos.php':
                require_once 'controllers/imagenesController.php';
                $controller2 = new imagenesController();
                $controller2->obtenerImagenesFavoritas();
                break;

    // Otros casos para otros archivos si es necesario...
    
}


?>