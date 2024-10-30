
<?php 
require_once '../../../includes/conexion.php'; 
if(!empty ($_POST)){
    if(empty($_POST['nombreActividad'])){
        $respuesta = array('status' => false ,'msg'=> 'Todos los campos son obligatorios');
    }else {
        /*las variables se igualan al name del formulario que esta en el modal*/
        $idactividad = $_POST['idActividad'];
        $nombre = $_POST['nombreActividad'];
        $estado = $_POST['listEstado'];
        /* aca se encrypta la clave para ser enviada a la base de datos */

        $sql = 'SELECT * FROM actividad where nombre_actividad = ? AND actividad_id != ? AND estado != 0'; 
        $query = $conn-> prepare($sql);
        $query->execute(array($nombre,$idactividad)); 
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if($result>0){
            $respuesta = array('status'=> false ,'msg'=> 'La actividad ya existe');

        }
        else{
            if($idactividad == 0){
                $sqlInsert = 'INSERT INTO actividad (nombre_actividad,estado) VALUES (?,?)';
                $queryInsert = $conn->prepare($sqlInsert);
                $request = $queryInsert->execute(array($nombre,$estado));
                $action = 1; 
            }else{
                    $sqlUpdate = 'UPDATE actividad SET nombre_actividad = ?,estado = ? WHERE actividad_id = ?';
                    $queryUpdate = $conn->prepare($sqlUpdate);
                    $request = $queryUpdate->execute(array($nombre,$estado,$idactividad));
                    $action = 2; 
                }
            if($request > 0){
                if($action == 1){
                    $respuesta = array('status'=> true ,'msg'=> 'Actividad Registrada');
                }else{
                    $respuesta = array('status'=> true ,'msg'=> 'Actividad Actualizada');
                }
            }
        }
    }
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}