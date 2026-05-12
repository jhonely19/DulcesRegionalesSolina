<?php
session_start();

// Usamos __DIR__ para asegurar que la ruta sea relativa al archivo actual
require_once __DIR__ . '/../model/Pedido.php';

class PedidoController {

    private Pedido $pModel;

    public function __construct() {
        $this->pModel = new Pedido();
    }

    public function listar(): array {
        return $this->pModel->listar();
    }

    public function cargarFormulario(): array {
        return [
            'clientes' => $this->pModel->getClientes(),
            'productos' => $this->pModel->getProductos(),
        ];
    }

    public function guardar(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: PedidoController.php');
            exit();
        }

        $id_cliente = (int)($_POST['id_cliente'] ?? 0);
        $id_producto = (int)($_POST['id_producto'] ?? 0);
        $cantidad = (int)($_POST['cantidad'] ?? 0);
        $estado_pedido = trim($_POST['estado_pedido'] ?? 'pendiente');
        $fecha_pedido = trim($_POST['fecha_pedido'] ?? date('Y-m-d'));

        if ($id_cliente <= 0 || $id_producto <= 0 || $cantidad <= 0 || $fecha_pedido === '') {
            header('Location: PedidoController.php?msj=error');
            exit();
        }

        $ok = $this->pModel->insertar($id_cliente, $id_producto, $fecha_pedido, $cantidad, $estado_pedido);
        header('Location: PedidoController.php?msj=' . ($ok ? 'ok' : 'error'));
        exit();
    }
}

// Lógica del Router
$controller = new PedidoController();
$accion = $_GET['a'] ?? 'listar';

if ($accion === 'guardar') {
    $controller->guardar();
    exit();
}

// CARGA DE DATOS ANTES DE LA VISTA
$datos = $controller->listar();
$formData = $controller->cargarFormulario();

// Esta línea es la que "dibuja" la página con los datos ya cargados
require_once __DIR__ . '/../views/pedidos.php';