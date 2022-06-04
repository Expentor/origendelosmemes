<?php
require "partials/header-navbar.php";
require "database.php";

$articles = $conn->query("SELECT * FROM articles");
$categories = $conn->query("SELECT * FROM Category");

?>

<br><br><br><br><br>
<center>
    <h2 class="articles-searched">ARTÍCULOS ENCONTRADOS</h2>
</center>

<section id="articulos">
    <div class="articulos-container">

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

        <?php

        //CODIGO DE FILTRADO DE FECHAS

        if (isset($_POST['date'])) {
            $keyword = $_POST['fecha_de'];
            $query = $conn->prepare("SELECT * FROM articles WHERE publish_date LIKE '$keyword' ORDER BY publish_date");
            //$query->bindvalue(':keyword', '%'.$key.'%', PDO::PARAM_STR);
            $query->execute();
            //$results = $query->fetchAll();
            //$row = $query->rowCount();
            while ($row = $query->fetch()) { ?>
                <a href="articles.php?id=<?= $row["id"] ?>" style="background-image: url(<?= $row["picture"] ?>);">
                    <div class="articulo-data">
                        <h2><?= $row["title"] ?></h2>
                        <?= $row["subtitle"] ?>
                    </div>
                </a>
        <?php
            }
        }

        ?>

    </div>
</section>

<?php require "partials/footer.php" ?>