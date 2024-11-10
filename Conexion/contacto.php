<?php
    include ('conexion.php');
    class Contacto extends Conexion
    {
        public function login($correo, $password)
        {
            $this->sentencia="SELECT * FROM usuarios WHERE correo='$correo' AND password='$password'";
            $resultado = $this->ejecutar_sentencia();
    
            // Verificar si el usuario existe
            if ( $resultado && $row = $resultado->fetch_assoc()) {
                // Verificar si el usuario ya tiene una sesión activa
                if (isset($row['session_activa']) && $row['session_activa'] == 1) {
                    echo "<script>alert('La cuenta ya está activa en otro lugar.'); window.location.href='login.php';</script>";
                    return false;
                } else {
                    if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                    }
 //codigo que tenia antes de actualizar lo de lau//if ($row['correo'] == $correo && $row['password'] == $password) {
                    // Iniciar sesión y guardar variables de sesión
                    //este tambien //session_start();
                    $_SESSION['nombre'] = $row['nombre'];
                    $_SESSION['correo'] = $row['correo'];
                    $_SESSION['tipo_usuario'] = $row['tipo_usuario'];
                    $_SESSION['user_id'] = $row['id'];

                    // Actualizar session_activa en la base de datos
                    $this->sentencia = "UPDATE usuarios SET session_activa = 1 WHERE id = " . $row['id'];
                    $this->ejecutar_sentencia();

                    // Redirigir al dashboard de acuerdo al tipo_usuario
                    switch ($row['tipo_usuario']) {
                        case 'Administrator':
                            header("location: ../Admin/dashboard.php");
                            break;
                        case 'Student':
                            header("location: ../Beneficiarios/dashboard.php");
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
                $user_id = $_SESSION['id'];

                // Actualizar session_activa a 0 en la base de datos
                $this->sentencia = "UPDATE usuarios SET session_activa = 0 WHERE id = $user_id";
                $this->ejecutar_sentencia();

                // Destruir la sesión
                session_destroy();
                header("Location: login.php");
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

    public function obtenerRegistrosPorPeriodo($periodo) {
        switch ($periodo) {
            case 'daily':
                $this->sentencia = "SELECT DATE(fecha_registro) as periodo, COUNT(*) as total FROM usuarios GROUP BY DATE(fecha_registro)";
                break;
            case 'weekly':
                $this->sentencia = "SELECT YEAR(fecha_registro) AS year, WEEK(fecha_registro) AS week, COUNT(*) as total 
                                    FROM usuarios 
                                    GROUP BY year, week";
                break;
            case 'monthly':
                $this->sentencia = "SELECT YEAR(fecha_registro) AS year, MONTH(fecha_registro) AS month, COUNT(*) as total 
                                    FROM usuarios 
                                    GROUP BY year, month";
                break;
            default:
                return [];
        }
        
        $result = $this->obtener_sentencia();
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
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

public function obtener_todos_programas() {
    //$sql = "SELECT id, nombre, descripcion, FK_materia FROM programas";
    $sql = "
    SELECT 
        p.id, 
        p.nombre, 
        p.descripcion, 
        m.nombre_materia 
    FROM programas p
    LEFT JOIN materias m ON p.FK_materia = m.id
    ";
    $this->sentencia = $sql; 
    $result = $this->obtener_sentencia();
    return $result ? $result ->fetch_all(MYSQLI_ASSOC): [];
}

//public function ejecutar_sentencia() {
   // if (!$this->conexion) {
     //   die("Conexión no inicializada.");
   // }

   // $resultado = $this->conexion->query($this->sentencia);
    //if (!$resultado) {
      //  die("Error en la consulta: " . $this->conexion->error);
    //}
    //return $resultado;
//}


    // Verificar si el usuario ya está inscrito en el programa
    public function verificar_inscripcion($user_id, $programa_id) {
        // Abrir la conexión
        $this->abrir_conexion();

        // Preparar y ejecutar la consulta
        $sql = "SELECT COUNT(*) AS count FROM inscripciones WHERE user_id = ? AND programa_id = ?";
        $stmt = $this->conexion->prepare($sql);

        if (!$stmt) {
            die("Error en la preparación de la consulta: " . $this->conexion->error);
        }

        $stmt->bind_param("ii", $user_id, $programa_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        // Cerrar la conexión
        $stmt->close();
        $this->cerrar_conexion();

        return $row['count'] > 0;
    }

    // Inscribir al usuario en el programa
    public function inscribir_usuario_en_programa($user_id, $programa_id) {
        // Abrir la conexión
        $this->abrir_conexion();

        // Preparar y ejecutar la consulta
        $sql = "INSERT INTO inscripciones (user_id, programa_id) VALUES (?, ?)";
        $stmt = $this->conexion->prepare($sql);

        if (!$stmt) {
            echo "Error en la preparación: " . $this->conexion->error;
            return false;
        }

        $stmt->bind_param("ii", $user_id, $programa_id);
        $resultado = $stmt->execute();

        // Cerrar la conexión
        $stmt->close();
        $this->cerrar_conexion();

        return $resultado;
    }

    public function obtener_programas_inscritos($user_id) {
        $this->abrir_conexion();
        
        $sql = "SELECT p.id, p.nombre, p.descripcion, m.nombre_materia
                FROM programas p
                INNER JOIN inscripciones i ON p.id = i.programa_id
                LEFT JOIN materias m ON p.FK_materia = m.id
                WHERE i.user_id = ?";
        
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $programas = $result->fetch_all(MYSQLI_ASSOC);
        
        $stmt->close();
        $this->cerrar_conexion();
        
        return $programas;
    }
    
    public function verificar_inscripcion_materia($user_id, $materia_id) {
        $this->abrir_conexion();
    
        $sql = "SELECT COUNT(*) AS count FROM inscripciones_materias WHERE user_id = ? AND materia_id = ?";
        $stmt = $this->conexion->prepare($sql);
    
        if (!$stmt) {
            die("Error en la preparación de la consulta: " . $this->conexion->error);
        }
    
        $stmt->bind_param("ii", $user_id, $materia_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
    
        $stmt->close();
        $this->cerrar_conexion();
    
        return $row['count'] > 0;
    }
    

    public function inscribir_usuario_en_materia($user_id, $materia_id) {
        $this->abrir_conexion();
    
        $sql = "INSERT INTO inscripciones_materias (user_id, materia_id) VALUES (?, ?)";
        $stmt = $this->conexion->prepare($sql);
    
        if (!$stmt) {
            echo "Error en la preparación: " . $this->conexion->error;
            return false;
        }
    
        $stmt->bind_param("ii", $user_id, $materia_id);
        $resultado = $stmt->execute();
    
        $stmt->close();
        $this->cerrar_conexion();
    
        return $resultado;
    }

    public function obtener_programas_por_materia_inscrita($user_id) {
        $this->abrir_conexion();
    
        $sql = "
            SELECT p.id, p.nombre, p.descripcion, m.nombre_materia
            FROM programas p
            INNER JOIN materias m ON p.FK_materia = m.id
            INNER JOIN inscripciones_materias im ON m.id = im.materia_id
            WHERE im.user_id = ?
        ";
        
        $stmt = $this->conexion->prepare($sql);
    
        if (!$stmt) {
            die("Error en la preparación de la consulta: " . $this->conexion->error);
        }
    
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $programas = $result->fetch_all(MYSQLI_ASSOC);
    
        $stmt->close();
        $this->cerrar_conexion();
    
        return $programas;
    }

}
?>