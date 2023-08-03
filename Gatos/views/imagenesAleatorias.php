<!DOCTYPE html>
<html>
<head>
    <title>Galería de imágenes aleatorias de gatos</title>
</head>
<body>
    <h1>Galería de imágenes aleatorias de gatos</h1>
    <div>
        <?php foreach ($imagenes as $imagenUrl) : ?>
            <img src="<?php echo $imagenUrl; ?>" alt="Gato">
              <form method="POST" action="ImagenesFavoritasGatos.php">
                <input type="hidden" name="action" value="imagenFavorita">
                <input type="hidden" name="imagenId" value="<?php echo $imagenUrl; ?>">
                <input type="submit" value="Marcar como favorita">
            </form>
        <?php endforeach; ?>
    </div>
</body>
</html>