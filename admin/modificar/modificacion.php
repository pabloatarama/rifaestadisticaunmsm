<?php
  session_start();
  if ( $_SESSION["rifaestadisticaunmsm"] != true ) {
    header("Location: ingreso.php");
  }

 ?>
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
  UPDATE  Boletos
  SET     nombre_completo = ?,
          telefono = ?,
          vendedor = ?,
          monto = ?
  WHERE   id = ?
";

# Preparo los datos que voy a insertar
$nombre_completo = $_POST["nombre_completo"];
$telefono = $_POST["telefono"];
$vendedor = $_POST["vendedor"];
$monto = $_POST["monto"];
$id = $_POST["id"];
if ($telefono==0) {
  $telefono = null;
}
if ($monto==0) {
  $monto = null;
}
if ($monto==0) {
  $monto = null;
}
if ($nombre_completo=="") {
  $nombre_completo = null;
}
if ($vendedor=="") {
  $vendedor = null;
}

# Preparo la consulta
$pre = mysqli_prepare($conn, $sql);

# indico los datos a reemplazar con su tipo
mysqli_stmt_bind_param($pre, "sisdi", $nombre_completo, $telefono, $vendedor, $monto, $id);

# Ejecuto la consulta
mysqli_stmt_execute($pre);

# PASO OPCIONAL (SOLO PARA CONSULTAS DE INSERCIÓN):
# Obtener el ID del registro insertado
$nuevo_id = mysqli_insert_id($conn);

# Cierro la consulta y la conexión
mysqli_stmt_close($pre);
mysqli_close($conn);

header("Location: ../../admin/");

 ?>
