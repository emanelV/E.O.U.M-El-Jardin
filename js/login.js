$(document).ready(function(){
$('#loginUsuario').on('click',function(){
    loginUsuario();
});

$('#loginProfesor').on('click',function(){
    loginProfesor();
});

$('#loginEncargado').on('click',function(){
    loginEncargado();
});

});

function loginUsuario(){
    var login = $('#user').val();
    var pass = $('#pass').val();
    $.ajax({
        url: './includes/loginUser.php',
        method: 'POST',
        data:{
            login:login,
            pass:pass
        }, 
        success: function(data){
           $('#messageAdmin').html(data);
           if (data.indexOf('Administrador/') >= 0) {
            window.location = 'Administrador/';
      
           }else if (data.indexOf('Asistente/') >= 0) {
            window.location = 'Asistente/';
        }
        }
    });
}

function loginProfesor(){
    var loginProfesor = $('#userProfesor').val();
    var passProfesor = $('#passProfesor').val();
    $.ajax({
        url: './includes/loginProfesor.php',
        method: 'POST',
        data:{
            loginProfesor:loginProfesor,
            passProfesor:passProfesor
        }, 
        success: function(data){
           $('#messageProfesor').html(data);
           if(data.indexOf('Redirecting')>=0){
            window.location = 'Maestro/';
           }
        }
    });
}


function loginEncargado(){
    var loginEncargado = $('#usuarioEncargado').val();
    var passEncargado = $('#passEncargado').val();
    $.ajax({
        url: './includes/loginEncargado.php',
        method: 'POST',
        data:{
            loginEncargado:loginEncargado,
            passEncargado:passEncargado
        }, 
        success: function(data){
           $('#messageEncargado').html(data);
           if(data.indexOf('Redirecting')>=0){
            window.location = 'Alumno/';
           }
        }
    });
}