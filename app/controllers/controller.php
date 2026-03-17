<?php
// Controlador principal para cargar datos iniciales

require_once __DIR__ . '/../../config/db.php';

require_once __DIR__ . '/../models/bodega.php';
require_once __DIR__ . '/../models/sucursales.php';
require_once __DIR__ . '/../models/moneda.php';
require_once __DIR__ . '/../models/materiales.php';

$bodegas = getBodegas();
$monedas = getMonedas();
$materiales = getMateriales();

// Ya que la carga de sucursales es dinamica, es decir, depende de la bodega seleccionada, se deja vacia la variable sucursales
$sucursales = [];
