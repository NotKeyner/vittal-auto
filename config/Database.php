<?php
class Database {
    // Credenciales de Aiven en la nube
    private $host = "vehiculos-db-vittal-auto.k.aivencloud.com";
    private $db_name = "defaultdb";
    private $username = "avnadmin";
    private $password; // Se declara vacía, sin la función aquí
    private $port = "24301"; 
    public $conn;

    public function getConnection() {
        $this->conn = null;
        
        // La función getenv() se ejecuta aquí adentro
        $this->password = getenv('DB_PASSWORD');
        
        try {
            $dsn = "mysql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->db_name . ";charset=utf8mb4";
            
            // Opciones de conexión exigidas por Aiven (SSL Requerido)
            $options = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false
            );

            $this->conn = new PDO($dsn, $this->username, $this->password, $options);
            
        } catch(PDOException $exception) {
            echo "Error de conexión a la nube: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>