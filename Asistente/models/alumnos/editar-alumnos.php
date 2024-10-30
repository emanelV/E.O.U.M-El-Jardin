<?php 
require_once '../../../includes/conexion.php'; 
if(!empty($_GET)){
    $idalumno = $_GET['idAlumno'];
    $sql = 'SELECT * FROM alumnos where alumno_id = ?';
    $query = $conn->prepare($sql);
    $query->execute(array($idalumno));  
    $result = $query->fetch(PDO::FETCH_ASSOC);
    if(empty($result)){
        $respuesta = array('status'=> false , 'message' => 'Datos no encontrados');

    }else{
        $sqlEncargado = 'SELECT * FROM encargado WHERE alumno_id = ?';
        $queryEncargado = $conn->prepare($sqlEncargado);
        $queryEncargado->execute(array($idalumno));  
        $resultEncargado = $queryEncargado->fetch(PDO::FETCH_ASSOC);

        if(empty($resultEncargado)){
            $respuesta = array(
                'status' => true,
                'data' => array(
                    'alumno' => $result,
                    'encargado' => null // No se encontró encargado
                )
            );
        }else{
            $respuesta = array(
                'status' => true,
                'data' => array(
                    'alumno' => $result,
                    'encargado' => $resultEncargado // Datos del encargado
                )
            );
        }
    }
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);

}