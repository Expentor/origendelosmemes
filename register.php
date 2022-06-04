<?php
require "database.php";

$error = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $picture = $_FILES['picture']["type"];
  if (empty($_POST["username"]) || empty($_POST["email"]) || empty($_POST["password"]) || empty($_POST["confirm_password"])) {
    $error = "Porfavor rellene todos los espacios.";
  } else if (!str_contains($_POST["email"], "@")) {
    $error = "El formato de email es incorrecto.";
  } else if ($_POST["password"] != $_POST["confirm_password"]) {
    $error = "Las contraseñas no son iguales.";
  } else if (empty($_FILES['picture']["type"])) {
    $error = "Es obligatorio que seleccione una foto de perfil.";
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
      if ($picture == "image/png" || $picture == "image/jpeg" || $picture == "image/gif") {
        $fecha = new DateTime();
        $picture = $_FILES['picture']['name'] . $fecha->getTimestamp();
        $path = $_FILES['picture']['tmp_name'];

        $destiny = "pfps/" . $picture;
        move_uploaded_file($path, $destiny);

        $conn
          ->prepare("INSERT INTO users (username, email, password, picture) VALUES (:username, :email, :password, :destiny)")
          ->execute([
            ":username" => $_POST["username"],
            ":email" => $_POST["email"],
            ":destiny" => $destiny,
            ":password" => password_hash($_POST["password"], PASSWORD_BCRYPT)
          ]);

        $statement  = $conn->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $statement->bindParam(":email", $_POST["email"]);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        session_start();
        $_SESSION["user"] = $user;

        header("Location: index.php");
      } else {
        $error = "Sólo se aceptan archivos png, jpg y gif";
      }
    }
  }
}
?>

<?php require "partials/header-navbar.php" ?>
<div class="login-banner">
  <div class="login-box">
    <img class="avatar" src="img/ODM.png" alt="Logo de ODM">
    <h2>Regístrate</h2>
    <?php if ($error) : ?>
      <p class="text-danger">
        <?= $error ?>
      <?php endif ?>
      <form method="POST" action="register.php" enctype="multipart/form-data">
        <form>

          <input id="username" type="text" name="username" autofocus placeholder="Ingresa tu nombre de usuario">
          <center>
            <h5>Foto de perfil</h5>
          </center>
          <input type="file" value="<?php echo $file['picture'] ?>" type="file" class="form-control" name="picture" placeholder="Imagen" autofocus>
          <input id="email" type="text" name="email" autofocus placeholder="Ingresa tu Email">
          <input id="password" type="password" name="password" autofocus placeholder="Ingresa tu contraseña">
          <input id="confirm_password" type="password" name="confirm_password" autofocus placeholder="Confirma tu contraseña">
          <input type="submit" value="Registrarse">
        </form>
        <center>
          <p>¿Ya tienes cuenta?</p> <a href="login.php">
            <p>INICIA SESIÓN
          </a>
        </center>

  </div>
</div>
</main>
</body>

</html>