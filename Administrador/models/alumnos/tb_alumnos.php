<?php
require_once '../../../includes/conexion.php';

$sql = 'SELECT a.alumno_id, a.cod_personal, a.nombre_alumno, a.apellidos_alumno, a.direccion, a.estado, 
e.nombre_enc AS nombre_enc, e.apellidos_enc as apellidos_enc, e.telefono_enc as telefono_enc, e.parentesco as parentesco FROM 
alumnos a LEFT JOIN encargado e ON a.alumno_id = e.alumno_id WHERE a.estado != 0; ';
$query = $conn->prepare($sql); 
$query->execute();  


$consu = $query->fetchAll(PDO::FETCH_ASSOC);

for($i = 0; $i < count($consu); $i++){
        if($consu[$i]['estado'] == 1){
            $consu[$i]['estado'] = '<span class="badge bg-success">Activo</span>';
    }else{
            $consu[$i]['estado'] = '<span class="badge bg-danger">Inactivo</span>';
    }
    $consu[$i]['acciones'] = '
    <button class="btn btn-primary" title="Editar" onclick="editarAlumno('.$consu[$i]['alumno_id'].')">Editar</button> 
    <button class="btn btn-danger" title="Eliminar" onclick="eliminarAlumno('.$consu[$i]['alumno_id'].')">Eliminar</button>
    ';
}

header('Content-Type: application/json');

echo json_encode($consu, JSON_UNESCAPED_UNICODE);

?>