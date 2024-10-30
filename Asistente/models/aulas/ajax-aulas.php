
<?php 
require_once '../../../includes/conexion.php'; 
if(!empty ($_POST)){
    if(empty($_POST['nombreAula'])){
        $respuesta = array('status' => false ,'msg'=> 'Todos los campos son obligatorios');
    }else {
        /*las variables se igualan al name del formulario que esta en el modal*/
        $idaula = $_POST['idAula'];
        $nombre = $_POST['nombreAula'];
        $estado = $_POST['listEstado'];
        /* aca se encrypta la clave para ser enviada a la base de datos */

        $sql = 'SELECT * FROM aulas where nombre_aula = ? AND aula_id != ? AND estado != 0'; 
        $query = $conn-> prepare($sql);
        $query->execute(array($nombre,$idaula)); 
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if($result>0){
            $respuesta = array('status'=> false ,'msg'=> 'La seccion ya existe');

        }
        else{
            if($idaula == 0){
                $sqlInsert = 'INSERT INTO aulas (nombre_aula,estado) VALUES (?,?)';
                $queryInsert = $conn->prepare($sqlInsert);
                $request = $queryInsert->execute(array($nombre,$estado));
                $action = 1; 
            }else{
                    $sqlUpdate = 'UPDATE aulas SET nombre_aula = ?,estado = ? WHERE aula_id = ?';
                    $queryUpdate = $conn->prepare($sqlUpdate);
                    $request = $queryUpdate->execute(array($nombre,$estado,$idaula));
                    $action = 2; 
                }
            if($request > 0){
                if($action == 1){
                    $respuesta = array('status'=> true ,'msg'=> 'Seccion Registrada');
                }else{
                    $respuesta = array('status'=> true ,'msg'=> 'Seccion Actualizada');
                }
            }
        }
    }
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}