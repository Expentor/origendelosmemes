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
      $subtitle = $_POST["subtitle"];
      $publish_date = $_POST["publish_date"];
      $author=$_POST['author'];

      $picture=$_FILES['picture']["type"];

      if($picture == "image/png" || $picture == "image/jpeg" || $picture == "image/gif"){
        $fecha = new DateTime();
        $picture= $_FILES['picture']['name'].$fecha->getTimestamp();
        $path=$_FILES['picture']['tmp_name'];

        $destiny = "fotos/".$picture;
        move_uploaded_file($path, $destiny);

        $origin = $_POST["origin"];
        $category = $_POST["category"];
        $links = $_POST["links"];
        $information = $_POST["information"];


        $statement = $conn->prepare("INSERT INTO articles (author, title, subtitle, information, picture, 
        publish_date, origin, category, links) VALUES (:author, :title, :subtitle, :information, :destiny, 
        :publish_date, :origin, :category, :links)");
        $statement->bindParam(":author", $_POST["author"]);
        $statement->bindParam(":title", $_POST["title"]);
        $statement->bindParam(":subtitle", $_POST["subtitle"]);
        $statement->bindParam(":information", $_POST["information"]);
        $statement->bindParam(":destiny", $destiny);
        $statement->bindParam(":publish_date", $_POST["publish_date"]);
        $statement->bindParam(":origin", $_POST["origin"]);
        $statement->bindParam(":category", $_POST["category"]);
        $statement->bindParam(":links", $_POST["links"]);
        $statement->execute();

        $_SESSION["flash"] = ["message" => "Artículo {$_POST['title']} añadido."];

        header("Location: panelAdmins.php");
        return;
      }else{
        $error = "Sólo se aceptan archivos png, jpg y gif";
      }
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
          <form method="POST" action="add.php" enctype="multipart/form-data">
            <div class="mb-3 row">
              <label for="title" class="col-md-4 col-form-label text-md-end">Título</label>

              <div class="col-md-6">
                <input id="title" type="text" class="form-control" name="title" autocomplete="title" autofocus>
              </div>
            </div>

            <div class="mb-3 row">
              <label for="subtitle" class="col-md-4 col-form-label text-md-end">Subtitulo</label>

              <div class="col-md-6">
                <input id="subtitle" type="text" class="form-control" name="subtitle" autocomplete="subtitle" autofocus>
              </div>
            </div>

            <div class="mb-3 row">
              <label for="picture" class="col-md-4 col-form-label text-md-end">Imagen</label>

              <div class="col-md-6">
                <input type="file" value="<?php echo $file['picture'] ?>" type="file" class="form-control" name="picture" placeholder="Imagen" autofocus>
              </div>
            </div>

            <div class="mb-3 row">
              <label for="author" class="col-md-4 col-form-label text-md-end">Autor</label>

              <div class="col-md-6">
                <input id="author" type="text" class="form-control" name="author" autocomplete="autor" autofocus>
              </div>
            </div>

            <div class="mb-3 row">
              <label for="origin" class="col-md-4 col-form-label text-md-end">Origen</label>

              <div class="col-md-6">
                <input id="origin" type="text" class="form-control" name="origin" autocomplete="origin" autofocus>
              </div>
            </div>

            <div class="mb-3 row">
              <label for="category" class="col-md-4 col-form-label text-md-end">Categoría</label>

              <div class="col-md-6">
                <input id="category" type="text" class="form-control" name="category" autocomplete="category" autofocus>
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
                <textarea id="information" type="text" class="form-control" name="information" autocomplete="information" autofocus></textarea>
              </div>
            </div>

            <div class="mb-3 row">
              <label for="links" class="col-md-4 col-form-label text-md-end">Links</label>

              <div class="col-md-6">
                <input id="links" type="text" class="form-control" name="links" autofocus>
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