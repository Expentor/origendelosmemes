<?php

require "partials/header.php";
require "partials/header-navbarv2.php";
require "database.php";

$articles = $conn->query("SELECT * FROM articles");

?>

<br><br><br><br><br>
<center><h2 class="articles-searched">ARTÍCULOS ENCONTRADOS</h2></center>

<section id="articulos">
<div class="articulos-container">

<nav class="navbar navbar-expand-lg">
		<div class="container-fluid">
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<form action="search.php" method="POST" class="d-flex" role="search">
						<input class="form-control me-2" type="search" name="keyword" placeholder="Buscar articulo" aria-label="Buscar articulo">
						<button class="btn btn-outline-success" name="search" type="submit">Buscar</button>
				</form>
			</div>
		</div>
</nav>

<nav class="navbar navbar-expand-lg">
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

<nav class="navbar navbar-expand-lg">
		<div class="container-fluid">
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<div>
					<h5><b>Categorias</b></h5>
					<form action="categoryFilter.php" method="POST" class="form_category">
								<select class="form-select" name="category">
										<option selected="selected">Seleccione una categoria</option>
										<option value='1'>Anime</option>";
										<option value='2'>Videojuegos</option>";
										<option value='3'>Gatos</option>";
										<option value='4'>Animales</option>";
										<option value='5'>Personas</option>";
								</select>
								<button class="btn btn-outline-warning" name="category_button" type="submit">Filtrar</button>
					</form>	
				</div>
			</div>
		</div>
</nav>

<?php

//CODIGO DE FILTRADO POR CATEGORIAS

if (isset($_POST['category'])) {
    $category=$_POST['category'];
    $query = $conn->prepare("SELECT * FROM articles WHERE category = '$category'");
    $query->execute();
    while ($row=$query->fetch()) {?>
        <a href="articles.php?id=<?= $row["id"]?>" style="background-image: url(<?= $row["picture"] ?>);">
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