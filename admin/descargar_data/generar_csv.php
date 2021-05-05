<?php

// header("Content-Type: text/html;charset=utf-8");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

#Preparar las variables con los datos de conexion
require '../../conexion.php';

# Conectandose a la base da datos
$conn = mysqli_connect($host, $usuario, $clave, $db);

# Preparo la sentencia con los comando ?
$sql = "
  SELECT id, nombre_completo, telefono, vendedor, monto
  FROM   Boletos
  WHERE  vendedor != ''
";

#Preparo los datos que voy a insertar

# Preparo la consulta
$pre = mysqli_prepare($conn, $sql);

# indico los datos a reemplazar con su tipo

# Ejecuto la consulta
mysqli_stmt_execute($pre);

# asocio los nombres de campo a nombres de variables
mysqli_stmt_bind_result($pre, $id, $nombre_completo, $telefono, $vendedor, $monto);
$contenido_txt = "NÚMERO;NOMBRE COMPLETO;TELÉFONO;VENDEDOR;MONTO";
# Capturo los resultados y los guardo en un array
while(mysqli_stmt_fetch($pre)) {
  if (strlen($id)==1) {
    $id_str = "00" . $id;
  } elseif (strlen($id)==2) {
    $id_str = "0" . $id;
  } else {
    $id_str = $id;
  }
  $contenido_txt = $contenido_txt . "\n".$id_str.";".$nombre_completo.";".$telefono.";".$vendedor.";".$monto;
}

# Cierro la consulta y la conexión
mysqli_stmt_close($pre);
mysqli_close($conn);

// Reemplazamos carácteres latinos


// $contenido_csv = html_entity_decode($contenido_csv);

$nombre_archivo = "rifaestadisticaunmsm_" . date("Y-m-d_H-i-s",time()-(6*3600));
$archivo_txt = fopen($nombre_archivo.".csv", "w" );
fwrite($archivo_txt, $contenido_txt);
fclose($archivo_txt);



//$archivo_2 = fopen($nombre_archivo.".txt", "w" );
// $contenido_csv = file_get_contents($nombre_archivo.".txt");
//
// $contenido_csv = str_replace("Ã¡","á",$contenido_csv);
//
// $archivo_csv = fopen($nombre_archivo.".csv", "w" );
// fwrite($archivo_csv, $contenido_csv);
// fclose($archivo_csv);

echo $nombre_archivo.".csv";



 ?>
