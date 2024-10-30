<?php

require_once '../../../includes/conexion.php'; 

if($_POST){
 $idalumno = $_POST ['idAlumno']; 
 $sql = "UPDATE alumnos set estado = 0 where alumno_id = ?"; 
 $query = $conn ->prepare($sql);
 $result=$query->execute(array($idalumno));
 if($result){

    $respuesta = array ('status'=>true,'msg'=> 'Alumno eliminado satisfactoriamente');
 }else{
    $respuesta = array ('status'=>false,'msg'=> 'Error no se pudo eliminar');

 }
 echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);

}