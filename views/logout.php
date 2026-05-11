<?php
session_start();
session_unset();
session_destroy();

// Redirigir al login que está en la misma carpeta
header("Location: login.php");
exit;
?>