<?php
session_start();
include('includes/db.php');

// Verifica si el formulario ha sido enviado
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $role = 'estudiante'; // El rol se asigna como 'estudiante' por defecto

    // Inicializa variables de mensaje de error
    $username_error = '';
    $email_error = '';

    // Verifica si el nombre de usuario ya existe
    $query = "SELECT * FROM users WHERE username='$username' OR email='$email'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Revisa si el nombre de usuario ya está en uso
        $user_check = $conn->query("SELECT * FROM users WHERE username='$username'");
        if ($user_check->num_rows > 0) {
            $username_error = "El nombre de usuario ya está en uso. Elige otro.";
        }

        // Revisa si el correo electrónico ya está en uso
        $email_check = $conn->query("SELECT * FROM users WHERE email='$email'");
        if ($email_check->num_rows > 0) {
            $email_error = "El correo electrónico ya está en uso. Elige otro.";
        }
    } else {
        // Inserta el nuevo estudiante en la base de datos sin encriptar la contraseña
        $query = "INSERT INTO users (username, password, email, role) VALUES ('$username', '$password', '$email', '$role')";

        if ($conn->query($query) === TRUE) {
            echo "<script>alert('Registro exitoso. Ahora puedes iniciar sesión.');</script>";
            header("Location: login.php"); // Redirige al login después de registrarse
            exit(); // Asegúrate de salir después de la redirección
        } else {
            // Maneja el error de registro
            $error_message = "Error al registrar: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Estudiantes</title>
    <link rel="stylesheet" href="css/login.css">
    <script>
        // Muestra las alertas si hay mensajes de error
        <?php if (!empty($username_error)): ?>
            alert("<?php echo $username_error; ?>");
        <?php endif; ?>
        <?php if (!empty($email_error)): ?>
            alert("<?php echo $email_error; ?>");
        <?php endif; ?>
    </script>
</head>
<body>

    <div class="container">
        <div class="login-form">
            <h2>Registro de Estudiantes</h2>
            <form method="POST" action="">
                <div class="input-group">
                    <label for="name">Nombre Completo</label>
                    <input type="text" name="name" placeholder="Nombre Completo" required>
                </div>
                <div class="input-group">
                    <label for="username">Nombre de Usuario</label>
                    <input type="text" name="username" placeholder="Nombre de Usuario" required>
                </div>
                <div class="input-group">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" name="email" placeholder="Correo Electrónico" required>
                </div>
                <div class="input-group">
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" placeholder="Contraseña" required>
                </div>
                <button type="submit" name="register">Registrarse</button>
            </form>
            <form action="index.php" method="GET">
                <button type="submit" class="public-btn">Regresar</button>
            </form>
        </div>
    </div>

</body>
</html>
