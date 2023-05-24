<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistema de almacen</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <h2 class="logo">Logo</h2>
    <nav class="navigation">
      <a href="#">Home</a>
      <a href="views/productos.views.html">Productos</a>
      <button class="btnLogin-popup">Login</button>
    </nav>
  </header>

  <div class="wrapper">
    <div class="form-box login">
      <h2>Login</h2>
      <form action="#">
        <div class="input-box">
          <span class="icon"><ion-icon name="mail-outline"></ion-icon></span>
          <input id="usuario" type="text" required>
          <label>Usuario</label>
        </div>
        <div class="input-box">
          <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon></span>
          <input id="claveacceso" type="password" required>
          <label>Contraseña</label>
          <button type="submit" class="btn" name="btnIngresar">Login</button>
          <div class="login-register">
            <p>¿No tienes una cuenta?
              <a href="#" class="register-link">Registrate</a>
            </p>
          </div>
        </div>
      </form>
    </div>
  </div>

  <script src="script.js"></script>

  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>
</html>