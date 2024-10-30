
$('#tb_maestros').DataTable();

var tb_maestros;
document.addEventListener('DOMContentLoaded',function(){
    tb_maestros = $('#tb_maestros').DataTable({
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
            "url": "./models/maestros/tb_maestros.php",
            "dataSrc": ""
        }, 
        "columns":[
            {"data":"acciones"},
            {"data":"profesor_id"},
            {"data":"nombre"},
            {"data":"apellidos"},
            {"data":"direccion"},
            {"data":"dpi"},
            {"data":"telefono"},
            {"data": "correo"},
            {"data": "estado"}

        ],
        "responsive": true,
        "bDestroy": true, 
        "iDisplayLength": 10,
        "order": [[0, "asc"]]

    })

    var formprofesor = document.querySelector('#formProfesor');
    formprofesor.onsubmit = function(e){
        e.preventDefault(); 

        var idprofesor = document.querySelector('#idProfesor').value;
        var nombre = document.querySelector('#nombreProfesor').value;
        var apellidos = document.querySelector('#apellidosProfesor').value;
        var direccion = document.querySelector('#direccionProfesor').value;
        var dpi = document.querySelector('#dpiProfesor').value;
        var clave = document.querySelector('#passProfesor').value;
        var telefono = document.querySelector('#telefonoProfesor').value;
        var correo = document.querySelector('#correoProfesor').value;
        var estado = document.querySelector('#listEstado').value;
        if(nombre == '' || apellidos == '' || direccion == '' || dpi == '' || telefono == '' || correo == ''){
            Swal.fire({
                title: "Error",
                text: "Todos los campos son requeridos",
                icon: "error"
              });
            return false;
        }
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microst.XMLHTTP'); 
        var url = './models/maestros/ajax-profesores.php';
        var form = new FormData(formprofesor);
        request.open('POST',url,true);
        request.send(form); 
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                var data = JSON.parse(request.responseText);
                if(request.status){
                    $('#modalProfesor').modal('hide');
                    Swal.fire({
                        title: '¡Éxito!',
                        text: data.msg,
                        icon: 'success'
                    });
                    formprofesor.reset();
                    tb_maestros.ajax.reload(); 
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



function editarMaestro(id){
    var idprofesor = id; 
    document.querySelector('#tituloModal').innerHTML='Actualizar Profesor'; 
    document.querySelector('#action').innerHTML='Actualizar'; 
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microst.XMLHTTP'); 
    var url = './models/maestros/editar-maestros.php?idProfesor='+idprofesor;
    request.open('GET',url,true);
    request.send(); 
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var data = JSON.parse(request.responseText);
            if(data.status){
                    document.querySelector('#idProfesor').value = data.data.profesor_id;
                    document.querySelector('#nombreProfesor').value = data.data.nombre;
                    document.querySelector('#apellidosProfesor').value = data.data.apellidos;
                    document.querySelector('#direccionProfesor').value = data.data.direccion;
                    document.querySelector('#dpiProfesor').value = data.data.dpi;
                    document.querySelector('#telefonoProfesor').value = data.data.telefono;
                    document.querySelector('#correoProfesor').value = data.data.correo;
                    document.querySelector('#listEstado').value = data.data.estado;
                $('#modalProfesor').modal('show');

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

function eliminarMaestro (id){
    var idprofesor = id; 
    swal.fire({
        title: "Eliminar maestro",
         text: "Esta seguro de eliminar?", 
         icon: "warning",
         showCancelButton: true, 
         confirmButtonText: "Si, eliminar",
         cancelButtonText: "Cancelar", 
        }).then((result)=>{
            if(result.isConfirmed){

                var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microst.XMLHTTP'); 
                var url = './models/maestros/eliminar-maestro.php';
                request.open('POST',url,true);
                var strData = "idProfesor="+idprofesor; 
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
                            tb_maestros.ajax.reload()

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

function ModalMaestro(){
    document.querySelector('#idProfesor').value="0";
    document.querySelector('#tituloModal').innerHTML='Crear Nuevo Profesor'; 
    document.querySelector('#action').innerHTML='Guardar'; 
    document.querySelector('#formProfesor').reset();
    $('#modalProfesor').modal('show');
};