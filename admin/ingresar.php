<?php
  session_start();
  $usuarioV = "admin";
  $contrasenaV = "654321";
  // if (isset($_POST["A"]) && isset($_POST["B"])) {
    if ( ($_POST["usuario"] == $usuarioV) && ($_POST["contrasena"] == $contrasenaV ) ){
      $_SESSION["rifaestadisticaunmsm"] = true;
      header("Location: index.php");
    } else {
      header("Location: index.php");
    }
  // }
?>
