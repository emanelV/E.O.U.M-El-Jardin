<?php 
require_once '../../../includes/conexion.php'; 
if(!empty ($_POST)){
    if(empty($_POST['NombreUser']) || empty($_POST['User'])){
        $respuesta = array('status' => false ,'msg'=> 'Todos los campos son obligatorios');
    }else {
        /*las variables se igualan al name del formulario que esta en el modal*/
        $idusuario = $_POST['idusuario'];
        $nombre = $_POST['NombreUser'];
        $apellidos = $_POST['ApellidosUser'];
        $usuario = $_POST['User']; 
        $clave = $_POST['clave'];
        $rol= $_POST['listRol'];
        $estado = $_POST['listEstado'];
        /* aca se encrypta la clave para ser enviada a la base de datos */
        $clave = password_hash($clave, PASSWORD_DEFAULT);

        $sql = 'SELECT id_usuario FROM usuarios WHERE LOGINUSUARIO = ? AND ID_USUARIO != ? AND ACTIVO != 0'; 
        $query = $conn-> prepare($sql);
        $query->execute(array($usuario,$idusuario)); 
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if($result>0){
            $respuesta = array('status'=> false ,'msg'=> 'El usuario ya existe');

        }
        else{
            if($idusuario == 0){
                $sqlInsert = 'INSERT INTO usuarios (NOMBRE_USUARIO, APELLIDOS, ID_ROL, LOGINUSUARIO, CONTRASENA,ACTIVO) VALUES (?,?,?,?,?,?)';
                $queryInsert = $conn->prepare($sqlInsert);
                $request = $queryInsert->execute(array($nombre,$apellidos,$rol,$usuario,$clave,$estado));
                $action = 1; 
            }else{
                if(empty($clave)){
                    $sqlUpdate = 'UPDATE usuarios SET NOMBRE_USUARIO = ?, APELLIDOS = ?, ID_ROL = ?, LOGINUSUARIO = ?,ACTIVO = ? where ID_USUARIO = ?';
                    $queryUpdate = $conn->prepare($sqlUpdate);
                    $request = $queryUpdate->execute(array($nombre,$apellidos,$rol,$usuario,$estado,$idusuario));
                    $action = 2; 
                    }else{
                        $sqlUpdate = 'UPDATE usuarios SET NOMBRE_USUARIO = ?, APELLIDOS = ?, ID_ROL = ?, LOGINUSUARIO = ?, CONTRASENA = ?, ACTIVO = ? where ID_USUARIO = ?';
                        $queryUpdate = $conn->prepare($sqlUpdate);
                        $request = $queryUpdate->execute(array($nombre,$apellidos,$rol,$usuario, $clave,$estado,$idusuario));
                        $action = 3; 
                    }
                }
            if($request > 0){
                if($action == 1){
                    $respuesta = array('status'=> true ,'msg'=> 'Usuario Registrado');
                }else{
                    $respuesta = array('status'=> true ,'msg'=> 'Usuario Actualizado');
                }
            }
        }
    }
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}