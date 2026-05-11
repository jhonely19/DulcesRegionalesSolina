<?php
session_start();

if(!isset($_SESSION['usuario'])){
    header('Location: login.php');
    exit;
}

$usuario = $_SESSION['usuario'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Dulces Regionales</title>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="icon" href="../imagenes/logotipo.png">
    <link rel="stylesheet" href="../assetes/css/style_home.css">
</head>

<body>

<header class="topbar">
    <div class="logo-area">
        <img src="../imagenes/logo1.png" class="logo" alt="Logo">
        <span class="brand">Dulces Regionales</span>
    </div>

    <nav class="top-menu">
        <a href="home.php">Inicio</a>
        <a href="clientes.php">Clientes</a>
        <a href="productos.php">Productos</a>
        <a href="pedidos.php">Pedidos</a>
    </nav>

    <div class="user-area">
        <div class="search-box">
            <input type="text" placeholder="Buscar...">
            <button>🔍</button>
        </div>
        <span class="user-name">Hola, <strong><?php echo htmlspecialchars($usuario); ?></strong></span>
        <a href="logout.php" class="btn-salir">Salir</a>
    </div>
</header>

<div class="layout">

    <aside class="sidebar">
        <a href="home.php">🏠 Inicio</a>
        <a href="clientes.php">👥 Clientes</a>
        <a href="productos.php">📦 Productos</a>
        <a href="pedidos.php">🧾 Pedidos</a>
    </aside>

    <main class="content">
        <div class="main-body">
            <h1>Bienvenidos</h1>
            <p>“La dulzura de nuestra tradición está en cada producto hecho con amor y calidad.”</p>
            <img src="../imagenes/img.png" class="main-img" alt="Dulces Regionales">
        </div>

        <footer class="footer">
            <h3>Síguenos en nuestras redes sociales</h3>
            <div class="social">
                <a href="#" class="social-link"><img src="../imagenes/facebook.png" alt="Facebook"></a>
                <a href="#" class="social-link"><img src="../imagenes/instagram.png" alt="Instagram"></a>
                <a href="#" class="social-link"><img src="../imagenes/tik-tok.png" alt="TikTok"></a>
                <a href="#" class="social-link"><img src="../imagenes/whatsapp.png" alt="WhatsApp"></a>
            </div>
            <p class="copy">
                © 2026 Dulceria Solina | Todos los derechos reservados 💖
            </p>
        </footer>
    </main>

</div>

</body>
</html>