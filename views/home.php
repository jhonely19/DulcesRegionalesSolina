<?php
session_start();

if(!isset($_SESSION['usuario'])){
    header('Location: login.php');
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<body>

<h1>Bienvenido <?php echo $_SESSION['usuario']; ?></h1>

<ul>
    <li><a href="clientes.php">Clientes</a></li>
    <li><a href="productos.php">Productos</a></li>
    <li><a href="pedidos.php">Pedidos</a></li>
</ul>

</body>
</html>