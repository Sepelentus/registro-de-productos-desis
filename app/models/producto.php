<?php

function existeCodigoProducto($codigoProducto)
{
    global $pdo;
    $sql = "SELECT * FROM productos WHERE codigo_producto = :codigo_producto LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['codigo_producto' => $codigoProducto]);
    return $stmt->fetch() !== false;
}

function guardarProductoDB($codigoProducto, $nombreProducto, $bodegaId, $sucursalId, $monedaId, $precioUnitario, $descripcionProducto, $materiales)
{
    global $pdo;
    $pdo->beginTransaction();
    try {
        $sql = "INSERT INTO productos (codigo_producto, nombre_producto, descripcion_producto, bodega_id, sucursal_id, moneda_id, precio_unitario) 
                        VALUES (:codigo, :nombre, :descripcion, :bodega, :sucursal, :moneda, :precio) RETURNING id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'codigo' => $codigoProducto,
            'nombre' => $nombreProducto,
            'descripcion' => $descripcionProducto,
            'bodega' => $bodegaId,
            'sucursal' => $sucursalId,
            'moneda' => $monedaId,
            'precio' => $precioUnitario
        ]);

        $productoId = $stmt->fetchColumn();

        $sqlMat = "INSERT INTO productos_materiales (producto_id, material_id) VALUES (:producto_id, :material_id)";
        $stmtMat = $pdo->prepare($sqlMat);
        foreach ($materiales as $material_id) {
            $stmtMat->execute([
                'producto_id' => $productoId,
                'material_id' => $material_id
            ]);
        }

        $pdo->commit();
        return true;
    } catch (Exception $e) {
        $pdo->rollBack();
        return false;
    }
}