<?php
// Carga de controlador que maneja queries a la BD
require_once __DIR__ . '/controllers/controller.php';

$bodegas = getBodegas();
$monedas = getMonedas();
$materiales = getMateriales();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Formulario de Producto</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="form-container">
        <h1>Formulario de Producto</h1>

        <!-- Cambiar luego funcionalidad del form action a utilizar ID -->
        <form action="procesar.php" method="POST">
            <label for="codigo_producto">Código</label>
            <input type="text" name="codigo_producto" id="codigo_producto" class="text">
            <br><br>

            <label for="nombre_producto">Nombre</label>
            <input type="text" name="nombre_producto" id="nombre_producto" class="text">
            <br><br>

            <label for="bodega">Bodega</label>
            <select name="bodega" id="bodega">
                <option value="">Seleccione una bodega</option>
                <?php foreach ($bodegas as $bodega): ?>
                    <option value="<?php echo htmlspecialchars($bodega['id']); ?>">
                        <?php echo htmlspecialchars($bodega['nombre']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br><br>

            <!-- Aqui se debe actualizar sucursal cuando se haga la carga dinamica de sucursales -->

            <label for="sucursal">Sucursal</label>
            <select name="sucursal" id="sucursal">
                <option value="">Seleccione una sucursal</option>
                <?php foreach ($sucursales as $sucursal): ?>
                    <option value="<?php echo htmlspecialchars($sucursal['id']); ?>">
                        <?php echo htmlspecialchars($sucursal['nombre']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br><br>

            <label for="moneda">Moneda</label>
            <select name="moneda" id="moneda">
                <option value="">Seleccione una moneda</option>
                <?php foreach ($monedas as $moneda): ?>
                    <option value="<?php echo htmlspecialchars($moneda['id']); ?>">
                        <?php echo htmlspecialchars($moneda['nombre']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br><br>

            <label for="precio_unitario">Precio</label>
            <input type="text" name="precio_unitario" id="precio_unitario" class="text">
            <br><br>

            <!-- Checkboxes de material de producto iran aqui -->
            <label for="material">Material del Producto</label>
            <?php foreach ($materiales as $material): ?>
                <input type="checkbox" name="material[]" id="material">
                <?php echo htmlspecialchars($material['nombre']); ?>
            <?php endforeach; ?>
            <br><br>

            <label for="descripcion_producto">Descripción</label>
            <textarea name="descripcion_producto" id="descripcion_producto" class="textarea"></textarea>
            <br><br>


            <button type="submit" class="save-button">Guardar Producto</button>
        </form>
</body>

</html>