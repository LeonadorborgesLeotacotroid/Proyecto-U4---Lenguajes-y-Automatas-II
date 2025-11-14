<?php
require_once("../config/conexion.php");
require_once("../models/Alumno.php");

$alumno = new Alumno();

if (isset($_GET["op"])) {
    switch ($_GET["op"]) {

        case "listar":
            $datos = $alumno->get_alumnos();
            echo json_encode($datos);
            break;

        case "aprobados":
            $datos = $alumno->get_aprobados();
            echo json_encode($datos);
            break;

        case "reprobados":
            $datos = $alumno->get_reprobados();
            echo json_encode($datos);
            break;

        case "estado":
            $datos = $alumno->get_alumnos_estado();
            echo json_encode($datos);
            break;
        

        default:
            echo json_encode(["error" => "Operación no válida"]);
            break;
    }
}
?>
