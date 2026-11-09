<?php
require_once 'models/DocumentModel.php';

class DashboardController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function showDashboard($user_id) {
        $model = new DocumentModel($this->db);
        $documents = $model->getDocumentsByUser($user_id);
        
        $processed_docs = [];
        $hoy = new DateTime(); // Fecha actual del servidor web

        foreach ($documents as $doc) {
            $fecha_vencimiento = new DateTime($doc['expiration_date']);
            
            // Restar la fecha de vencimiento con la fecha de hoy
            $intervalo = $hoy->diff($fecha_vencimiento);
            
            // Obtener los días de diferencia. Si es negativo (ya pasó), lo marcamos.
            $dias_restantes = (int)$intervalo->format('%r%a');
            
            // LÓGICA DE ALERTAS (Replicando lo que hizo Claude en SQL)
            $estado = "VIGENTE";
            $clase_css = "success"; // Verde

            if ($dias_restantes < 0) {
                $estado = "VENCIDO";
                $clase_css = "danger"; // Rojo
            } elseif ($dias_restantes <= 5) {
                $estado = "CRÍTICO";
                $clase_css = "danger"; // Rojo
            } elseif ($dias_restantes <= $doc['alert_days_before']) {
                $estado = "ALERTA";
                $clase_css = "warning"; // Amarillo
            }

            // Guardamos todo en un nuevo arreglo para enviarlo a la vista
            $doc['dias_restantes'] = $dias_restantes;
            $doc['estado'] = $estado;
            $doc['clase_css'] = $clase_css;
            
            $processed_docs[] = $doc;
        }

        // Llamamos a la vista (View) y le pasamos los datos ya calculados
        require_once 'views/dashboard.php';
    }
}
?>