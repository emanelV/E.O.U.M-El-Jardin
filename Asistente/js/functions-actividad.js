
$('#tableactividades').DataTable();

var tableactividades;
document.addEventListener('DOMContentLoaded',function(){
    tableactividades = $('#tableactividades').DataTable({
        "aProcessing": true, 
        "aServerSide": true, 
        "languaje":{
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": "./models/actividad/table_actividad.php",
            "dataSrc": ""
        }, 
        "columns":[
            {"data":"acciones"},
            {"data":"actividad_id"},
            {"data":"nombre_actividad"},
            {"data": "estado"}

        ],
        "responsive": true,
        "bDestroy": true, 
        "iDisplayLength": 10,
        "order": [[0, "asc"]]

    })

    var formActividad = document.querySelector('#formActividad');
    formActividad.onsubmit = function(e){
        e.preventDefault(); 

        var idactividad = document.querySelector('#idActividad').value;
        var nombre = document.querySelector('#nombreActividad').value;
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
        var url = './models/actividad/ajax-actividad.php';
        var form = new FormData(formActividad);
        request.open('POST',url,true);
        request.send(form); 
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                var data = JSON.parse(request.responseText);
                if(request.status){
                    $('#modalActividad').modal('hide');
                    Swal.fire({
                        title: '¡Éxito!',
                        text: data.msg,
                        icon: 'success'
                    });
                    formActividad.reset();
                    tableactividades.ajax.reload(); 
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



function editarActividad(id){
    var idactividad = id; 
    document.querySelector('#tituloModal').innerHTML='Actualizar Actividad'; 
    document.querySelector('#action').innerHTML='Actualizar'; 
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microst.XMLHTTP'); 
    var url = './models/actividad/edit-actividad.php?idActividad='+idactividad;
    request.open('GET',url,true);
    request.send(); 
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var data = JSON.parse(request.responseText);
            if(data.status){
                    document.querySelector('#idActividad').value = data.data.actividad_id;
                    document.querySelector('#nombreActividad').value = data.data.nombre_actividad;
                    document.querySelector('#listEstado').value = data.data.estado;
                $('#modalActividad').modal('show');

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

function eliminarActividad(id){
    var idactividad = id; 
    swal.fire({
        title: "Eliminar Activudad",
         text: "Esta seguro de eliminar?", 
         icon: "warning",
         showCancelButton: true, 
         confirmButtonText: "Si, eliminar",
         cancelButtonText: "Cancelar", 
        }).then((result)=>{
            if(result.isConfirmed){

                var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microst.XMLHTTP'); 
                var url = './models/actividad/delet-actividad.php';
                request.open('POST',url,true);
                var strData = "idActividad="+idactividad; 
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
                            tableactividades.ajax.reload()

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

function NuevaActividad (){
    document.querySelector('#idActividad').value="0";
    document.querySelector('#tituloModal').innerHTML='Crear Nueva Actividad'; 
    document.querySelector('#action').innerHTML='Guardar'; 
    document.querySelector('#formActividad').reset();
    $('#modalActividad').modal('show');
};