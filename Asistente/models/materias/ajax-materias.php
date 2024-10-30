
<?php 
require_once '../../../includes/conexion.php'; 
if(!empty ($_POST)){
    if(empty($_POST['nombreMateria'])){
        $respuesta = array('status' => false ,'msg'=> 'Todos los campos son obligatorios');
    }else {
        /*las variables se igualan al name del formulario que esta en el modal*/
        $idmateria = $_POST['idMateria'];
        $nombre = $_POST['nombreMateria'];
        $estado = $_POST['listEstado'];
        /* aca se encrypta la clave para ser enviada a la base de datos */

        $sql = 'SELECT * FROM materias where nombre_materia = ? AND materia_id != ? AND estado != 0'; 
        $query = $conn-> prepare($sql);
        $query->execute(array($nombre,$idmateria)); 
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if($result>0){
            $respuesta = array('status'=> false ,'msg'=> 'La Materia ya existe');

        }
        else{
            if($idmateria == 0){
                $sqlInsert = 'INSERT INTO materias (nombre_materia,estado) VALUES (?,?)';
                $queryInsert = $conn->prepare($sqlInsert);
                $request = $queryInsert->execute(array($nombre,$estado));
                $action = 1; 
            }else{
                    $sqlUpdate = 'UPDATE materias SET nombre_materia = ?,estado = ? WHERE materia_id = ?';
                    $queryUpdate = $conn->prepare($sqlUpdate);
                    $request = $queryUpdate->execute(array($nombre,$estado,$idmateria));
                    $action = 2; 
                }
            if($request > 0){
                if($action == 1){
                    $respuesta = array('status'=> true ,'msg'=> 'Materia Registrada');
                }else{
                    $respuesta = array('status'=> true ,'msg'=> 'Materia Actualizada');
                }
            }
        }
    }
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}