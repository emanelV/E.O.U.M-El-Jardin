<?php
require_once '../../../includes/conexion.php';

$sql = 'SELECT * FROM actividad WHERE estado != 0';
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
    <button class="btn btn-primary" title="Editar" onclick="editarActividad('.$consu[$i]['actividad_id'].')">Editar</button> 
    <button class="btn btn-danger" title="Eliminar" onclick="eliminarActividad('.$consu[$i]['actividad_id'].')">Eliminar</button>
    ';
}

echo json_encode($consu, JSON_UNESCAPED_UNICODE);

?>