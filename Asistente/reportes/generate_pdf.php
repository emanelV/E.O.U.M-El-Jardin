<?php
require '../../vendor/setasign/fpdf/fpdf.php';
require_once '../../includes/conexion.php';

if (isset($_GET['alumno_id'])) {
    $alumno_id = $_GET['alumno_id'];

    // Consulta para obtener las notas del alumno
    $sql = "SELECT m.nombre_materia, SUM(n.valor_nota) AS suma_total_notas 
            FROM notas AS n 
            INNER JOIN env_entregadas AS ev_e ON n.ev_entregada_id = ev_e.ev_entregada_id 
            INNER JOIN alumnos AS al ON ev_e.alumno_id = al.alumno_id 
            INNER JOIN evaluaciones AS ev ON ev_e.evaluacion_id = ev.evaluacion_id 
            INNER JOIN contenidos AS c ON ev.contenido_id = c.contenido_id 
            INNER JOIN procesoprofesor AS pm ON c.pm_id = pm.pm_id 
            INNER JOIN materias AS m ON pm.materia_id = m.materia_id 
            WHERE al.alumno_id = :alumno_id 
            GROUP BY m.nombre_materia";

    $query = $conn->prepare($sql);
    $query->bindParam(':alumno_id', $alumno_id, PDO::PARAM_INT);
    $query->execute();
    $notas = $query->fetchAll(PDO::FETCH_ASSOC);

    $sql_alumno = "SELECT nombre_alumno, apellidos_alumno FROM alumnos WHERE alumno_id = :alumno_id";
    $query_alumno = $conn->prepare($sql_alumno);
    $query_alumno->bindParam(':alumno_id', $alumno_id, PDO::PARAM_INT);
    $query_alumno->execute();
    $alumno = $query_alumno->fetch(PDO::FETCH_ASSOC);
    $nombre_alumno = $alumno['nombre_alumno'] ?? 'Desconocido';
    $apellidos_alumno = $alumno['apellidos_alumno'] ?? 'Desconocido';
 

    // Crear el PDF
    $pdf = new FPDF(); 
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $imagePath = '../../images/logeljardin.jpg'; // Ruta de la imagen
    $imageWidth = 40; 
    $imageHeight = 40; 
    
    $imageX = ($pdf->GetPageWidth() - $imageWidth) / 2; // Posición X centrada
    
    $pdf->Image($imagePath, $imageX, 10, $imageWidth, $imageHeight); // Carga la imagen con dimensiones especificadas
    $pdf->Ln(40);
    $pdf->Cell(0, 10, 'E.O.U.M El Jardin', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 7, 'Barrio El Jardin Coatepeque, Quetzaltenango', 0, 1, 'C');
    $pdf->Cell(0, 10, 'Informe de Notas del Alumno', 0, 1, 'C');

    // Información del alumno (puedes ajustar los datos según los que necesites mostrar)
   $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 7, 'Nombre: ' . $nombre_alumno, 0, 1);
    $pdf->Cell(0, 7, 'Apellidos: ' . $apellidos_alumno, 0, 1);
    $pdf->Cell(0, 10, 'No: ' . $alumno_id, 0, 1);
    $pdf->Ln(10);
    // Encabezados de la tabla
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(100, 10, 'Materia', 1);
    $pdf->Cell(90, 10, 'Total', 1);
    $pdf->Ln();

    // Datos de las notas
    $pdf->SetFont('Arial', '', 12);
    foreach ($notas as $nota) {
        $pdf->Cell(100, 10, $nota['nombre_materia'], 1);
        $pdf->Cell(90, 10, $nota['suma_total_notas'], 1);
        $pdf->Ln();
    }

    // Enviar el PDF al navegador
    $pdf->Output('D', 'InformeNotasAlumno.pdf');
}
