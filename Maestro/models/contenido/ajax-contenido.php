<?php

require_once '../../../includes/conexion.php';

if (!empty($_POST)) {
    if (empty($_POST['titulo']) || empty($_POST['descripcion']) || empty($_FILES['file']['name'])) {
        $respuesta = array('status' => false, 'msg' => 'Todos los campos son necesarios, incluido el archivo.');
    } else {
        $idcontenido = $_POST['idContenido']; 
        $idcurso = $_POST['idCurso'];
        $titulo = $_POST['titulo']; 
        $descripcion = $_POST['descripcion'];
        $material = $_FILES['file']['name'];
        $type = $_FILES['file']['type'];
        $url_temp = $_FILES['file']['tmp_name'];

        // Directorio de almacenamiento
        $directorio = '../../../uploads/' . rand(1000, 10000); 
        if (!file_exists($directorio)) {
            mkdir($directorio, 0777, true);
        }

        $destino = $directorio . '/' . $material;

        if ($_FILES['file']['size'] > 15000000) {
            $respuesta = array('status' => false, 'msg' => 'Solo se permiten archivos de hasta 15 MB');
        } else {
            // Insertar contenido
            $sqlInsert = 'INSERT INTO contenidos (titulo, descripcion, material, pm_id) VALUES (?, ?, ?, ?)';
            $queryInsert = $conn->prepare($sqlInsert);
            $request = $queryInsert->execute(array($titulo, $descripcion, $destino, $idcurso));

            if ($request > 0) {

                move_uploaded_file($url_temp, $destino);
                $respuesta = array('status' => true, 'msg' => 'Contenido creado correctamente');
            } else {
                $respuesta = array('status' => false, 'msg' => 'Error al crear contenido');
            }
        }
    }

    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}
?>
