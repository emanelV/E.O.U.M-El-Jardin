<?php 
require_once '../../../includes/conexion.php'; 
if(!empty($_GET)){
    $idaula= $_GET['idAula'];
    $sql = 'SELECT * FROM aulas where aula_id = ?';
    $query = $conn->prepare($sql);
    $query->execute(array($idaula));  
    $result = $query->fetch(PDO::FETCH_ASSOC);
    if(empty($result)){
        $respuesta = array('status'=> false , 'message' => 'Datos no encontrados');

    }else{
        $respuesta = array('status' => true, 'data' => $result);
    }
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);

}