<?php
require_once __DIR__ . '/../config/conexion.php';

class AlumnoSeeder extends Conectar
{
    public function generarAlumnosYCalificaciones($cantidad = 100)
    {
        try {
            $conectar = parent::conexion();

            // (Opcional) Limpia datos anteriores
            $conectar->exec("DELETE FROM calificaciones");
            $conectar->exec("DELETE FROM alumnos");

            // Listas de nombres y apellidos
            $nombres = ['Juan', 'Ana', 'Carlos', 'María', 'Pedro', 'Lucía', 'Miguel', 'Fernanda', 'Luis', 'Laura', 'Jorge', 'Andrea', 'Cristina', 'Raúl', 'Sofía', 'Roberto', 'Daniel', 'Paula'];
            $apellidos = ['López', 'Gómez', 'Hernández', 'Ramírez', 'Martínez', 'Castro', 'Guerrero', 'Sánchez', 'Vargas', 'Flores', 'Morales', 'Romero', 'Medina', 'Campos', 'García'];

        
            $sqlAlumno = "INSERT INTO alumnos (nombre, apellido, nombre_completo, fecha_creacion) VALUES (?, ?, ?, GETDATE())";
            $stmtAlumno = $conectar->prepare($sqlAlumno);

            $sqlCalif = "INSERT INTO calificaciones (idAlum, tarea_a, tarea_b, tarea_c, proyecto1, proyecto2, proyecto3) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmtCalif = $conectar->prepare($sqlCalif);

            for ($i = 1; $i <= $cantidad; $i++) {
                $nombre = $nombres[array_rand($nombres)];
                $apellido = $apellidos[array_rand($apellidos)];
                $nombreCompleto = "$nombre $apellido";

                
                $stmtAlumno->execute([$nombre, $apellido, $nombreCompleto]);
                $idAlumno = $conectar->lastInsertId();

              
                $tarea_a = round(mt_rand(600, 1000) / 100, 2);
                $tarea_b = round(mt_rand(600, 1000) / 100, 2);
                $tarea_c = round(mt_rand(600, 1000) / 100, 2);

                $proyecto1 = rand(0, 1);
                $proyecto2 = rand(0, 1);
                $proyecto3 = rand(0, 1);

              
                $stmtCalif->execute([$idAlumno, $tarea_a, $tarea_b, $tarea_c, $proyecto1, $proyecto2, $proyecto3]);
            }

            echo "<h3 style='color:green;'>Se generaron $cantidad alumnos con calificaciones aleatorias correctamente.</h3>";
        } catch (PDOException $e) {
            echo "<h3 style='color:red;'>Error: " . $e->getMessage() . "</h3>";
        }
    }
}
