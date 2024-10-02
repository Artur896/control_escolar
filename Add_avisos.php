<?php
include('includes/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $imagen = $_FILES['imagen']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($imagen);

    // Subir la imagen al servidor
    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $target_file)) {
        // Insertar los datos en la base de datos
        $query = "INSERT INTO avisos_publicos (titulo, descripcion, imagen) 
                  VALUES ('$titulo', '$descripcion', '$imagen')";
        if ($conn->query($query) === TRUE) {
            echo "Aviso subido exitosamente.";
        } else {
            echo "Error al subir el aviso: " . $conn->error;
        }
    } else {
        echo "Error al subir la imagen.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Aviso Público</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/credenciales.css">
</head>
<body>
    <?php include('includes/header.php'); ?>
    <div class="container">
        <h2>Subir Aviso Público</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="input-group">
                <label for="titulo">Título del Aviso:</label>
                <input type="text" name="titulo" id="titulo" required>
            </div>
            <div class="input-group">
                <label for="descripcion">Descripción:</label>
                <textarea name="descripcion" id="descripcion" rows="5" required></textarea>
            </div>
            <div class="input-group">
                <label for="imagen">Subir Imagen:</label>
                <input type="file" name="imagen" id="imagen" accept="image/*" required>
            </div>
            <br></br>
            <button type="submit">Subir Aviso</button>
            <br></br>
            <a href="dashboard.php" class="btn-secondary"></a>
        </form>
    </div>
</body>
</html>
