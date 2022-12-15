<?php
	ini_set('display_errors', 0);
	session_start();
	require('./biblioteca.php');
	if (!isset($_SESSION['usuari'])){
		header("Location: ./errors/error_acces.php");
	}
	if (!isset($_SESSION['expira']) || (time() - $_SESSION['expira'] >= 0)){
		header("Location: ./errors/logout_expira_sessio.php");
	}
	if(fAutoritzacio($_SESSION['usuari'])){
		header("Location: ./menu_admin.php");
	}
?>
<!DOCTYPE html>
<html lang="ca">
	<head>
		<meta charset="utf-8">
		<title>Interfície de l'usuari</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sidebars/">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bitter:400,700">
		<link href="css/sidebars.css" rel="stylesheet">
	</head>
	<body>
		<nav class="navbar navbar-expand-lg bg-info" background-color="black">
			<div class="container-fluid">
				<div class=" collapse navbar-collapse" id="navbarNavDropdown">
				<div class="card">
				<h5 class="card-header "></h5>
					<div class="card-body">
						<?php
						echo "<p class='navbar-nav ms-auto'>Usuari: ".$_SESSION['usuari']."</p>";
						$autoritzat=fAutoritzacio($_SESSION['usuari']);
						if(!$autoritzat){
							echo "<p class='navbar-nav ms-auto'> Rol: Basic </p>";
						}else{
							echo "<p class='navbar-nav ms-auto'> Rol: Administrador </p>";
						}
						?>
					</div>
					</div>
				</div>
			</div>
		</nav>
		<div class="flex-shrink-0 p-3 justify-content-center" style="width: 280px; margin: 0 auto;">
			<a class="d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none border-bottom">
				<span class="fs-5 fw-semibold">Menú de l'usuari basic</span>
			</a>
			<ul class="list-unstyled ps-0">
      			<li class="mb-1">
					<button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
						Visualització dels alumnes
        			</button>
					<div class="collapse show" id="home-collapse">
						<ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
							<li><a href="visualitzarAlumnesBasic.php" class="link-dark rounded">Visualitzar alumnes</a></li>
						</ul>
					</div>
				</li>		
      			<li class="mb-1">
				  	<button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
					  	Tancament de sessió
        			</button>
        			<div class="collapse" id="orders-collapse">
						<ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
							<li><a href="logout.php" class="link-dark rounded">Finalitza la sessió</a></li>
						</ul>
					</div>
				</li>
			</ul>
		</div>
	</body>
</html>
