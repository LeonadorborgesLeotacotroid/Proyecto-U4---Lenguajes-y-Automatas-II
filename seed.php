<?php
require_once "models/AlumnoSeeder.php";

$seeder = new AlumnoSeeder();
$seeder->generarAlumnosYCalificaciones(1000); 
