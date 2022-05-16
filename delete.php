<?php
  require "database.php";

  session_start();

  if (!isset($_SESSION["admin"])) {
  header("Location: index.php");
  return;
  }

  $id = $_GET["id"];

  $statement = $conn->prepare("DELETE FROM articles WHERE id = :id");
  $statement->execute([":id" => $id]);

  if ($statement->rowCount() == 0) {
    http_response_code(404);
    echo("HTTP 404 NOT FOUND");
    return;
  }

  $conn->prepare("DELETE FROM articles WHERE id = :id")->execute([":id" => $id]);

  $_SESSION["flash"] = ["message" => "Artículo {$articles['id']} eliminado."];

  header("Location: panelAdmins.php");