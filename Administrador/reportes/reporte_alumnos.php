<?php
require '../vendor/autoload.php'; // Cargar la autoloader de Composer

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Font;

// Crear una nueva hoja de cálculo
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Agregar el título
$sheet->setCellValue('A1', 'Reporte de Alumnos');

// Establecer el estilo del título (opcional)
$sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
$sheet->mergeCells('A1:C1'); // Fusionar celdas del título

// Agregar los encabezados
$sheet->setCellValue('A2', 'No.');
$sheet->setCellValue('B2', 'Codigo Personal');
$sheet->setCellValue('C2', 'Apellidos');
$sheet->setCellValue('D2', 'Nombre');
$sheet->setCellValue('E2', 'Fecha de Nacimiento');
$sheet->setCellValue('F2', 'No. De Identicacion');
$sheet->setCellValue('G2', 'Genero');

// Conectar a la base de datos
require_once '../../includes/conexion.php'; 
$sql = "SELECT alumno_id, cod_personal, nombre_alumno, apellidos_alumno, direccion, cui, fecha_nac, CASE WHEN genero = '1' THEN 
'MASCULINO' WHEN genero = '2' THEN 'FEMENINO' ELSE 'DESCONOCIDO' END AS genero, fecha_registro, estado, u_acceso FROM alumnos"; 
$query = $conn->prepare($sql);
$query->execute();
$row = $query->rowCount();

if ($row > 0) {
    $rowIndex = 3; // Comienza desde la tercera fila (la segunda fila es para encabezados)
    while ($data = $query->fetch()) {
        $sheet->setCellValue('A' . $rowIndex, $data['alumno_id']);
        $sheet->setCellValue('B' . $rowIndex, $data['cod_personal']);
        $sheet->setCellValue('C' . $rowIndex, $data['apellidos_alumno']);
        $sheet->setCellValue('D' . $rowIndex, $data['nombre_alumno']);
        $sheet->setCellValue('E' . $rowIndex, $data['fecha_nac']);
        $sheet->setCellValue('F' . $rowIndex, $data['cui']);
        $sheet->setCellValue('G' . $rowIndex, $data['genero']);

        $rowIndex++;
    }
}

// Configurar encabezados para la descarga del archivo
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="ReportedeAlumnos.xlsx"');
header('Cache-Control: max-age=0');

// Crear el escritor de Excel y guardar la salida
$writer = new Xlsx($spreadsheet);
$writer->save('php://output'); // Esto envía el archivo al navegador para la descarga

exit; // Termina el script para evitar que se envíen más datos
