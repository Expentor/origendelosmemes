<?php

 session_start();

 if (!isset($_SESSION["admin"])) {
   header("Location: index.php");
   return;
 }

  require "database.php";

  $id = $_GET["id"];

  $statement = $conn->prepare("SELECT * FROM users WHERE id = :id LIMIT 1");
  $statement->execute([":id" => $id]);

  if ($statement->rowCount() == 0) {
    http_response_code(404);
    echo("HTTP 404 NOT FOUND");
    return;
  }

  $users = $statement->fetch(PDO::FETCH_ASSOC);

  $error = null;

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["username"])) {
      $error = "Porfavor rellene todos los espacios.";
    } else if ($_FILES["picture"]["error"] == 4) {

      $statement = $conn->prepare("UPDATE users SET username = :username WHERE id = :id");
      $statement->execute([
        ":id" => $id,
        ":username" => $_POST["username"],
      ]);

      $_SESSION["flash"] = ["message" => "Usuario {$_POST['username']} actualizado."];

      header("Location: users.php");
      return;
    } else {
      $picture=$_POST['picture'];
      
      $fecha = new DateTime();

      $picture=$_FILES['picture']['name'].$fecha->getTimestamp();
      $path=$_FILES['picture']['tmp_name'];

      $destiny = "images/".$picture;
      move_uploaded_file($path, $destiny);

      $statement = $conn->prepare("UPDATE users SET username = :username, picture = :destiny  WHERE id = :id");
      $statement->execute([
        ":id" => $id,
        ":username" => $_POST["username"],
        ":destiny" => $destiny,
      ]);

      $_SESSION["flash"] = ["message" => "Usuario {$_POST['username']} actualizado."];

      header("Location: users.php");
      return;
    }
  }
?>


<?php require "partials/header.php" ?>

<div class="container pt-5">
  <div class="row justify-content-center">
    <div class="col-md-8 mt-5">
      <div class="card">
        <div class="card-header">Editar usuario</div>
        <div class="card-body">
          <?php if ($error): ?>
            <p class="text-danger">
              <?= $error ?>
            <?php endif ?>
          <form method="POST" enctype="multipart/form-data" action="edit_user.php?id=<?= $users["id"] ?>">

            <div class="mb-3 row">
              <label for="picture" class="col-md-4 col-form-label text-md-end">Imagen</label>

              <div class="col-md-6">
                <input type="file" class="form-control" name="picture" placeholder="Imagen" autofocus>
              </div>
            </div>

            <div class="mb-3 row">
              <label for="username" class="col-md-4 col-form-label text-md-end">Username</label>

              <div class="col-md-6">
                <input value="<?= $users["username"]?>" id="username" type="text" class="form-control" name="username" autocomplete="username" autofocus>
              </div>
          </div>

            <div class="mb-3 row">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">Editar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>