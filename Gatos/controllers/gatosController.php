<?php
// Importar el modelo Gato
 include __DIR__ . '/../models/gatosModel.php';
  include __DIR__ . '/../config/database.php';
class GatoController {

    // Método para mostrar todos los gatos
    public function mostrarGatos() {
        $modeloGato = new Gato();
        $gatos = $modeloGato->leer();
        include('views/listaGatos.php');
    }

    // Método para mostrar un gato individual
    public function mostrarGato($id) {
        $modeloGato = new Gato();
        $gato = $modeloGato->leer_individual($id);
        include('views/detallesGato.php');
    }

    //Agregar Nuevo Gato
    public function agregarGato() {
            $baseDatos = new Basemysql();
             $db = $baseDatos->connect();
             var_dump($db);
        // Verificar si se envió el formulario (se utilizó el método POST)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener los datos del formulario
            $nombre = $_POST['nombre'];
            $raza = $_POST['raza'];
            $edad = $_POST['edad'];

            var_dump($_POST);

             // Imprimir los datos para verificar que se capturan correctamente en el controlador
            // Verificar si se ha subido una imagen y procesarla
            if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
                // Obtener el nombre temporal del archivo subido
                $archivoTemporal = $_FILES['foto']['tmp_name'];

                // Generar un nombre único para el archivo utilizando la función md5
                $nombreArchivo = md5(uniqid());

                // Obtener la extensión del archivo subido
                $extension = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);

                // Crear el nombre final del archivo con la extensión
                $nombreFinal = $nombreArchivo . '.' . $extension;

                // Mover el archivo subido a la ubicación deseada (por ejemplo, la carpeta "imagenes" en el servidor)
                move_uploaded_file($archivoTemporal, 'ruta/del/servidor/imagenes/' . $nombreFinal);

                // Llamar al método del modelo para agregar el gato con el nombre de la foto
                $modeloGato = new Gato($db);
                $resultado = $modeloGato->crear($nombre);

               // Habilitar la opción PDO::ATTR_ERRMODE para capturar errores de consulta
             $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try {
            $resultado = $modeloGato->crear($nombre);
        } catch (PDOException $e) {
            // Capturar el mensaje de error generado por la consulta y mostrarlo
            echo "Error en la consulta: " . $e->getMessage();
        }
                // Redireccionar a la página de lista de gatos después de agregar uno nuevo
             include __DIR__ . '/../views/crearGato.php';
                //header('Location: index.php?action=mostrarGatos');
                exit;
            } else {
            }
}        }
    
    // Método para actualizar un gato existente
    public function actualizarGato($id, $nombre, $raza, $edad, $foto) {
        $modeloGato = new Gato();
        $resultado = $modeloGato->actualizar($id, $nombre, $raza, $edad, $foto);
        header('Location: index.php?action=mostrarGato&id=' . $id);
    }

    // Método para eliminar un gato
    public function eliminarGato($id) {
        $modeloGato = new Gato();
        $resultado = $modeloGato->borrar($id);
        header('Location: index.php?action=mostrarGatos');
    }
}


?>