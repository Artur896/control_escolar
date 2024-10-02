<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generador de Credenciales Escolares</title>
    
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/credenciales.css">
    <link rel="stylesheet" href="css/students.css">
</head>
<body>
<?php
    include('includes/header.php');
    ?>
    <div class="container">
    <h1>Generador de Credenciales Escolares.</h1>
    <form action="generate_pdf.php" method="POST" enctype="multipart/form-data">
        <label for="studentName">Nombre del Estudiante:</label>
        <input type="text" id="studentName" name="studentName" required>
        
        <label for="studentId">ID del Estudiante:</label>
        <input type="text" id="studentId" name="studentId" required>
        
        <label for="grade">Grado:</label>
        <input type="text" id="grade" name="grade" required>
        
        <label for="classSection">Grupo:</label>
        <input type="text" id="classSection" name="classSection" required>
        
        <label for="turno">Turno:</label>
        <input type="text" id="turno" name="turno" required>

        <label for="studentPhoto">Foto del Estudiante:</label>
        <input type="file" id="studentPhoto" name="studentPhoto" accept="image/*" required>
        <br></br>
        <button type="submit">Descargar Credencial</button>
    </form></div>
   
    <a href="dashboard_estudiantes.php" class="btn-secondary">Regresar</a>

</body>
</html>
