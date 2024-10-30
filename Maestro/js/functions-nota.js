document.addEventListener('DOMContentLoaded',function(){

     var formNota = document.querySelector('#formNota'); 
     formNota.onsubmit = function(e){
        e.preventDefault(); 

        var ideventregada = document.querySelector('#ideventregada').value;
        console.log('ID de Entrega', ideventregada); 
        var nota = document.querySelector('#nota').value; 



        if(nota.trim() == ''){
            Swal.fire({
                title: "Error",
                text: "Todos los campos son requeridos",
                icon: "error"
              });
            return false;
        }

        if (ideventregada.trim() === '') {
            Swal.fire({
                title: "Error",
                text: "ID de entrega no válido",
                icon: "error"
            });
            return false;
        }
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microst.XMLHTTP'); 
            var url = './models/nota/ajax-nota.php';
            var form = new FormData(formNota);
            request.open('POST',url,true);
            request.send(form); 
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    var data = JSON.parse(request.responseText);
                    if(data.status){
                    Swal.fire({
                        title: "Cargar Nota", 
                        icon: "success", 
                        ConfirmButtonText: "Aceptar", 
                    }).then((result)=>{
                        if(result.isConfirmed){
                          
                                $('#modalNota').modal('hide');
                                location.reload();
                                formNota.reset();
                        }
                       
                    })
                }else{
                    swal.fire('Atencion', data.msg, 'error');
                     }
                }
            }
        }

    });


    function modalNota(){
        $('#modalNota').modal('show'); 


    }