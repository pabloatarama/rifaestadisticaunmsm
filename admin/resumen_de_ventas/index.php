<?php
  session_start();
  if ( $_SESSION["rifaestadisticaunmsm"] != true ) {
    header("Location: ../ingreso.php");
  }
 ?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Resumen de ventas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <meta http-equiv="refresh" content="30">
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
                <a class="nav-link" aria-current="page" href="../../admin/">Inicio</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="../resumen_de_ventas/">Resumen de ventas</a>
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
          <div class="p-3 col-sm">
            <h1>Resumen de ventas</h1>
            <div class="alert alert-info" role="alert">
              <?php require 'progreso.php'; ?>
            </div>
            <p><span class="badge bg-success">Verde</span> Vendida.</p>
            <p><span class="badge bg-warning text-dark">Amarillo</span> Reservada por vendedor (reservar inscribiendo solo nombre del vendedor).</p>
            <p><span class="badge bg-danger">Rojo</span> No vendida ni reservada.</p>
            <table class="table">
              <tbody>
                <tr>
                  <?php
                  #Preparar las variables con los datos de conexion
                  require '../../conexion.php';

                  # Conectandose a la base da datos
                  $conn = mysqli_connect($host, $usuario, $clave, $db);

                  # Preparo la sentencia con los comando ?
                  $sql = "
                    SELECT id, vendedor, nombre_completo
                    FROM   Boletos
                  ";

                  #Preparo los datos que voy a insertar

                  # Preparo la consulta
                  $pre = mysqli_prepare($conn, $sql);

                  # indico los datos a reemplazar con su tipo

                  # Ejecuto la consulta
                  mysqli_stmt_execute($pre);

                  # asocio los nombres de campo a nombres de variables
                  mysqli_stmt_bind_result($pre, $id, $vendedor, $nombre_completo);

                  # Capturo los resultados y los guardo en un array
                  while(mysqli_stmt_fetch($pre)) {
                    if (strlen($id)==1) {
                      $id_str = "00" . $id;
                    } elseif (strlen($id)==2) {
                      $id_str = "0" . $id;
                    } else {
                      $id_str = $id;
                    }

                    echo "<td";
                    if ($nombre_completo!="" and $vendedor!="") {
                      echo " class='table-success'";
                    } elseif ($vendedor!="") {
                      echo " class='table-warning'";
                    } else {
                      echo " class='table-danger'";
                    }
                    echo ">".$id_str."</td>";

                    if (($id%20) == 0) {
                      echo "</tr><tr>";
                    }
                  }

                  # Cierro la consulta y la conexión
                  mysqli_stmt_close($pre);
                  mysqli_close($conn);
                   ?>
                </tr>
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </main>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
  </body>
</html>
