<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Tracker Dashboard</title>
    <!-- Bootstrap para estilos rápidos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="mb-4">Mis Vehículos y Documentos</h2>
        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Placa</th>
                            <th>Documento</th>
                            <th>Vencimiento</th>
                            <th>Días Restantes</th>
                            <th>Estado Legal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Bucle PHP para imprimir lo que calculó el Controlador -->
                        <?php foreach ($processed_docs as $doc): ?>
                        <tr>
                            <td><strong><?= htmlspecialchars($doc['plate']) ?></strong></td>
                            <td><?= htmlspecialchars($doc['document_name']) ?></td>
                            <td><?= htmlspecialchars($doc['expiration_date']) ?></td>
                            <td><?= $doc['dias_restantes'] ?> días</td>
                            <td>
                                <!-- El color cambia dinámicamente según la clase calculada (danger, warning, success) -->
                                <span class="badge bg-<?= $doc['clase_css'] ?>">
                                    <?= $doc['estado'] ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>