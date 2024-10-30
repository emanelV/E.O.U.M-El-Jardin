<?php
session_start();
if(empty($_SESSION['Admin'])){
  header('Location: ./');
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="description" content="E.O.U.M EL JARDIN">
    <title>EL JARDIN</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script src="https://kit.fontawesome.com/9a8c615983.js" crossorigin="anonymous"></script>
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">-->
    <style>
      .icon-spacing {
        margin-right: 8px; /* Ajusta el valor para darle más espacio */
      }
    </style>
    <!-- Font-icon css-->
       </head>
  <body class="app sidebar-mini">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="lista_usuarios.php">El Jardin</a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"><i class="fa-solid fa-bars"></i></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
        <!-- User Menu-->
      </ul>
    </header>
    <?php require_once("barranav.php");?>