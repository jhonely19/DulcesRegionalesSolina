<?php
require_once dirname(__DIR__) . '/config/Database.php';

class Cliente {
    private PDO $conexion;

    public function __construct() {
        $this->conexion = Database::conectar();
    }

    public function listar(): array {
        $sql = "SELECT id_cliente, nombre, apellido, dni, telefono, direccion, correo
                FROM cliente
                ORDER BY id_cliente DESC";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertar(string $nombre, string $apellido, string $dni, ?string $telefono, ?string $direccion, ?string $correo): bool {
        $sql = "INSERT INTO cliente (nombre, apellido, dni, telefono, direccion, correo)
                VALUES (:nombre, :apellido, :dni, :telefono, :direccion, :correo)";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([
            ':nombre' => $nombre,
            ':apellido' => $apellido,
            ':dni' => $dni,
            ':telefono' => $telefono,
            ':direccion' => $direccion,
            ':correo' => $correo,
        ]);
    }

    public function obtenerPorId(int $id_cliente): ?array {
        $sql = "SELECT id_cliente, nombre, apellido, dni, telefono, direccion, correo
                FROM cliente
                WHERE id_cliente = :id_cliente";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':id_cliente' => $id_cliente]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    public function actualizar(int $id_cliente, string $nombre, string $apellido, string $dni, ?string $telefono, ?string $direccion, ?string $correo): bool {
        $sql = "UPDATE cliente
                SET nombre = :nombre,
                    apellido = :apellido,
                    dni = :dni,
                    telefono = :telefono,
                    direccion = :direccion,
                    correo = :correo
                WHERE id_cliente = :id_cliente";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([
            ':id_cliente' => $id_cliente,
            ':nombre' => $nombre,
            ':apellido' => $apellido,
            ':dni' => $dni,
            ':telefono' => $telefono,
            ':direccion' => $direccion,
            ':correo' => $correo,
        ]);
    }

    public function eliminar(int $id_cliente): bool {
        $sql = "DELETE FROM cliente WHERE id_cliente = :id_cliente";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([':id_cliente' => $id_cliente]);
    }
}

