<?php
session_start();
include('includes/db.php');

// Verifica si el usuario es administrador
if ($_SESSION['user']['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Verifica si se envió el formulario de calificaciones
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $matematicas = $_POST['matematicas'];
    $espanol = $_POST['espanol'];
    $ciencias = $_POST['ciencias'];
    $historia = $_POST['historia'];
    $geografia = $_POST['geografia'];
    $ingles = $_POST['ingles'];
    $educacion_fisica = $_POST['educacion_fisica'];

    // Verifica si el usuario ya tiene calificaciones
    $query = "SELECT * FROM calificaciones WHERE username='$username'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Si el usuario ya tiene calificaciones, actualiza las existentes
        $query = "UPDATE calificaciones SET 
                    matematicas='$matematicas', 
                    espanol='$espanol', 
                    ciencias='$ciencias', 
                    historia='$historia', 
                    geografia='$geografia', 
                    ingles='$ingles', 
                    educacion_fisica='$educacion_fisica' 
                  WHERE username='$username'";
    } else {
        // Inserta nuevas calificaciones
        $query = "INSERT INTO calificaciones 
                    (username, matematicas, espanol, ciencias, historia, geografia, ingles, educacion_fisica) 
                  VALUES 
                    ('$username', '$matematicas', '$espanol', '$ciencias', '$historia', '$geografia', '$ingles', '$educacion_fisica')";
    }

    if ($conn->query($query) === TRUE) {
        echo "Calificaciones registradas exitosamente.";
    } else {
        echo "Error al registrar calificaciones: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Calificaciones</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/calificaciones.css">
    <link rel="stylesheet" href="css/students.css">
</head>
<body>
<?php
    include('includes/header.php');
    ?>

<div class="container">
    <h2>Registro de Calificaciones</h2>
    <br>
        <form method="POST" action="">
            <div class="form-grid">
                <div class="form-group">
                    <label for="username">Nombre de Usuario:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="matematicas">Matemáticas:</label>
                    <input type="number" id="matematicas" step="0.01" name="matematicas" required>
                </div>
                <div class="form-group">
                    <label for="espanol">Español:</label>
                    <input type="number" id="espanol" step="0.01" name="espanol" required>
                </div>
                <div class="form-group">
                    <label for="ciencias">Ciencias:</label>
                    <input type="number" id="ciencias" step="0.01" name="ciencias" required>
                </div>
                <div class="form-group">
                    <label for="historia">Historia:</label>
                    <input type="number" id="historia" step="0.01" name="historia" required>
                </div>
                <div class="form-group">
                    <label for="geografia">Geografía:</label>
                    <input type="number" id="geografia" step="0.01" name="geografia" required>
                </div>
                <div class="form-group">
                    <label for="ingles">Inglés:</label>
                    <input type="number" id="ingles" step="0.01" name="ingles" required>
                </div>
                <div class="form-group">
                    <label for="educacion_fisica">Educación Física:</label>
                    <input type="number" id="educacion_fisica" step="0.01" name="educacion_fisica" required>
                </div>
            </div>
            <button type="submit" name="submit">Registrar Calificaciones</button>
        </form>
    </div>
    <a href="dashboard.php" class="btn-secondary">Regresar </a>
    </body>
</html>
