<?php
session_start();
// Ruta profesional usando el nivel del directorio
require_once dirname(__DIR__) . '/model/Usuario.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    $modelo = new Usuario();
    $usuario = $modelo->login($correo, $contrasena);

    if ($usuario) {
        $_SESSION['usuario'] = $usuario['nombre_usuario'];
        // Redirección limpia al Home
        header('Location: ../views/home.php');
        exit();
    } else {
        // Guardamos el mensaje en sesión para mostrarlo en el login
        $_SESSION['error'] = "Correo o contraseña incorrectos";
        header('Location: ../views/login.php');
        exit();
    }
}
?>