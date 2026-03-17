<!-- Obtencion de sucursales para el dropdown -->
<?php
function getSucursalesByBodega($bodega_id)
{
    global $pdo;
    $sql = "SELECT * FROM sucursales WHERE bodega_id = :bodega_id ORDER BY nombre ASC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['bodega_id' => $bodega_id]);
    return $stmt->fetchAll();
}
?>