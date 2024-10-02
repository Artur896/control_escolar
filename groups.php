<?php
session_start();
include('includes/db.php');
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header("Location: index.php");
    exit();
}

if (isset($_POST['add_group'])) {
    $grade = $_POST['grade'];
    $group_name = $_POST['group_name'];

    $query = "INSERT INTO classes (grade, subject) VALUES ('$grade', '$group_name')";
    $conn->query($query);
}

$query = "SELECT * FROM classes";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset = "UTF-8">
    <title>Administrar Grupos</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/students.css">
    <link rel="stylesheet" href="css/tablas.css">
</head>
<body>
    <?php
    include('includes/header.php');
    ?>
    <div class="container">
        <h1>Administrar Grupos</h1>
      
        <form method="POST" action="">
            <input type="text" name="grade" placeholder="Grado" required>
            <input type="text" name="group_name" placeholder="Nombre del grupo" required>
            <button type="submit" name="add_group">Añadir Grupo</button>
        </form>
        <table>
            <tr>
                <th>No.</th>
                <th>Grado</th>
                <th>Grupo</th>
            </tr>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['grade']; ?></td>
                <td><?php echo $row['subject']; ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
        <a href="dashboard.php" class="btn-secondary">Regresar</a>
        </div>
</body>
</html>
