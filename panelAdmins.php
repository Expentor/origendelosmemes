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
<a href="index.php" class="btn btn-primary mb-2 mt-5 mx-5">Regresar al index</a>
<a href="add.php" class="btn btn-success mb-2 mt-5 mx-5">Añadir artículo</a>
<div class="container pt-4 p-3">
  <h2 class="mb-5"> <center>Panel de control para admins</center></h2>
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
        <div><?= '<img width="200px" src="'.$articles["picture"].'">' ?></div>
        <div>
        <p class="m-2"><?= $articles["author"] ?></p>
        <p class="m-2"><?= $articles["publish_date"] ?></p>
        <p class="m-2"><?= $articles["origin"] ?></p>
        </div>
        <p class="m-2"><?= substr($articles["information"],0,300) ?>...</p>
        <p class="m-2"><?= $articles["links"] ?></p>
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
