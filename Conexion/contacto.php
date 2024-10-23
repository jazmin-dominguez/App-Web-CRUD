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
                            header("location: ../Cordinador/dashboard.php");
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
    }
?>