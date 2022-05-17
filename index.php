<?php require "partials/header-navbar.php" ?>

<?php

require "database.php";

$articles = $conn->query("SELECT * FROM articles LIMIT 10 OFFSET 0");

?>

<div class="blogem-banner">
	<div class="container pt-5 mt-3">
			<?php if (isset($_SESSION["admin"])):?>
			<div class="container pt-5"class="b">
				<a href="panelAdmins.php" class="btn btn-primary">Ir al panel de control</a>
			</div>
				<?php endif ?>
			</div>
	<div class="blogem-banner__info">
		<div class="blogem-banner__info-container">
			<img src="img/ODM.png">
			<h1>ORIGEN DE LOS MEMES</h1>
			<h2>Un blog sobre <b>memes</b>...</h2>
		</div>
	</div>
	<div class="flecha">
		<a href="#articulos"><i class="fas fa-chevron-down"></i></a>
	</div>
</div>
</header>
<section id="articulos">
<h2 class="articulos-texto">ARTÍCULOS RECIENTES</h2>
<div class="articulos-container">
<?php foreach ($articles as $articles) { ?>
	<a href="articles.php?id=<?= $articles["id"]?>" style="background-image: url(<?= $articles["picture"] ?>);">
		<div class="articulo-data">
			<h2><?= $articles["title"] ?></h2>
			<?= $articles["subtitle"] ?>
		</div>
	</a>
<?php } ?>
</div>
</section>
	
<?php require "partials/footer.php" ?>