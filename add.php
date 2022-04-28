
<?php
  require "database.php";

  session_start();

  if (!isset($_SESSION["admin"])) {
    header("Location: index.php");
    return;
  }

  $error = null;

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["title"]) || empty($_POST["publish_date"]) || empty($_POST["information"])) {
      $error = "Porfavor rellene todos los espacios.";
    } else {
      $title = $_POST["title"];
      $publish_date = $_POST["publish_date"];
      $information = $_POST["information"];

      $statement = $conn->prepare("INSERT INTO articles (title, publish_date, information) VALUES (:title, :publish_date, :information)");
      $statement->bindParam(":title", $_POST["title"]);
      $statement->bindParam(":publish_date", $_POST["publish_date"]);
      $statement->bindParam(":information", $_POST["information"]);
      $statement->execute();

      header("Location: articles.php");
    }
  }
  
    
?>

<?php require "partials/header.php" ?>

<div class="container pt-5">
  <div class="row justify-content-center">
    <div class="col-md-8 mt-5">
      <div class="card">
        <div class="card-header">Añadir un nuevo articulo</div>
        <div class="card-body">
          <?php if ($error): ?>
            <p class="text-danger">
              <?= $error ?>
            <?php endif ?>
          <form method="POST" action="add.php">
            <div class="mb-3 row">
              <label for="title" class="col-md-4 col-form-label text-md-end">Título</label>

              <div class="col-md-6">
                <input id="title" type="text" class="form-control" name="title" autocomplete="title" autofocus>
              </div>
            </div>

            <div class="mb-3 row">
              <label for="publish_date" class="col-md-4 col-form-label text-md-end">Fecha de publicación</label>

              <div class="col-md-6">
                <input id="publish_date" type="text" class="form-control" name="publish_date" autocomplete="date" placeholder="YYYY-MM-DD" autofocus>
              </div>
            </div>

            <div class="mb-3 row">
              <label for="information" class="col-md-4 col-form-label text-md-end">Información</label>

              <div class="col-md-6">
                <input id="information" type="text" class="form-control" name="information" autocomplete="information" autofocus>
              </div>
            </div>

            <div class="mb-3 row">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">Añadir</button>
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
