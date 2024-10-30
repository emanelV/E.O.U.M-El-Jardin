document.addEventListener('DOMContentLoaded',function(){
    var formEvaluacion = document.querySelector('#formEvaluacion');
    formEvaluacion.onsubmit = function(e){
        e.preventDefault(); 
        var idevaluacion = document.querySelector('#idevaluacion').value;
        var idcontenido = document.querySelector('#idcontenido').value; 
        var titulo = document.querySelector('#titulo').value;
        var descripcion = document.querySelector('#descripcion').value;
        var fecha = document.querySelector('#fecha').value;
        var valor = document.querySelector('#valor').value;


        if(titulo == '' || descripcion == '' || fecha == '' || valor == ''){
            Swal.fire({
                title: "Error",
                text: "Todos los campos son requeridos",
                icon: "error"
              });
            return false;
        }
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microst.XMLHTTP'); 
            var url = './models/evaluacion/ajax-evaluacion.php';
            var form = new FormData(formEvaluacion);
            request.open('POST',url,true);
            request.send(form); 
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    var data = JSON.parse(request.responseText);
                    Swal.fire({
                        title: "Crear / Actualizar actividad", 
                        icon: "success", 
                        ConfirmButtonText: "Aceptar", 
                    }).then((result)=>{
                        if(result.isConfirmed){
                            if(data.status){
                                $('#modalEvaluacion').modal('hide');
                                location.reload();
                                formEvaluacion.reset();
                            }else{
                                    swal.fire('Atencion', data.msg, 'error');
                                }
                            }
                    })
                }
            }
        }

    });


   function OpenModalEvaluacion(){
    document.querySelector('#idevaluacion').value ="0";
    document.querySelector('#tituloModal').innerHTML='Nueva Actividad'; 
    document.querySelector('#action').innerHTML='Guardar'; 
    document.querySelector('#formEvaluacion').reset();
    $('#modalEvaluacion').modal('show');

   }

   
function editarEvaluacion(id){
    var idevaluacion = id; 
    document.querySelector('#tituloModal').innerHTML='Editar Actividad'; 
    document.querySelector('#action').innerHTML='Actualizar'; 

    var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microst.XMLHTTP'); 
    var url = './models/evaluacion/edit-evaluacion.php?idevaluacion='+idevaluacion;
    request.open('GET',url,true);
    request.send(); 
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var data = JSON.parse(request.responseText);
            if(data.status){
                    document.querySelector('#idevaluacion').value = data.data.evaluacion_id;
                    document.querySelector('#titulo').value = data.data.titulo_eva;
                    document.querySelector('#descripcion').value = data.data.descripcion;
                    document.querySelector('#fecha').value = data.data.fecha;
                    document.querySelector('#valor').value = data.data.porcentaje;
                $('#modalEvaluacion').modal('show');

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

function eliminarEvaluacion (id){
            var idevaluacion = id; 
                swal.fire({
                    title: "Eliminar la actividad",
                    text: "Esta seguro de eliminar?", 
                    icon: "warning",
                    showCancelButton: true, 
                    confirmButtonText: "Si, eliminar",
                    cancelButtonText: "Cancelar", 
                    }).then((result)=>{
                        if(result.isConfirmed){

                var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microst.XMLHTTP'); 
                var url = './models/evaluacion/delet-evaluacion.php';
                request.open('POST',url,true);
                var strData = "idevaluacion="+idevaluacion; 
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