<?php
session_start();
if(!empty($_POST)){
    if(empty($_POST['loginEncargado']) || empty($_POST['passEncargado'])){
        echo'<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"></button>Todos los campos son requeridos</div>';
}else{
    require_once 'conexion.php';
    $login = $_POST['loginEncargado'];
    $pass = $_POST['passEncargado'];
    $sql = 'SELECT * FROM encargado as enc INNER JOIN alumnos as al ON enc.alumno_id = al.alumno_id where enc.dpi_enc = ?';
    $query = $conn ->prepare($sql);
    $query -> execute(array($login));
    $result = $query->fetch(PDO::FETCH_ASSOC);
    if($query->rowCount() > 0){
        if(password_verify($pass,$result['clave_enc'])){
            $_SESSION['ActiveE']=true;
            $_SESSION['dpi_enc']= $result ['dpi_enc'];
            $_SESSION['nombre_enc']= $result ['nombre_enc'];
            $_SESSION['apellidos_enc']= $result ['apellidos_enc'];
            $_SESSION['alumno_id']= $result ['alumno_id'];
            $_SESSION['nombre_alumno']= $result ['nombre_alumno'];
            $_SESSION['apellidos_alumno']= $result ['apellidos_alumno'];
            $_SESSION['u_acceso']= $result ['u_acceso'];
            echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">Redirecting</button></div>';
            
            date_default_timezone_set("America/Guatemala"); 
            $fecha = date('Y-m-d H:i:s'); 
            $id_alumno = $result['alumno_id']; 
            $sql = "UPDATE alumnos SET u_acceso = '$fecha' WHERE alumno_id = ?";
            $query = $conn->prepare($sql);
            $res = $query->execute(array($id_alumno));


        }else{
            echo'<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"></button>Credenciales Incorrectas</div>';
        }

    }else{
        echo'<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"></button>Credenciales Incorrectas</div>';
    }
}
}