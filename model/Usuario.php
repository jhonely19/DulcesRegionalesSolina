<?php
require_once dirname(__DIR__) . '/config/Database.php';

class Usuario {
    private $conexion;

    public function __construct() {
        $db = new Database();
        $this->conexion = $db->conectar();
    }

    public function login($correo, $contrasena) {
        $sql = "SELECT * FROM usuario WHERE correo = ? AND contrasena = ?";
        $query = $this->conexion->prepare($sql);
        $query->execute([$correo, $contrasena]);

        return $query->fetch(PDO::FETCH_ASSOC);
    }
}
?>