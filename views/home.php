<?php
session_start();

// SEGURIDAD: Ajustamos la ruta para que siempre encuentre el login fuera de 'views'
if (!isset($_SESSION['usuario'])) {
    header('Location: ../login.php'); 
    exit();
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

    <?php include 'layouts/header.php'; ?>

    <div class="layout">

        <?php include 'layouts/sidebar.php'; ?>

        <main class="content">
            <div class="main-body">
                <?php $q = trim($_GET['q'] ?? ''); ?>
                <h1><?= $q !== '' ? 'Resultados de búsqueda' : 'Bienvenidos' ?></h1>
                <p>
                    <?= $q !== '' ? ('Buscando: ' . htmlspecialchars($q)) : '“La dulzura de nuestra tradición está en cada producto hecho con amor y calidad.”' ?>
                </p>

                <?php if ($q !== ''): ?>
                    <div class="alert alert-info" style="max-width: 700px;">Por ahora la búsqueda se muestra en pantalla. Si quieres búsqueda real en productos/clientes, se implementa consultando la BD.</div>
                <?php endif; ?>

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