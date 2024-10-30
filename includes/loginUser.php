<?php
session_start();
if(!empty($_POST)){
    if(empty($_POST['login']) || empty($_POST['pass'])){
        echo'<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"></button>Todos los campos son requeridos</div>';
}else{
    require_once 'conexion.php';
    $login = $_POST['login'];
    $pass = $_POST['pass'];
    $sql = 'SELECT u.*, r.NOMBREROL FROM usuarios AS u INNER JOIN rol AS r ON u.ID_ROL = r.ID_ROL WHERE u.LOGINUSUARIO = ? AND u.activo != 0';
    $query = $conn ->prepare($sql);
    $query -> execute(array($login));
    $result = $query->fetch(PDO::FETCH_ASSOC);
    if($query->rowCount() > 0){
        if(password_verify($pass,$result['CONTRASENA'])){
            if($result['ACTIVO'] == 1){
            $_SESSION['Admin']=true;
            $_SESSION['id_user']= $result ['ID_USUARIO'];
            $_SESSION['Nombre']= $result ['NOMBRE_USUARIO'];
            $_SESSION['Rol']= $result ['ID_ROL'];
            $_SESSION['Nombre_rol']= $result ['NOMBREROL'];
            if($result['NOMBREROL'] == 'Administrador'){
                echo '<div class="alert alert-success">Redirecting</div>';
                echo '<script>window.location.href = "Administrador/";</script>';
            } elseif($result['NOMBREROL'] == 'Suplente') {
                echo '<div class="alert alert-success">Redirecting</div>';
                echo '<script>window.location.href = "Asistente/";</script>';
            } else {
                echo '<div class="alert alert-warning">Rol no autorizado</div>';
            }
            }else{
                '<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert">Usuario Inactivo</button></div>';
            }
        }else{
            echo'<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"></button>Credenciales Incorrectas</div>';
        }
    }else{
        echo'<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"></button>Credenciales Incorrectas</div>';
    }
}
}