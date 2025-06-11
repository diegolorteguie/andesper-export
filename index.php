<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro de Exportación</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script>
    function calcularTotal() {
      const cantidad = parseFloat(document.getElementById('cantidad').value) || 0;
      const precio = parseFloat(document.getElementById('precio').value) || 0;
      const total = cantidad * precio;
      document.getElementById('total').value = total.toFixed(2);
    }
  </script>
</head>
<body class="container mt-4">
  <h1 class="mb-4">Registrar Lote de Exportación</h1>
  <form action="registrar.php" method="post">
    <div class="mb-3">
      <label class="form-label">Producto</label>
      <select name="producto" class="form-select" required>
        <option value="" disabled selected>Selecciona un producto</option>
        <option value="Quinua">Quinua</option>
        <option value="Maíz Morado">Maíz Morado</option>
        <option value="Papa Nativa">Papa Nativa</option>
        <option value="Tarwi">Tarwi</option>
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label">Cantidad (kg)</label>
      <input type="number" name="cantidad" id="cantidad" class="form-control" min="1" required oninput="calcularTotal()">
    </div>
    <div class="mb-3">
      <label class="form-label">Precio por kilo (S/.)</label>
      <input type="number" step="0.01" name="precio" id="precio" class="form-control" min="0.01" required oninput="calcularTotal()">
    </div>
    <div class="mb-3">
      <label class="form-label">Valor total (S/.)</label>
      <input type="text" id="total" class="form-control" readonly>
    </div>
<div class="mb-3">
  <label class="form-label">País de destino</label>
  <select name="pais" class="form-select" required>
    <option value="" disabled selected>Selecciona un país</option>
    <option value="EE.UU.">Estados Unidos</option>
    <option value="Alemania">Alemania</option>
  </select>
</div>
    <button type="submit" class="btn btn-primary">Registrar</button>
    <a href="reporte.php" class="btn btn-secondary">Ver Reporte</a>
  </form>
</body>
</html>
