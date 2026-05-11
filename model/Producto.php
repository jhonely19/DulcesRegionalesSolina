<?php
// Usamos la ruta absoluta para conectar con la base de datos
require_once dirname(__DIR__) . '/config/Database.php';

class Producto {
    private $conexion;

    public function __construct() {
        $db = new Database();
        $this->conexion = $db->conectar();
    }

    // Función para registrar un nuevo dulce regional
    public function insertar($nombre, $cat, $region, $precio, $stock, $desc) {
        try {
            $sql = "INSERT INTO producto_regional (nombre_producto, categoria, region_origen, precio, stock, descripcion) 
                    VALUES (?, ?, ?, ?, ?, ?)";
            $query = $this->conexion->prepare($sql);
            return $query->execute([$nombre, $cat, $region, $precio, $stock, $desc]);
        } catch (PDOException $e) {
            error_log("Error en inserción: " . $e->getMessage());
            return false;
        }
    }

    // Función para listar y ver que se registraron correctamente
    public function listar() {
        $sql = "SELECT * FROM producto_regional ORDER BY id_producto DESC";
        $query = $this->conexion->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}