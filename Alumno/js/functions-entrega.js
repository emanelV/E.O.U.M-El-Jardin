document.addEventListener('DOMContentLoaded',function(){


    var formEntrega = document.querySelector('#formEntrega');
    formEntrega.onsubmit = function(e){
        e.preventDefault(); 

        var observacion = document.querySelector('#observacion').value;
        var file = document.querySelector('#file').value;


        if(observacion.trim()=='' || file == ''){
            Swal.fire({
                title: "Error",
                text: "Todos los campos son requeridos",
                icon: "error"
              });
            return false;
        }

            var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microst.XMLHTTP'); 
            var url = './models/entrega/ajax-entrega.php';
            var form = new FormData(formEntrega);
            request.open('POST',url,true);
            request.send(form); 

            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    var data = JSON.parse(request.responseText);

                    if(data.status){
                    Swal.fire({
                        title: "Crear entrega", 
                        text: data.msg, 
                        icon: "success", 
                        ConfirmButtonText: "Aceptar", 
                        allowOutsideClick: true
                    }).then((result)=>{
                        if(result.isConfirmed){
                                location.reload();
                                formEntrega.reset();
                        }
                    });
                    }else{

                        Swal.fire({
                            title: "Atención",
                            text: data.msg,
                            icon: "error"
                        });

                        }
                    } 
                }
            
            };
        }); 