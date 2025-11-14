<?php
require_once("config/conexion.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Alumnos Aprobados</title>
     <?php include("includes/style.php"); ?>
</head>
<body class="body">
    <?php include("includes/navbar.php"); ?>
    <h2 style="text-align:center;">Lista de Alumnos Aprobados</h2>
    <div class="container mt-4" > 
        <table id="tabla_aprobados" class="display" style="width:90%;margin:auto;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre Completo</th>
                <th>Calificación Final</th>
            </tr>
        </thead>

    </div>
    
    <?php include("includes/script.php"); ?>
</body>
</html>
