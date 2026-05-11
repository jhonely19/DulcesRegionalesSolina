<?php
session_start();

// borrar todas las variables de sesión
session_unset();

// destruir la sesión
session_destroy();

// redirigir al login
header('Location: ../views/login.php');
exit;
?>