<?php
if (isset($_POST['producto'], $_POST['cantidad'], $_POST['precio'], $_POST['pais'])) {
    $producto = $_POST['producto'];
    $cantidad = (int) $_POST['cantidad'];
    $precio = (float) $_POST['precio'];
    $pais = trim($_POST['pais']);
    $fecha = date('Y-m-d H:i:s');

    $linea = "$producto,$cantidad,$precio,$pais,$fecha" . PHP_EOL;
    file_put_contents("exportaciones.txt", $linea, FILE_APPEND);

    header("Location: reporte.php");
    exit;
} else {
    echo "Datos incompletos.";
}
?>
