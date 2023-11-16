<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Médico</title>
    <style>
        body {
            font-family: 'Garamond', sans-serif;
            background-color: #D9D9D9;
            text-align: center;
        }
        .container {
            max-width: 600px;
            margin: 100px auto;
            padding: 20px;
            background-color: #fff;
            
            box-shadow: 0 2px 5px #ccc;
        }
        h2 {
            color: #333;
        }
        input[type="text"], input[type="date"], select, textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
           
            font-family: 'Garamond', sans-serif;
        }
        button {
            width: 60%;
            padding: 15px;
            background-color: #383838;
            color: #fff;
            border: none;
            margin-bottom: 10px; /* Espacio entre los botones */
            cursor: pointer;
            font-family: 'Garamond', sans-serif;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Citatorio</h2>
        <button id="openPacienteFormButton">Registrar Paciente</button>
        <br>
        <button id="openMedicoFormButton">Registrar Médico</button>
        <br>
        <button id="openCitaFormButton">Programar Cita</button>

        <div class="container" id="pacienteForm" style="display: none;">
            <h2>Registro de Paciente</h2>
            <form id="registroPacienteForm" action="registro_paciente.php" method="POST">
                <input type="text" placeholder="Nombre del paciente" name="nombrePaciente" required>
                <input type="date" placeholder="Fecha de nacimiento" name="fechaNacimiento" required>
                <input type="text" placeholder="Dirección" name="direccion" required>
                <input type="text" placeholder="Teléfono" name="telefono" required>
                <input type="text" placeholder="Email" name="email" required>
                
                <button type="submit">Registrar Paciente</button>
            </form>
        </div>

        <div class="container" id="medicoForm" style="display: none;">
            <h2>Registro de Médico</h2>
            <form id="registroMedicoForm" action="registro_medico.php" method="POST">
                <input type="text" placeholder="Nombre del médico" name="nombreMedico" required>
                <input type="text" placeholder="Especialidad" name="especialidad" required>
                <input type="text" placeholder="Teléfono" name="telefonoMedico" required>
                <input type="text" placeholder="Email" name="emailMedico" required>
                <button type="submit">Registrar Médico</button>
            </form>
        </div>

        <div class="container" id="citaForm" style="display: none;">
            <h2>Programar Cita</h2>
            <form id="programarCitaForm" action="programar_cita.php" method="POST">
                <select name="pacienteId" id="pacienteId">
                    <option value="">Seleccionar paciente</option>
                    <?php
                        // Código PHP para cargar dinámicamente la lista de pacientes desde la base de datos
                        $host = "localhost";
                        $usuario = "user";
                        $contrasena = "";
                        $base_de_datos = "medico1";

                        $conexion = new mysqli($host, $usuario, $contrasena, $base_de_datos);

                        if ($conexion->connect_error) {
                            die("Error de conexión: " . $conexion->connect_error);
                        }

                        $query = "SELECT id, nombre FROM Pacientes";
                        $resultado = $conexion->query($query);

                        while ($fila = $resultado->fetch_assoc()) {
                            echo '<option value="' . $fila["id"] . '">' . $fila["nombre"] . '</option>';
                        }

                        $conexion->close();
                    ?>
                </select>
                <select name="medicoId" id="medicoId">
                    <option value="">Seleccionar médico</option>
                    <?php
                        // Código PHP para cargar dinámicamente la lista de médicos desde la base de datos
                        $host = "localhost";
                        $usuario = "user";
                        $contrasena = "";
                        $base_de_datos = "medico1";

                        $conexion = new mysqli($host, $usuario, $contrasena, $base_de_datos);

                        if ($conexion->connect_error) {
                            die("Error de conexión: " . $conexion->connect_error);
                        }

                        $query = "SELECT id, nombre FROM Medicos";
                        $resultado = $conexion->query($query);

                        while ($fila = $resultado->fetch_assoc()) {
                            echo '<option value="' . $fila["id"] . '">' . $fila["nombre"] . '</option>';
                        }

                        $conexion->close();
                    ?>
                </select>
                <select name="salaId" id="salaId">
                    <option value="">Seleccionar sala</option>
                    <?php
                        // Código PHP para cargar dinámicamente la lista de salas desde la base de datos
                        $host = "localhost";
                        $usuario = "user";
                        $contrasena = "";
                        $base_de_datos = "medico1";

                        $conexion = new mysqli($host, $usuario, $contrasena, $base_de_datos);

                        if ($conexion->connect_error) {
                            die("Error de conexión: " . $conexion->connect_error);
                        }

                        $query = "SELECT id, nombre FROM Salas";
                        $resultado = $conexion->query($query);

                        while ($fila = $resultado->fetch_assoc()) {
                            echo '<option value="' . $fila["id"] . '">' . $fila["nombre"] . '</option>';
                        }

                        $conexion->close();
                    ?>
                </select>
                <input type="datetime-local" name="fechaHora" required>
                <textarea placeholder="Observaciones" name="observaciones"></textarea>
                <button type="submit">Programar Cita</button>
            </form>
        </div>
    </div>

</body>
</html>
