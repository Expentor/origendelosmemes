<?php require "partials/header-navbar.php" ?>

<?php

require "database.php";

$articles = $conn->query("SELECT * FROM articles ORDER BY id DESC");

?>

<div class="blogem-banner">
	<div class="container pt-5 mt-3">
		<?php if (isset($_SESSION["admin"])) : ?>
			<div class="container pt-5" class="b">
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
	<center>
	<div class="col">
		<div class="row">
			<div class="col-md-5">
				<!-- SEARCH BAR -->
				<nav class="navbar navbar-expand">
					<div class="container-fluid">
						<div class="collapse navbar-collapse" id="navbarSupportedContent">
							<form action="search.php" method="POST" class="d-flex" role="search">
								<input class="form-control me-2" type="search" name="keyword" placeholder="Buscar articulo" aria-label="Buscar articulo">
								<button class="btn btn-outline-success" name="search" type="submit">Buscar</button>
							</form>
						</div>
					</div>
				</nav>
			</div>
			<div class="col-md-5">
				<!-- FILTER DATE -->
				<nav class="navbar navbar-expand">
					<div class="container-fluid">
						<div class="collapse navbar-collapse" id="navbarSupportedContent">
							<div>
								<h5><b>Buscar por fecha</b></h5>
								<form action="filterDate.php" method="POST" class="form_searh_date" role="date">
									<input type="date" name="fecha_de" id="fecha_de" value="<?php echo $fecha_de; ?>" required>
									<button class="btn btn-outline-danger" name="date"><i class="bi bi-calendar-date"></i>Buscar</button>
								</form>
							</div>
						</div>
					</div>
				</nav>
			</div>
			<div class="col">
				<!-- FILTER CATEGORY -->
				<nav class="navbar navbar-expand">
					<div class="container-fluid">
						<div class="collapse navbar-collapse" id="navbarSupportedContent">
							<div>
								<h5><b>Categorias</b></h5>
								<form action="categoryFilter.php" method="POST" class="form_category">
									<select class="form-select" name="category">
										<option selected="selected">Seleccione una categoria</option>
										<option value='Anime'>Anime</option>";
										<option value='Videojuegos'>Videojuegos</option>";
										<option value='Gatos'>Gatos</option>";
										<option value='Animales'>Animales</option>";
										<option value='Personas'>Personas</option>";
									</select>
									<button class="btn btn-outline-warning" name="category_button" type="submit">Filtrar</button>
								</form>
							</div>
						</div>
					</div>
				</nav>
			</div>
		</div>
	</div>
	</center>
	<?php if ($articles->rowCount() == 0) : ?>
      <div class="col-md-4 mx-auto">
        <div class="card card-body text-center">
          <p>No existe ningún artículo publicado</p>
        </div>
      </div>
    <?php endif ?>
	<div class="articulos-container">
		<?php foreach ($articles as $articles) { ?>
			<a href="articles.php?id=<?= $articles["id"] ?>" style="background-image: url(<?= $articles["picture"] ?>);">
				<div class="articulo-data">
					<h2><?= $articles["title"] ?></h2>
					<?= $articles["subtitle"] ?>
				</div>
			</a>
		<?php } ?>
	</div>
</section>

<?php require "partials/footer.php" ?>