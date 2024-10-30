
$('#tablegrados').DataTable();

var tablegrados;
document.addEventListener('DOMContentLoaded',function(){
    tablegrados = $('#tablegrados').DataTable({
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
            "url": "./models/grados/table_grados.php",
            "dataSrc": ""
        }, 
        "columns":[
            {"data":"acciones"},
            {"data":"grado_id"},
            {"data":"nombre_grado"},
            {"data": "estado"}

        ],
        "responsive": true,
        "bDestroy": true, 
        "iDisplayLength": 10,
        "order": [[0, "asc"]]

    })

    var formGrado = document.querySelector('#formGrado');
    formGrado.onsubmit = function(e){
        e.preventDefault(); 

        var idgrado = document.querySelector('#idGrado').value;
        var nombre = document.querySelector('#nombreGrado').value;
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
        var url = './models/grados/ajax-grados.php';
        var form = new FormData(formGrado);
        request.open('POST',url,true);
        request.send(form); 
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                var data = JSON.parse(request.responseText);
                if(request.status){
                    $('#modalGrado').modal('hide');
                    Swal.fire({
                        title: '¡Éxito!',
                        text: data.msg,
                        icon: 'success'
                    });
                    formGrado.reset();
                    tablegrados.ajax.reload(); 
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



function editarGrado(id){
    var idgrado = id; 
    document.querySelector('#tituloModal').innerHTML='Actualizar Grado'; 
    document.querySelector('#action').innerHTML='Actualizar'; 
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microst.XMLHTTP'); 
    var url = './models/grados/edit-grado.php?idGrado='+idgrado;
    request.open('GET',url,true);
    request.send(); 
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var data = JSON.parse(request.responseText);
            if(data.status){
                    document.querySelector('#idGrado').value = data.data.grado_id;
                    document.querySelector('#nombreGrado').value = data.data.nombre_grado;
                    document.querySelector('#listEstado').value = data.data.estado;
                $('#modalGrado').modal('show');

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

function eliminarGrado (id){
    var idgrado = id; 
    swal.fire({
        title: "Eliminar grado",
         text: "Esta seguro de eliminar?", 
         icon: "warning",
         showCancelButton: true, 
         confirmButtonText: "Si, eliminar",
         cancelButtonText: "Cancelar", 
        }).then((result)=>{
            if(result.isConfirmed){

                var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microst.XMLHTTP'); 
                var url = './models/grados/delet-grado.php';
                request.open('POST',url,true);
                var strData = "idGrado="+idgrado; 
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
                            tablegrados.ajax.reload()

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

function NuevoGrado(){
    document.querySelector('#idGrado').value="0";
    document.querySelector('#tituloModal').innerHTML='Crear Nuevo Grado'; 
    document.querySelector('#action').innerHTML='Guardar'; 
    document.querySelector('#formGrado').reset();
    $('#modalGrado').modal('show');
};