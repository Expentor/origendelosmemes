<?php
  require "database.php";

  $error = null;

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["email"]) || empty($_POST["password"])) {
      $error = "Please fill all the fields.";
    } else if (!str_contains($_POST["email"], "@")) {
      $error = "Email format is incorrect.";
    } else {
      $statement  = $conn->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
      $statement->bindParam(":email", $_POST["email"]);
      $statement->execute();

      if ($statement->rowCount() == 0) {
        $error = "Invalid credentials.";
      } else {
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if(!password_verify($_POST["password"], $user["password"])) {
          $error = "Invalid credentials.";
        } else {
          session_start();

          unset($user["password"]);

          header("Location: index.php");
        }
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="./estilo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
</head>
<body>
    
    <form metod="POST" action="login.php" class="form-box animate__animated animate__backInDown">
        <h1 class="form-title">Iniciar Sesión</h1>
        <input type="email" id="email" name="email" autocomplete="email" placeholder="Email">
        <input type="password" id="password" name="password" autocomplete="password" placeholder="Contraseña">
        <button type="submit" class="login-btn">
            Ingresar
        </button>
        <a href="register.php">Registrarse</a>
    </form>

</body>
</html>