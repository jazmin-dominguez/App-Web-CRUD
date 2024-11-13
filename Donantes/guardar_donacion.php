<?php
include '../Conexion/contacto.php';

// Crear una instancia de la clase Contacto
$contacto = new Contacto();

// Datos a insertar (puedes capturarlos del formulario con $_POST)
$nombre_donacion = $_POST['nombre_donacion'];
$fecha_donacion = $_POST['fecha_donacion'];
$FK_tipo_Usuario = $_POST['FK_tipo_Usuario'];
$monto = $_POST['monto'];

// Llamar a la función para guardar la donación
$resultado = $contacto->guardar_donacion($nombre_donacion, $fecha_donacion, $FK_tipo_Usuario, $monto);


?>
