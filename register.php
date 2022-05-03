<?php
  require "database.php";

  $error = null;

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["username"]) || empty($_POST["email"]) || empty($_POST["password"]) || empty($_POST["confirm_password"])){
      $error = "Porfavor rellene todos los espacios.";
    } else if (!str_contains($_POST["email"], "@")) {
      $error = "El formato de email es incorrecto.";
    } else if ($_POST["password"] != $_POST["confirm_password"]) {
      $error = "Las contraseñas no son iguales.";
    } else {
      $select  = $conn->prepare("SELECT * FROM users WHERE username = :username");
      $select->bindParam(":username", $_POST["username"]);
      $select->execute();

      $statement  = $conn->prepare("SELECT * FROM users WHERE email = :email");
      $statement->bindParam(":email", $_POST["email"]);
      $statement->execute();
      if ($statement->rowCount() > 0) {
        $error = "Este email ya se está usando.";
      } else if ($select->rowCount() > 0) {
        $error = "Este usuario ya se está usando.";
      } else {
        $conn
          ->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)")
          ->execute([
            ":username" => $_POST["username"],
            ":email" => $_POST["email"],
            ":password" => password_hash($_POST["password"], PASSWORD_BCRYPT)
          ]);

          $statement  = $conn->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
          $statement->bindParam(":email", $_POST["email"]);
          $statement->execute();
          $user = $statement->fetch(PDO::FETCH_ASSOC);

          session_start();
          $_SESSION["user"] = $user;

          header("Location: index.php");
      }
    }
  }
?>

<?php require "partials/header.php" ?>

      <div class="container pt-5">
        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">Registrarse</div>
              <div class="card-body">
                <?php if ($error): ?>
                  <p class="text-danger">
                    <?= $error ?>
                  <?php endif ?>
                <form method="POST" action="register.php">
                  <div class="mb-3 row">
                    <label for="username" class="col-md-4 col-form-label text-md-end">Username</label>

                    <div class="col-md-6">
                      <input id="username" type="text" class="form-control" name="username" autocomplete="username" autofocus>
                    </div>
                  </div>

                  <div class="mb-3 row">
                    <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>

                    <div class="col-md-6">
                      <input id="email" type="email" class="form-control" name="email" autocomplete="email" autofocus>
                    </div>
                  </div>

                  <div class="mb-3 row">
                    <label for="password" class="col-md-4 col-form-label text-md-end">Contraseña</label>

                    <div class="col-md-6">
                      <input id="password" type="password" class="form-control" name="password" autocomplete="password" autofocus>
                    </div>
                  </div>

                  <div class="mb-3 row">
                    <label for="confirm_password" class="col-md-4 col-form-label text-md-end">Confirmar Contraseña</label>

                  <div class="col-md-6">
                      <input id="confirm_password" type="password" class="form-control" name="confirm_password" autofocus>
                    </div>
                  </div>

                  <div class="mb-3 row">
                    <div class="col-md-6 offset-md-4">
                      <button type="submit" class="btn btn-primary">Registrarse</button>
                    </div>
                  </div>
                </form>
                <a href="login.php">¿Ya tienes una cuenta?</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </body>
</html>