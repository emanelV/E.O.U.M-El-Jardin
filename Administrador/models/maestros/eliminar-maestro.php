<?php

require_once '../../../includes/conexion.php'; 

if($_POST){
 $idprofesor = $_POST ['idProfesor']; 
 $sql = "UPDATE profesor set estado= 0 where profesor_id = ?"; 
 $query = $conn ->prepare($sql);
 $result=$query->execute(array($idprofesor));
 if($result){

    $respuesta = array ('status'=>true,'msg'=> 'Profesor Eliminado Satisfactoriamente');
 }else{
    $respuesta = array ('status'=>false,'msg'=> 'Error no se pudo eliminar');

 }
 echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);

}