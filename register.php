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
          ->prepare("INSERT INTO users (username, email, password, age) VALUES (:username, :email, :password, :age)")
          ->execute([
            ":username" => $_POST["username"],
            ":age" => $_POST["age"],
            ":email" => $_POST["email"],
            ":password" => password_hash($_POST["password"], PASSWORD_BCRYPT)
          ]);

          header("Location: index.php");
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
    
    <form method="POST" action="register.php" class="form-box2 animate__animated animate__backInDown">
        <h1 class="form-title2">Registrarse</h1>
        <input type="text" id="username" name="username" autocomplete="name" placeholder="Nombre de usuario">
        <input type="text" id="age" name="age" autocomplete="age" placeholder="Edad">
        <input type="text" id="email" name="email" autocomplete="mail" placeholder="Email">
        <input type="password" id="password" name="password" autocomplete="password" placeholder="Contraseña">
        <button type="submit"> Ingresar </button>
        <a href="login.php">Iniciar Sesión</a>
    </form>
    </body>
</html>