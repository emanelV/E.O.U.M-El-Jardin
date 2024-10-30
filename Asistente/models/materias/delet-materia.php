<?php

require_once '../../../includes/conexion.php'; 

if($_POST){
 $idmateria = $_POST ['idMateria']; 
 $sql = "UPDATE materias set estado= 0 where materia_id = ?"; 
 $query = $conn ->prepare($sql);
 $result=$query->execute(array($idmateria));
 if($result){

    $respuesta = array ('status'=>true,'msg'=> 'Materia Eliminada Satisfactoriamente');
 }else{
    $respuesta = array ('status'=>false,'msg'=> 'Error no se pudo eliminar');

 }
 echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);

}