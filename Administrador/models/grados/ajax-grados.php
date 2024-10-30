
<?php 
require_once '../../../includes/conexion.php'; 
if(!empty ($_POST)){
    if(empty($_POST['nombreGrado'])){
        $respuesta = array('status' => false ,'msg'=> 'Todos los campos son obligatorios');
    }else {
        /*las variables se igualan al name del formulario que esta en el modal*/
        $idgrado = $_POST['idGrado'];
        $nombre = $_POST['nombreGrado'];
        $estado = $_POST['listEstado'];
        /* aca se encrypta la clave para ser enviada a la base de datos */

        $sql = 'SELECT * FROM grados where nombre_grado = ? AND grado_id != ? AND estado != 0'; 
        $query = $conn-> prepare($sql);
        $query->execute(array($nombre,$idgrado)); 
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if($result>0){
            $respuesta = array('status'=> false ,'msg'=> 'El grado ya existe');

        }
        else{
            if($idgrado == 0){
                $sqlInsert = 'INSERT INTO grados (nombre_grado,estado) VALUES (?,?)';
                $queryInsert = $conn->prepare($sqlInsert);
                $request = $queryInsert->execute(array($nombre,$estado));
                $action = 1; 
            }else{
                    $sqlUpdate = 'UPDATE grados SET nombre_grado = ?,estado = ? WHERE grado_id = ?';
                    $queryUpdate = $conn->prepare($sqlUpdate);
                    $request = $queryUpdate->execute(array($nombre,$estado,$idgrado));
                    $action = 2; 
                }
            if($request > 0){
                if($action == 1){
                    $respuesta = array('status'=> true ,'msg'=> 'Grado Registrado');
                }else{
                    $respuesta = array('status'=> true ,'msg'=> 'Grado Actualizado');
                }
            }
        }
    }
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}