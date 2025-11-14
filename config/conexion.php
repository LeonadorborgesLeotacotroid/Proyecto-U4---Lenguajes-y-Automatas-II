<?php
class Conectar {
    private $host = "localhost\\SQLEXPRESS";
    private $db = "alumnos";
    private $user = "leoudemy";     
    private $pass = "03182130";      
    protected $dbh;

    protected function conexion() {
        try {
            $dsn = "sqlsrv:Server={$this->host};Database={$this->db}";
            $this->dbh = new PDO($dsn, $this->user, $this->pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);

            return $this->dbh;

        } catch (PDOException $e) {
            die("Error BD: " . $e->getMessage());
        }
    }
}
?>
