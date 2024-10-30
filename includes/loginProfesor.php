<?php
session_start();
if(!empty($_POST)){
    if(empty($_POST['loginProfesor']) || empty($_POST['passProfesor'])){
        echo'<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"></button>Todos los campos son requeridos</div>';
}else{
    require_once 'conexion.php';
    $login = $_POST['loginProfesor'];
    $pass = $_POST['passProfesor'];
    $sql = 'SELECT*FROM profesor where DPI = ?';
    $query = $conn ->prepare($sql);
    $query -> execute(array($login));
    $result = $query->fetch(PDO::FETCH_ASSOC);
    if($query->rowCount() > 0){
        if(password_verify($pass,$result['clave'])){
            $_SESSION['AdminP']=true;
            $_SESSION['ID_MAESTRO']= $result ['profesor_id'];
            $_SESSION['NOMBRES_MAESTRO']= $result ['nombre'];

            $_SESSION['dpi']= $result ['dpi'];
            echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">Redirecting</button></div>';
        }else{
            echo'<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"></button>Credenciales Incorrectas</div>';
        }
    }else{
        echo'<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"></button>Credenciales Incorrectas</div>';
    }
}
}