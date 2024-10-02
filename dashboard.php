<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SEC</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/students.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    
</head>
<body>
<?php
    include('includes/header.php');
    ?>
    <main>
        <h2>Hola, <?php echo $user['username']; ?></h2>
        <p>¿Qué desea hacer hoy?</p>
        <div class="dashboard-grid">
            <a href="students.php" class="dashboard-item">
                <img src="img/Alumnos.png" alt="Registrar alumno">
                <span>Registrar Alumno</span>
            </a>
            <a href="groups.php" class="dashboard-item">
                <img src="img/Grupos.png" alt="Administrar grupos">
                <span>Administrar Grupos</span>
            </a>
            <a href="teachers.php" class="dashboard-item">
                <img src="img/docentes.png" alt="Administrar docentes">
                <span>Administrar Docentes</span>
            </a>
            <a href="horarios_Admin.php" class="dashboard-item">
                <img src="img/docentes.png" alt="Agregar horarios">
                <span>Agregar horarios</span>
            </a>
            <a href="Add_avisos.php" class="dashboard-item">
                <img src="img/docentes.png" alt="Subir aviso">
                <span>Subir aviso</span>
            </a>
            <a href="subir_calificaciones.php" class="dashboard-item">
                <img src="img/docentes.png" alt="Subir aviso">
                <span>Subir calificaciones</span>
            </a>
        </div>
        <br>
        <br><br><br>
        <a href="logout.php" class="btn-secondary">Cerrar sesión </a>
    </main>
    <footer>
    </footer>
</body>
</html>
