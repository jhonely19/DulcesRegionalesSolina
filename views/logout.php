<?php
session_start();
session_unset();
session_destroy();
// Volvemos al index de la raíz
header('Location: ../index.php');
exit();
?>