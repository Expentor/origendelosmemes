<?php
require "database.php";

$error = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["email"]) || empty($_POST["password"])) {
    $error = "Porfavor rellene todos los espacios.";
  } else if (!str_contains($_POST["email"], "@")) {
    $error = "El formato del email es incorrecto.";
  } else if ($_POST["password"] != $_POST["confirm_password"]) {
    $error = "Las contraseñas no son iguales.";
  } else {
    $statement  = $conn->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
    $statement->bindParam(":email", $_POST["email"]);
    $statement->execute();

    if ($statement->rowCount() == 0) {
      $error = "Credenciales incorrectas.";
    } else {
      $user = $statement->fetch(PDO::FETCH_ASSOC);

      if (!password_verify($_POST["password"], $user["password"])) {
        $error = "Datos incorrectos, verifique nuevamente.";
      } else {
        session_start();

        unset($user["password"]);

        $_SESSION["user"] = $user;

        header("Location: index.php");
      }
    }
  }
}
?>
<?php require "partials/header-navbar.php" ?>
<div class="login-banner">
      <div class="login-box">
        <img class="avatar" src="img/ODM.png" alt="Logo de ODM">
          <h2>Cambiar contraseña</h2>
          <?php if ($error): ?>
                  <p class="text-danger">
                    <?= $error ?>
                  <?php endif ?>
                <form method="POST" action="login.php"> 
          <form>
                <input id="email" type="text"  name="email" autofocus placeholder="Ingresa tu Email">        
                <input id="password" type="password" name="password" autofocus placeholder="Ingresa tu contraseña anterior">
                <input id="password" type="password" name="password" autofocus placeholder="Ingresa tu contraseña nueva">
                <input id="password" type="password" name="password" autofocus placeholder="Confirma tu nueva contraseña">
                <input type="submit" value="Iniciar Sesion">
            </form>
            <a href="login.php">REGRESAR</a>
       </div>
    </div> 
    </main>
  </body>
</html>