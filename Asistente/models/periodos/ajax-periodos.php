
<?php 
require_once '../../../includes/conexion.php'; 
if(!empty ($_POST)){
    if(empty($_POST['nombrePeriodo'])){
        $respuesta = array('status' => false ,'msg'=> 'Todos los campos son obligatorios');
    }else {
        /*las variables se igualan al name del formulario que esta en el modal*/
        $idperiodo = $_POST['idPeriodo'];
        $nombre = $_POST['nombrePeriodo'];
        $estado = $_POST['listEstado'];
        /* aca se encrypta la clave para ser enviada a la base de datos */

        $sql = 'SELECT * FROM periodos where nombre_periodo = ? AND periodo_id != ? AND estado != 0'; 
        $query = $conn-> prepare($sql);
        $query->execute(array($nombre,$idperiodo)); 
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if($result>0){
            $respuesta = array('status'=> false ,'msg'=> 'El Periodo ya existe');

        }
        else{
            if($idperiodo == 0){
                $sqlInsert = 'INSERT INTO periodos (nombre_periodo,estado) VALUES (?,?)';
                $queryInsert = $conn->prepare($sqlInsert);
                $request = $queryInsert->execute(array($nombre,$estado));
                $action = 1; 
            }else{
                    $sqlUpdate = 'UPDATE periodos SET nombre_periodo = ?,estado = ? WHERE periodo_id = ?';
                    $queryUpdate = $conn->prepare($sqlUpdate);
                    $request = $queryUpdate->execute(array($nombre,$estado,$idperiodo));
                    $action = 2; 
                }
            if($request > 0){
                if($action == 1){
                    $respuesta = array('status'=> true ,'msg'=> 'Periodo Registrado');
                }else{
                    $respuesta = array('status'=> true ,'msg'=> 'Periodo Actualizado');
                }
            }
        }
    }
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}