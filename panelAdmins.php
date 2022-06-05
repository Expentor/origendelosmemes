<?php

require "database.php";

session_start();

if (!isset($_SESSION["admin"])) {
  header("Location: index.php");
  return;
}

$articles = $conn->query("SELECT * FROM articles ORDER BY id DESC");

?>

<?php require "partials/header.php" ?>
<a href="index.php" class="btn btn-primary mb-2 mt-5 mx-5">Regresar al index</a>
<a href="add.php" class="btn btn-success mb-2 mt-5 mx-5">Añadir artículo</a>
<a href="users.php" class="btn btn-success mb-2 mt-5 mx-5">Gestionar usuarios</a>
<div class="container pt-4 p-3">
  <h2 class="mb-5">
    <center>Panel de control para admins</center>
  </h2>
  <div class="row">

    <?php if ($articles->rowCount() == 0) : ?>
      <div class="col-md-4 mx-auto">
        <div class="card card-body text-center">
          <p>No existe ningun articulo publicado</p>
          <a href="add.php" class="btn btn-primary mb-2 mt-5 mx-5">Añadir artículo</a>
        </div>
      </div>
    <?php endif ?>
    <?php foreach ($articles as $articles) { ?>
      <div class="col-md-4 mb-3">
        <div class="card text-center">
          <div class="card-body">
            <h3 class="card-title text-capitalize"><?= $articles["title"] ?></h3>
            <div><?= '<img width="200px" src="' . $articles["picture"] . '">' ?></div>
            <div>
              <p class="m-2"><?= $articles["subtitle"] ?></p>
              <p class="m-2"><?= $articles["author"] ?></p>
              <p class="m-2"><?= $articles["publish_date"] ?></p>
            </div>
            <a href="edit.php?id=<?= $articles["id"] ?>" class="btn btn-success mb-2">Editar Artículo</a>
            <a href="articles.php?id=<?= $articles["id"] ?>" class="btn btn-info mb-2 mx-1"><i class="fas fa-eye"></i></a>
            <div class="container text-center">
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Borrar Articulo</button>
            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <h5>¿Está seguro que desea eliminar este artículo?</h5>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <a href="delete.php?id=<?= $articles["id"] ?>" class="btn btn-primary">Borrar Artículo</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>
<script src="https://kit.fontawesome.com/62ea397d3a.js"></script>
</body>

</html>