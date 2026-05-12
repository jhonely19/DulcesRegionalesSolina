<?php
class Database {
    // Cambiamos las variables a static para que el método estático pueda verlas
    private static string $host = 'localhost';
    private static string $db = 'dona_solina';
    private static string $user = 'root';
    private static string $pass = '';
    private static string $charset = 'utf8mb4';

    // Añadimos la palabra "static" al método
    public static function conectar(): PDO {
        try {
            // Usamos self::$ para acceder a variables estáticas
            $dsn = "mysql:host=" . self::$host . ";dbname=" . self::$db . ";charset=" . self::$charset;
            
            return new PDO($dsn, self::$user, self::$pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ]);
        } catch (PDOException $e) {
            // Mostrar error exacto para depuración
            $msg = 'Error de conexion a la base de datos: ' . $e->getMessage();
            if (php_sapi_name() !== 'cli') {
                header('Content-Type: text/plain; charset=utf-8');
                die($msg);
            }
            die($msg);
        }
    }
}
?>