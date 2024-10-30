<?php

require_once '../../../includes/conexion.php'; 

if($_POST){
 $idperiodo = $_POST ['idPeriodo']; 
 $sql = "UPDATE periodos set estado= 0 where periodo_id = ?"; 
 $query = $conn ->prepare($sql);
 $result=$query->execute(array($idperiodo));
 if($result){

    $respuesta = array ('status'=>true,'msg'=> 'Periodo Eliminado Satisfactoriamente');
 }else{
    $respuesta = array ('status'=>false,'msg'=> 'Error no se pudo eliminar');

 }
 echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);

}