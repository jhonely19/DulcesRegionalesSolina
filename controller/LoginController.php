<?php
session_start();
require_once '../model/Usuario.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    $modelo = new Usuario();
    $usuario = $modelo->login($correo,$contrasena);

    if($usuario){

        $_SESSION['usuario'] = $usuario['nombre_usuario'];

        // limpiar error si existía
        unset($_SESSION['error']);

        header('Location: ../views/home.php');
        exit;

    }else{

        $_SESSION['error'] = 'Correo o contraseña incorrectos';
        header('Location: ../views/login.php');
        exit;
    }
}
?>