<?php

require_once '../../../includes/conexion.php'; 

if($_POST){
 $idprofesormateria = $_POST ['id']; 
 $sql = "UPDATE procesoprofesor set estadopm= 0 where pm_id = ?"; 
 $query = $conn ->prepare($sql);
 $result=$query->execute(array($idprofesormateria));
 if($result){

    $respuesta = array ('status'=>true,'msg'=> 'Asignacion Eliminada Satisfactoriamente');
 }else{
    $respuesta = array ('status'=>false,'msg'=> 'Error no se pudo eliminar');

 }
 echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);

}