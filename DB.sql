CREATE TABLE Beneficiarios (
    matricula VARCHAR(7) NOT NULL,
    nombres   VARCHAR(255) NOT NULL,
    apellidopaterno  VARCHAR(255) NOT NULL,
    apellidomaterno VARCHAR(255) NOT NULL,
    correo VARCHAR(255) NOT NULL,
    edad DATE NOT NULL,
    contrasena VARCHAR(8) NOT NULL,
    confirmarcontrasena VARCHAR(8) NOT NULL,
    idactividad VARCHAR(5) NOT NULL,
    idcurso VARCHAR(5) NOT NULL,
    `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
);

CREATE TABLE Voluntarios (
    matricula VARCHAR(7) NOT NULL,
    nombres   VARCHAR(255) NOT NULL,
    apellidopaterno  VARCHAR(255) NOT NULL,
    apellidomaterno VARCHAR(255) NOT NULL,
    correo VARCHAR(255) NOT NULL,
    idcurso VARCHAR(5) NOT NULL,
    `fecha_nacimiento` date DEFAULT NULL,
    `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
);

CREATE TABLE Coordinador (
    nombres VARCHAR(255) NOT NULL,
    apellidopaterno   VARCHAR(255) NOT NULL,
    apellidomaterno  VARCHAR(255) NOT NULL,
    correo VARCHAR(255) NOT NULL,
    `fecha_nacimiento` date DEFAULT NULL,
    idprograma VARCHAR(5) NOT NULL,
    matriculavoluntario VARCHAR(7) NOT NULL,
    matriculabeneficiario VARCHAR(7) NOT NULL,
    idactividad VARCHAR(5) NOT NULL,
    `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
);


CREATE TABLE Donante (
    iddonante VARCHAR(255) NOT NULL,
    nombres   VARCHAR(255) NOT NULL,
    apellidopaterno  VARCHAR(255) NOT NULL,
    apellidomaterno VARCHAR(255) NOT NULL,
    idcurso VARCHAR(5) NOT NULL,
    `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
);

CREATE TABLE Curso (
    idcurso VARCHAR(5) NOT NULL,
    nombre   VARCHAR(255) NOT NULL,
    actividades  VARCHAR(255) NOT NULL,
    `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
);

CREATE TABLE Actividades (
    idactividades VARCHAR(5) NOT NULL,
    nombre   VARCHAR(255) NOT NULL,
    estado  VARCHAR(255) NOT NULL,
    cantidad  INT(2) NOT NULL,
    `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
);

CREATE TABLE Programa (
    idprograma VARCHAR(5) NOT NULL,
    nombre VARCHAR(255) NOT NULL,
    informacion VARCHAR(255) NOT NULL,
    `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
)