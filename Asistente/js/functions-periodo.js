
$('#tableperiodos').DataTable();

var tableperiodos;
document.addEventListener('DOMContentLoaded',function(){
    tableperiodos = $('#tableperiodos').DataTable({
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
            "url": "./models/periodos/table_periodos.php",
            "dataSrc": ""
        }, 
        "columns":[
            {"data":"acciones"},
            {"data":"periodo_id"},
            {"data":"nombre_periodo"},
            {"data": "estado"}

        ],
        "responsive": true,
        "bDestroy": true, 
        "iDisplayLength": 10,
        "order": [[0, "asc"]]

    })

    var formPeriodo = document.querySelector('#formPeriodo');
    formPeriodo.onsubmit = function(e){
        e.preventDefault(); 

        var idperiodo = document.querySelector('#idPeriodo').value;
        var nombre = document.querySelector('#nombrePeriodo').value;
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
        var url = './models/periodos/ajax-periodos.php';
        var form = new FormData(formPeriodo);
        request.open('POST',url,true);
        request.send(form); 
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                var data = JSON.parse(request.responseText);
                if(request.status){
                    $('#modalPeriodo').modal('hide');
                    Swal.fire({
                        title: '¡Éxito!',
                        text: data.msg,
                        icon: 'success'
                    });
                    formPeriodo.reset();
                    tableperiodos.ajax.reload(); 
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



function editarPeriodo(id){
    var idperiodo = id; 
    document.querySelector('#tituloModal').innerHTML='Actualizar Periodo'; 
    document.querySelector('#action').innerHTML='Actualizar'; 
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microst.XMLHTTP'); 
    var url = './models/periodos/edit-periodo.php?idPeriodo='+idperiodo;
    request.open('GET',url,true);
    request.send(); 
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var data = JSON.parse(request.responseText);
            if(data.status){
                    document.querySelector('#idPeriodo').value = data.data.periodo_id;
                    document.querySelector('#nombrePeriodo').value = data.data.nombre_periodo;
                    document.querySelector('#listEstado').value = data.data.estado;
                $('#modalPeriodo').modal('show');

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

function eliminarPeriodo (id){
    var idperiodo = id; 
    swal.fire({
        title: "Eliminar Periodo",
         text: "Esta seguro de eliminar?", 
         icon: "warning",
         showCancelButton: true, 
         confirmButtonText: "Si, eliminar",
         cancelButtonText: "Cancelar", 
        }).then((result)=>{
            if(result.isConfirmed){

                var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microst.XMLHTTP'); 
                var url = './models/periodos/delet-periodo.php';
                request.open('POST',url,true);
                var strData = "idPeriodo="+idperiodo; 
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
                            tableperiodos.ajax.reload()

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

function NuevoPeriodo(){
    document.querySelector('#idPeriodo').value="0";
    document.querySelector('#tituloModal').innerHTML='Crear Nuevo Periodo'; 
    document.querySelector('#action').innerHTML='Guardar'; 
    document.querySelector('#formPeriodo').reset();
    $('#modalPeriodo').modal('show');
};