<?php
session_start();
require_once dirname(__DIR__) . '/model/Producto.php';

$pModel = new Producto();

// Verificamos si la acción es GUARDAR
if (isset($_GET['a']) && $_GET['a'] == 'guardar') {
    
    // Capturamos los datos del formulario (POST)
    $nombre = $_POST['nombre_producto'];
    $cat    = $_POST['categoria'];
    $reg    = $_POST['region_origen'];
    $pre    = $_POST['precio'];
    $stock  = $_POST['stock'];
    $desc   = $_POST['descripcion'] ?? '';

    // Llamamos al modelo para registrar
    $resultado = $pModel->insertar($nombre, $cat, $reg, $pre, $stock, $desc);

    if ($resultado) {
        // Si todo sale bien, refrescamos la lista
        header('Location: ProductoController.php');
        exit();
    } else {
        echo "Hubo un error al registrar el producto regional.";
    }
} 
// Si solo entramos normalmente, mostramos la lista de productos
else {
    $datos = $pModel->listar();
    require_once dirname(__DIR__) . '/views/productos.php';
}