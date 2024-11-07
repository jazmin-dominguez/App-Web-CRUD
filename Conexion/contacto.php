<?php
include('conexion.php');

class Contacto extends Conexion
{
    public function login($correo, $password)
    {
        $this->sentencia = "SELECT * FROM usuarios WHERE correo='$correo' AND password='$password'";
        $resultado = $this->ejecutar_sentencia();

        if ($resultado && $row = $resultado->fetch_assoc()) {
            // Verificar si el usuario ya tiene una sesión activa
            if (isset($row['session_activa']) && $row['session_activa'] == 1) {
                echo "<script>alert('La cuenta ya está activa en otro lugar.'); window.location.href='login.php';</script>";
                return false;
            } else {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }

                $_SESSION['nombre'] = $row['nombre'];
                $_SESSION['correo'] = $row['correo'];
                $_SESSION['tipo_usuario'] = $row['tipo_usuario'];
                $_SESSION['user_id'] = $row['id']; // Almacenar el ID del usuario en la sesión

                // Actualizar session_activa en la base de datos
                $this->sentencia = "UPDATE usuarios SET session_activa = 1 WHERE id = " . $row['id'];
                $this->ejecutar_sentencia();

                // Redirigir según el tipo de usuario
                switch ($row['tipo_usuario']) {
                    case 'Administrator':
                        header("location: ../Admin/dashboard.php");
                        break;
                    case 'Student':
                        header("location: ../Alumno/dashboard.php");
                        break;
                    case 'Teacher':
                        header("location: ../Voluntarios/dashboard.php");
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
            // Credenciales incorrectas
            header("location: login.php?error=1");
            exit();
        }
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];

            // Actualizar session_activa a 0 en la base de datos
            $this->sentencia = "UPDATE usuarios SET session_activa = 0 WHERE id = $user_id";
            $this->ejecutar_sentencia();

            // Destruir la sesión
            session_destroy();
            header("Location: login.php");
            exit();
        }
    }

    public function crear_usuario($nombre, $correo, $password, $genero, $edad, $tipo_usuario, $fecha_nac)
    {
        $this->sentencia = "INSERT INTO usuarios (nombre, correo, password, genero, edad, tipo_usuario, fecha_nac) VALUES ('$nombre','$correo','$password','$genero',$edad,'$tipo_usuario','$fecha_nac');";
        return $this->ejecutar_sentencia();
    }

    public function listar_usuarios()
    {
        $this->sentencia = "SELECT * FROM usuarios";
        return $this->ejecutar_sentencia();
    }

    public function crear_materia($nombre_materia, $descripcion)
    {
        $this->sentencia = "INSERT INTO materias (nombre_materia, objetivos) VALUES ('$nombre_materia', '$descripcion');";
        return $this->ejecutar_sentencia();
    }

    public function listar_materias()
    {
        $this->sentencia = "SELECT * FROM materias";
        return $this->ejecutar_sentencia();
    }

    public function crear_programa($nombre_programa, $descripcion_programa, $materia, $tipo_usuario)
    {
        $this->sentencia = "INSERT INTO programas (nombre, descripcion, FK_materia, FK_tipo_usuario) VALUES ('$nombre_programa', '$descripcion_programa', '$materia', '$tipo_usuario')";
        return $this->ejecutar_sentencia();
    }

    public function listar_programas()
    {
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

    public function crear_actividad($nombre_actividad, $descripcion, $fecha, $id_materia, $id_teacher)
    {
        $this->sentencia = "INSERT INTO actividades (nombre_actividad, descripcion, fecha, fk_materia, fk_teacher) 
                            VALUES ('$nombre_actividad', '$descripcion', '$fecha', '$id_materia', '$id_teacher')";
        return $this->ejecutar_sentencia();
    }

    public function listar_actividades()
    {
        $this->sentencia = "
            SELECT 
                actividades.id, 
                actividades.nombre_actividad, 
                actividades.descripcion, 
                actividades.fecha, 
                materias.nombre_materia AS nombre_materia, 
                usuarios.nombre AS nombre_teacher 
            FROM actividades
            LEFT JOIN materias ON actividades.fk_materia = materias.id
            LEFT JOIN usuarios ON actividades.fk_teacher = usuarios.id";
        return $this->ejecutar_sentencia();
    }

    public function modificar_actividad($id, $nombre_actividad, $descripcion, $fk_materia, $fk_teacher)
    {
        $this->sentencia = "UPDATE actividades 
                            SET nombre_actividad='$nombre_actividad', 
                                descripcion='$descripcion', 
                                fk_materia='$fk_materia', 
                                fk_teacher='$fk_teacher' 
                            WHERE id = $id";
        return $this->ejecutar_sentencia();
    }

    public function eliminar_actividad($id)
    {
        $this->sentencia = "DELETE FROM actividades WHERE id = $id";
        return $this->ejecutar_sentencia();
    }

    public function obtener_usuarios_teachers()
    {
        $this->sentencia = "SELECT id, nombre FROM usuarios WHERE tipo_usuario = 'Teacher'";
        return $this->ejecutar_sentencia()->fetch_all(MYSQLI_ASSOC);
    }

    public function obtener_todas_materias()
    {
        $this->sentencia = "SELECT id, nombre_materia FROM materias";
        return $this->ejecutar_sentencia()->fetch_all(MYSQLI_ASSOC);
    }

    public function obtener_programa_por_id($id)
    {
        $this->sentencia = "SELECT * FROM programas WHERE id = $id";
        return $this->ejecutar_sentencia()->fetch_assoc();
    }

    public function modificar_programa($id, $nombre_programa, $descripcion_programa, $FK_materia, $FK_tipo_usuario)
    {
        $this->sentencia = "UPDATE programas 
                            SET nombre = '$nombre_programa', 
                                descripcion = '$descripcion_programa', 
                                FK_materia = $FK_materia, 
                                FK_tipo_usuario = $FK_tipo_usuario 
                            WHERE id = $id";
        return $this->ejecutar_sentencia();
    }

    public function eliminar_programa($id)
    {
        $this->sentencia = "DELETE FROM programas WHERE id = $id";
        return $this->ejecutar_sentencia();
    }
}
?>
