<?php
function getMateriales()
{
    global $pdo;
    $sql = "SELECT * FROM materiales";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}
