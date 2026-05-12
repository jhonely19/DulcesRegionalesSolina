<?php
require_once dirname(__DIR__) . '/config/Database.php';

class Pedido {
    private PDO $conexion;

    public function __construct() {
        $this->conexion = Database::conectar();
    }

    public function listar(): array {
        // Asegúrate de que las tablas se llamen 'pedido', 'cliente' y 'producto_regional'
        $sql = "SELECT 
                    p.id_pedido,
                    p.id_cliente,
                    c.nombre AS cliente_nombre,
                    c.apellido AS cliente_apellido,
                    p.id_producto,
                    pr.nombre_producto AS producto_nombre,
                    p.fecha_pedido,
                    p.cantidad,
                    p.total,
                    p.estado_pedido
                FROM pedido p
                INNER JOIN cliente c ON c.id_cliente = p.id_cliente
                INNER JOIN producto_regional pr ON pr.id_producto = p.id_producto
                ORDER BY p.id_pedido DESC";

        try {
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Si hay error de tabla no encontrada, lo verás aquí
            error_log("Error en listar: " . $e->getMessage());
            return [];
        }
    }

    public function insertar(int $id_cliente, int $id_producto, string $fecha_pedido, int $cantidad, string $estado_pedido = 'pendiente'): bool {
        try {
            // 1. Obtener el precio para calcular el total automáticamente
            $sqlProducto = "SELECT precio FROM producto_regional WHERE id_producto = :id_producto";
            $stmtProducto = $this->conexion->prepare($sqlProducto);
            $stmtProducto->execute([':id_producto' => $id_producto]);
            $row = $stmtProducto->fetch(PDO::FETCH_ASSOC);

            if (!$row) return false;

            $precio = (float)$row['precio'];
            $total = $precio * $cantidad;

            // 2. Insertar el registro
            $sql = "INSERT INTO pedido (id_cliente, id_producto, fecha_pedido, cantidad, total, estado_pedido)
                    VALUES (:id_cliente, :id_producto, :fecha_pedido, :cantidad, :total, :estado_pedido)";

            $stmt = $this->conexion->prepare($sql);
            return $stmt->execute([
                ':id_cliente'   => $id_cliente,
                ':id_producto'  => $id_producto,
                ':fecha_pedido' => $fecha_pedido,
                ':cantidad'     => $cantidad,
                ':total'        => $total,
                ':estado_pedido'=> $estado_pedido,
            ]);
        } catch (PDOException $e) {
            error_log("Error en insertar: " . $e->getMessage());
            return false;
        }
    }

    public function getClientes(): array {
        $sql = "SELECT id_cliente, nombre, apellido FROM cliente ORDER BY nombre ASC";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductos(): array {
        $sql = "SELECT id_producto, nombre_producto, precio, stock FROM producto_regional WHERE stock > 0 ORDER BY nombre_producto ASC";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}