<?php 
require_once '../../../includes/conexion.php'; 
if(!empty($_GET)){
    $idgrado = $_GET['idGrado'];
    $sql = 'SELECT * FROM grados where grado_id = ?';
    $query = $conn->prepare($sql);
    $query->execute(array($idgrado));  
    $result = $query->fetch(PDO::FETCH_ASSOC);
    if(empty($result)){
        $respuesta = array('status'=> false , 'message' => 'Datos no encontrados');

    }else{
        $respuesta = array('status' => true, 'data' => $result);
    }
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);

}