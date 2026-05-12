<aside class="sidebar">
    <a href="../views/home.php">
        <img src="../imagenes/inicio.png" class="side-icon" alt="Inicio"> Inicio
    </a>
    
    <!-- Se recomienda mantener un estándar: si usas ?a=listar en uno, úsalo en todos o en ninguno -->
    <a href="../controller/ClienteController.php?a=listar">
        <img src="../imagenes/clientes.png" class="side-icon" alt="Clientes"> Clientes
    </a>
    
    <a href="../controller/ProductoController.php">
        <img src="../imagenes/producto.png" class="side-icon" alt="Productos"> Productos
    </a>
    
    <!-- Corregido: Eliminada la etiqueta </a> extra que estaba en medio del texto -->
    <a href="../controller/PedidoController.php">
        <img src="../imagenes/pedido.png" class="side-icon" alt="Pedidos"> Pedidos
    </a>
</aside>