<?php
class Database {
    // Estas variables las llenarás con los datos que te dé tu proveedor de nube (Aiven, Clever Cloud, etc.)
    private $host = "vehiculos-db-vittal-auto.k.aivencloud.com";
    private $db_name = "defaultdb";
    private $username = "avnadmin";
    private $password = getenv('DB_PASSWORD');
    private $port = "24301"; 
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            // Se usa PDO por seguridad y requerimiento técnico. Aquí se arma la cadena de conexión.
            $dsn = "mysql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->db_name . ";charset=utf8mb4";
            $this->conn = new PDO($dsn, $this->username, $this->password);
            
            // Configurar PDO para que lance excepciones si hay errores en SQL
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Error de conexión a la nube: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>