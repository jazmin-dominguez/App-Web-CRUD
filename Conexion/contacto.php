<?php
    include ('conexion.php');
    
    class Contacto extends Conexion
    {
        public function login($correo, $password)
        {
            $this->sentencia = "SELECT * FROM usuarios WHERE correo='$correo' AND password='$password'";
            $resultado = $this->ejecutar_sentencia();

            // Verificar si el usuario existe
            if ($row = $resultado->fetch_assoc()) {
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
            } else {
                header("location: login.php?error=1");
                exit();
            }
        }

        public function crear_usuario($nombre, $correo, $password, $genero, $edad, $tipo_usuario, $fecha_nac)
        {
            $this->sentencia = "INSERT INTO usuarios (nombre, correo, password, genero, edad, tipo_usuario, fecha_nac) 
                                VALUES ('$nombre','$correo','$password','$genero',$edad,'$tipo_usuario','$fecha_nac')";
            return $this->ejecutar_sentencia();
        }

        public function listar_usuarios()
        {
            $this->sentencia = "SELECT * FROM usuarios";
            return $this->ejecutar_sentencia();
        }

        public function obtenerPorId($id)
        {
            $this->sentencia = "SELECT * FROM usuarios WHERE id = $id";
            return $this->ejecutar_sentencia();
        }

        public function modificar_usuario($id, $nombre, $correo, $genero, $edad, $tipo_usuario, $fecha_nac)
        {
            $this->sentencia = "UPDATE usuarios SET nombre='$nombre', correo='$correo', genero='$genero', edad='$edad', tipo_usuario='$tipo_usuario', fecha_nac='$fecha_nac' 
                                WHERE id = $id";
            return $this->ejecutar_sentencia();
        }

        public function eliminar_usuario($id)
        {
            $this->sentencia = "DELETE FROM usuarios WHERE id = $id";
            return $this->ejecutar_sentencia();
        }

        public function crear_user($nombre, $edad, $correo, $contrasena, $tipo_usuario, $fecha_nac)
        {
            $this->sentencia = "INSERT INTO usuarios (nombre, correo, password, edad, tipo_usuario, fecha_nac) 
                                VALUES ('$nombre','$correo','$contrasena','$edad','$tipo_usuario','$fecha_nac')";
            return $this->ejecutar_sentencia();
        }

        public function crear_materia($nombre_materia, $descripcion)
        {
            $this->sentencia = "INSERT INTO materias (nombre_materia, objetivos) 
                                VALUES ('$nombre_materia','$descripcion')";
            return $this->ejecutar_sentencia();
        }

        public function listar_materias()
        {
            $this->sentencia = "SELECT * FROM materias";
            return $this->ejecutar_sentencia();
        }

        public function obtener_materia_por_id($id)
        {
            $this->sentencia = "SELECT * FROM materias WHERE id = $id";
            return $this->ejecutar_sentencia();
        }

        public function modificar_materia($id, $nombre_materia, $objetivos)
        {
            $this->sentencia = "UPDATE materias SET nombre_materia='$nombre_materia', objetivos='$objetivos' 
                                WHERE id = $id";
            return $this->ejecutar_sentencia();
        }

        public function eliminar_materia($id)
        {
            $this->sentencia = "DELETE FROM materias WHERE id = $id";
            return $this->ejecutar_sentencia();
        }

        public function crear_programa($nombre_programa, $descripcion_programa, $materia, $tipo_usuario)
        {
            $this->sentencia = "INSERT INTO programas (nombre, descripcion, FK_materia, FK_tipo_usuario) 
                                VALUES ('$nombre_programa', '$descripcion_programa', '$materia', '$tipo_usuario')";
            return $this->ejecutar_sentencia();
        }

        public function listar_programas()
        {
            $this->sentencia = "
                SELECT 
                    programas.nombre AS programa_nombre,
                    programas.descripcion,
                    materias.nombre_materia AS nombre_materia,
                    usuarios.nombre AS nombre,
                    usuarios.tipo_usuario AS tipo_usuario  
                FROM programas
                JOIN materias ON programas.FK_materia = materias.id
                JOIN usuarios ON programas.FK_tipo_usuario = usuarios.id
            "; 
        
            return $this->ejecutar_sentencia(); // Ejecutar la sentencia y retornar el resultado
        }

        public function obtenerprogramaporid($id)
        {
            $this->sentencia = "SELECT * FROM programas WHERE id = $id";
            return $this->ejecutar_sentencia();
        }

        // Funciones auxiliares
        public function obtener_usuarios_teachers()
        {
            $this->sentencia = "SELECT id, nombre FROM usuarios WHERE tipo_usuario = 'Teacher'";
            $resultado = $this->ejecutar_sentencia();
            return $resultado->fetch_all(MYSQLI_ASSOC);
        }

        public function obtener_todas_materias()
        {
            $this->sentencia = "SELECT id, nombre_materia FROM materias";
            $resultado = $this->ejecutar_sentencia();
            return $resultado->fetch_all(MYSQLI_ASSOC);
        }
    }
?>
