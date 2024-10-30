<?php
require '../vendor/autoload.php'; 

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Font;

// Crear una nueva hoja de cálculo
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();


$sheet->setCellValue('A1', 'Reporte de Profesores');

$sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
$sheet->mergeCells('A1:C1'); 

// Agregar los encabezados
$sheet->setCellValue('A2', 'No.');
$sheet->setCellValue('B2', 'Nombre');
$sheet->setCellValue('C2', 'Apellidos');
$sheet->setCellValue('D2', 'Dpi');
$sheet->setCellValue('E2', 'Correo');


// Conectar a la base de datos
require_once '../../includes/conexion.php'; 
$sql = "SELECT * FROM profesor"; 
$query = $conn->prepare($sql);
$query->execute();
$row = $query->rowCount();

if ($row > 0) {
    $rowIndex = 3; // Comienza desde la tercera fila (la segunda fila es para encabezados)
    while ($data = $query->fetch()) {
        $sheet->setCellValue('A' . $rowIndex, $data['profesor_id']);
        $sheet->setCellValue('B' . $rowIndex, $data['nombre']);
        $sheet->setCellValue('C' . $rowIndex, $data['apellidos']);
        $sheet->setCellValue('D' . $rowIndex, $data['dpi']);
        $sheet->setCellValue('E' . $rowIndex, $data['correo']);


        $rowIndex++;
    }
}


header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="ReportedeProfesores.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output'); 

exit; // Termina el script para evitar que se envíen más datos
