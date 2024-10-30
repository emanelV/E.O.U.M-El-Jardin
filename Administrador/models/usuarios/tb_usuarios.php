<?php
require_once '../../../includes/conexion.php';

$sql = 'SELECT * FROM usuarios as u INNER JOIN rol as r ON u.ID_ROL = r.ID_ROL WHERE u.activo != 0';
$query = $conn->prepare($sql); 
$query->execute();  


$consu = $query->fetchAll(PDO::FETCH_ASSOC);

for($i = 0; $i < count($consu); $i++){
        if($consu[$i]['ACTIVO'] == 1){
            $consu[$i]['ACTIVO'] = '<span class="badge bg-success">Activo</span>';
    }else{
            $consu[$i]['ACTIVO'] = '<span class="badge bg-danger">Inactivo</span>';
    }
    $consu[$i]['ACCIONES'] = '
    <button class="btn btn-primary" title="Editar" onclick="editarUser('.$consu[$i]['ID_USUARIO'].')">Editar</button> 
    <button class="btn btn-danger" title="Eliminar" onclick="eliminarUser('.$consu[$i]['ID_USUARIO'].')">Eliminar</button>
    ';
}

echo json_encode($consu, JSON_UNESCAPED_UNICODE);

?>