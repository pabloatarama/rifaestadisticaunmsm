<?php
  session_start();
  if ( $_SESSION["rifaestadisticaunmsm"] != true ) {
    header("Location: ingreso.php");
  }

 ?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Administración rifa estadística</title>
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
                <a class="nav-link active" aria-current="page" href="../admin/">Inicio</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="resumen_de_ventas/">Resumen de ventas</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="ranking/">Ranking</a>
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
            <div class="alert alert-danger" role="alert">
              No se permiten más ventas
            </div>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Número</th>
                  <th scope="col">Nombre completo</th>
                  <th scope="col">Teléfono</th>
                  <th scope="col">Monto</th>
                  <th scope="col">Vendedor</th>
                  <th scope="col">Modificar</th>
                  <th scope="col">Link de ticket</th>
                </tr>
              </thead>
              <tbody>
                <?php

                ini_set('display_errors', 1);
                ini_set('display_startup_errors', 1);
                error_reporting(E_ALL);

                $total = 0;

                #Preparar las variables con los datos de conexion
                require '../conexion.php';

                # Conectandose a la base da datos
                $conn = mysqli_connect($host, $usuario, $clave, $db);

                # Preparo la sentencia con los comando ?
                $sql = "
                  SELECT id, nombre_completo, telefono, vendedor, monto
                  FROM   Boletos
                ";

                # Preparo la consulta
                $pre = mysqli_prepare($conn, $sql);

                # Ejecuto la consulta
                mysqli_stmt_execute($pre);

                # asocio los nombres de campo a nombres de variables
                mysqli_stmt_bind_result($pre, $id, $nombre_completo, $telefono, $vendedor, $monto);

                # Capturo los resultados y los guardo en un array
                while(mysqli_stmt_fetch($pre)) {
                  if (strlen($id)==1) {
                    $id_str = "00" . $id;
                  } elseif (strlen($id)==2) {
                    $id_str = "0" . $id;
                  } else {
                    $id_str = $id;
                  }
                  if ($telefono==0) {
                    $telefono = "";
                  }
                  echo "<tr>
                    <td>".$id_str."</td>
                    <td>".$nombre_completo."</td>
                    <td>".$telefono."</td>
                    <td>S/ ".$monto."</td>
                    <td>".$vendedor."</td>
                    <td><form action='' name='formulario".$id."' method='post'>
                      <input type='hidden' name='id' value='".$id."'>
                      <button type='button' disabled onclick='cambiarEstado(".$id.")' class='btn btn-warning'>Modificar</button>

                    </form></td>
                    <td><a target='_blank' href='https://rifaestadisticaunmsm.tk/".$id_str."/'>link de ticket</a></td>
                  </tr>";
                  $total = $total + $monto;
                }

                # Cierro la consulta y la conexión
                mysqli_stmt_close($pre);
                mysqli_close($conn);
                 ?>
                 <tr>
                   <td></td>
                   <th colspan="2" >Monto recaudado total</th>
                   <th colspan="2"><?php echo "S/ " . $total; ?></th>
                   <td></td>
                   <td></td>
                 </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- onclick='cambiarEstado(".$id.")' -->
    </main>
    <script type="text/javascript">
      var formularios = document.getElementsByTagName("form");

      function cambiarEstado(id){
        // setInterval(function(){

          var datos = new FormData();
          datos.append("id", id);
          var url = "consulta_instante.php";
          var solicitud = new XMLHttpRequest();
          solicitud.addEventListener("load", function(evento){
            var evento = evento.target;
            if (evento.status == 200) {
              if (evento.responseText!="") {
                alert("Este ticket está siendo actualmente modificado o se modificó hace muy poco por otro vendedor.");
              } else {
                formularios[id-1].submit();
               }
            }
          });
          solicitud.open("POST", url, true);
          solicitud.send(datos);
        // },1000);
      }



    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
  </body>
</html>
