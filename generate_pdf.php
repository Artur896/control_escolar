<?php
require('fpdf/fpdf.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibiendo datos del formulario
    $studentName = $_POST['studentName'];
    $studentId = $_POST['studentId'];
    $grade = $_POST['grade'];
    $classSection = $_POST['classSection'];
    $turno = $_POST['turno'];

    // Procesando la imagen subida
    if (isset($_FILES['studentPhoto']) && $_FILES['studentPhoto']['error'] == 0) {
        $photoTmpPath = $_FILES['studentPhoto']['tmp_name'];
        $photoName = basename($_FILES['studentPhoto']['name']);
        $uploadDir = 'uploads/'; // Directorio de subida
        $photoPath = $uploadDir . $photoName;

        // Moviendo la imagen subida al directorio especificado
        if (!move_uploaded_file($photoTmpPath, $photoPath)) {
            die('Error: No se pudo mover la foto subida.');
        }
    } else {
        die('Error: No se subió ninguna foto o hubo un problema en la subida.');
    }

    // Definir ruta del logo
    $logoPath = 'uploads/fondo.png'; // Ruta del logo

    // Verificar que el archivo del logo exista
    if (!file_exists($logoPath)) {
        die('Error: No se encuentra el archivo del logo en la ruta especificada.');
    }

    // Crear el PDF
    $pdf = new FPDF('P', 'mm', array(85.6, 67.2)); // Tamaño de la tarjeta tipo ID
    $pdf->AddPage();

    // Fondo de la tarjeta
    $pdf->SetFillColor(255, 255, 255); // Color de fondo blanco
    $pdf->Rect(0, 0, 65.6, 30, 'F'); // Fondo completo

    // Agregar foto del estudiante
    $pdf->Image($photoPath, 3, 8, 14, 14); // Ruta, posición x, posición y, tamaño

    // Nombre del estudiante
    $pdf->SetFont('Arial', '', 7);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetXY(19, 8); // Posición del texto
    $pdf->Cell(45, 18, $studentName, 0, 1, 'L');

    // ID del estudiante
    $pdf->SetFont('Arial', '', 7);
    $pdf->SetXY(40, 15);
    $pdf->Cell(45, 13, 'ID: ' . $studentId, 0, 1, 'L');

    // Grado y sección del estudiante
    $pdf->SetFont('Arial', '', 7);
    $pdf->SetXY(16, 15);
    $pdf->Cell(45, 12, 'GRADO:' . $grade . ' - ' . $classSection, 0, 1, 'L');

    // Agregar logo
    $pdf->Image($logoPath, 0.3, 0.3, 65.7, 30); // Ruta, posición x, posición y, tamaño


    //turno 
    $pdf->SetFont('Arial', '', 7);
    $pdf->SetXY(22, 18);
    $pdf->Cell(45, 16, 'TURNO:' . $turno,  0, 1, 'L');


    //Instituto
    $pdf->SetFont('Arial', '', 7);
    $pdf->SetXY(15, 1);
    $pdf->Cell(25, 18, 'ESC SECUNDARIA OFICIAL NO. 0933',  0, 1, 'L');

    // Pie de página
    $pdf->SetFont('Arial', '', 7);
    $pdf->SetXY(18, 6.5);
    $pdf->Cell(15, 13, '"SOR JUANA INES DE LA CRUZ"', 0, 1, 'L');

    // Salida del PDF
    $pdf->Output('D', 'credencial_escolar.pdf');
}
?>
