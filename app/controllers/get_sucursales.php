<?php
header('Content-Type: application/json');

require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../models/sucursales.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['bodega_id'])) {
    $bodega_id = intval($_GET['bodega_id']);

    if ($bodega_id > 0) {
        $sucursales = getSucursalesByBodega($bodega_id);
        echo json_encode(['success' => true, 'sucursales' => $sucursales]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Bodega inválida.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
}
?>