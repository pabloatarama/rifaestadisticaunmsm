<?php
  session_start();
  $_SESSION["rifaestadisticaunmsm"] = false;


 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Ingreso</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style media="screen">
      html,body {
      height: 100%;
      }

      body {
      display: flex;
      align-items: center;
      padding-top: 40px;
      padding-bottom: 40px;
      background-color: #f5f5f5;
      }

      .form-signin {
      width: 100%;
      max-width: 330px;
      padding: 15px;
      margin: auto;
      }
      .form-signin .checkbox {
      font-weight: 400;
      }
      .form-signin .form-control {
      position: relative;
      box-sizing: border-box;
      height: auto;
      padding: 10px;
      font-size: 16px;
      }
      .form-signin .form-control:focus {
      z-index: 2;
      }
      .form-signin input[type="text"] {
      margin-bottom: -1px;
      border-bottom-right-radius: 0;
      border-bottom-left-radius: 0;
      }
      .form-signin input[type="password"] {
      margin-bottom: 10px;
      border-top-left-radius: 0;
      border-top-right-radius: 0;
      }
    </style>
  </head>
  <body class="text-center">

    <main class="form-signin">
      <form action="ingresar.php" method="post">
        <img class="mb-3" src="gauss.svg" alt="" width="72" height="57">
        <h1 class="h3 mb-3 fw-normal">Administración de rifa estadística</h1>
        <label for="inputEmail" class="visually-hidden">Usuario</label>
        <input type="text" id="inputEmail" name="usuario" class="form-control" placeholder="Usuario" required="" autofocus="">
        <label for="inputPassword" class="visually-hidden">Contraseña</label>
        <input type="password" name="contrasena" id="inputPassword" class="form-control" placeholder="Contraseña" required="">

        <button class="w-100 btn btn-lg btn-primary" type="submit">Ingresar</button>
        <p class="mt-3 mb-3 text-muted">Éxito chicos!! 🥳</p>
      </form>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>
