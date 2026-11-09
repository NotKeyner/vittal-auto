<?php
class DocumentModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Función para obtener los documentos de un usuario específico
    public function getDocumentsByUser($user_id) {
        // Consulta SQL con INNER JOIN para traer placas, tipo de documento y fechas
        $query = "SELECT v.plate, dt.name AS document_name, vd.expiration_date, dt.alert_days_before 
                  FROM vehicle_document vd
                  INNER JOIN vehicle v ON vd.vehicle_id = v.vehicle_id
                  INNER JOIN document_type dt ON vd.document_type_id = dt.document_type_id
                  WHERE v.user_id = :user_id 
                  ORDER BY vd.expiration_date ASC";

        // Preparar la consulta (Evita inyección SQL, punto a favor en la sustentación)
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>