
$('#tb_usuarios').DataTable();

var tb_usuarios;
document.addEventListener('DOMContentLoaded',function(){
    tb_usuarios = $('#tb_usuarios').DataTable({
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
            "url": "./models/usuarios/tb_usuarios.php",
            "dataSrc": ""
        }, 
        "columns":[
            {"data":"ACCIONES"},
            {"data":"ID_USUARIO"},
            {"data":"NOMBRE_USUARIO"},
            {"data":"APELLIDOS"},
            {"data":"NOMBREROL"},
            {"data":"LOGINUSUARIO"},
            {"data": "ACTIVO"}

        ],
        "responsive": true,
        "bDestroy": true, 
        "iDisplayLength": 10,
        "order": [[0, "asc"]]

    })

    var formusuario = document.querySelector('#formUser');
    formusuario.onsubmit = function(e){
        e.preventDefault(); 

        var idusuario = document.querySelector('#idusuario').value;
        var nombre = document.querySelector('#NombreUser').value;
        var apellidos = document.querySelector('#ApellidosUser').value;
        var usuario = document.querySelector('#User').value;
        var clave = document.querySelector('#clave').value;
        var rol = document.querySelector('#listRol').value;
        var estado = document.querySelector('#listEstado').value;
        if(nombre == '' || usuario == ''){
            Swal.fire({
                title: "Error",
                text: "Todos los campos son requeridos",
                icon: "error"
              });
            return false;
        }
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microst.XMLHTTP'); 
        var url = './models/usuarios/ajax-usuarios.php';
        var form = new FormData(formusuario);
        request.open('POST',url,true);
        request.send(form); 
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                var data = JSON.parse(request.responseText);
                if(request.status){
                    $('#modaluser').modal('hide');
                    Swal.fire({
                        title: '¡Éxito!',
                        text: data.msg,
                        icon: 'success'
                    });
                    formusuario.reset();
                    tb_usuarios.ajax.reload(); 
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


function ModalUsuario(){
    document.querySelector('#idusuario').value="0";
    document.querySelector('#tituloModal').innerHTML='Crear Usuario'; 
    document.querySelector('#action').innerHTML='Guardar'; 
    document.querySelector('#formUser').reset();
    $('#modaluser').modal('show');
};

function editarUser(id){
    var idusuario = id; 
    document.querySelector('#tituloModal').innerHTML='Actualizar Usuario'; 
    document.querySelector('#action').innerHTML='Actualizar'; 
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microst.XMLHTTP'); 
    var url = './models/usuarios/editar-usuarios.php?idusuario='+idusuario;
    request.open('GET',url,true);
    request.send(); 
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var data = JSON.parse(request.responseText);
            if(data.status){
                document.querySelector('#idusuario').value = data.data.ID_USUARIO; 
                document.querySelector('#NombreUser').value = data.data.NOMBRE_USUARIO; 
                document.querySelector('#ApellidosUser').value = data.data.APELLIDOS; 
                document.querySelector('#User').value = data.data.LOGINUSUARIO; 
                document.querySelector('#listRol').value = data.data.ID_ROL; 
                document.querySelector('#listEstado').value = data.data.ACTIVO; 
                $('#modaluser').modal('show');

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

function eliminarUser (id){
    var idusuario = id; 
    swal.fire({
        title: "Eliminar Usuario",
         text: "Esta seguro de eliminar?", 
         icon: "warning",
         showCancelButton: true, 
         confirmButtonText: "Si, eliminar",
         cancelButtonText: "Cancelar", 
        }).then((result)=>{
            if(result.isConfirmed){

                var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microst.XMLHTTP'); 
                var url = './models/usuarios/eliminar-usuarios.php';
                request.open('POST',url,true);
                var strData = "idusuario="+idusuario; 
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
                            tb_usuarios.ajax.reload()

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