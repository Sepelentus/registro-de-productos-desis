document.addEventListener('DOMContentLoaded', () => {
    const formulario = document.getElementById('formularioProducto');

    formulario.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(formulario);

        // Debug
        console.log(formData);

        const codigo = formData.get('codigo_producto').trim();
        const nombre = formData.get('nombre_producto').trim();
        const bodega = formData.get('bodega');
        const sucursal = formData.get('sucursal');
        const moneda = formData.get('moneda');
        const precio = formData.get('precio_unitario').trim();
        const descripcion = formData.get('descripcion_producto').trim();

        const materiales = formData.getAll('material[]');

        if (!validarCampos(codigo, nombre, bodega, sucursal, moneda, precio, materiales, descripcion)) {
            return;
        }

        // Envio mediante AJAX para guardar el producto
        const response = await fetch('controllers/guardar_producto.php', {
            method: 'POST',
            body: formData
        });

        const data = await response.json();

        if (data.success) {
            alert(data.message);
            formulario.reset();
            document.getElementById('sucursal').innerHTML = '<option value="">Seleccione una sucursal</option>';
        } else {
            alert(data.message);
        }

    });

    // Seccion de carga dinamica de sucursales
    const bodegaSelect = document.getElementById('bodega');
    const sucursalSelect = document.getElementById('sucursal');

    bodegaSelect.addEventListener('change', async (e) => {
        const bodegaId = e.target.value;
        sucursalSelect.innerHTML = '<option value="">Seleccione una sucursal</option>';

        if (bodegaId) {
            try {
                const response = await fetch(`controllers/get_sucursales.php?bodega_id=${bodegaId}`);
                const data = await response.json();
                if (data.success) {
                    data.sucursales.forEach(sucursal => {
                        const option = document.createElement('option');
                        option.value = sucursal.id;
                        option.textContent = sucursal.nombre;
                        sucursalSelect.appendChild(option);
                    });
                } else {
                    console.error("Error cargando sucursales:", data.message);
                }
            } catch (error) {
                console.error("Error en la solicitud AJAX de sucursales:", error);
            }
        }
    });
});

const validarCodigo = (codigo) => {
    // RegexCodigo -> Permitir solo si tiene al menos una letra y un numero
    const codigoRegex = /^(?=.*[a-zA-Z])(?=.*\d)[a-zA-Z0-9]+$/;

    if (codigo === "") {
        alert("El código del producto no puede estar en blanco.");
        return;
    }

    if (codigo.length < 5 || codigo.length > 15) {
        alert("El código del producto debe tener entre 5 y 15 caracteres.");
        return;
    }

    if (!codigoRegex.test(codigo)) {
        alert("El código del producto debe contener letras y números");
        return;
    }

    return true;
};

const validarNombre = (nombre) => {
    if (nombre === "") {
        alert("El nombre del producto no puede estar en blanco.");
        return;
    }

    if (nombre.length < 2 || nombre.length > 50) {
        alert("El nombre del producto debe tener entre 2 y 50 caracteres.");
        return;
    }

    return true;
};

const validarBodega = (bodega) => {
    if (bodega === "") {
        alert("Debe seleccionar una bodega.");
        return;
    }

    return true;
};

const validarSucursal = (sucursal) => {
    if (sucursal === "") {
        alert("Debe seleccionar una sucursal para la bodega seleccionada.");
        return;
    }

    return true;
};

const validarMoneda = (moneda) => {
    if (moneda === "") {
        alert("Debe seleccionar una moneda para el producto.");
        return;
    }

    return true;
};

const validarPrecio = (precio) => {
    // RegexPrecio -> Permitir solo numeros positivos, hasta 2 decimales
    const precioRegex = /^\d+(\.\d{1,2})?$/;

    if (precio === "") {
        alert("El precio del producto no puede estar en blanco.");
        return;
    }

    if (!precioRegex.test(precio) || parseFloat(precio) <= 0) {
        alert("El precio del producto debe ser un número positivo con hasta dos decimales.");
        return;
    }

    return true;
};

const validarMateriales = (materiales) => {
    if (materiales.length < 2) {
        alert("Debe seleccionar al menos dos materiales para el producto.");
        return;
    }

    return true;
};

const validarDescripcion = (descripcion) => {
    if (descripcion === "") {
        alert("La descripción del producto no puede estar en blanco.");
        return;
    }

    if (descripcion.length < 10 || descripcion.length > 1000) {
        alert("La descripción del producto debe tener entre 10 y 1000 caracteres.");
        return;
    }

    return true;
};

const validarCampos = (codigo, nombre, bodega, sucursal, moneda, precio, materiales, descripcion) => {
    if (!validarCodigo(codigo)) {
        return false;
    }

    if (!validarNombre(nombre)) {
        return false;
    }

    if (!validarBodega(bodega)) {
        return false;
    }

    if (!validarSucursal(sucursal)) {
        return false;
    }

    if (!validarMoneda(moneda)) {
        return false;
    }

    if (!validarPrecio(precio)) {
        return false;
    }

    if (!validarMateriales(materiales)) {
        return false;
    }

    if (!validarDescripcion(descripcion)) {
        return false;
    }

    return true;
};