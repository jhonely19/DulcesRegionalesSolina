<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../model/Usuario.php';

class UsuarioController {
    private Usuario $uModel;

    public function __construct() {
        $this->uModel = new Usuario();
    }

    public function listar() {
        return $this->uModel->listar();
    }

    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre_usuario']);
            $correo = trim($_POST['correo']);
            $pass   = $_POST['contrasena'];
            $rol    = $_POST['rol'];
            $estado = $_POST['estado'];

            if (!empty($nombre) && !empty($correo) && !empty($pass)) {
                $ok = $this->uModel->insertar($nombre, $correo, $pass, $rol, $estado);
                header("Location: UsuarioController.php?msj=" . ($ok ? 'ok' : 'error'));
            } else {
                header("Location: UsuarioController.php?msj=vacio");
            }
            exit();
        }
    }

    public function eliminar() {
        $id = (int)($_GET['id'] ?? 0);
        if ($id > 0) {
            $ok = $this->uModel->eliminar($id);
            header("Location: UsuarioController.php?msj=" . ($ok ? 'delete' : 'error'));
        }
        exit();
    }
}

// Router del controlador
$controller = new UsuarioController();
$accion = $_GET['a'] ?? 'listar';

if ($accion === 'guardar') {
    $controller->guardar();
} elseif ($accion === 'eliminar') {
    $controller->eliminar();
} else {
    // Si no hay acción, listamos y cargamos la vista
    $datos = $controller->listar();

    // Vista correcta (la existente es views/usuario.php)
    require_once __DIR__ . '/../views/usuario.php';
}

