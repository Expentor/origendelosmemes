<?php
  require "database.php";

  $error = null;

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["username"]) || empty($_POST["age"]) || empty($_POST["email"]) || empty($_POST["password"])) {
      $error = "Please fill all the fields.";
    } else if (!str_contains($_POST["email"], "@")) {
      $error = "Email format is incorrect.";
    } else {
      $statement  = $conn->prepare("SELECT * FROM users WHERE email = :email");
      $statement->bindParam(":email", $_POST["email"]);
      $statement->execute();

      if ($statement->rowCount() > 0) {
        $error = "This email is taken.";
      } else {
        $conn
          ->prepare("INSERT INTO userorigendelosmemes (username, age, email, password) VALUES (:username, :age, :email, :password)")
          ->execute([
            ":username" => $_POST["username"],
            ":age" => $_POST["age"],
            ":email" => $_POST["email"],
            ":password" => $_POST["password"],
          ]);

          header("Location: home.php");
      }
    }
  }
?>

<?php require "partials/navbar.php" ?>
    
    <form action="register.php" class="form-box2 animate__animated animate__backInDown">
        <h1 class="form-title2">Registrarse</h1>
        <input type="text" placeholder="Nombre de usuario">
        <input type="number" placeholder="Edad">
        <input type="email" placeholder="Email">
        <input type="password" placeholder="Contraseña">
        <button type="submit">
            Ingresar
        </button>
        <a href="login.php">Iniciar Sesión</a>
    </form>

<?php require "partials/footer.php" ?>