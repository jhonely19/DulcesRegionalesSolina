<?php
require_once dirname(__DIR__) . '/config/Database.php';

class Usuario {
    private $conexion;

    public function __construct() {
        $this->conexion = Database::conectar();
    }

    // LISTAR: Para ver todos los usuarios en tu tabla
    public function listar(): array {
        $sql = "SELECT id_usuario, nombre_usuario, correo, rol, estado FROM usuario ORDER BY id_usuario DESC";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // INSERTAR: Con encriptación de contraseña (BCRYPT)
    public function insertar($nombre, $correo, $pass, $rol, $estado): bool {
        // Encriptamos la clave: '123' se convierte en algo como '$2y$10$abc...'
        $passHash = password_hash($pass, PASSWORD_BCRYPT);
        
        $sql = "INSERT INTO usuario (nombre_usuario, correo, contrasena, rol, estado) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([$nombre, $correo, $passHash, $rol, $estado]);
    }

    // LOGIN: Ahora de forma segura usando password_verify
    public function login($correo, $contrasena) {
        $sql = "SELECT * FROM usuario WHERE correo = ? AND estado = 'activo'";
        $query = $this->conexion->prepare($sql);
        $query->execute([$correo]);
        $user = $query->fetch(PDO::FETCH_ASSOC);

        // Verificamos si existe el usuario y si la contraseña coincide con el hash
        if ($user && password_verify($contrasena, $user['contrasena'])) {
            return $user; // Login exitoso
        }
        return false; // Credenciales inválidas
    }

    // ELIMINAR: Para la gestión administrativa
    public function eliminar($id): bool {
        $sql = "DELETE FROM usuario WHERE id_usuario = ?";
        return $this->conexion->prepare($sql)->execute([$id]);
    }
}