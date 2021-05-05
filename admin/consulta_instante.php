<?php
#Preparar las variables con los datos de conexion
require '../conexion.php';

# Conectandose a la base da datos
$conn = mysqli_connect($host, $usuario, $clave, $db);

# Preparo la sentencia con los comando ?
$sql = "
  SELECT instante_modificacion
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
mysqli_stmt_bind_result($pre, $instante);

# Capturo los resultados y los guardo en un array
while(mysqli_stmt_fetch($pre)) {
  // echo $instante;
  // echo "<br>";
  // echo strtotime($instante);
  // echo "<br>";
  // echo "<br>";
  // echo "<br>";
  // echo time();
  // echo "<br>";
  // echo date("Y-m-d H:i:s",time());
  if ((time()) - strtotime($instante) < 5 ) {
    echo true;
  }

}

# Cierro la consulta y la conexión
mysqli_stmt_close($pre);
mysqli_close($conn);


 ?>
