<?php

session_start();

if (!isset($_SESSION["admin"])) {
  header("Location: index.php");
  return;
}

require "database.php";

$id = $_GET["id"];

$statement = $conn->prepare("SELECT * FROM articles WHERE id = :id LIMIT 1");
$statement->execute([":id" => $id]);

if ($statement->rowCount() == 0) {
  http_response_code(404);
  echo ("HTTP 404 NOT FOUND");
  return;
}

$article = $statement->fetch(PDO::FETCH_ASSOC);

$error = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["title"]) || empty($_POST["publish_date"]) || empty($_POST["information"])) {
    $error = "Porfavor rellene todos los espacios.";
  } else if ($_FILES["picture"]["error"] == 4 ) {

    $statement = $conn->prepare("UPDATE articles SET title = :title, subtitle = :subtitle, publish_date = :publish_date, information = :information,
      author = :author, origin = :origin, links = :links WHERE id = :id");
    $statement->execute([
      ":id" => $id,
      ":title" => $_POST["title"],
      ":subtitle" => $_POST["subtitle"],
      ":publish_date" => $_POST["publish_date"],
      ":information" => $_POST["information"],
      ":author" => $_POST["author"],
      ":origin" => $_POST["origin"],
      ":links" => $_POST["links"],
    ]);

    $_SESSION["flash"] = ["message" => "Artículo {$_POST['title']} actualizado."];

    header("Location: panelAdmins.php");
    return;
  } else {
    $fecha = new DateTime();

    $picture = $_FILES['picture']['name'] . $fecha->getTimestamp();
    $path = $_FILES['picture']['tmp_name'];

    $destiny = "images/" . $picture;
    move_uploaded_file($path, $destiny);

    $statement = $conn->prepare("UPDATE articles SET title = :title, subtitle = :subtitle, publish_date = :publish_date, information = :information,
      author = :author, picture = :destiny, origin = :origin, links = :links WHERE id = :id");
    $statement->execute([
      ":id" => $id,
      ":title" => $_POST["title"],
      ":subtitle" => $_POST["subtitle"],
      ":publish_date" => $_POST["publish_date"],
      ":information" => $_POST["information"],
      ":author" => $_POST["author"],
      ":destiny" => $destiny,
      ":origin" => $_POST["origin"],
      ":links" => $_POST["links"],
    ]);

    $_SESSION["flash"] = ["message" => "Artículo {$_POST['title']} actualizado."];

    header("Location: panelAdmins.php");
    return;
  }
}
?>


<?php require "partials/header.php" ?>

<div class="container pt-5">
  <div class="row justify-content-center">
    <div class="col-md-8 mt-5">
      <div class="card">
        <div class="card-header">Editar articulo</div>
        <div class="card-body">
          <?php if ($error) : ?>
            <p class="text-danger">
              <?= $error ?>
            <?php endif ?>
            <form method="POST" enctype="multipart/form-data" action="edit.php?id=<?= $article["id"] ?>">
              <div class="mb-3 row">
                <label for="title" class="col-md-4 col-form-label text-md-end">Título</label>

                <div class="col-md-6">
                  <input value="<?= $article["title"] ?>" id="title" type="text" class="form-control" name="title" autocomplete="title" autofocus>
                </div>
              </div>

              <div class="mb-3 row">
                <label for="subtitle" class="col-md-4 col-form-label text-md-end">Subtitulo</label>

                <div class="col-md-6">
                  <input value="<?= $article["subtitle"] ?>" id="subtitle" type="text" class="form-control" name="subtitle" autocomplete="subtitle" autofocus>
                </div>
              </div>

              <div class="mb-3 row">
                <label for="picture" class="col-md-4 col-form-label text-md-end">Imagen</label>

                <div class="col-md-6">
                  <input type="file" class="form-control" name="picture" placeholder="Imagen" autofocus>
                </div>
              </div>

              <div class="mb-3 row">
                <label for="author" class="col-md-4 col-form-label text-md-end">Autor</label>

                <div class="col-md-6">
                  <input value="<?= $article["author"] ?>" id="author" type="text" class="form-control" name="author" autocomplete="author" autofocus>
                </div>
              </div>

              <div class="mb-3 row">
                <label for="origin" class="col-md-4 col-form-label text-md-end">Origen</label>

                <div class="col-md-6">
                  <input value="<?= $article["origin"] ?>" id="origin" type="text" class="form-control" name="origin" autocomplete="origin" autofocus>
                </div>
              </div>

              <div class="mb-3 row">
                <label for="category" class="col-md-4 col-form-label text-md-end">Categoría</label>

                <div class="col-md-6">
                  <input value="<?= $article["category"] ?>" id="category" type="text" class="form-control" name="category" autocomplete="category" autofocus>
                </div>
              </div>

              <div class="mb-3 row">
                <label for="publish_date" class="col-md-4 col-form-label text-md-end">Fecha de publicación</label>

                <div class="col-md-6">
                  <input value="<?= $article["publish_date"] ?>" id="publish_date" type="text" class="form-control" name="publish_date" autocomplete="date" placeholder="YYYY-MM-DD" autofocus>
                </div>
              </div>

              <div class="mb-3 row">
                <label for="information" class="col-md-4 col-form-label text-md-end">Información</label>

                <div class="col-md-6">
                  <textarea id="information" type="text" class="form-control" name="information" autocomplete="information" autofocus><?= $article["information"] ?></textarea>
                </div>
              </div>

              <div class="mb-3 row">
                <label for="links" class="col-md-4 col-form-label text-md-end">Links</label>

                <div class="col-md-6">
                  <input value="<?= $article["links"] ?>" id="links" type="text" class="form-control" name="links" autofocus>
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