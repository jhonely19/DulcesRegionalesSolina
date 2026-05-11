<?php
session_start();
$mensaje = '';
if (isset($_SESSION['error'])) {
    $mensaje = $_SESSION['error'];
    unset($_SESSION['error']); 
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="JL tech">
    <meta name="robots" content="index,follow">
    <meta name="description" content="dulces regionales">
    <meta name="keywords" content="dulces, regionales">

    <link rel="icon" href="../imagenes/logotipo.png">
    <link rel="stylesheet" href="../assetes/css/login.css">
    <title>Login - Doña Solina</title>

    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- ICONOS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>

<div class="contenedor">

    <!-- PANEL IZQUIERDO -->
    <div class="izquierda">
        <div class="contenido">
            <h1>Doña Solina</h1>
            <h2>DULCES REGIONALES</h2>
            <p>
                Tradición que endulza,<br>
                calidad que encanta.
            </p>

            <div class="info">
                <div>
                    <i class="fa-solid fa-heart"></i>
                    <span>Hecho con amor</span>
                </div>
                <div>
                    <i class="fa-solid fa-award"></i>
                    <span>Calidad garantizada</span>
                </div>
                <div>
                    <i class="fa-solid fa-leaf"></i>
                    <span>Productos regionales</span>
                </div>
            </div>
        </div>

    </div>
    <!-- PANEL DERECHO -->
    <div class="derecha">

        <form action="../controller/LoginController.php" method="POST">

            <h2>¡Bienvenida!</h2>
            <p>Inicia sesión para continuar</p>
            <?php if($mensaje != ''): ?>
    <div style="color:red; font-weight:bold; margin-bottom:10px;">
        <?php echo $mensaje; ?>
    </div>
<?php endif; ?>
            <div class="input-group">
                <i class="fa-solid fa-envelope"></i>

                <input 
                    type="email" 
                    name="correo" 
                    placeholder="Correo electrónico"
                    required
                >
            </div>

            <div class="input-group">

                <i class="fa-solid fa-lock"></i>
                <input 
                    type="password" 
                    name="contrasena" 
                    placeholder="Contraseña"
                    required
                >
            </div>
            <div class="extras">
                <label>
                    <input type="checkbox">
                    Recordarme
                </label>
                <a href="#">¿Olvidaste tu contraseña?</a>
            </div>
            <button type="submit">

                <i class="fa-solid fa-right-to-bracket"></i>

                Iniciar Sesión

            </button>

            <div class="footer">
                © 2026 Doña Solina- Todos los derechos reservados.
            </div>

        </form>
    </div>
</div>

</body>
</html>