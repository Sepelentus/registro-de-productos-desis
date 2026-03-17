CREATE TABLE bodegas (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL
);

CREATE TABLE sucursales (
    id SERIAL PRIMARY KEY,
    bodega_id INT REFERENCES bodegas(id) NOT NULL,
    nombre VARCHAR(100) NOT NULL
);

CREATE TABLE monedas (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(20) NOT NULL
);

CREATE TABLE materiales (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL
);

CREATE TABLE productos (
    id SERIAL PRIMARY KEY,
    codigo_producto VARCHAR(15) NOT NULL UNIQUE CONSTRAINT codigo_producto_min_length CHECK (length(codigo_producto) >= 5),
    nombre_producto VARCHAR(50) NOT NULL CONSTRAINT nombre_producto_min_length CHECK (length(nombre_producto) >= 2),
    descripcion_producto TEXT NOT NULL CONSTRAINT descripcion_producto_min_length CHECK (length(descripcion_producto) >= 10 AND length(descripcion_producto) <= 1000),
    bodega_id INT REFERENCES bodegas(id) NOT NULL,
    sucursal_id INT REFERENCES sucursales(id) NOT NULL,
    moneda_id INT REFERENCES monedas(id) NOT NULL,
    precio_unitario DECIMAL(10, 2) NOT NULL CONSTRAINT precio_unitario_check CHECK (precio_unitario > 0)
);

-- Debido a que un producto debe tener al menos 2 materiales, se crea una tabla intermedia (Relacion N:N)
CREATE TABLE productos_materiales (
    producto_id INT NOT NULL REFERENCES productos(id) ON DELETE CASCADE,
    material_id INT NOT NULL REFERENCES materiales(id) ON DELETE CASCADE,
    PRIMARY KEY (producto_id, material_id)
);