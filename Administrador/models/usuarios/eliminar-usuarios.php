<?php

require_once '../../../includes/conexion.php'; 

if($_POST){
 $idusuario = $_POST ['idusuario']; 
 $sql = "UPDATE usuarios set activo = 0 where ID_USUARIO = ?"; 
 $query = $conn ->prepare($sql);
 $result=$query->execute(array($idusuario));
 if($result){

    $respuesta = array ('status'=>true,'msg'=> 'Usuario Eliminado Satisfactoriamente');
 }else{
    $respuesta = array ('status'=>false,'msg'=> 'Error no se pudo eliminar');

 }
 echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);

}