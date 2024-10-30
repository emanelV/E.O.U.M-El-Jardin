<?php

require_once '../../../includes/conexion.php'; 

if($_POST){
 $idactividad = $_POST ['idActividad']; 
 $sql = "UPDATE actividad set estado= 0 where actividad_id = ?"; 
 $query = $conn ->prepare($sql);
 $result=$query->execute(array($idactividad));
 if($result){

    $respuesta = array ('status'=>true,'msg'=> 'Actividad Eliminada Satisfactoriamente');
 }else{
    $respuesta = array ('status'=>false,'msg'=> 'Error no se pudo eliminar');

 }
 echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);

}