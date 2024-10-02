<?php
session_start();
include('includes/db.php');
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header("Location: index.php");
    exit();
}

if (isset($_POST['add_teacher'])) {
    $name = $_POST['name'];
    $subject = $_POST['subject'];

    $query = "INSERT INTO teachers (name, subject) VALUES ('$name', '$subject')";
    $conn->query($query);
}

$query = "SELECT * FROM teachers";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gestión de Maestros</title>

    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/students.css">
    <link rel="stylesheet" href="css/tablas.css">
</head>
<body>

    <?php
    include ('includes/header.php');
    ?>
    <div class="container">
        <h1>Gestión de Maestros.</h1>
        <form method="POST" action="">
            <input type="text" name="name" placeholder="Nombre del maestro" required>
            <input type="text" name="subject" placeholder="Materias" required>
            <button type="submit" name="add_teacher">Añadir Maestro</button>
        </form>
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Materias</th>
            </tr>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['subject']; ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
        <a href="dashboard.php" class="btn-secondary">Regresar</a>
    </div>
    <footer></footer>
</body>
</html>
