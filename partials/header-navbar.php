<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>BLOGEM - Un blog sobre memes... :trollface:</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

	<!-- Bootstrap -->
    <link 
        rel="stylesheet" 
        href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.1.3/darkly/bootstrap.min.css"
        integrity="sha512-ZdxIsDOtKj2Xmr/av3D/uo1g15yxNFjkhrcfLooZV5fW0TT7aF7Z3wY1LOA16h0VgFLwteg14lWqlYUQK3to/w==" 
        crossorigin="anonymous" 
        referrerpolicy="no-referrer" 
    />
    <script
    defer
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"
  ></script>
</head>
<body>
	<header>
		<nav>
			<div class="icono-del-menu"> 
				<i class="fas fa-bars"></i>
			</div>
			<ul id="menu">
				<li><a href="#">Página principal</a></li>
				<li><a href="#">Contacto</a></li>
				<li><a href="#">Política de privacidad</a></li>
				<?php if (isset($_SESSION["user"])): ?>
					<li class="different-li"><a href="logout.php" class="button-link">Salir de la sesión</a></li>
					<?php endif ?>
				<li class="different-li"><a href="login.php" class="button-link">Iniciar sesión</a></li>
			</ul>
			<?php if (isset($_SESSION["user"])): 
				?>
          <div>
            <?= $_SESSION["user"]["email"] ?>
          </div>
        <?php endif ?>
			</nav>