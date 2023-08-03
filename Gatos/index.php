<?php
include 'includes/headers.php';
require('controllers/imagenesController.php');

$controladorImagenes = new imagenesController();
        $controladorImagenes->mostrarGaleria();
?>