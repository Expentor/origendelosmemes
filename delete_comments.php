<?php
  require "database.php";

  session_start();

  $id = $_GET["id"];
  $post_id = $_GET["post_id"];

  if (!isset($_SESSION["admin"]) && !isset($_SESSION["user"])) {
    header("Location: articles.php?id=$post_id");
  }

  $statement = $conn->prepare("DELETE FROM comments WHERE id = :id");
  $statement->execute([":id" => $id]);

  if ($statement->rowCount() == 0) {
    http_response_code(404);
    echo("HTTP 404 NOT FOUND");
    return;
  }

  $conn->prepare("DELETE FROM comments WHERE id = :id")->execute([":id" => $id]);

  header("Location: articles.php?id=$post_id");