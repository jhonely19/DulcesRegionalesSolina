<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once dirname(__DIR__) . '/config/Database.php';
require_once dirname(__DIR__) . '/model/Cliente.php';

class ClienteController {
    private Cliente $cModel;

    public function __construct() {
        $this->cModel = new Cliente();
    }

    public function listar(): array {
        return $this->cModel->listar();
    }

    public function guardar(): void {
        if (empty($_POST)) {
            header("Location: ClienteController.php?a=listar&msj=error");
            exit();
        }

        $nombre = trim($_POST['nombre'] ?? '');
        $apellido = trim($_POST['apellido'] ?? '');
        $dni = trim($_POST['dni'] ?? '');
        $telefono = trim($_POST['telefono'] ?? '');
        $direccion = trim($_POST['direccion'] ?? '');
        $correo = trim($_POST['correo'] ?? '');

        if ($nombre === '' || $apellido === '' || $dni === '') {
            header("Location: ClienteController.php?a=listar&msj=vacio");
            exit();
        }

        $ok = $this->cModel->insertar(
            $nombre,
            $apellido,
            $dni,
            $telefono !== '' ? $telefono : null,
            $direccion !== '' ? $direccion : null,
            $correo !== '' ? $correo : null
        );

        header("Location: ClienteController.php?a=listar&msj=" . ($ok ? 'ok' : 'error'));
        exit();
    }

    public function editar(): void {
        if (empty($_GET['id'])) {
            header('Location: ClienteController.php?a=listar&msj=error');
            exit();
        }

        $id = (int)$_GET['id'];
        $cliente = $this->cModel->obtenerPorId($id);

        if (!$cliente) {
            header('Location: ClienteController.php?a=listar&msj=error');
            exit();
        }

        // Datos para tabla + formulario
        $datos = $this->listar();
        require_once dirname(__DIR__) . '/views/clientes.php';
    }

    public function actualizar(): void {

        if (empty($_POST['id_cliente'])) {
            header('Location: ClienteController.php?a=listar&msj=error');
            exit();
        }

        $id_cliente = (int)$_POST['id_cliente'];
        $nombre = trim($_POST['nombre'] ?? '');
        $apellido = trim($_POST['apellido'] ?? '');
        $dni = trim($_POST['dni'] ?? '');
        $telefono = trim($_POST['telefono'] ?? '');
        $direccion = trim($_POST['direccion'] ?? '');
        $correo = trim($_POST['correo'] ?? '');

        if ($nombre === '' || $apellido === '' || $dni === '') {
            header('Location: ClienteController.php?a=editar&id=' . $id_cliente . '&msj=vacio');
            exit();
        }

        $ok = $this->cModel->actualizar(
            $id_cliente,
            $nombre,
            $apellido,
            $dni,
            $telefono !== '' ? $telefono : null,
            $direccion !== '' ? $direccion : null,
            $correo !== '' ? $correo : null
        );

        header('Location: ClienteController.php?a=listar&msj=' . ($ok ? 'ok' : 'error'));
        exit();
    }


}


// Lógica de ruteo
$controller = new ClienteController();
$accion = $_GET['a'] ?? 'listar';

if ($accion === 'guardar') {
    $controller->guardar();
} elseif ($accion === 'editar') {
    $controller->editar();
} elseif ($accion === 'actualizar') {
    $controller->actualizar();
} elseif ($accion === 'eliminar') {
    // para no romper el flujo, eliminamos y volvemos a listar
    if (empty($_GET['id'])) {
        header('Location: ClienteController.php?a=listar&msj=error');
        exit();
    }
    $id = (int)$_GET['id'];
    if ($id <= 0) {
        header('Location: ClienteController.php?a=listar&msj=error');
        exit();
    }
    // llamamos al modelo que ya está dentro del controller
    $ok = (new Cliente())->eliminar($id);
    header('Location: ClienteController.php?a=listar&msj=' . ($ok ? 'delete' : 'error'));
    exit();
} else {
    $datos = $controller->listar();
    require_once dirname(__DIR__) . '/views/clientes.php';
}
