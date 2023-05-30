<?php
session_start();
if (!isset($_SESSION['login']) || !$_SESSION['login']['status']){
    header("Location:../");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <!-- <link rel="stylesheet" href="style.css"> -->
</head>
<body>
  <header>
    <h2 class="logo">Logo</h2>
    <nav class="navigation">
      <a href="#">Home</a>
      <a href="views/productos.views.php">Productos</a>
      <button class="btnLogin-popup">Login</button>
    </nav>
  </header>
</body>
</html>