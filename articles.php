<?php
session_start();
require "database.php";

$id = $_GET["id"];

$statement = $conn->prepare("SELECT * FROM articles WHERE id = :id LIMIT 1");
$statement->execute([":id" => $id]);

if ($statement->rowCount() == 0) {
    http_response_code(404);
    echo ("HTTP 404 NOT FOUND");
    return;
}

$article = $statement->fetch(PDO::FETCH_ASSOC);
?>

<?php
$post_id = $_GET["id"];

// $statement2 = $conn->prepare("SELECT * FROM comments WHERE post_id = :id");
// $statement2->execute([":id" => $id]);

// $comments = $statement2->fetch(PDO::FETCH_ASSOC);

$comments = $conn->query("SELECT * FROM comments WHERE post_id = $id LIMIT 10 OFFSET 0");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARTÍCULO</title>
    <link rel="stylesheet" type="text/css" href="articuloscss.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <!--<link rel="stylesheet" type="text/css" href="styles.css">-->
</head>

<body>
    <!--<header>
        <img class="logo" src="bandera.jpg" alt="">
    </header> -->
    <nav>
        <!--<div class="logo">Weblog</div>-->
        <ul>
            <li class="nav-item"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door" viewBox="0 0 16 16">
                    <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z" />
                </svg><a href="index.php">Página principal</a></li>
            <li class="nav-item"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                </svg><a href="aboutUs.html">About Us</a></li>
            <li class="nav-item"><a href="#">Política de privacidad</a></li>
            <?php if (isset($_SESSION["user"]) || isset($_SESSION["admin"])) : ?>
                <!-- Subject to change -->
                <li class="different-li"><a href="logout.php" class="button-link">Salir de la sesión</a></li>
            <?php else : ?>
                <li class="different-li"><a href="login.php" class="button-link">Iniciar sesión</a></li>
                <li class="different-li"><a href="register.php" class="button-link">Registrarse</a></li>
            <?php endif ?>
            <?php if (isset($_SESSION["user"])) :
            ?>
                <div>
                    <h5><?= $_SESSION["user"]["username"] ?></h5>
                </div>
            <?php endif ?>
            <?php if (isset($_SESSION["admin"])) :
            ?>
                <div>
                    <h5><?= $_SESSION["admin"]["email"] ?></h5>
                </div>
            <?php endif ?>
        </ul>
    </nav>
    </ul>
    </nav>
    <div class="container">
        <div class="section">
            <!--<div class="col span_2_of_3">-->
            <div class="blog-post">
                <p><img src="<?= $article["picture"] ?>" alt=""></p>
                <p>
                <h1 class="blog-title-principal"><?= $article["title"] ?></h1>
                </p>
                <div class="tabla-post-left">
                    <!--<img src="Firma .jpg" alt="">-->
                    <h1 class="blog-subtitulo">Fecha:</h1>
                    <p class="side-content"><?= $article["publish_date"] ?></p>
                    <h1 class="blog-subtitulo">Autor:</h1>
                    <p class="side-content"><?= $article["author"] ?></p>
                </div>
                <div class="tabla-post-right">
                    <h1 class="blog-subtitulo">Origen:</h1>
                    <p class="side-content"><?= $article["origin"] ?></p>
                    <h1 class="blog-subtitulo">Categoría</h1>
                    <p class="side-content"><?= $article["category"] ?></p>
                </div>
                <!--<p class="blog-content"></p>-->
            </div>
            <!--</div>-->
        </div>
        <div class="section">
            <div class="side-post">
                <h1 class="blog-title">Informacion:</h1>
                <p class="side-content"><?= $article["information"] ?></p>
                <hr>
                <h1 class="blog-title">Referencias</h1>
                <p class="side-content"><?= $article["links"] ?></p>
            </div>
        </div>
        <div class="section">
            <div class="side-comment">
                <div class="posts-wrapper">
                    <i class="fa fa-thumbs-up like-btn" class="fa fa-thumbs-o-up like-btn" data-id=""></i>
                    <span class="likes"></span>
                    <i class="fa fa-thumbs-down dislike-btn" class="fa fa-thumbs-o-down dislike-btn" data-id=""></i>
                    <span class="dislikes"></span>
                </div>
                <!-- <button type="button" class="boton-reacciones">
                    <span class="texto-boton">Reaccionar</span>
                        <div class="reacciones">
                            <div class="reaccion">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-hand-thumbs-up" viewBox="0 0 16 16">
                                    <path d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2.144 2.144 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a9.84 9.84 0 0 0-.443.05 9.365 9.365 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111L8.864.046zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a8.908 8.908 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.224 2.224 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.866.866 0 0 1-.121.416c-.165.288-.503.56-1.066.56z"/>
                                </svg>
                                <span class="nombre-reccion">
                                    Like
                                </span>
                            </div>
                            <div class="reaccion">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-hand-thumbs-down" viewBox="0 0 16 16">
                                    <path d="M8.864 15.674c-.956.24-1.843-.484-1.908-1.42-.072-1.05-.23-2.015-.428-2.59-.125-.36-.479-1.012-1.04-1.638-.557-.624-1.282-1.179-2.131-1.41C2.685 8.432 2 7.85 2 7V3c0-.845.682-1.464 1.448-1.546 1.07-.113 1.564-.415 2.068-.723l.048-.029c.272-.166.578-.349.97-.484C6.931.08 7.395 0 8 0h3.5c.937 0 1.599.478 1.934 1.064.164.287.254.607.254.913 0 .152-.023.312-.077.464.201.262.38.577.488.9.11.33.172.762.004 1.15.069.13.12.268.159.403.077.27.113.567.113.856 0 .289-.036.586-.113.856-.035.12-.08.244-.138.363.394.571.418 1.2.234 1.733-.206.592-.682 1.1-1.2 1.272-.847.283-1.803.276-2.516.211a9.877 9.877 0 0 1-.443-.05 9.364 9.364 0 0 1-.062 4.51c-.138.508-.55.848-1.012.964l-.261.065zM11.5 1H8c-.51 0-.863.068-1.14.163-.281.097-.506.229-.776.393l-.04.025c-.555.338-1.198.73-2.49.868-.333.035-.554.29-.554.55V7c0 .255.226.543.62.65 1.095.3 1.977.997 2.614 1.709.635.71 1.064 1.475 1.238 1.977.243.7.407 1.768.482 2.85.025.362.36.595.667.518l.262-.065c.16-.04.258-.144.288-.255a8.34 8.34 0 0 0-.145-4.726.5.5 0 0 1 .595-.643h.003l.014.004.058.013a8.912 8.912 0 0 0 1.036.157c.663.06 1.457.054 2.11-.163.175-.059.45-.301.57-.651.107-.308.087-.67-.266-1.021L12.793 7l.353-.354c.043-.042.105-.14.154-.315.048-.167.075-.37.075-.581 0-.211-.027-.414-.075-.581-.05-.174-.111-.273-.154-.315l-.353-.354.353-.354c.047-.047.109-.176.005-.488a2.224 2.224 0 0 0-.505-.804l-.353-.354.353-.354c.006-.005.041-.05.041-.17a.866.866 0 0 0-.121-.415C12.4 1.272 12.063 1 11.5 1z"/>
                                </svg>
                                <span class="nombre-reccion">
                                    Dislike
                                </span>
                            </div>
                        </div>
                </button> -->
                <!--<div class="comentar">
                            <h1 class="comment">Comentarios</h1>
                        </div>-->
                <?php if ($error) : ?>
                    <p class="text-danger">
                        <?= $error ?>
                    <?php endif ?>
                <h1 class="blog-title">Comentarios:</h1>
                <form method="POST" action="comments.php?id=<?= $id ?>" class="form_comentarios">
                    <textarea name="comments" id="comments" placeholder="Comentario"></textarea>
                    <button class="btn btn1" type="submit">Comentar</button>
                </form>

                <?php foreach ($comments as $comments) { ?>
                    <div class="comments">
                        <div class="photo-perfil">
                            <?= '<img src="' . $comments["profile_picture"] . '">' ?>
                        </div>
                        <div class="info-comments">
                            <div class="header">
                                <h4><?= $comments["author"] ?></h4>
                                <h5><?= $comments["datecom"] ?></h5>
                                <?php if (isset($_SESSION["user"])) : ?>
                                    <?php if ($_SESSION["user"]["username"] == $comments["author"]) : ?>
                                        <div>
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
                                    <?php endif ?>
                                <?php endif ?>

                                <?php if (isset($_SESSION["admin"])) : ?>
                                    <?php if ($_SESSION["admin"]["username"] == $comments["author"]) : ?>
                                        <div>
                                            <button><i class="fa-solid fa-gear"></i></button>
                                        </div>
                                    <?php endif ?>
                                <?php endif ?>
                            </div>
                            <p><?= $comments["comments"] ?></p>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <footer id="footer">
        <div class="redes-sociales">
            <div class="red-social">
                <a href="https://m.facebook.com/Blogem-105007245467226/?ref=bookmarks"><i class="fab fa-facebook"></i></a>
            </div>
            <div class="red-social">
                <a href="https://twitter.com/blogem"><i class="fab fa-twitter"></i></a>
            </div>
        </div>
        <div class="newsletter">
            <form>
                <h2>SUSCRÍBETE PARA RECIBIR NOTIFICACIONES DE ARTÍCULOS NUEVOS PUBLICADOS</h2>
                <input type="email" placeholder="Introduce tu Email">
                <input type="submit" value="SUSCRIBIRME" class="sub-to-newsletter">
            </form>
        </div>
        <div class="derechos">
            <p><b>BLOGEM DEVELOPER TEAM</b> - Derechos Reservados</p>
        </div>
    </footer>
    <script src="https://kit.fontawesome.com/62ea397d3a.js"></script>
    <script src="script.js"></script>
</body>

</html>