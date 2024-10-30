<?php

require_once '../../../includes/conexion.php'; 

if($_POST){
 $idaula = $_POST ['idAula']; 
 $sql = "UPDATE aulas set estado= 0 where aula_id = ?"; 
 $query = $conn ->prepare($sql);
 $result=$query->execute(array($idaula));
 if($result){

    $respuesta = array ('status'=>true,'msg'=> 'Seccion Eliminada Satisfactoriamente');
 }else{
    $respuesta = array ('status'=>false,'msg'=> 'Error no se pudo eliminar');

 }
 echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);

}