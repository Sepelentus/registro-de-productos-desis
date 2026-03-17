<?php
function getMateriales()
{
    global $pdo;
    $sql = "SELECT * FROM materiales ORDER BY nombre ASC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}
?>