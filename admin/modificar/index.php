<?php
  session_start();
  if ( $_SESSION["rifaestadisticaunmsm"] != true ) {
    header("Location: ingreso.php");
  }

 ?>
<?php

$nombre_completo = "";
$telefono = "";
$vendedor = "";
$monto = "";

#Preparar las variables con los datos de conexion
require '../../conexion.php';

# Conectandose a la base da datos
$conn = mysqli_connect($host, $usuario, $clave, $db);

# Preparo la sentencia con los comando ?
$sql = "
  SELECT nombre_completo, telefono, vendedor, monto
  FROM   Boletos
  WHERE  id = ?
";

#Preparo los datos que voy a insertar
$id = $_POST["id"];

# Preparo la consulta
$pre = mysqli_prepare($conn, $sql);

# indico los datos a reemplazar con su tipo
mysqli_stmt_bind_param($pre, "i", $id);

# Ejecuto la consulta
mysqli_stmt_execute($pre);

# asocio los nombres de campo a nombres de variables
mysqli_stmt_bind_result($pre, $nom, $telf, $vend, $mont);

# Capturo los resultados y los guardo en un array
while(mysqli_stmt_fetch($pre)) {
  $nombre_completo = $nom;
  $telefono = $telf;
  $vendedor = $vend;
  $monto = $mont;
}

# Cierro la consulta y la conexión
mysqli_stmt_close($pre);
mysqli_close($conn);

if (strlen($id)==1) {
  $id_str = "00" . $id;
} elseif (strlen($id)==2) {
  $id_str = "0" . $id;
} else {
  $id_str = $id;
}
 ?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Administración rifa estadística</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  </head>
  <body>
    <header>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <span class="navbar-brand" href="#">Administración rifa estadística</span>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="../">Inicio</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../resumen_de_ventas/">Resumen de ventas</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../ranking/">Ranking</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
    <main>
      <div class="container">
        <div class="row">
          <div class="col-sm p-3">
            <h1>Administración rifa estadística</h1>
            <h2>Modificar ticket <?php echo $id_str; ?></h2>
            <form action="modificacion.php" method="post">
              <div class="mb-3">
                <label class="form-label">Nombre completo</label>
                <input name="nombre_completo" type="text" class="form-control" value="<?php echo $nombre_completo; ?>">
                <div class="form-text">Nombre completo del comprador</div>
              </div>
              <div class="mb-3">
                <label class="form-label">Teléfono</label>
                <input name="telefono" type="number" step="1" inputmode="numeric" class="form-control" value="<?php echo $telefono; ?>">
                <div class="form-text">Teléfono del comprador</div>
              </div>
              <div class="mb-3">
                <label class="form-label">Monto</label>
                <input name="monto" type="number" step="0.01" class="form-control" value="<?php echo $monto; ?>">
                <div class="form-text">Precio al que fue vendido el ticket</div>
              </div>
              <div class="mb-3">
                <label class="form-label">Vendedor</label>
                <input name="vendedor" type="text" class="form-control" value="<?php echo $vendedor; ?>">
                <div class="form-text">Nombre de la persona que hizo la venta</div>
              </div>
              <input type="hidden" name="id" value="<?php echo $id; ?>">
              <div class="btn-group" role="group">
                <button type="submit" class="btn btn-success">Guardar</button>
              </div>
              <div class="btn-group" role="group">
                <a href="../../admin/" class="btn btn-danger">Regresar a inicio</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </main>
    <script type="text/javascript">
      setInterval(function () {
        var datos = new FormData();
        datos.append("id","<?php echo $id; ?>");

        var solicitudPhp = new XMLHttpRequest();
        solicitudPhp.addEventListener("load", function(evento) {
            // var estado = evento.target;
            // if (estado.status == 200) {
            //     main[0].innerHTML = estado.responseText;
            // }
        });
        solicitudPhp.open("POST", "actualizar_instante.php", true);
        solicitudPhp.send(datos);
      },1000);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
  </body>
</html>
