
$('#tableProfesorMateria').DataTable();

var tableProfesorMateria;
document.addEventListener('DOMContentLoaded',function(){
    tableProfesorMateria = $('#tableProfesorMateria').DataTable({
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
            "url": "./models/maestros-materia/table_profesor_materia.php",
            "dataSrc": ""
        }, 
        "columns":[
            {"data":"acciones"},
            {"data":"pm_id"},
            {"data":"nombre"},
            {"data":"nombre_grado"},
            {"data":"nombre_aula"},
            {"data":"nombre_materia"},
            {"data":"nombre_periodo"},
            {"data": "estadopm"}

        ],
        "responsive": true,
        "bDestroy": true, 
        "iDisplayLength": 10,
        "order": [[0, "asc"]]

    })

    var formprofesorMaterias = document.querySelector('#formProfesorMaterias');
    formprofesorMaterias.onsubmit = function(e){
        e.preventDefault(); 

        var idprofesormateria = document.querySelector('#idProfesorMateria').value;
        var nombre = document.querySelector('#listProfesor').value;
        var grado = document.querySelector('#listGrado').value;
        var aula = document.querySelector('#listAula').value;
        var materia = document.querySelector('#listMateria').value;
        var periodo = document.querySelector('#listPeriodo').value;
        var estado = document.querySelector('#listEstado').value;


        if(nombre == '' || grado == '' || aula == '' || materia == '' || periodo == '' || estado == ''){
            Swal.fire({
                title: "Error",
                text: "Todos los campos son requeridos",
                icon: "error"
              });
            return false;
        }
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microst.XMLHTTP'); 
        var url = './models/maestros-materia/ajax-profesor-materia.php';
        var form = new FormData(formprofesorMaterias);
        request.open('POST',url,true);
        request.send(form); 
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                var data = JSON.parse(request.responseText);
                if(request.status){
                    $('#modalProfesorMateria').modal('hide');
                    Swal.fire({
                        title: '¡Éxito!',
                        text: data.msg,
                        icon: 'success'
                    });
                    formprofesorMaterias.reset();
                    tableProfesorMateria.ajax.reload(); 
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


function editarProfesorMateria(id){
    var idprofesormateria = id; 
    document.querySelector('#tituloModal').innerHTML='Actualizar asignacion'; 
    document.querySelector('#action').innerHTML='Actualizar'; 
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microst.XMLHTTP'); 
    var url = './models/maestros-materia/edit-profesor-materia.php?id='+idprofesormateria;
    request.open('GET',url,true);
    request.send(); 
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var data = JSON.parse(request.responseText);
            if(data.status){
                    document.querySelector('#idProfesorMateria').value = data.data.pm_id;
                    document.querySelector('#listProfesor').value = data.data.profesor_id;
                    document.querySelector('#listGrado').value = data.data.grado_id;
                    document.querySelector('#listAula').value = data.data.aula_id;
                    document.querySelector('#listMateria').value = data.data.materia_id;
                    document.querySelector('#listPeriodo').value = data.data.proceso_id;
                    document.querySelector('#listEstado').value = data.data.estadopm;
                $('#modalProfesorMateria').modal('show');

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

function eliminarProfesorMateria (id){
    var idprofesormateria = id; 
    swal.fire({
        title: "Eliminar asignaciones",
         text: "Esta seguro de eliminar?", 
         icon: "warning",
         showCancelButton: true, 
         confirmButtonText: "Si, eliminar",
         cancelButtonText: "Cancelar", 
        }).then((result)=>{
            if(result.isConfirmed){

                var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microst.XMLHTTP'); 
                var url = './models/maestros-materia/delet-profesor-materia.php';
                request.open('POST',url,true);
                var strData = "id="+idprofesormateria; 
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
                            tableProfesorMateria.ajax.reload()

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

function ModalProfesorMateria(){
    document.querySelector('#idProfesorMateria').value="0";
    document.querySelector('#tituloModal').innerHTML='Crear Nueva Asignacion'; 
    document.querySelector('#action').innerHTML='Guardar'; 
    document.querySelector('#formProfesorMaterias').reset();
    $('#modalProfesorMateria').modal('show');
};

window.addEventListener('load',function(){
    showProfesor();
    showGrado(); 
    showAula(); 
    showMateria(); 
    showPeriodo(); 

},false)

function showProfesor(){
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microst.XMLHTTP'); 
    var url = './models/options/options-profesor.php';
    request.open('GET',url,true);
    request.send(); 
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var data = JSON.parse(request.responseText);

            data.forEach(function(valor){
                data += '<option value = "'+valor.profesor_id+'">'+valor.nombre+" "+valor.apellidos+'</option>'
            })
            document.querySelector('#listProfesor').innerHTML = data;

        }
    }
};

function showGrado(){
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microst.XMLHTTP'); 
    var url = './models/options/options-grado.php';
    request.open('GET',url,true);
    request.send(); 
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var data = JSON.parse(request.responseText);

            data.forEach(function(valor){
                data += '<option value = "'+valor.grado_id+'">'+valor.nombre_grado+'</option>'
            })
            document.querySelector('#listGrado').innerHTML = data;

        }
    }
};

function showAula(){
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microst.XMLHTTP'); 
    var url = './models/options/options-aula.php';
    request.open('GET',url,true);
    request.send(); 
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var data = JSON.parse(request.responseText);

            data.forEach(function(valor){
                data += '<option value = "'+valor.aula_id+'">'+valor.nombre_aula+'</option>'
            })
            document.querySelector('#listAula').innerHTML = data;

        }
    }
};

function showMateria (){
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microst.XMLHTTP'); 
    var url = './models/options/options-materia.php';
    request.open('GET',url,true);
    request.send(); 
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var data = JSON.parse(request.responseText);

            data.forEach(function(valor){
                data += '<option value = "'+valor.materia_id+'">'+valor.nombre_materia+'</option>'
            })
            document.querySelector('#listMateria').innerHTML = data;

        }
    }
};

function showPeriodo (){
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microst.XMLHTTP'); 
    var url = './models/options/options-periodo.php';
    request.open('GET',url,true);
    request.send(); 
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var data = JSON.parse(request.responseText);

            data.forEach(function(valor){
                data += '<option value = "'+valor.periodo_id+'">'+valor.nombre_periodo+'</option>'
            })
            document.querySelector('#listPeriodo').innerHTML = data;

        }
    }
};
