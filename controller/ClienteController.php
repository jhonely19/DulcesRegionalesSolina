<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once dirname(__DIR__) . '/config/Database.php';

class ClienteController {
    
    public function listar(): array {
        $pdo = Database::conectar();
        $stmt = $pdo->query("SELECT id_cliente, nombre, apellido, dni, telefono, direccion, correo FROM cliente ORDER BY id_cliente DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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

        $pdo = Database::conectar();
        $sql = "INSERT INTO cliente (nombre, apellido, dni, telefono, direccion, correo)
                VALUES (:nombre, :apellido, :dni, :telefono, :direccion, :correo)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nombre' => $nombre,
            ':apellido' => $apellido,
            ':dni' => $dni,
            ':telefono' => $telefono,
            ':direccion' => $direccion,
            ':correo' => $correo
        ]);

        // REDIRECCIÓN CRÍTICA: Esto evita que se dupliquen datos al recargar
        header("Location: ClienteController.php?a=listar&msj=ok");
        exit();
    }
}

// Lógica de ruteo
$controller = new ClienteController();
$accion = $_GET['a'] ?? 'listar';

if ($accion === 'guardar') {
    $controller->guardar();
} else {
    // Si la acción es listar o cualquier otra, cargamos los datos y la vista
    $datos = $controller->listar();
    require_once dirname(__DIR__) . '/views/clientes.php';
}