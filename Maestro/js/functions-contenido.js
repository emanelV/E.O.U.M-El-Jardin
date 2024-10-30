document.addEventListener('DOMContentLoaded',function(){
    var formContenido = document.querySelector('#formContenido');
    formContenido.onsubmit = function(e){
        e.preventDefault(); 
        var idcontenido = document.querySelector('#idContenido').value;
        var titulo = document.querySelector('#titulo').value;
        var descripcion = document.querySelector('#descripcion').value;
        var material = document.querySelector('#file').value;



        if(titulo == '' || descripcion == ''  || material == '' ){
            Swal.fire({
                title: "Error",
                text: "Todos los campos son requeridos",
                icon: "error"
              });
            return false;
        }
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microst.XMLHTTP'); 
            var url = './models/contenido/ajax-contenido.php';
            var form = new FormData(formContenido);
            request.open('POST',url,true);
            request.send(form); 
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    var data = JSON.parse(request.responseText);
                    Swal.fire({
                        title: "Contenido creado", 
                        icon: "success", 
                        ConfirmButtonText: "Aceptar", 
                    }).then((result)=>{
                        if(result.isConfirmed){
                            if(data.status){
                                $('#modalContenido').modal('hide');
                                location.reload();
                                formContenido.reset();
                            }else{
                                    swal.fire('Atencion', data.msg, 'error');
                                }
                            }
                    })
                }
            }
        }

    });


   function OpenModalContenido(){
    document.querySelector('#idContenido').value ="0";
    document.querySelector('#tituloModal').innerHTML='Nuevo Contenido'; 
    document.querySelector('#action').innerHTML='Guardar'; 
    document.querySelector('#formContenido').reset();
    $('#modalContenido').modal('show');

   }

   
function editarContenido(id){
    var idcontenido = id; 
    document.querySelector('#tituloModal').innerHTML='Actualizar Contenido'; 
    document.querySelector('#action').innerHTML='Actualizar'; 

    var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microst.XMLHTTP'); 
    var url = './models/contenido/edit-contenido.php?idcontenido='+idcontenido;
    request.open('GET',url,true);
    request.send(); 
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var data = JSON.parse(request.responseText);
            if(data.status){
                    document.querySelector('#idContenido').value = data.data.contenido_id;
                    document.querySelector('#titulo').value = data.data.titulo;
                    document.querySelector('#descripcion').value = data.data.descripcion;
                $('#modalContenido').modal('show');

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

function eliminarContenido (id){
            var idcontenido = id; 
                swal.fire({
                    title: "Eliminar el contenido",
                    text: "Esta seguro de eliminar?", 
                    icon: "warning",
                    showCancelButton: true, 
                    confirmButtonText: "Si, eliminar",
                    cancelButtonText: "Cancelar", 
                    }).then((result)=>{
                        if(result.isConfirmed){

                var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microst.XMLHTTP'); 
                var url = './models/contenido/delet-contenido.php';
                request.open('POST',url,true);
                var strData = "idcontenido="+idcontenido; 
                request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                request.send(strData); 


                request.onreadystatechange = function(){
                    if(request.readyState == 4 && request.status == 200){
                        var data = JSON.parse(request.responseText);
                        if(data.status){

                            swal.fire({
                                title: "Eliminado",
                                text: data.msg, 
                                icon: "success", 
                                ConfirmButtonText: "OK"
                            }).then(() =>{    
                                  location.reload(); 
                            }); 

                        }else{
                            swal.fire('atencion', data.msg, 'error');
                        }
                    }
                };

            }
    });
}