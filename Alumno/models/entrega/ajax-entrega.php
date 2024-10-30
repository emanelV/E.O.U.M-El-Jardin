<?php

require_once '../../../includes/conexion.php';


if(!empty($_POST)){
    if(trim($_POST['observacion']) == '' || empty($_FILES['file'])){
        $respuesta = array ('status' => false, 'msg' => 'Todos los campos son necesarios');
    }else{
    $idevaluacion = $_POST['idevaluacion']; 
    $id_alumno = $_POST['idalumno'];
    $observacion = $_POST['observacion']; 

    $material = $_FILES['file']['name'];
    $type = $_FILES['file']['type'];
    $url_temp = $_FILES['file']['tmp_name'];

    $directorio = '../../../uploads/'.rand(1000,10000); 
    if(!file_exists($directorio)){
        mkdir($directorio, 0777, true);
    }

    $destino = $directorio.'/'.$material; 


    if($_FILES['file']['size']>15000000){
        $respuesta = array('status'=> false ,'msg'=> 'Solo se permiten archivos de 15 mb');

    }else{
            $sqlInsert = 'INSERT INTO env_entregadas (evaluacion_id,alumno_id,material_alumno,observacion) values (?,?,?,?)';
            $queryInsert = $conn->prepare($sqlInsert);
            $request = $queryInsert->execute(array($idevaluacion, $id_alumno, $destino, $observacion));
            move_uploaded_file($url_temp,$destino);

        }
        if($request > 0){
            $respuesta = array('status'=> true,'msg'=> 'Actividad se envio correctamente'); 
        }
    }

    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}
