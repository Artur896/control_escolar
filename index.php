
<!DOCTYPE html>
<html lang="es">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SEC</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <nav></nav>
    <?php include('includes/header_publica.php'); ?>
    <main>
        <h2>HOLA, BIENVENIDO</h2>
        <p> ¿En qué podemos ayudarte?</p>
        <div class="dashboard-grid">
            <a href="avisos_publicos.php" class="dashboard-item">
                <img src="img/aviso.png" alt="Avisos">
                <span>Avisos</span>
            </a>
            <a href="login.php" class="dashboard-item">
                <img src="img/HORARIO.png" alt="Horarios">
                <span>Inicio de Sesión</span>
            </a>
            <a href="horarios_publico.php" class="dashboard-item">
                <img src="img/HORARIO.png" alt="Horarios">
                <span>Horarios</span>
            </a>
        </div>
        <br></br>
        <img src="img/Foto1.jpg" class="rounded float-start" alt="...", width="480", height="240">
    </main>
    <footer>

    </footer>
</body>
</html>