
$('#tb_alumnos').DataTable();

var tb_alumnos;
document.addEventListener('DOMContentLoaded',function(){
    tb_alumnos = $('#tb_alumnos').DataTable({
        "aProcessing": true, 
        "aServerSide": true, 
        "language":{
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "search": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
        },
        "ajax":{
            "url": "./models/alumnos/tb_alumnos.php",
            "dataSrc": function (json){
            console.log(json); 
            return json;
            }
        }, 
        "columns":[
            {"data":"acciones"},
            {"data":"alumno_id"},
            {"data":"cod_personal"},  
             {"data":"apellidos_alumno"},
            {"data":"nombre_alumno"},
            {"data":"direccion"},   
            {"data":"estado"},
            {"data":"nombre_enc"},
            {"data": "apellidos_enc"},
            {"data": "telefono_enc"},
            {"data": "parentesco"}

        ],
        "responsive": true,
        "bDestroy": true, 
        "iDisplayLength": 10,
        "order": [[1, "asc"]]

    })

    var formalumno = document.querySelector('#formAlumno');
    formalumno.onsubmit = function(e){
        e.preventDefault(); 

        var idalumno = document.querySelector('#idAlumno').value;
        var nombreAlumno = document.querySelector('#nombreAlumno').value;
        var apellidosAlumno = document.querySelector('#apellidosAlumno').value;
        var direccionAlumno = document.querySelector('#direccionAlumno').value;
        var cuiAlumno = document.querySelector('#dpiAlumno').value;
        var fechaNacAlu = document.querySelector('#fechaNacAlumno').value;
        var generoAlumno = document.querySelector('#listgenero').value;
        var fechaderegis = document.querySelector('#fechaRecAlumno');
        var estadoAlumno = document.querySelector('#listEstado').value;

        //Datos del Padre o Encargado 
        var nombreEncargado = document.querySelector('#nombreEncargado').value; 
        var apellidosEncargado = document.querySelector('#apellidosEncargado').value; 
        var telefonoEncargado = document.querySelector('#telefonoEncargado').value;
        var dpiEncargado = document.querySelector('#dpiEncargado').value;
        var clavenc = document.querySelector('#claveEnc').value; 
        var parentescoEncargado = document.querySelector('#parentesco').value;   

        if(nombreAlumno == '' || apellidosAlumno == '' || direccionAlumno == '' || cuiAlumno == '' || fechaNacAlu == '' || generoAlumno == ''
            || fechaderegis == '' || estadoAlumno == '' || nombreEncargado == '' || apellidosEncargado == '' || telefonoEncargado == '' || dpiEncargado == ''|| parentescoEncargado == ''
        ){
            Swal.fire({
                title: "Error",
                text: "Todos los campos son requeridos",
                icon: "error"
              });
            return false;
        }
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microst.XMLHTTP'); 
        var url = './models/alumnos/ajax-alumnos.php';
        var form = new FormData(formalumno);
        request.open('POST',url,true);
        request.send(form); 
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                console.log(request.responseText); // Añade esta línea para ver la respuesta
                var data = JSON.parse(request.responseText);
                if(request.status){
                    $('#modalAlumno').modal('hide');
                    Swal.fire({
                        title: '¡Éxito!',
                        text: data.msg,
                        icon: 'success'
                    });
                    formalumno.reset();
                    tb_alumnos.ajax.reload(); 
                }else{
                    Swal.fire({
                        title: 'Error',
                        text: data.msg,
                        icon: 'error'
                    });
                }
            }
        }
    }

})



async function editarAlumno(id) {
    var idalumno = id; 
    document.querySelector('#tituloModal').innerHTML = 'Editar Alumno'; 
    document.querySelector('#action').innerHTML = 'Actualizar'; 

    try {
        // Enviamos la solicitud de manera asíncrona
        var request = await fetch(`./models/alumnos/editar-alumnos.php?idAlumno=${idalumno}`);
        if (request.ok) {
            var data = await request.json();

            if (data.status) {
                // Cargar los datos del alumno
                document.querySelector('#idAlumno').value = data.data.alumno.alumno_id;
                document.querySelector('#codAlumno').value = data.data.alumno.cod_personal;
                document.querySelector('#nombreAlumno').value = data.data.alumno.nombre_alumno;
                document.querySelector('#apellidosAlumno').value = data.data.alumno.apellidos_alumno;
                document.querySelector('#direccionAlumno').value = data.data.alumno.direccion;
                document.querySelector('#dpiAlumno').value = data.data.alumno.cui;
                document.querySelector('#fechaNacAlumno').value = data.data.alumno.fecha_nac;
                document.querySelector('#listgenero').value = data.data.alumno.genero;
                document.querySelector('#fechaRecAlumno').value = data.data.alumno.fecha_registro;
                document.querySelector('#listEstado').value = data.data.alumno.estado;

                // Cargar los datos del encargado si existen
                if (data.data.encargado) {
                    document.querySelector('#nombreEncargado').value = data.data.encargado.nombre_enc;
                    document.querySelector('#apellidosEncargado').value = data.data.encargado.apellidos_enc;
                    document.querySelector('#telefonoEncargado').value = data.data.encargado.telefono_enc;
                    document.querySelector('#dpiEncargado').value = data.data.encargado.dpi_enc;
                    document.querySelector('#parentesco').value = data.data.encargado.parentesco;
                } else {
                    // Limpiar los campos del encargado si no existe
                    document.querySelector('#nombreEncargado').value = '';
                    document.querySelector('#apellidosEncargado').value = '';
                    document.querySelector('#telefonoEncargado').value = '';
                    document.querySelector('#dpiEncargado').value = '';
                    document.querySelector('#parentesco').value = '';
                }

                // Mostrar el modal para editar
                $('#modalAlumno').modal('show');
            } else {
                Swal.fire({
                    title: 'Error',
                    text: data.message,
                    icon: 'error'
                });
            }
        }
    } catch (error) {
        console.error('Error:', error);
        Swal.fire({
            title: 'Error',
            text: 'Ocurrió un problema al intentar cargar los datos del alumno.',
            icon: 'error'
        });
    }
}


function eliminarAlumno(id){
    var idalumno = id; 
    swal.fire({
        title: "Eliminar Alumno",
         text: "Esta seguro de eliminar?", 
         icon: "warning",
         showCancelButton: true, 
         confirmButtonText: "Si, eliminar",
         cancelButtonText: "Cancelar", 
        }).then((result)=>{
            if(result.isConfirmed){

                var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microst.XMLHTTP'); 
                var url = './models/alumnos/eliminar-alumno.php';
                request.open('POST',url,true);
                var strData = "idAlumno="+idalumno; 
                request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                request.send(strData); 
                request.onreadystatechange = function(){
                    if(request.readyState == 4 && request.status == 200){
                        var data = JSON.parse(request.responseText);
                        if(data.status){
                            Swal.fire({
                                title: 'Eliminado',
                                text: data.msg,
                                icon: 'success'
                            });
                            tb_alumnos.ajax.reload()

                        }else{
                            Swal.fire({
                                title: 'Error',
                                text: data.msg,
                                icon: 'error'
                            });
                        }
                    }
                }

            }
        })
}

function ModalAlumno(){
    document.querySelector('#idAlumno').value="0";
    document.querySelector('#idEncargado').value="0";
    document.querySelector('#tituloModal').innerHTML='Inscripcion de Alumno'; 
    document.querySelector('#action').innerHTML='Guardar'; 
    document.querySelector('#formAlumno').reset();
    $('#modalAlumno').modal('show');
};