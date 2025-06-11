<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Reporte de Exportaciones</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
  <h1 class="mb-4">Reporte de Lotes Exportados</h1>

  <form method="get" class="row g-3 mb-4">
    <div class="col-md-4">
      <input type="text" name="producto" class="form-control" placeholder="Filtrar por producto" value="<?= htmlspecialchars($_GET['producto'] ?? '') ?>">
    </div>
    <div class="col-md-4">
      <input type="text" name="pais" class="form-control" placeholder="Filtrar por país" value="<?= htmlspecialchars($_GET['pais'] ?? '') ?>">
    </div>
    <div class="col-md-4">
      <button class="btn btn-primary w-100" type="submit">Filtrar</button>
    </div>
  </form>

  <table class="table table-striped table-bordered">
    <thead class="table-dark">
      <tr>
        <th>Producto</th>
        <th>Cantidad (kg)</th>
        <th>Precio x kg</th>
        <th>Valor Total (S/.)</th>
        <th>País</th>
        <th>Fecha</th>
        <th>Clasificación</th>
      </tr>
    </thead>
    <tbody>
<?php
$total_acumulado = 0;
$altos = 0;
$especiales = 0;

$productoFiltro = strtolower($_GET['producto'] ?? '');
$paisFiltro = strtolower($_GET['pais'] ?? '');

if (file_exists("exportaciones.txt")) {
    $lineas = file("exportaciones.txt");

    foreach ($lineas as $linea) {
        $datos = str_getcsv($linea);
        list($producto, $cantidad, $precio, $pais, $fecha) = $datos;
        $valor = $cantidad * $precio;

        // Filtros
        if ($productoFiltro && stripos($producto, $productoFiltro) === false) continue;
        if ($paisFiltro && stripos($pais, $paisFiltro) === false) continue;

        $clasificacion = "";
        if ($cantidad > 1000) {
            $clasificacion .= "Alta Exportación ";
            $altos++;
        }
        if (in_array(trim(strtolower($pais)), ['ee.uu.', 'alemania', 'eeuu', 'estados unidos'])) {
            $clasificacion .= "Destino Especial";
            $especiales++;
        }

        $total_acumulado += $valor;

        echo "<tr>
                <td>$producto</td>
                <td>$cantidad</td>
                <td>S/. $precio</td>
                <td><strong>S/. $valor</strong></td>
                <td>$pais</td>
                <td>$fecha</td>
                <td>$clasificacion</td>
              </tr>";
    }
}
?>
    </tbody>
  </table>

  <div class="alert alert-info">
    <p><strong>Total exportado:</strong> S/. <?= number_format($total_acumulado, 2) ?></p>
    <p><strong>Lotes de alta exportación (>1000kg):</strong> <?= $altos ?></p>
    <p><strong>Lotes con destino a EE.UU. o Alemania:</strong> <?= $especiales ?></p>
  </div>
  <a href="index.php" class="btn btn-success">Registrar nuevo lote</a>
</body>
</html>
