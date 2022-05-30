<!-- PHP COMMENTS -->
<?php
require "database.php";
session_start();
$error = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["comments"])) {
    $error = "No se puede ingresar un comentario en blanco.";
  } else if (!isset($_SESSION["admin"]) || !isset($_SESSION["admin"])) {
    $error = "Primero debes de iniciar sesion para poder comentar";
  } else {
    
    // $author_admin = $_SESSION["admin"]["username"];
    $post_id = $_GET["id"];
    if (isset($_SESSION["user"])) {
      $author = $_SESSION["user"]["username"];
      $profile_picture = $_SESSION["user"]["picture"];
    } else if (isset($_SESSION["admin"])) {
      $author = $_SESSION["admin"]["username"];
      $profile_picture = $_SESSION["admin"]["picture"];
    }

    $comments = $_POST["comments"];

    $statement = $conn->prepare("INSERT INTO comments (comments, author, post_id, profile_picture) VALUES (:comments, :author, :post_id, :profile_picture)");
    $statement->bindParam(":comments", $_POST["comments"]);
    $statement->bindParam(":author", $author);
    $statement->bindParam(":post_id", $post_id);
    $statement->bindParam(":profile_picture", $profile_picture);
    $statement->execute();

    header("Location: articles.php?id=$post_id");
  }
  return $error;
}
