<?php
function getMonedas()
{
    global $pdo;
    $sql = "SELECT * FROM monedas ORDER BY id ASC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}
