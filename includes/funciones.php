<?php

$baseDir = str_replace(basename($_SERVER['SCRIPT_NAME']), '',$_SERVER['SCRIPT_NAME']);
$baseUrl = 'http://'.$_SERVER['HTTP_HOST']. $baseDir; 
define('BASE_URL',$baseUrl); 


function promedio($alumno,$curso){
    global $conn; 
    $promedio = 0; 

    $cantNotas = 0;
    $sqlCantNotas = "SELECT COUNT(valor_nota) as numero from notas as n INNER JOIN env_entregadas as ev ON n.ev_entregada_id = ev.ev_entregada_id  where ev.alumno_id = ?";
    $queryCantNotas = $conn->prepare($sqlCantNotas); 
    $queryCantNotas->execute(array($alumno)); 

    if($row = $queryCantNotas->fetch()){
        $cantNotas = $row['numero']; 
    }
    $sqlNotas = "SELECT * FROM notas as n INNER JOIN env_entregadas as ev_e ON n.ev_entregada_id = ev_e.ev_entregada_id INNER JOIN alumnos as al ON ev_e.alumno_id = al.alumno_id
     INNER JOIN evaluaciones as ev ON ev_e.evaluacion_id = ev.evaluacion_id INNER JOIN contenidos as c ON ev.contenido_id = c.contenido_id INNER JOIN procesoprofesor as pm on c.pm_id = pm.pm_id 
     where al.alumno_id = ? and pm.pm_id = ?"; 
    $queryNotas = $conn->prepare($sqlNotas); 
    $queryNotas->execute(array($alumno,$curso)); 
    $count = $queryNotas->rowCount(); 
    while($row = $queryNotas->fetch()){
        $promedio += $row['valor_nota'];
    }

    if($count > 0){
        return $promedio;
    }
    else{
        $promedio = 0; 

    }
}

    function formatoNota($cantidad){
        $cantidad = number_format($cantidad,2,',','.'); 
        return $cantidad; 


    }