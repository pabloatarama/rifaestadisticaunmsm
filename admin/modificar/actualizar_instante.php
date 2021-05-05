<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
# Preparar las variables con los datos de conexión
require '../../conexion.php';

# Conectarse a la base de datos
$conn = mysqli_connect($host, $usuario, $clave, $db);

# Preparo la sentencia con los comodines ?
$sql = "
  UPDATE Boletos
  SET    instante_modificacion = NOW()
  WHERE id = ?
";

# Preparo los datos que voy a insertar
$id = $_POST["id"];

# Preparo la consulta
$pre = mysqli_prepare($conn, $sql);

# indico los datos a reemplazar con su tipo
mysqli_stmt_bind_param($pre, "i", $id);

# Ejecuto la consulta
mysqli_stmt_execute($pre);

# Cierro la consulta y la conexión
mysqli_stmt_close($pre);
mysqli_close($conn);
 ?>
