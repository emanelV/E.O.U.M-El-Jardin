
$('#tablematerias').DataTable();

var tablematerias;
document.addEventListener('DOMContentLoaded',function(){
    tablematerias = $('#tablematerias').DataTable({
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
            "url": "./models/materias/table_materias.php",
            "dataSrc": ""
        }, 
        "columns":[
            {"data":"acciones"},
            {"data":"materia_id"},
            {"data":"nombre_materia"},
            {"data": "estado"}

        ],
        "responsive": true,
        "bDestroy": true, 
        "iDisplayLength": 10,
        "order": [[0, "asc"]]

    })

    var formMateria = document.querySelector('#formMateria');
    formMateria.onsubmit = function(e){
        e.preventDefault(); 

        var idmateria = document.querySelector('#idMateria').value;
        var nombre = document.querySelector('#nombreMateria').value;
        var estado = document.querySelector('#listEstado').value;
        if(nombre == ''){
            Swal.fire({
                title: "Error",
                text: "Todos los campos son requeridos",
                icon: "error"
              });
            return false;
        }
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microst.XMLHTTP'); 
        var url = './models/materias/ajax-materias.php';
        var form = new FormData(formMateria);
        request.open('POST',url,true);
        request.send(form); 
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                var data = JSON.parse(request.responseText);
                if(request.status){
                    $('#modalMateria').modal('hide');
                    Swal.fire({
                        title: '¡Éxito!',
                        text: data.msg,
                        icon: 'success'
                    });
                    formMateria.reset();
                    tablematerias.ajax.reload(); 
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



function editarMateria(id){
    var idmateria = id; 
    document.querySelector('#tituloModal').innerHTML='Actualizar Materia'; 
    document.querySelector('#action').innerHTML='Actualizar'; 
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microst.XMLHTTP'); 
    var url = './models/materias/edit-materia.php?idMateria='+idmateria;
    request.open('GET',url,true);
    request.send(); 
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var data = JSON.parse(request.responseText);
            if(data.status){
                    document.querySelector('#idMateria').value = data.data.materia_id;
                    document.querySelector('#nombreMateria').value = data.data.nombre_materia;
                    document.querySelector('#listEstado').value = data.data.estado;
                $('#modalMateria').modal('show');

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

function eliminarMateria (id){
    var idmateria = id; 
    swal.fire({
        title: "Eliminar Materia",
         text: "Esta seguro de eliminar?", 
         icon: "warning",
         showCancelButton: true, 
         confirmButtonText: "Si, eliminar",
         cancelButtonText: "Cancelar", 
        }).then((result)=>{
            if(result.isConfirmed){

                var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microst.XMLHTTP'); 
                var url = './models/materias/delet-materia.php';
                request.open('POST',url,true);
                var strData = "idMateria="+idmateria; 
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
                            tablematerias.ajax.reload()

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

function NuevaMateria(){
    document.querySelector('#idMateria').value="0";
    document.querySelector('#tituloModal').innerHTML='Crear Nueva Materia'; 
    document.querySelector('#action').innerHTML='Guardar'; 
    document.querySelector('#formMateria').reset();
    $('#modalMateria').modal('show');
};