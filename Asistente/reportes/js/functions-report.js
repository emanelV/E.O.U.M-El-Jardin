
window.addEventListener('load',function(){

    showAlum(); 
    document.getElementById('generatePDF').addEventListener('click',function(){
        var alumnoId = document.getElementById('listAlumno').value;
        if(alumnoId){
            window.location.href = 'reportes/generate_pdf.php?alumno_id='+alumnoId;
        }else{
            alert('Por favor, Selecciona un alumno'); 
        }
    });

},false)


function showAlum(){
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microst.XMLHTTP'); 
    var url = 'reportes/opt-alumno.php';
    request.open('GET',url,true);
    request.send(); 
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var data = JSON.parse(request.responseText);

            data.forEach(function(valor){
                data += '<option value = "'+valor.alumno_id+'">'+valor.nombre_alumno+", "+valor.apellidos_alumno+'</option>'
            })
            document.querySelector('#listAlumno').innerHTML = data;

        }
    }
};