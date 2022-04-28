<?php

require "database.php";

session_start();

if (!isset($_SESSION["admin"])) {
  header("Location: index.php");
  return;
}

$articles = $conn->query("SELECT * FROM articles");

?>

<?php require "partials/header.php" ?>
<a href="add.php" class="btn btn-primary mb-2 mt-5 mx-5">Añadir artículo</a>
<div class="container pt-4 p-3">
  <div class="row">

  <?php if ($articles->rowCount() == 0): ?>
      <div class="col-md-4 mx-auto">
        <div class="card card-body text-center">
        <p>No existe ningun articulo publicado</p>
        <a href="add.php" class="btn btn-primary mb-2 mt-5 mx-5">Añadir artículo</a>
      </div>
    </div>
  <?php endif?>
  <?php foreach ($articles as $articles) { ?>
    <div class="col-md-4 mb-3">
    <div class="card text-center">
      <div class="card-body">
        <h3 class="card-title text-capitalize"><?= $articles["title"] ?></h3>
        <p class="m-2"><?= $articles["publish_date"] ?></p>
        <p class="m-2"><?= $articles["information"] ?></p>
        <a href="edit.php?id=<?= $articles["id"] ?>" class="btn btn-secondary mb-2">Editar Artículo</a>
        <a href="delete.php?id=<?= $articles["id"] ?>" class="btn btn-danger mb-2">Borrar Artículo</a>
      </div>
    </div>
  </div>
  <?php } ?>
  </div>
</div>

</body>
</html>
