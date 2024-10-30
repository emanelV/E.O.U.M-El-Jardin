<?php
session_start();
if(!empty($_SESSION['Admin'])){
    header('Location:Administrador/');
}else if(!empty($_SESSION['Adminp'])){
    header('Location:Maestro/');
}else if(!empty($_SESSION['ActiveE'])){
    header('Location:Alumno/');
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"href="boxicons-2.1.4/css/boxicons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Inicio de Sesion</title>
    <style>
    .image-container {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px; /* Espacio entre las imágenes y la línea */
    }
    .image-container img {
        width: 150px; /* Ajusta el tamaño como prefieras */
        height: 150px;
        object-fit: cover; /* Mantén la proporción de la imagen */
    }
    .vertical-line {
        width: 2px; /* Grosor de la línea */
        height: 150px; /* Altura de la línea, debe ser igual al de las imágenes */
        background-color: #000; /* Color de la línea (puedes cambiarlo) */
    }
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding-top: 10px; /* Añadido para el espacio superior */
        }
        .container {
            max-width: 450px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .topheader {
            text-align: center;
            margin-bottom: 20px;
        }
        .topheader header {
            font-size: 1.5rem;
            font-weight: bold;
        }
        .input-field {
            position: relative;
            margin-bottom: 20px;
        }
        .input-field input {
            width: 100%;
            padding: 10px 40px 10px 20px;
            border: 1px solid #ced4da;
            border-radius: 4px;
        }
        .input-field i {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            color: #6c757d;
        }
        .btn-primary {
            width: 100%;
            padding: 10px;
            border-radius: 4px;
            font-size: 1rem;
        }
        .top-images {
            margin-bottom: 20px; /* Espacio entre las imágenes y el contenido */
        }
        .top-images img {
            width: 100%; /* Asegura que las imágenes se adapten al contenedor */
            height: auto; /* Mantiene la proporción de la imagen */
            border-radius: 8px; /* Bordes redondeados para las imágenes */
            margin-bottom: 10px; /* Espacio entre las imágenes */
        }
    </style>
</head>
<body>
    <div class="container">
            <!-- Espacios para las imágenes en la parte superior -->
                <div class="image-container">
                    <img src="images/logomarr.jpg" alt="Imagen 1">
                    <div class="vertical-line"></div> <!-- Línea vertical -->
                    <img src="images/logeljardin.jpg" alt="Imagen 2">
                </div>

    <div class="box">
        <div class="container">
                <div class="topheader">
                <span>E.O.U.M EL JARDIN</span>
                    <header>Inicio de sesion</header>
                    </div>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" 
                                aria-controls="home-tab-pane" aria-selected="true">Administrador</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" 
                                aria-controls="profile" aria-selected="false">Profesor</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="alumno-tab" data-bs-toggle="tab" data-bs-target="#alumno-tab-pane" type="button" role="tab" 
                                aria-controls="alumno" aria-selected="false">Encargado</button>
                            </li>
                        </ul>
                                <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                                    <form action="" onsubmit="return validar()">
                                        
                                        <div class="input-field">
                                            <input type="text" id="user" name="user" class="input" placeholder="Nombre de Usuario">
                                            <i class="bx bx-user"></i>

                                        </div>
                                        <div class="input-field">
                                            <input type="password" id="pass" name="pass" class="input" placeholder="Contraseña">
                                            <div id="messageAdmin"></div>
                                            <i class="bx bx-lock-alt"></i>
                                        </div>

                                        <div class="input-field">
                                            <button id="loginUsuario" type="button">Ingresar</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                                <form action="" onsubmit="return validar()">
                                        
                                        <div class="input-field">
                                            <input type="text" class="input" id="userProfesor" name="userProfesor" placeholder="DPI">
                                            <i class="bx bx-user"></i>

                                        </div>
                                        <div class="input-field">
                                            <input type="password" class="input" id= "passProfesor" name="passProfesor" placeholder="Contraseña">
                                            <div id="messageProfesor"></div>
                                            <i class="bx bx-lock-alt"></i>
                                        </div>

                                        <div class="input-field">
                                            <button id="loginProfesor" type="button">Ingresar</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="alumno-tab-pane" role="tabpanel" aria-labelledby="alumno-tab" tabindex="0">
                                <form action="" onsubmit="return validar()">
                                        
                                        <div class="input-field">
                                            <input type="text" class="input" id="usuarioEncargado" name="usuarioEncargado" placeholder="DPI">
                                            <i class="bx bx-user"></i>

                                        </div>
                                        <div class="input-field">
                                            <input type="password" class="input" id= "passEncargado" name="passEncargado" placeholder="Contraseña">
                                            <div id="messageEncargado"></div>
                                            <i class="bx bx-lock-alt"></i>
                                        </div>

                                        <div class="input-field">
                                            <button id="loginEncargado" type="button">Ingresar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>


                    
                </div>
            </div>

    <script src="js/jquery-3.7.0.min.js"></script>    
    <script src="js/login.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

</body>
</html>