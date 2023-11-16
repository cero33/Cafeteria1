<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro y Login</title>
    <style>
        body {
            font-family:Serif, sans-serif;
            background-color:  #D9D9D9;
            text-align: center;
        }
        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #383838;
            box-shadow: 0 2px 5px #ccc;
            font-family: 'Garamond', sans-serif;
        }
        h2 {
            color: white;
            font-family: 'Garamond', sans-serif;
        }
        input[type="text"], input[type="password"] {
            width: 80%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
             font-family: 'Garamond', sans-serif;
        }
        button {
            width: 90%;
            padding: 10px;
            background-color:  #BFBFBF;
            color: #fff;
            border: none;
            cursor: pointer;
            font-family: 'Garamond', sans-serif;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Registro</h2>
        <form id="registroForm" method="post">
            <input type="text" placeholder="Nombre de usuario" name="nombre_usuario" required>
            <input type="password" placeholder="Contraseña" name= "contrasena" required>
            <button type="submit" name="registrar">Registrarse</button>
        </form>
        <h2>Iniciar Sesión</h2>
        <form id="loginForm" method="post">
            <input type="text" placeholder="Nombre de usuario" name="nombre_usuario" required>
            <input type="password" placeholder="Contraseña" name="contrasena" required>
            <button type="submit" name="iniciarSesion">Iniciar Sesión</button>
        </form>
    </div>

    <?php
    // Configura la conexión a la base de datos (reemplaza con tus propios datos)
    $host = "localhost";
    $usuario = "root";
    $contrasena = "";
    $base_de_datos = "medico1";

    $conexion = new mysqli($host, $usuario, $contrasena, $base_de_datos);

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Procesa el registro de usuario
    if (isset($_POST["registrar"])) {
        $nombreUsuario = $_POST["nombre_usuario"];
        $contrasena = $_POST["contrasena"];

        // Hash la contraseña antes de almacenarla en la base de datos
        $hashedContrasena = password_hash($contrasena, PASSWORD_DEFAULT);

        // Rol predeterminado: "paciente"
        $rol = "paciente";

        // Realiza la inserción en la tabla de usuarios con el rol predeterminado
        $insertSQL = "INSERT INTO Usuarios (nombre_usuario, contrasena, rol) VALUES ('$nombreUsuario', '$hashedContrasena', '$rol')";
        if ($conexion->query($insertSQL) === TRUE) {
            echo "Registro exitoso.";
            header('Location: preparado.php');  // Redirige al usuario a preparado.php
            exit;  // Termina el script para evitar que se ejecute el código HTML restante
        } else {
            echo "Error en el registro: " . $conexion->error;
        }
    }

    // Procesa el inicio de sesión de usuario
    if (isset($_POST["iniciarSesion"])) {
        $nombreUsuario = $_POST["nombre_usuario"];
        $contrasena = $_POST["contrasena"];

        // Busca el usuario en la base de datos
        $selectSQL = "SELECT id, contrasena FROM Usuarios WHERE nombre_usuario = '$nombreUsuario'";
        $resultado = $conexion->query($selectSQL);

        if ($resultado->num_rows === 1) {
            $fila = $resultado->fetch_assoc();
            $contrasenaAlmacenada = $fila["contrasena"];
            // Verifica si la contraseña coincide
            if (password_verify($contrasena, $contrasenaAlmacenada)) {
                echo "Inicio de sesión exitoso.";
                header('Location: preparado.php');  // Redirige al usuario a preparado.php
                exit;  // Termina el script para evitar que se ejecute el código HTML restante
            } else {
                echo "Contraseña incorrecta.";
            }
        } else {
            echo "Usuario no encontrado.";
        }
    }

    $conexion->close();
    ?>
</body>
</html>
