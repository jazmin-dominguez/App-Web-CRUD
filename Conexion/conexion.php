<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Conexion {
    private $host = 'localhost';
    private $usuario = 'root';
    private $password = '';
    private $base = 'unityclass';
    public $sentencia;
    private $rows = array();
    public $conexion;

    public function abrir_conexion() {
        $this->conexion = new mysqli($this->host, $this->usuario, $this->password, $this->base);
        
        if ($this->conexion->connect_error) {
            die("Error de conexión: " . $this->conexion->connect_error);
        }
        
        return $this->conexion; // Asegúrate de retornar la conexión.
    }
    

    protected function cerrar_conexion() {
            $this->conexion->close();

    }

    public function ejecutar_sentencia() {
        $this->abrir_conexion();
        
        // Verificar que la sentencia no esté vacía o nula
        if (empty($this->sentencia)) {
        $this->cerrar_conexion();
        trigger_error("Error: La consulta SQL está vacía", E_USER_WARNING);
        return false;
    }
        
        $bandera = $this->conexion->query($this->sentencia);

        // Manejo de errores después de ejecutar la sentencia
        if (!$bandera) {
        trigger_error("Error al ejecutar la sentencia: " . $this->conexion->error, E_USER_WARNING);
    }
        
        $this->cerrar_conexion();
        return $bandera;
    }

    public function obtener_sentencia() {
        $this->abrir_conexion();
        $result = $this->conexion->query($this->sentencia);
        if (!$result) {
            trigger_error("Error en la consulta: " . $this->conexion->error, E_USER_WARNING);
        }
        $this->cerrar_conexion();
        return $result;
    }
    
}
?>
