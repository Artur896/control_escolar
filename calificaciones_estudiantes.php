<?php
session_start();
include('includes/db.php');

// Verifica si el usuario está conectado
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// Obtiene las calificaciones del usuario actual
$username = $_SESSION['user']['username'];
$query = "SELECT * FROM calificaciones WHERE username='$username'";
$result = $conn->query($query);
$calificaciones = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calificaciones de Estudiante</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/tablas.css">
</head>
<body>
<?php
    include('includes/header_publica.php');
    ?>

    <h2>Calificaciones</h2>
    <table>
        <thead>
            <tr>
                <th>Materia</th>
                <th>Calificación</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Matemáticas</td>
                <td><?php echo $calificaciones['matematicas']; ?></td>
            </tr>
            <tr>
                <td>Español</td>
                <td><?php echo $calificaciones['espanol']; ?></td>
            </tr>
            <tr>
                <td>Ciencias</td>
                <td><?php echo $calificaciones['ciencias']; ?></td>
            </tr>
            <tr>
                <td>Historia</td>
                <td><?php echo $calificaciones['historia']; ?></td>
            </tr>
            <tr>
                <td>Geografía</td>
                <td><?php echo $calificaciones['geografia']; ?></td>
            </tr>
            <tr>
                <td>Inglés</td>
                <td><?php echo $calificaciones['ingles']; ?></td>
            </tr>
            <tr>
                <td>Educación Física</td>
                <td><?php echo $calificaciones['educacion_fisica']; ?></td>
            </tr>
        </tbody>
    </table>
    <br>
    <button onclick="window.print();">Imprimir Boleta</button>
    <br><br>
    <!-- Botón para generar PDF -->
    <form action="generar_pdf.php" method="GET">
        <button type="submit">Descargar PDF</button>
    </form>
</body>
</html>
