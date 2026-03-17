<!-- Obtencion de bodegas para el dropdown -->
<?php
function getBodegas()
{
    global $pdo;
    $sql = "SELECT * FROM bodegas ORDER BY id ASC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}

?>