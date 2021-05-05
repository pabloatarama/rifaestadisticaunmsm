<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Descargar data</title>
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
                <a class="nav-link" aria-current="page" href="../../admin/">Inicio</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../resumen_de_ventas/">Resumen de ventas</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../ranking/">Ranking</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="../descargar_data/">Descargar datos</a>
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
            <h1>Descargar datos</h1>
            <p>Se generará un archivo CSV que puede ser abierto con total normalidad por Microsoft Excel.</p>
            <p>El archivo solo contendrá los datos de las rifas con un vendedor inscrito.</p>
            <form class="" action="index.html" method="post">
              <div class="mb-3">
                <button onclick="descargar()" type="button" class="btn btn-primary">Generar archivo CSV</button>
                <a id="boton_descarga" type="button" disabled class="btn btn-success disabled">Descargar archivo CSV</a>
                <label id="label" for=""></label>
              </div>
            </form>

          </div>
        </div>
      </div>
    </main>


    <script type="text/javascript">

      var botonDescarga = document.getElementById("boton_descarga");
      var label = document.getElementById("label")
      function descargar(){
        // var datos = new FormData();
        // datos.append("nombre", "Juan");
        var url = "generar_csv.php";
        var solicitud = new XMLHttpRequest();
        solicitud.addEventListener("load", function(evento){
          var evento = evento.target;
          if (evento.status == 200) {
              var nombre = evento.responseText;
              botonDescarga.href = nombre;
              label.innerHTML = nombre;
              botonDescarga.className = "btn btn-success";
          }
        });
        solicitud.open("POST", url, true);
        solicitud.send();
      }



    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
  </body>
</html>
