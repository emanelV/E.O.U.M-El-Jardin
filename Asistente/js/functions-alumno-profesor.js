
$('#tableAlumnoProfesor').DataTable();

var tableAlumnoProfesor;
document.addEventListener('DOMContentLoaded',function(){
    tableAlumnoProfesor = $('#tableAlumnoProfesor').DataTable({
        "aProcessing": true, 
        "aServerSide": true, 
        "language":{
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": "./models/alumno-profesor/table_alumno_profesor.php",
            "dataSrc": ""
        }, 
        "columns":[
            {"data":"acciones"},
            {"data":"pm_id"},
            {"data":"nombre_alumno"},
            {"data":"nombre"},
            {"data":"nombre_grado"},
            {"data":"nombre_materia"},
            {"data":"nombre_periodo"},
            {"data": "estadop"}

        ],
        "responsive": true,
        "bDestroy": true, 
        "iDisplayLength": 10,
        "order": [[0, "asc"]]

    })

    var formAlumnoProfesor = document.querySelector('#formAlumnoProfesor');
    formAlumnoProfesor.onsubmit = function(e){
        e.preventDefault(); 

        var idAlumnoProfesor = document.querySelector('#idAlumnoProfesor').value;
        var alumno = document.querySelector('#listAlumno').value;
        var profesor = document.querySelector('#listProfesorAlu').value;
        var periodo = document.querySelector('#listPeriodoAlu').value;
        var estado = document.querySelector('#listEstado').value;


        if(alumno == '' || profesor == '' || periodo == '' || estado == ''){
            Swal.fire({
                title: "Error",
                text: "Todos los campos son requeridos",
                icon: "error"
              });
            return false;
        }
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microst.XMLHTTP'); 
        var url = './models/alumno-profesor/ajax-alumno-profesor.php';
        var form = new FormData(formAlumnoProfesor);
        request.open('POST',url,true);
        request.send(form); 
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                var data = JSON.parse(request.responseText);
                if(request.status){
                    $('#modalAlumnoProfesor').modal('hide');
                    Swal.fire({
                        title: '¡Éxito!',
                        text: data.msg,
                        icon: 'success'
                    });
                    formAlumnoProfesor.reset();
                    tableAlumnoProfesor.ajax.reload(); 
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


function editarAlumnoProfesor(id){
    var idAlumnoProfesor = id; 
    document.querySelector('#tituloModal').innerHTML='Actualizar Asignacion de Alumno'; 
    document.querySelector('#action').innerHTML='Actualizar'; 
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microst.XMLHTTP'); 
    var url = './models/alumno-profesor/edit-alumno-profesor.php?id='+idAlumnoProfesor;
    request.open('GET',url,true);
    request.send(); 
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var data = JSON.parse(request.responseText);
            if(data.status){
                    document.querySelector('#idAlumnoProfesor').value = data.data.ap_id;
                    document.querySelector('#listAlumno').value = data.data.alumno_id;
                    document.querySelector('#listProfesorAlu').value = data.data.pm_id;
                    document.querySelector('#listPeriodoAlu').value = data.data.periodo_id;
                    document.querySelector('#listEstado').value = data.data.estadop;
                $('#modalAlumnoProfesor').modal('show');

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

function eliminarAlumnoProfesor (id){
    var idAlumnoProfesor = id; 
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
                var url = './models/alumno-profesor/delet-alumno-profesor.php';
                request.open('POST',url,true);
                var strData = "id="+idAlumnoProfesor; 
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
                            tableAlumnoProfesor.ajax.reload()

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

function ModalProfesorAlumno(){
    document.querySelector('#idAlumnoProfesor').value="0";
    document.querySelector('#tituloModal').innerHTML='Asignar nuevo alumno'; 
    document.querySelector('#action').innerHTML='Guardar'; 
    document.querySelector('#formAlumnoProfesor').reset();
    $('#modalAlumnoProfesor').modal('show');
};

window.addEventListener('load',function(){
    showProfesorAlu();
    showAlumno(); 
    showPeriodoAlu(); 

},false)

function showProfesorAlu(){
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microst.XMLHTTP'); 
    var url = './models/options/options-aprofesor.php';
    request.open('GET',url,true);
    request.send(); 
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var data = JSON.parse(request.responseText);

            data.forEach(function(valor){
                data += '<option value = "'+valor.pm_id+'">'+valor.nombre+" "+valor.apellidos+", Grado:"+valor.nombre_grado+", Seccion:"+valor.nombre_aula+", Materia: "+valor.nombre_materia+'</option>'
            })
            document.querySelector('#listProfesorAlu').innerHTML = data; 

        }
    }
};

function showAlumno(){
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microst.XMLHTTP'); 
    var url = './models/options/options-alumno.php';
    request.open('GET',url,true);
    request.send(); 
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var data = JSON.parse(request.responseText);

            data.forEach(function(valor){
                data += '<option value = "'+valor.alumno_id+'">'+valor.nombre_alumno+", "+valor.apellidos_alumno+'</option>'
            })
            document.querySelector('#listAlumno').innerHTML = data;

        }
    }
};

function showPeriodoAlu (){
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
            document.querySelector('#listPeriodoAlu').innerHTML = data;

        }
    }
};
