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

        if(!password_verify($_POST["password"], $user["password"])) {
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
<?php require "partials/header.php" ?>
  <div class="blogem-banner">
      <div class="container pt-5">
        <div class="row justify-content-center">
          <div class="col-md-8">
          <h2 class="mb-5"> <center>Cambiar contraseña</center></h2>
            <div class="card">
              <div class="card-header">Cambiar contraseña</div>
              <div class="card-body">
                <?php if ($error): ?>
                  <p class="text-danger">
                    <?= $error ?>
                  <?php endif ?>
                <form method="POST" action="login.php">
                  <div class="mb-3 row">
                    <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>

                    <div class="col-md-6">
                      <input id="email" type="email" class="form-control" name="email" autocomplete="email" autofocus>
                    </div>
                  </div>

                  <div class="mb-3 row">
                    <label for="password" class="col-md-4 col-form-label text-md-end">Contraseña anterior</label>

                    <div class="col-md-6">
                      <input id="password" type="password" class="form-control" name="password" autocomplete="password" autofocus>
                    </div>
                  </div>

                  <div class="mb-3 row">
                    <label for="password" class="col-md-4 col-form-label text-md-end">Contraseña nueva</label>

                    <div class="col-md-6">
                      <input id="password" type="password" class="form-control" name="password" autocomplete="password" autofocus>
                    </div>
                  </div>

                  <div class="mb-3 row">
                    <label for="password" class="col-md-4 col-form-label text-md-end">Confirmar contraseña nueva</label>

                    <div class="col-md-6">
                      <input id="password" type="password" class="form-control" name="password" autocomplete="password" autofocus>
                    </div>
                  </div>

                  <div class="mb-3 row">
                    <div class="col-md-6 offset-md-4">
                      <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                    </div>
                  </div>
                </form>
                <a href="login.php">Regresar</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
    </main>
  </body>
</html>