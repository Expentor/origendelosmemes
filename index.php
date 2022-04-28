<?php require "partials/header-navbar.php" ?>

<div class="blogem-banner">
	<div class="blogem-banner__info">
		<div class="blogem-banner__info-container">
			<img src="img/ODM.PNG">
			<h1>ORIGEN DE LOS MEMES</h1>
			<h2>Un blog sobre <b>memes</b>...</h2>
		</div>
		<?php if (isset($_SESSION["user"])): 
				?>
          <div>
            <?= $_SESSION["user"]["email"] ?>
          </div>
        <?php endif ?>
	</div>
	<div class="flecha">
		<a href="#articulos"><i class="fas fa-chevron-down"></i></a>
	</div>
</div>
</header>
<section id="articulos">
<h2 class="articulos-texto">ARTICULOS RECIENTES</h2>
<div class="articulos-container">
	<a href="https://youtu.be/OUntyFa1GSw" class="aloy"> 
		<div class="articulo-data">
			<h2>ALOY CON BARBA</h2>
			<p>Lo ultimo en bromas</p>
		</div>
	</a>
	<a href="https://youtu.be/-9g5gStDVkE" class="tilin">
		<div class="articulo-data">
			<h2>Eso tilin</h2>
			<p>Lo ultimo en bromas</p>
		</div>
	</a>
	<a href="https://youtu.be/6hVpNK8Oe7g" class="potatxio">
		<div class="articulo-data">
			<h2>Potatxio</h2>
			<p>Lo ultimo en bromas</p>
		</div>
	</a>
	<a href="https://youtu.be/6hVpNK8Oe7g" class="potatxio">
		<div class="articulo-data">
			<h2>Potatxio</h2>
			<p>Lo ultimo en bromas</p>
		</div>
	</a>
	<a href="https://youtu.be/6hVpNK8Oe7g" class="potatxio">
		<div class="articulo-data">
			<h2>Potatxio</h2>
			<p>Lo ultimo en bromas</p>
		</div>
	</a>
</div>
</section>
	
<?php require "partials/footer.php" ?>