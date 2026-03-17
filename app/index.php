<?php
// Carga de controlador que maneja queries a la DB
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
    <script src="js/validacion.js"></script>
</head>

<body>
    <div class="form-container">
        <h1>Formulario de Producto</h1>

        <!-- Cambiar luego funcionalidad del form action a utilizar ID -->
        <form id="formularioProducto">
            <div class="row">
                <div class="col">
                    <label for="codigo_producto">Código</label>
                    <input type="text" name="codigo_producto" id="codigo_producto" class="text" placeholder="PROD01K">
                </div>
                <div class="col">
                    <label for="nombre_producto">Nombre</label>
                    <input type="text" name="nombre_producto" id="nombre_producto" class="text" placeholder="Set Comedor">
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="bodega">Bodega</label>
                    <select name="bodega" id="bodega">
                        <option value="">Seleccione una bodega</option>
                        <?php foreach ($bodegas as $bodega): ?>
                            <option value="<?php echo htmlspecialchars($bodega['id']); ?>">
                                <?php echo htmlspecialchars($bodega['nombre']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col">
                    <label for="sucursal">Sucursal</label>
                    <select name="sucursal" id="sucursal">
                        <option value="">Seleccione una sucursal</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="moneda">Moneda</label>
                    <select name="moneda" id="moneda">
                        <option value="">Seleccione una moneda</option>
                        <?php foreach ($monedas as $moneda): ?>
                            <option value="<?php echo htmlspecialchars($moneda['id']); ?>">
                                <?php echo htmlspecialchars($moneda['nombre']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col">
                    <label for="precio_unitario">Precio</label>
                    <input type="text" name="precio_unitario" id="precio_unitario" class="text" placeholder="1500">
                </div>
            </div>

            <div class="full-width">
                <label>Material del Producto</label>
                <div class="checkbox-group">
                    <?php foreach ($materiales as $material): ?>
                        <label class="checkbox-label">
                            <input type="checkbox" name="material[]" value="<?php echo htmlspecialchars($material['id']); ?>" id="material_<?php echo htmlspecialchars($material['id']); ?>">
                            <?php echo htmlspecialchars($material['nombre']); ?>
                        </label>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="full-width">
                <label for="descripcion_producto">Descripción</label>
                <textarea name="descripcion_producto" id="descripcion_producto" class="textarea"></textarea>
            </div>

            <div class="btn-container">
                <button type="submit" class="save-button">Guardar Producto</button>
            </div>
        </form>
</body>

</html>