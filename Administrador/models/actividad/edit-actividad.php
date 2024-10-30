<?php 
require_once '../../../includes/conexion.php'; 
if(!empty($_GET)){
    $idactividad = $_GET['idActividad'];
    $sql = 'SELECT * FROM actividad where actividad_id = ?';
    $query = $conn->prepare($sql);
    $query->execute(array($idactividad));  
    $result = $query->fetch(PDO::FETCH_ASSOC);
    if(empty($result)){
        $respuesta = array('status'=> false , 'message' => 'Datos no encontrados');

    }else{
        $respuesta = array('status' => true, 'data' => $result);
    }
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);

}