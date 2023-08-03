
<?php
  include __DIR__ . '/../includes/headers.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Agregar Gato</title>
</head>
<body>
    <h1>Agregar Gato</h1>
    <form method="POST"  action="../router.php" >
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required><br>

        <label for="raza">Raza:</label>
        <input type="text" name="raza" required><br>

        <label for="edad">Edad:</label>
        <input type="number" name="edad" required><br>

        <label for="foto">Foto:</label>
        <input type="file" name="foto" accept="image/*" required><br>

         <input type="hidden" name="action" value="gatoCrear">
        <input type="submit" value="Agregar Gato">
    </form>
</body>
</html>