<?php
require_once '../../../includes/conexion.php';

$sql = 'SELECT * FROM grados WHERE estado != 0';
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
    <button class="btn btn-primary" title="Editar" onclick="editarGrado('.$consu[$i]['grado_id'].')">Editar</button> 
    <button class="btn btn-danger" title="Eliminar" onclick="eliminarGrado('.$consu[$i]['grado_id'].')">Eliminar</button>
    ';
}

echo json_encode($consu, JSON_UNESCAPED_UNICODE);

?>