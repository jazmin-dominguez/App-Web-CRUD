<?php
    include ('conexion.php');
    class Contacto extends Conexion
    {
        public function login($correo, $password)
        {
            $this->sentencia="SELECT * FROM usuarios WHERE correo='$correo' AND password='$password'";
            $resultado = $this->ejecutar_sentencia();
    
            // Verificar si el usuario existe
            if ($row = $resultado->fetch_assoc()) {
                if ($row['correo'] == $correo && $row['password'] == $password) {
                    // Iniciar sesión y guardar variables de sesión
                    session_start();
                    $_SESSION['nombre'] = $row['nombre'];
                    $_SESSION['correo'] = $row['correo'];
                    $_SESSION['tipo_usuario'] = $row['tipo_usuario'];
    
                    // Redirigir al dashboard de acuerdo al tipo_usuario
                    switch ($row['tipo_usuario']) {
                        case 'Administrator':
                            header("location: ../Admin/dashboard.php");
                            break;
                        case 'Student':
                            header("location: ../Alumno/dashboard.php");
                            break;
                        case 'Teacher':
                            header("location: ../Maestro/dashboard.php");
                            break;
                        case 'Donor':
                            header("location: ../Donacion/dashboard.php");
                            break;
                        case 'Cordinator':
                            header("location: ../Coordinador/dashboard.php");
                            break;
                        default:
                            header("location: login.php?error=1");
                            break;
                    }
                    exit();
                }
            } else {
                header("location: login.php?error=1");
                exit();
            }
        }

        // Método para registrar un nuevo usuario
        public function crear_usuario($nombre, $correo, $password, $genero, $edad, $tipo_usuario, $fecha_nac)
        {
            $this->sentencia = "INSERT INTO usuarios (nombre, correo, password, genero, edad,tipo_usuario, fecha_nac) VALUES ('$nombre','$correo','$password','$genero',$edad,'$tipo_usuario','$fecha_nac');";
            $result = $this->ejecutar_sentencia();
            return $result;
        }
        public function listar_usuarios()
        {
            $this->sentencia = "SELECT * FROM usuarios";
            $result = $this->ejecutar_sentencia();
            return $result;
        }
        public function obtenerPorId($id)
        {
            $this->sentencia = "SELECT * FROM usuarios WHERE id = $id";
            $result = $this->ejecutar_sentencia();
            return $result;
        }
        public function modificar_usuario($id, $nombre, $correo, $genero, $edad, $tipo_usuario, $fecha_nac)
        {
            $this->sentencia = "UPDATE usuarios SET nombre='$nombre', correo='$correo', genero='$genero', edad='$edad', tipo_usuario='$tipo_usuario', fecha_nac='$fecha_nac' WHERE id = $id";
            $result = $this->ejecutar_sentencia();
            return $result;
        }
        public function eliminar_usuario($id)
        {
            $this->sentencia = "DELETE FROM usuarios WHERE id = $id";
            $result = $this->ejecutar_sentencia();
            return $result;
        }
        public function crear_user($nombre, $edad, $correo, $contrasena, $tipo_usuario, $fecha_nac)
        {
            $this->sentencia = "INSERT INTO usuarios (nombre,correo, password, edad, tipo_usuario, fecha_nac) VALUES ('$nombre','$correo','$contrasena','$edad','$tipo_usuario','$fecha_nac');";
            $result = $this->ejecutar_sentencia();
            return $result;
        }
        public function crear_materia($nombre_materia, $descripcion)
        {
            $this->sentencia = "INSERT INTO materias (nombre_materia,objetivos) VALUES ('$nombre_materia','$descripcion');";
            $result = $this->ejecutar_sentencia();
            return $result;
        }
        public function listar_materias()
        {
            $this->sentencia = "SELECT * FROM materias";
            $result = $this->ejecutar_sentencia();
            return $result;
        }
        public function obtener_materia_por_id($id)
        {
            $this->sentencia = "SELECT * FROM materias WHERE id = $id";
            $result = $this->ejecutar_sentencia();
            return $result;
        }
        public function modificar_materia($id, $nombre_materia, $objetivos)
        {
            $this->sentencia = "UPDATE materias SET nombre_materia='$nombre_materia', objetivos='$objetivos' WHERE id = $id";
            $result = $this->ejecutar_sentencia();
            return $result;
        }
        public function eliminar_materia($id)
        {
            $this->sentencia = "DELETE FROM materias WHERE id = $id";
            $result = $this->ejecutar_sentencia();
            return $result;
        }
        public function crear_programa($nombre_programa, $descripcion_programa, $materia, $tipo_usuario)
        {
            $this->sentencia = "INSERT INTO programas (nombre, descripcion, FK_materia, FK_tipo_usuario) VALUES ('$nombre_programa', '$descripcion_programa', '$materia', '$tipo_usuario')";
            $result = $this->ejecutar_sentencia();
            return $result;
        }
        public function eliminar_programa($id)
        {
            $this->sentencia = "DELETE FROM programas WHERE id = $id";
            $result = $this->ejecutar_sentencia();
            return $result;
        }
        // Función para obtener todos los usuarios que son 'teachers'
public function obtener_usuarios_teachers() {
    $this->sentencia = "SELECT id, nombre FROM usuarios WHERE tipo_usuario = 'Teacher'";
    $resultado = $this->ejecutar_sentencia();
    return $resultado->fetch_all(MYSQLI_ASSOC);
}
// Función para obtener todas las materias
public function obtener_todas_materias() {
    $this->sentencia = "SELECT id, nombre_materia FROM materias";
    $resultado = $this->ejecutar_sentencia();
    return $resultado->fetch_all(MYSQLI_ASSOC);
}
public function listar_programas() {
    $this->sentencia = "
        SELECT 
            programas.id, 
            programas.nombre AS programa_nombre, 
            programas.descripcion, 
            materias.nombre_materia, 
            usuarios.nombre AS nombre, 
            usuarios.tipo_usuario 
        FROM programas
        LEFT JOIN materias ON programas.FK_materia = materias.id
        LEFT JOIN usuarios ON programas.FK_tipo_usuario = usuarios.id
    ";
    return $this->ejecutar_sentencia();
}

public function obtener_programa_por_id($id) {
    $this->sentencia = "SELECT * FROM programas WHERE id = $id";
    $result = $this->ejecutar_sentencia();
    return $result->fetch_assoc();
}
public function modificar_programa($id, $nombre_programa, $descripcion_programa, $FK_materia, $FK_tipo_usuario) {
    $this->sentencia = "UPDATE programas 
                        SET nombre = '$nombre_programa', 
                            descripcion = '$descripcion_programa', 
                            FK_materia = $FK_materia, 
                            FK_tipo_usuario = $FK_tipo_usuario 
                        WHERE id = $id";
    return $this->ejecutar_sentencia();

}




    }
?>