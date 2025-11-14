<?php

class Alumno extends Conectar {

    /**
     * Fórmula de calificación segura usando COALESCE y CAST
     */
    private function calificacionSQL(): string {
        return "ROUND(
                    (
                        (COALESCE(CAST(c.tarea_a AS FLOAT),0)*0.17 
                        + COALESCE(CAST(c.tarea_b AS FLOAT),0)*0.18 
                        + COALESCE(CAST(c.tarea_c AS FLOAT),0)*0.25)/6*60
                    )
                    + (COALESCE(CAST(c.proyecto1 AS FLOAT),0)*10 
                    + COALESCE(CAST(c.proyecto2 AS FLOAT),0)*18 
                    + COALESCE(CAST(c.proyecto3 AS FLOAT),0)*12),
                2)";
    }

    /**
     * Método genérico para ejecutar consultas con manejo de errores
     */
    private function consultar(string $query, array $params = []): array {
        $conectar = parent::Conexion();
        try {
            $stmt = $conectar->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en consulta SQL: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Validar resultados para evitar valores nulos o inconsistentes
     */
    private function validarResultados(array $datos): array {
        foreach ($datos as &$fila) {
            // Validar calificación final
            if (!isset($fila['calificacion_final']) || !is_numeric($fila['calificacion_final'])) {
                $fila['calificacion_final'] = 0;
            } else {
                $fila['calificacion_final'] = max(0, floatval($fila['calificacion_final']));
            }

            // Validar nombre completo
            if (!isset($fila['nombre_completo']) || $fila['nombre_completo'] === null || trim($fila['nombre_completo']) === '') {
                $fila['nombre_completo'] = 'Sin nombre';
            }
        }
        return $datos;
    }

    /**
     * Todos los alumnos
     */
    public function get_alumnos(): array {
        $sql = "SELECT 
                    ISNULL(a.nombre,'') + ' ' + ISNULL(a.apellido,'') AS nombre_completo,
                    a.id,
                    a.fecha_creacion
                FROM dbo.alumnos a
                ORDER BY a.id ASC;";
        $datos = $this->consultar($sql);
        return $this->validarResultados($datos);
    }

    /**
     * Alumnos aprobados
     */
    public function get_aprobados(): array {
        $calif = $this->calificacionSQL();
        $sql = "SELECT 
                    a.id,
                    ISNULL(a.nombre,'') + ' ' + ISNULL(a.apellido,'') AS nombre_completo,
                    $calif AS calificacion_final
                FROM dbo.alumnos a
                LEFT JOIN dbo.calificaciones c ON a.id = c.idAlum
                WHERE $calif >= 70
                ORDER BY calificacion_final DESC;";
        $datos = $this->consultar($sql);
        return $this->validarResultados($datos);
    }

    /**
     * Alumnos reprobados
     */
    public function get_reprobados(): array {
        $calif = $this->calificacionSQL();
        $sql = "SELECT 
                    a.id,
                    ISNULL(a.nombre,'') + ' ' + ISNULL(a.apellido,'') AS nombre_completo,
                    $calif AS calificacion_final
                FROM dbo.alumnos a
                LEFT JOIN dbo.calificaciones c ON a.id = c.idAlum
                WHERE $calif < 70
                ORDER BY calificacion_final DESC;";
        $datos = $this->consultar($sql);
        return $this->validarResultados($datos);
    }

    /**
     * Obtener alumnos por estado (APROBADO / REPROBADO / TODOS)
     */
    public function get_alumnos_estado(?string $estado = null): array {
        $calif = $this->calificacionSQL();
        $sql = "SELECT 
                    a.id,
                    ISNULL(a.nombre,'') + ' ' + ISNULL(a.apellido,'') AS nombre_completo,
                    $calif AS calificacion_final,
                    CASE 
                        WHEN $calif >= 70 THEN 'APROBADO'
                        ELSE 'REPROBADO'
                    END AS estado
                FROM dbo.alumnos a
                LEFT JOIN dbo.calificaciones c ON a.id = c.idAlum";

        if ($estado === 'APROBADO') {
            $sql .= " WHERE $calif >= 70";
        } elseif ($estado === 'REPROBADO') {
            $sql .= " WHERE $calif < 70";
        }

        $sql .= " ORDER BY calificacion_final DESC;";

        $datos = $this->consultar($sql);
        return $this->validarResultados($datos);
    }
}

?>
