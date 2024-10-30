
<?php 
require_once '../../../includes/conexion.php'; 
if(!empty ($_POST)){
    if(empty($_POST['nombreProfesor']) || empty($_POST['direccionProfesor']) || empty($_POST['apellidosProfesor']) || empty($_POST['dpiProfesor']) || empty($_POST['telefonoProfesor']) || empty($_POST['correoProfesor'])){
        $respuesta = array('status' => false ,'msg'=> 'Todos los campos son obligatorios');
    }else {
        /*las variables se igualan al name del formulario que esta en el modal*/
        $idprofesor = $_POST['idProfesor'];
        $nombre = $_POST['nombreProfesor'];
        $apellidos = $_POST['apellidosProfesor'];
        $direccion = $_POST['direccionProfesor'];
        $dpi = $_POST['dpiProfesor'];
        $telefono = $_POST['telefonoProfesor'];
        $correo = $_POST['correoProfesor'];
        $estado = $_POST['listEstado'];
        /* aca se encrypta la clave para ser enviada a la base de datos */


        $sql = 'SELECT * FROM profesor where dpi = ? AND profesor_id != ? AND estado != 0'; 
        $query = $conn-> prepare($sql);
        $query->execute(array($dpi,$idprofesor)); 
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if($result>0){
            $respuesta = array('status'=> false ,'msg'=> 'El profesor ya existe');

        }
        else{
            if($idprofesor == 0){
                $clave = password_hash($_POST['passProfesor'], PASSWORD_DEFAULT);
                $sqlInsert = 'INSERT INTO profesor (nombre,apellidos,direccion,dpi,clave,telefono,correo,estado) VALUES (?,?,?,?,?,?,?,?)';
                $queryInsert = $conn->prepare($sqlInsert);
                $request = $queryInsert->execute(array($nombre,$apellidos,$direccion,$dpi,$clave,$telefono,$correo,$estado));
                $action = 1; 
            }else{
                if(empty($_POST['passProfesor'])){
                    $sqlUpdate = 'UPDATE profesor SET nombre = ?, apellidos = ?, direccion = ?, dpi = ?, telefono = ?, correo = ?, estado = ? WHERE profesor_id = ?';
                    $queryUpdate = $conn->prepare($sqlUpdate);
                    $request = $queryUpdate->execute(array($nombre,$apellidos,$direccion,$dpi,$telefono,$correo,$estado,$idprofesor));
                    $action = 2; 
                    }else{
                        $claveUpdate = password_hash($_POST['passProfesor'], PASSWORD_DEFAULT);
                    $sqlUpdate = 'UPDATE profesor SET nombre = ?, apellidos = ?, direccion = ?, dpi = ?, clave = ? , telefono = ?, correo = ?, estado = ? WHERE profesor_id = ?';
                    $queryUpdate = $conn->prepare($sqlUpdate);
                    $request = $queryUpdate->execute(array($nombre,$apellidos,$direccion,$dpi,$claveUpdate,$telefono,$correo,$estado,$idprofesor));
                    $action = 3; 
                    
                    }
                }
            if($request > 0){
                if($action == 1){
                    $respuesta = array('status'=> true ,'msg'=> 'Maestro Registrado');
                }else{
                    $respuesta = array('status'=> true ,'msg'=> 'Maestro Actualizado');
                }
            }
        }
    }
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}