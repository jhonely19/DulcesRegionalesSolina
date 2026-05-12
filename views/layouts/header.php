<header class="topbar">
    <div class="logo-area">
        <img src="../imagenes/logo1.png" class="logo" alt="Logo">
        <span class="brand">Dulces Regionales</span>
    </div>

  <nav class="top-menu">
    <a href="../views/home.php">Inicio</a>
    <a href="../controller/ClienteController.php?a=listar">Clientes</a>
    <a href="../controller/ProductoController.php">Productos</a>
    <a href="../controller/PedidoController.php">Pedidos</a>
</nav>

    <div class="user-area">
        <div class="search-box">
            <input type="text" placeholder="Buscar...">
            <button>🔍</button>
        </div>
        <span class="user-name">Hola, <strong><?php echo htmlspecialchars($_SESSION['usuario'] ?? 'Usuario'); ?></strong></span>
        <a href="../views/logout.php" class="btn-salir">Salir</a>
    </div>
</header>
