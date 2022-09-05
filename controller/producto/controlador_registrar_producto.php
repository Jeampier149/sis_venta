<?php
require '../../model/modelo_producto.php';
$MPR = new Modelo_Producto();
$error = [];
$producto = htmlspecialchars($_POST['producto'], ENT_QUOTES, 'UTF-8');
$presentacion = htmlspecialchars($_POST['presentacion'], ENT_QUOTES, 'UTF-8');
$unidad_medida = htmlspecialchars($_POST['unidad_medida'], ENT_QUOTES, 'UTF-8');
$categoria = htmlspecialchars($_POST['categoria'], ENT_QUOTES, 'UTF-8');
$precio_venta = htmlspecialchars($_POST['precio_venta'], ENT_QUOTES, 'UTF-8');
$nombre_archivo = htmlspecialchars($_POST['nombre_archivo'], ENT_QUOTES, 'UTF-8');

if (!preg_match("/^[a-zA-Z ]+$/", $producto)) {
    $error[] = "El nombre solo debe contener letras";
}
if (!ctype_digit($precio_venta)) {
    $error[] = "El precio solo debe contener numeros";
}

if (is_array($_FILES) && count($_FILES) > 0) {
    if (move_uploaded_file($_FILES['foto']['tmp_name'], "img/" . $nombre_archivo)) {
        $ruta = "../controller/producto/img/" . $nombre_archivo;
        if (empty($error)) {
            $consulta = $MPR->registrarProducto($producto, $presentacion, $unidad_medida, $categoria, $precio_venta, $ruta);
            echo $consulta;
        } else {
            echo json_encode($error);
        }
    } else {
        echo 0;
    }
} else {
    $ruta = "../controller/producto/img/default.png";
    $consulta = $MPR->registrarProducto($producto, $presentacion, $unidad_medida, $categoria, $precio_venta, $ruta);
    echo $consulta;
}
