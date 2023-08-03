<?php

class modelImagenes{

private $api='https://api.thecatapi.com/v1/images/search?limit=10';
private $apiKey='f221c99b-304d-4404-b111-cbd3ddccf31a.';


public function obtenerImagenesAleatoriasGatos(){


    $encabezado=[
        'x-api-key:'.$this->apiKey,
    ];

    $respuestaApi=file_get_contents($this->api, false, stream_context_create(
        [
            'https' => [
            'method' => 'GET',
            'header' => implode("\r\n", $encabezado), //las imagenes están en un arreglo
            //y estan representadas por elementos ahora
            ]
        ]
            ));
        
        $data = json_decode($respuestaApi, true);

        //var_dump($data);
        $imagenes = [];
        foreach ($data as $item) {
            $imagenes[] = $item['url'];
        }

        return $imagenes;
    }

  /*  public function imagenFavorita($imagenId){
      
        $url = "https://api.thecatapi.com/v1/images/{$imagenId}";

        var_dump($url);
        $opciones = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'x-api-key: f221c99b-304d-4404-b111-cbd3ddccf31a'
            ]
        ];

         // Inicializar la solicitud curl
        $curl = curl_init();


        var_dump($curl);
        // Establecer las opciones de la solicitud curl
         curl_setopt_array($curl, $opciones);

         $respuesta = curl_exec($curl);

         var_dump($respuesta);
        if (curl_errno($curl)) {
        die('Error en la solicitud a la API: ' . curl_error($curl));
    }
    curl_close($curl);
    
      return $respuesta;

    }
}*/

    public function imagenFavorita($imagenId){
      
    // Verificar si la sesión ya está iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Obtener las imágenes favoritas de la sesión o inicializar el array si no existe
        $imagenesFavoritas = isset($_SESSION['imagenesFavoritas']) ? $_SESSION['imagenesFavoritas'] : [];

        // Verificar si el ID de la imagen ya está en el array de imágenes favoritas
        if (!in_array($imagenId, $imagenesFavoritas)) {
            // Agregar el ID de la imagen a las imágenes favoritas
            $imagenesFavoritas[] = $imagenId;

            
            // Actualizar las imágenes favoritas en la sesión
            $_SESSION['imagenesFavoritas'] = $imagenesFavoritas;
        }

    }

     public function obtenerImagenesFavoritas() {
        // Verificar si la sesión ya está iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Obtener la lista de imágenes favoritas de la variable de sesión
        $imagenesFavoritas = isset($_SESSION['imagenesFavoritas']) ? $_SESSION['imagenesFavoritas'] : [];

        return $imagenesFavoritas;
    }



}

        $controladorImagenes = new modelImagenes();
        $controladorImagenes->imagenFavorita("https://cdn2.thecatapi.com/images/ach.jpg");

?>