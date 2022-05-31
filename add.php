<?php
  require "database.php";

session_start();

/*if (!isset($_SESSION["admin"])) {
  header("Location: index.php");
  return;
}*/

  $categories = $conn->query("SELECT * FROM Category");

  $error = null;

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["title"]) || empty($_POST["publish_date"]) || empty($_POST["information"]) || empty($_POST["category"])) {
      $error = "Porfavor rellene todos los espacios.";
    } else {
      $title = $_POST["title"];
      $publish_date = $_POST["publish_date"];
      $information = $_POST["information"];
      $author=$_POST['author'];
      $picture=$_FILES['picture']['name'];
      $path=$_FILES['picture']['tmp_name'];
      $category = $_POST['category'];
      $destiny = "fotos/".$picture;
      copy($path, $destiny);

      $statement = $conn->prepare("INSERT INTO articles (author, title, subtitle, information, picture, publish_date, origin, category, links) VALUES (:author, :title, :subtitle, :information, :destiny, :publish_date, :origin, :category, :links)");
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

      header("Location: panelAdmins.php");
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

            <!-- NUEVO ADD DE CATEGORY -->
            <div class="mb-3 row">
              <label for="category" class="col-md-4 col-form-label text-md-end">Categoria</label>

              <div class="col-md-6">
                <div>
                    <select class="form-select" name="category">
                            <option selected="selected">Seleccione una categoria</option>
                            <?php
                            $title = "title";
                            $id_cat = "id_cat";
                            
                            foreach($categories as $item){
                                echo "<option value='$item[$id_cat]'>$item[$title]</option>";
                            }
                            ?>
                    </select>
                </div>

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