<?php

require "database.php";

session_start();

$articles = $conn->query("SELECT * FROM articles");

$error = NULL;

if (!isset($_SESSION["admin"])) {
  header("Location: index.php");
  return;
}

// if (!empty($_POST["email"]) && !empty($_POST["password"])) {
//   $statement  = $conn->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
//   $statement->bindParam(":email", $_POST["email"]);
//   $statement->execute();
//   $user = $statement->fetch(PDO::FETCH_ASSOC);

//   $error = NULL;

//   if(is_countable($statement) > 0 && password_verify($_POST["password"], $results["password"])) {
//     $_SESSION['user_id']=$results['id'];
//     header('Location: home.php');
//   }else{
//     $error = "Contraseña incorrecta.";
//   }
// }
?>

<?php require "partials/header.php" ?>
<div class="container pt-4 p-3">
  <div class="row">

  <?php if ($articles->rowCount() == 0): ?>
      <div class="col-md-4 mx-auto">
        <div class="card card-body text-center">
        <p>No contacts saved yet</p>
        <a href="add.php">Add One!</a>
      </div>
    </div>
  <?php endif?>
  <?php foreach ($articles as $article) { ?>
    <div class="col-md-4 mb-3">
    <div class="card text-center">
      <div class="card-body">
        <h3 class="card-title text-capitalize"><?= $article["name"] ?></h3>
        <p class="m-2"><?= $article["phone_number"] ?></p>
        <a href="edit.php?id=<?= $article["id"] ?>" class="btn btn-secondary mb-2">Edit Contact</a>
        <a href="delete.php?id=<?= $article["id"] ?>" class="btn btn-danger mb-2">Delete Contact</a>
      </div>
    </div>
  </div>
  <?php } ?>


  
  </div>
</div>

<?php require "partials/footer.php" ?>