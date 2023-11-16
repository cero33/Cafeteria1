<?php
session_start();
session_destroy();
header('Location: index.html'); // Redirige a la página principal (index.html) después de cerrar la sesión
?>
