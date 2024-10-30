
$('#tableaulas').DataTable();

var tableaula;
document.addEventListener('DOMContentLoaded',function(){
    tableaula = $('#tableaulas').DataTable({
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
            "url": "./models/aulas/table_aulas.php",
            "dataSrc": ""
        }, 
        "columns":[
            {"data":"acciones"},
            {"data":"aula_id"},
            {"data":"nombre_aula"},
            {"data": "estado"}

        ],
        "responsive": true,
        "bDestroy": true, 
        "iDisplayLength": 10,
        "order": [[0, "asc"]]

    })

    var formAula = document.querySelector('#formAula');
    formAula.onsubmit = function(e){
        e.preventDefault(); 

        var idgrado = document.querySelector('#idAula').value;
        var nombre = document.querySelector('#nombreAula').value;
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
        var url = './models/aulas/ajax-aulas.php';
        var form = new FormData(formAula);
        request.open('POST',url,true);
        request.send(form); 
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                var data = JSON.parse(request.responseText);
                if(request.status){
                    $('#modalAula').modal('hide');
                    Swal.fire({
                        title: '¡Éxito!',
                        text: data.msg,
                        icon: 'success'
                    });
                    formAula.reset();
                    tableaula.ajax.reload(); 
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



function editarAula(id){
    var idaula = id; 
    document.querySelector('#tituloModal').innerHTML='Actualizar Grado'; 
    document.querySelector('#action').innerHTML='Actualizar'; 
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microst.XMLHTTP'); 
    var url = './models/aulas/edit-aula.php?idAula='+idaula;
    request.open('GET',url,true);
    request.send(); 
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var data = JSON.parse(request.responseText);
            if(data.status){
                    document.querySelector('#idAula').value = data.data.aula_id;
                    document.querySelector('#nombreAula').value = data.data.nombre_aula;
                    document.querySelector('#listEstado').value = data.data.estado;
                $('#modalAula').modal('show');

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

function eliminarAula (id){
    var idaula = id; 
    swal.fire({
        title: "Eliminar seccion",
         text: "Esta seguro de eliminar?", 
         icon: "warning",
         showCancelButton: true, 
         confirmButtonText: "Si, eliminar",
         cancelButtonText: "Cancelar", 
        }).then((result)=>{
            if(result.isConfirmed){

                var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microst.XMLHTTP'); 
                var url = './models/aulas/delet-aula.php';
                request.open('POST',url,true);
                var strData = "idAula="+idaula; 
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
                            tableaula.ajax.reload()

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

function NuevoAula(){
    document.querySelector('#idAula').value="0";
    document.querySelector('#tituloModal').innerHTML='Crear Nueva Seccion'; 
    document.querySelector('#action').innerHTML='Guardar'; 
    document.querySelector('#formAula').reset();
    $('#modalAula').modal('show');
};