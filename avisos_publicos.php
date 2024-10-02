<?php
include('includes/db.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avisos Públicos.</title>
  
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/horarios.css">
    <link rel="stylesheet" href="css/students.css">
    <style>
        .aviso-card {
            border: 1px solid #ddd;
            padding: 15px;
            margin: 10px 0;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            flex-wrap: wrap;
        }
        .aviso-card img {
            max-width: 150px;
            margin-right: 20px;
            margin-bottom: 10px;
        }
        .aviso-card .info {
            flex: 1;
        }
        .aviso-card .fecha {
            font-size: 0.9em;
            color: #666;
        }
    </style>
</head>
<body>
<?php include('includes/header_publica.php'); ?>

    <div class="container">
        <h2>Avisos Importantes.</h2>
        <?php
        $query = "SELECT * FROM avisos_publicos ORDER BY fecha DESC";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="aviso-card">';
                echo '<img src="uploads/' . $row['imagen'] . '" alt="Imagen del aviso">';
                echo '<div class="info">';
                echo '<h3>' . $row['titulo'] . '</h3>';
                echo '<p>' . $row['descripcion'] . '</p>';
                echo '<p class="fecha">Publicado el: ' . $row['fecha'] . '</p>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "<p>No hay avisos públicos disponibles.</p>";
        }
        ?>
    </div>
    
     <a href="index.php" class="btn-secondary">Regresar</a>
    </div>
</body>
</html>
