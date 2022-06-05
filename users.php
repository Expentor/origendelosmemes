<?php

require "database.php";

session_start();

if (!isset($_SESSION["admin"])) {
  header("Location: index.php");
  return;
}

$users = $conn->query("SELECT * FROM users ORDER BY id DESC");

?>

<?php require "partials/header.php" ?>
<a href="index.php" class="btn btn-primary mb-2 mt-5 mx-5">Regresar al index</a>
<a href="panelAdmins.php" class="btn btn-success mb-2 mt-5 mx-5">Regresar al panel de articulos</a>
<div class="container pt-4 p-3">
  <h2 class="mb-5">
    <center>Gestor de usuarios</center>
  </h2>
  <div class="row">
    <?php foreach ($users as $users) { ?>
      <div class="col-md-4 mb-3">
        <div class="card text-center">
          <div class="card-body">
            <h3 class="card-title text-capitalize"><?= $users["username"] ?></h3>
            <div><?= '<img width="200px" src="' . $users["picture"] . '">' ?></div>
            <div>
              <p class="m-2"><?= $users["email"] ?></p>
            </div>
            <a href="edit_user.php?id=<?= $users["id"] ?>" class="btn btn-success mb-2">Editar informacion</a>
            <div class="container text-center">
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Borrar Usuario</button>
            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <h5>¿Está seguro que desea eliminar este usuario?</h5>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <a href="delete_user.php?id=<?= $users["id"] ?>" class="btn btn-primary">Borrar Usuario</a>
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