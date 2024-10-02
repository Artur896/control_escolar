<?php
session_start();
include('includes/db.php');

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Comprobación de cada campo individualmente
    if (
        !empty($_POST['grupo']) && 
        !empty($_POST['nombre']) && 
        !empty($_POST['curp']) && 
        !empty($_POST['edad']) && 
        !empty($_POST['genero']) && 
        !empty($_POST['direccion']) && 
        !empty($_POST['nombreTutor']) && 
        !empty($_POST['numeroTutor'])
    ) {
        $grupo = $conn->real_escape_string($_POST['grupo']);
        $nombre = $conn->real_escape_string($_POST['nombre']);
        $curp = $conn->real_escape_string($_POST['curp']);
        $edad = (int) $_POST['edad']; // Asegurarnos de que es un número entero
        $genero = $conn->real_escape_string($_POST['genero']);
        $direccion = $conn->real_escape_string($_POST['direccion']);
        $nombreTutor = $conn->real_escape_string($_POST['nombreTutor']);
        $numeroTutor = $conn->real_escape_string($_POST['numeroTutor']);

        // Inserción en la base de datos
        $query = "INSERT INTO students (grupo, nombre, curp, edad, genero, direccion, nombreTutor, numeroTutor) 
                  VALUES ('$grupo', '$nombre', '$curp', $edad, '$genero', '$direccion', '$nombreTutor', '$numeroTutor')";
        if ($conn->query($query) === TRUE) {
            echo "Estudiante añadido exitosamente";
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Por favor, complete todos los campos.";
    }
}

$query = "SELECT * FROM students";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Estudiantes - Control escolar</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/students.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <?php
    include('includes/header.php');
    ?>
    <main>
        <div class="container">
            <h2>Gestión de Estudiantes.</h2>
            <form method="POST" action="" class="student-form">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="grupo">Grupo:</label>
                        <select id="grupo" name="grupo" required>
                            <option value="">Seleccionar grupo</option>
                            <option value="Primero A"> Primero A</option>
                            <option value="Primero B"> Primero B</option>
                            <!-- Add more options as needed -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nombreCompleto">Nombre Completo:</label>
                        <input type="text" id="nombre" name="nombre" placeholder="Nombre del estudiante" required>
                    </div>
                    <div class="form-group">
                        <label for="curp">CURP:</label>
                        <input type="text" id="curp" name="curp" placeholder="CURP" required>
                    </div>
                    <div class="form-group">
                        <label for="edad">Edad:</label>
                        <input type="number" id="edad" name="edad" placeholder="Edad" required>
                    </div>
                    <div class="form-group">
                        <label for="genero">Género:</label>
                        <select id="genero" name="genero" required>
                            <option value="">Seleccionar género</option>
                            <option value="femenino">Femenino</option>
                            <option value="masculino">Masculino</option>
                            <option value="otro">Otro</option>
                            </select>
                            <br></br>
                            
                    </div>
                    <div class="form-group">
                        <label for="nombreTutor">Nombre del tutor:</label>
                        <input type="text" id="nombreTutor" name="nombreTutor" placeholder="Nombre del tutor" required>
                    </div>
                    <div class="form-group">
                        <label for="numeroTutor">Número del tutor:</label>
                        <input type="text" id="numeroTutor" name="numeroTutor" placeholder="Número del tutor" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="direccion">Dirección (Colonia, Calle y Número):</label>
                        <textarea id="direccion" name="direccion" placeholder="Dirección" required></textarea>
                    </div>
                </div>
                <br></br>
                <button type="submit" name="add_student" class="btn-primary">Añadir Estudiante</button>
            </form>
            <table class="student-table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>CURP</th>
                        <th>Edad</th>
                        <th>Grado y Grupo</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Código para recuperar y mostrar los estudiantes
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['curp']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['edad']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['grupo']) . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
          
            <a href="dashboard.php" class="btn-secondary">Regresar </a>
        </div>
    </main>
    <footer>
    </footer>
</body>
</html>
