<?php 
require_once '../../../includes/conexion.php'; 

if (!empty($_POST)) {
    if (empty($_POST['nombreAlumno']) || empty($_POST['apellidosAlumno']) || empty($_POST['direccionAlumno']) || empty($_POST['dpiAlumno']) || empty($_POST['fechaNacAlumno']) || empty($_POST['listgenero'])
        || empty($_POST['fechaRecAlumno']) || empty($_POST['nombreEncargado']) || empty($_POST['apellidosEncargado']) || empty($_POST['dpiEncargado']) || empty($_POST['telefonoEncargado']) || empty($_POST['parentesco'])) {

        $respuesta = array('status' => false, 'msg' => 'Todos los campos son obligatorios');
    } else {
        // Variables para el alumno
        $idalumno = $_POST['idAlumno'];
        $codperalumno = $_POST['codAlumno'];
        $nombreAlumno = $_POST['nombreAlumno'];
        $apellidosAlumno = $_POST['apellidosAlumno'];
        $direccion = $_POST['direccionAlumno'];
        $cuiAlumno = $_POST['dpiAlumno'];
        $fechanacalumno = $_POST['fechaNacAlumno'];
        $genero = $_POST['listgenero'];
        $fecharecAlumno = $_POST['fechaRecAlumno'];
        $estadoalumno = $_POST['listEstado'];

        // Variables para el encargado
        $nombreEncargad = $_POST['nombreEncargado'];
        $apellidosEncargad = $_POST['apellidosEncargado'];
        $telefonoEncargad = $_POST['telefonoEncargado'];
        $dpiEncargad = $_POST['dpiEncargado'];
        $claveenc = $_POST['claveEnc']; 
        $parentesco = $_POST['parentesco'];

        // Comprobar si el alumno ya existe
        $sql = 'SELECT * FROM alumnos WHERE cui = ? AND alumno_id != ? AND estado != 0'; 
        $query = $conn->prepare($sql);
        $query->execute(array($cuiAlumno, $idalumno)); 
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result > 0) {
            $respuesta = array('status' => false, 'msg' => 'El alumno ya existe');
        } else {
            if ($idalumno == 0) {
                // Inserción del alumno
                $sqlInsertAlumno = 'INSERT INTO alumnos (cod_personal, nombre_alumno, apellidos_alumno, direccion, cui, fecha_nac, genero, fecha_registro, estado) VALUES (?,?,?,?,?,?,?,?,?)';
                $queryInsertAlumno = $conn->prepare($sqlInsertAlumno);
                $requestAlumno = $queryInsertAlumno->execute(array($codperalumno, $nombreAlumno, $apellidosAlumno, $direccion, $cuiAlumno, $fechanacalumno, $genero, $fecharecAlumno, $estadoalumno));

                if ($requestAlumno) {
                    $idalumno = $conn->lastInsertId(); // Obtener el ID del alumno insertado

                    // Insertar los datos del encargado
                    $claveenc = password_hash($_POST['claveEnc'], PASSWORD_DEFAULT); 
                    $sqlInsertEncargado = 'INSERT INTO encargado (alumno_id, nombre_enc, apellidos_enc, telefono_enc, dpi_enc,clave_enc, parentesco) VALUES (?,?,?,?,?,?,?)'; 
                    $queryInsertEncargado = $conn->prepare($sqlInsertEncargado); 
                    $requestEncargado = $queryInsertEncargado->execute(array($idalumno, $nombreEncargad, $apellidosEncargad, $telefonoEncargad, $dpiEncargad,$claveenc, $parentesco));

                    if ($requestEncargado) {
                        $respuesta = array('status' => true, 'msg' => 'Inscripción guardada correctamente');
                    } else {
                        $respuesta = array('status' => false, 'msg' => 'Error al insertar los datos del encargado');
                    }
                } else {
                    $respuesta = array('status' => false, 'msg' => 'Error al insertar los datos del alumno');
                }
            } else {
                // Actualización del alumno
                $sqlUpdateAlumno = 'UPDATE alumnos SET cod_personal = ?, nombre_alumno = ?, apellidos_alumno = ?, direccion = ?, cui = ?, fecha_nac = ?, genero = ?, fecha_registro = ?, estado = ? WHERE alumno_id = ?';
                $queryUpdateAlumno = $conn->prepare($sqlUpdateAlumno);
                $requestAlumno = $queryUpdateAlumno->execute(array($codperalumno, $nombreAlumno, $apellidosAlumno, $direccion, $cuiAlumno, $fechanacalumno, $genero, $fecharecAlumno, $estadoalumno, $idalumno));

                if ($requestAlumno) {
                    if(!empty($_POST['claveEnc'])){
                    // Actualizar los datos del encargado
                    $claveenc = password_hash($_POST['claveEnc'], PASSWORD_DEFAULT); 
                    $sqlUpdateEncargado = 'UPDATE encargado SET nombre_enc = ?, apellidos_enc = ?, telefono_enc = ?, dpi_enc = ?, clave_enc = ?, parentesco = ? WHERE alumno_id = ?';
                    $queryUpdateEncargado = $conn->prepare($sqlUpdateEncargado);
                    $requestEncargado = $queryUpdateEncargado->execute(array($nombreEncargad, $apellidosEncargad, $telefonoEncargad, $dpiEncargad, $claveenc, $parentesco, $idalumno));
                    } else {
                        $sqlUpdateEncargado = 'UPDATE encargado SET nombre_enc = ?, apellidos_enc = ?, telefono_enc = ?, dpi_enc = ?, parentesco = ? WHERE alumno_id = ?';
                        $queryUpdateEncargado = $conn->prepare($sqlUpdateEncargado);
                        $requestEncargado = $queryUpdateEncargado->execute(array($nombreEncargad, $apellidosEncargad, $telefonoEncargad, $dpiEncargad, $parentesco, $idalumno));

                    }

                    if ($requestEncargado) {
                        $respuesta = array('status' => true, 'msg' => 'Inscripción actualizada correctamente');
                    } else {
                        $respuesta = array('status' => false, 'msg' => 'Error al actualizar los datos del encargado');
                    }
                } else {
                    $respuesta = array('status' => false, 'msg' => 'Error al actualizar los datos del alumno');
                }
            }
        }
    }

    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}
?>
