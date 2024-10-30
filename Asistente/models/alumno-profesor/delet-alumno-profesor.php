<?php

require_once '../../../includes/conexion.php'; 

if($_POST){
 $idAlumnoProfesor = $_POST ['id']; 
 $sql = "UPDATE procesoalumno set estadop= 0 where ap_id = ?"; 
 $query = $conn ->prepare($sql);
 $result=$query->execute(array($idAlumnoProfesor));
 if($result){

    $respuesta = array ('status'=>true,'msg'=> 'Asignacion Eliminada Satisfactoriamente');
 }else{
    $respuesta = array ('status'=>false,'msg'=> 'Error no se pudo eliminar');

 }
 echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);

}