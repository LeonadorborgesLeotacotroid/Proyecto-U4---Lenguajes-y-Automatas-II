<?php
require_once("config/conexion.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Alumnos Reprobados</title>
    <?php include("includes/style.php"); ?>
<body class="body">
    <?php include("includes/navbar.php"); ?>

    <h2 style="text-align:center;">Lista de Alumnos Reprobados</h2>
    <div class="container mt-4" > 
        <table id="tabla_reprobados" class="display" style="width:90%;margin:auto;">
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
