<?php
include('includes/db.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horarios </title>
   
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/horarios.css">
    <link rel="stylesheet" href="css/students.css">
</head>
<body>
    <?php include('includes/header_publica.php'); ?>
    <div class="container">
        <h2>Horarios </h2>
        <?php
        $query = "SELECT * FROM horarios_publicos";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                
                echo '<img src="uploads/' . $row['imagen'] . '" alt="Imagen del horario">';
            
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "<p>No hay horarios públicos disponibles.</p>";
        }
        ?>
    </div>
    <a href="dashboard_estudiantes.php" class="btn-secondary">Regresar</a>
</body>
</html>
