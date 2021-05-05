<?php
#Preparar las variables con los datos de conexion
require '../conexion.php';

# Conectandose a la base da datos
$conn = mysqli_connect($host, $usuario, $clave, $db);

# Preparo la sentencia con los comando ?
$sql = "
  SELECT nombre_completo
  FROM   Boletos
";

#Preparo los datos que voy a insertar

# Preparo la consulta
$pre = mysqli_prepare($conn, $sql);

# indico los datos a reemplazar con su tipo

# Ejecuto la consulta
mysqli_stmt_execute($pre);

# asocio los nombres de campo a nombres de variables
mysqli_stmt_bind_result($pre, $nombre_completo);

# Capturo los resultados y los guardo en un array
$total = 0;
$ventas = 0;
while(mysqli_stmt_fetch($pre)) {
  $total = $total + 1;
  if ($nombre_completo!="") {
    $ventas = $ventas + 1;
  }
}

# Cierro la consulta y la conexión
mysqli_stmt_close($pre);
mysqli_close($conn);

$progreso = ($ventas/$total)*100;
echo $progreso . "%";
 ?>
