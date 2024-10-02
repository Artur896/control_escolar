<?php
session_start();
include('includes/db.php');

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password']; // Encripta la contraseña ingresada

    // Consulta con verificación de usuario y contraseña
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['user'] = $row; // Guarda la información del usuario en la sesión

        // Verifica el rol del usuario para redirigir
        if ($row['role'] === 'admin') {
            header("Location: dashboard.php"); // Redirige al panel de admin
        } elseif ($row['role'] === 'estudiante') {
            header("Location: dashboard_estudiantes.php"); // Redirige al panel de estudiante
        } else {
            echo "Rol no reconocido. Contacta al administrador.";
        }
    } else {
        echo "Usuario o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SEC</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>

    <div class="container">
        <div class="login-form">
            <h2>Inicio de Sesión:</h2>
            <form method="POST" action="">
                <div class="input-group">
                    <input type="text" name="username" placeholder="Usuario" required>
                    <span class="input-icon">&#128100;</span>
                </div>
                <div class="input-group">
                    <input type="password" name="password" placeholder="Contraseña" required>
                    <span class="input-icon">&#128274;</span>
                </div>
                <button type="submit" name="login">Entrar</button>
            </form>
            <!-- Botón para usuarios públicos -->
            <form action="registro_estudiantes.php" method="GET">
                <button type="submit" class="public-btn">Registrate</button>
            </form>
            <form action="index.php" method="GET">
                <button type="submit" class="public-btn">Regresar</button>
            </form>

        </div>
    </div>
</body>
</html>
