<?php
        //include 'models/imagenesModel.php';

        include __DIR__ . '/../models/imagenesModel.php';

        //include '../models/imagenesModel.php';


    class imagenesController {
        
    public function mostrarGaleria() {
        $modelImagenes = new modelImagenes();
        $imagenes = $modelImagenes->obtenerImagenesAleatoriasGatos();
                
        //include '../views/ImagenesAleatorias.php';
        include 'views/ImagenesAleatorias.php';

    }

        public function imagenFavorita() {
        
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['imagenId'])) {
            $imagenId = $_POST['imagenId'];

             $modelImagenes = new modelImagenes();
             $modelImagenes->imagenFavorita($imagenId);
        }

        
}

    public function obtenerImagenesFavoritas() {
        $modelImagenes = new modelImagenes();
        $imagenesFavoritas2 = $modelImagenes->obtenerImagenesFavoritas();
        // Cargar la vista para mostrar las imágenes favoritas
        //include '../views/imagenesFavoritas.php';
        include __DIR__ . '/../views/imagenesFavoritas.php';
    }
    
}



 

?>