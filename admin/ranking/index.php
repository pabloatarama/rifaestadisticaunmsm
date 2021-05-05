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
    <title>Ranking ventas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh" content="30">
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
                <a class="nav-link" aria-current="page" href="../../admin/">Inicio</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../resumen_de_ventas/">Resumen de ventas</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="../ranking/">Ranking</a>
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
            <h1>Ranking de ventas</h1>

            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Puesto</th>
                  <th scope="col">Vendedor</th>
                  <th scope="col">Monto recaudado</th>
                  <th scope="col">Tickets vendidos</th>
                </tr>
              </thead>
              <tbody>
                <?php
                ini_set('display_errors', 1);
                ini_set('display_startup_errors', 1);
                error_reporting(E_ALL);
                #Preparar las variables con los datos de conexion
                require '../../conexion.php';

                # Conectandose a la base da datos
                $conn = mysqli_connect($host, $usuario, $clave, $db);

                # Preparo la sentencia con los comando ?
                $sql = "
                  SELECT vendedor, SUM(monto), COUNT(nombre_completo)
                  FROM   Boletos
                  WHERE nombre_completo != ''
                  GROUP BY vendedor
                  ORDER BY SUM(monto) DESC

                ";

                #Preparo los datos que voy a insertar

                # Preparo la consulta
                $pre = mysqli_prepare($conn, $sql);

                # Ejecuto la consulta
                mysqli_stmt_execute($pre);

                # asocio los nombres de campo a nombres de variables
                mysqli_stmt_bind_result($pre, $vendedor, $suma_monto, $numero_ventas);

                # Capturo los resultados y los guardo en un array
                $total = 0;
                $puesto = 0;
                $total_ventas = 0;
                while(mysqli_stmt_fetch($pre)) {
                  $puesto = $puesto + 1;
                  $total = $total + $suma_monto;
                  $total_ventas = $total_ventas + $numero_ventas;
                  if (!($vendedor == "")) {
                    if ($puesto == 1) {
                      echo "<tr>
                        <th scope='row'>1</th>
                        <td>".$vendedor." 🌟</td>
                        <td>S/ ".$suma_monto."</td>
                        <td>".$numero_ventas."</td>
                      </tr>";
                    } elseif ($puesto == 2) {
                      echo "<tr>
                        <th scope='row'>2</th>
                        <td colspan='3'>Supuestamente Muriel está aquí</td>
                      </tr>";
                      echo "<tr>
                        <th scope='row'>3</th>
                        <td>".$vendedor."</td>
                        <td>S/ ".$suma_monto."</td>
                        <td>".$numero_ventas."</td>
                      </tr>";
                    } else {
                      echo "<tr>
                        <th scope='row'>".($puesto+1)."</th>
                        <td>".$vendedor."</td>
                        <td>S/ ".$suma_monto."</td>
                        <td>".$numero_ventas."</td>
                      </tr>";
                    }

                  }

                }

                # Cierro la consulta y la conexión
                mysqli_stmt_close($pre);
                mysqli_close($conn);
                 ?>
                 <tr>
                   <th></th>
                   <th>TOTAL</th>
                   <th><?php echo "S/ " . $total; ?> + *</th>
                   <th><?php echo $total_ventas; ?> + *</th>
                 </tr>
              </tbody>
            </table>
            <p>*Ventas de Muriel</p>
          </div>
        </div>
      </div>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
  </body>
</html>
