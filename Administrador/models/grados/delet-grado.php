<?php

require_once '../../../includes/conexion.php'; 

if($_POST){
 $idgrado = $_POST ['idGrado']; 
 $sql = "UPDATE grados set estado= 0 where grado_id = ?"; 
 $query = $conn ->prepare($sql);
 $result=$query->execute(array($idgrado));
 if($result){

    $respuesta = array ('status'=>true,'msg'=> 'Grado Eliminado Satisfactoriamente');
 }else{
    $respuesta = array ('status'=>false,'msg'=> 'Error no se pudo eliminar');

 }
 echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);

}