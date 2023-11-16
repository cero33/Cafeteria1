<?php
// Conexión a la base de datos (debes completar con tus propias credenciales)
$host = "localhost";
$usuario = "root";
$contrasena = "";
$base_de_datos = "medico1";

$conexion = new mysqli($host, $usuario, $contrasena, $base_de_datos);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Procesar registro de paciente
if (isset($_POST["nombrePaciente"])) {
    $nombre = limpiar_dato($_POST["nombrePaciente"]);
    $fechaNacimiento = limpiar_dato($_POST["fechaNacimiento"]);
    $direccion = limpiar_dato($_POST["direccion"]);
    $telefono = limpiar_dato($_POST["telefono"]);
    $email = limpiar_dato($_POST["email"]);

    $query = "INSERT INTO Pacientes (nombre, fecha_nacimiento, direccion, telefono, email) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("sssss", $nombre, $fechaNacimiento, $direccion, $telefono, $email);
    if ($stmt->execute()) {
        echo "Registro de paciente exitoso.";
    } else {
        echo "Error al registrar al paciente: " . $stmt->error;
    }
    $stmt->close();
}

// Procesar registro de médico
if (isset($_POST["nombreMedico"])) {
    $nombre = limpiar_dato($_POST["nombreMedico"]);
    $especialidad = limpiar_dato($_POST["especialidad"]);
    $telefono = limpiar_dato($_POST["telefonoMedico"]);
    $email = limpiar_dato($_POST["emailMedico"]);

    $query = "INSERT INTO Medicos (nombre, especialidad, telefono, email) VALUES (?, ?, ?, ?)";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("ssss", $nombre, $especialidad, $telefono, $email);
    if ($stmt->execute()) {
        echo "Registro de médico exitoso.";
    } else {
        echo "Error al registrar al médico: " . $stmt->error;
    }
    $stmt->close();
}

// Procesar programación de cita
if (isset($_POST["pacienteId"])) {
    $pacienteId = limpiar_dato($_POST["pacienteId"]);
    $medicoId = limpiar_dato($_POST["medicoId"]);
    $salaId = limpiar_dato($_POST["salaId"]);
    $fechaHora = limpiar_dato($_POST["fechaHora"]);
    $observaciones = limpiar_dato($_POST["observaciones"]);

    $query = "INSERT INTO Citas (paciente_id, medico_id, sala_id, fecha_hora, observaciones) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("iiiss", $pacienteId, $medicoId, $salaId, $fechaHora, $observaciones);
    if ($stmt->execute()) {
        echo "Cita programada exitosamente.";
    } else {
        echo "Error al programar la cita: " . $stmt->error;
    }
    $stmt->close();
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
