<?php
include('includes/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    
    $imagen = $_FILES['imagen']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($imagen);

    // Subir la imagen al servidor
    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $target_file)) {
        // Insertar los datos en la base de datos
        $query = "INSERT INTO horarios_publicos (imagen) 
                  VALUES ('$imagen')";
        if ($conn->query($query) === TRUE) {
            echo "Horario subido exitosamente.";
        } else {
            echo "Error al subir el horario: " . $conn->error;
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
    <title>Subir Horario Público</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/students.css">
    <link rel="stylesheet" href="css/credenciales.css">
</head>
<body>
<?php include('includes/header.php'); ?>


    <div class="container">
        <h2>Subir Horario. </h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="input-group">
            
           
            <div class="input-group">
            <br></br>
                <label for="imagen">Subir Imagen:</label>
                <input type="file" name="imagen" id="imagen" accept="image/*" required>
            </div>
            <br></br>
            <button type="submit">Subir </button>
        </form>
        
        <a href="dashboard.php" class="btn-secondary">Regresar</a>
    </div>
   
</body>

</html>
