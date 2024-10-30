<?php

require_once '../../../includes/conexion.php';


if(!empty($_POST)){
    if(empty($_POST['titulo']) || empty($_POST['descripcion']) || empty($_POST['fecha']) || empty(['valor'])){
        $respuesta = array ('status' => false, 'msg' => 'Todos los campos son necesarios');
    }else{
    $idevaluacion = $_POST['idevaluacion']; 
    $idcontenido = $_POST['idcontenido'];
    $titulo = $_POST['titulo']; 
    $descripcion = $_POST['descripcion'];
    $fecha = $_POST['fecha'];
    $valor = $_POST['valor'];

        if($idevaluacion == 0){
            $sqlInsert = 'INSERT INTO evaluaciones (titulo_eva,descripcion,fecha,porcentaje,contenido_id) VALUES (?,?,?,?,?)';
            $queryInsert = $conn->prepare($sqlInsert);
            $request = $queryInsert->execute(array($titulo,$descripcion,$fecha,$valor,$idcontenido));
            $accion = 1; 
        }else{

                $sqlUpdate = 'UPDATE evaluaciones SET titulo_eva = ?, descripcion = ?, fecha = ?, porcentaje = ?, contenido_id = ? WHERE evaluacion_id = ?';
                $queryUpdate = $conn->prepare($sqlUpdate);
                $request = $queryUpdate->execute(array($titulo,$descripcion,$fecha,$valor, $idcontenido,$idevaluacion));
                $accion = 2; 
        }
        if($request > 0){
            if($accion == 1){
            $respuesta = array('status'=> true,'msg'=> 'Actividad creada correctamente'); 
         } else{
                $respuesta = array('status'=> true,'msg'=> 'Actividad actualizada correctamente');
            }
        }
    
}
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}


?>