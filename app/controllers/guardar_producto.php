<?php

header('Content-Type: application/json');

require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../app/models/producto.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigoProducto = trim($_POST['codigo_producto'] ?? '');
    $nombreProducto = trim($_POST['nombre_producto'] ?? '');
    $bodegaId = $_POST['bodega'] ?? '';
    $sucursalId = $_POST['sucursal'] ?? '';
    $monedaId = $_POST['moneda'] ?? '';
    $precioUnitario = trim($_POST['precio_unitario'] ?? '');
    $descripcionProducto = trim($_POST['descripcion_producto'] ?? '');
    $materiales = $_POST['material'] ?? [];

    if (existeCodigoProducto($codigoProducto)) {
        echo json_encode(['success' => false, 'message' => 'El codigo del producto ya existe']);
        exit;
    }

    if (guardarProductoDB($codigoProducto, $nombreProducto, $bodegaId, $sucursalId, $monedaId, $precioUnitario, $descripcionProducto, $materiales)) {
        echo json_encode(['success' => true, 'message' => 'Producto guardado correctamente']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al guardar el producto']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Metodo no permitido']);
}