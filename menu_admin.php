<?php
	session_start();
	require("biblioteca.php");
	if (!isset($_SESSION['expira']) || (time() - $_SESSION['expira'] >= 0)){
		header("Location: ./errors/logout_expira_sessio.php");
	}

	if (!isset($_SESSION['usuari'])){
		header("Location: ./errors/error_acces.php");
	}
	else{
		$autoritzat=fAutoritzacio($_SESSION['usuari']);
		if(!$autoritzat){
			header("Location: ./errors/error_autoritzacio.php");
		}
	}
?>
<!DOCTYPE html>
<html lang="ca">
	<head>
		<meta charset="utf-8">
		<title>Menú del administrador</title>
		<!--<link rel="stylesheet" href="agenda.css"> -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sidebars/">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bitter:400,700">
		<link href="css/sidebars.css" rel="stylesheet">
	</head>
	<body>
		<div class="flex-shrink-0 p-3 bg-white" style="width: 280px;">
			<a class="d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none border-bottom">
				<span class="fs-5 fw-semibold">Menú del Administrador</span>
			</a>
			<ul class="list-unstyled ps-0">
      			<li class="mb-1">
					<button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
						Gestionament dels alumnes
        			</button>
					<div class="collapse show" id="home-collapse">
						<ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
							<li><a href="crearAlumne.php" class="link-dark rounded">Crear alumne</a></li>
							<li><a href="visualitzarAlumnesAdmin.php" class="link-dark rounded">Visualitzar alumnes</a></li>
							<li><a href="modificarAlumne.php" class="link-dark rounded">Modificar notes dels alumnes</a></li>
							<li><a href="eliminarAlumne.php" class="link-dark rounded">Eliminar alumne</a></li>
						</ul>
					</div>
				</li>
      			<li class="mb-1">
				  	<button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
					  	Creació d'usuaris de l'aplicació
        			</button>
        			<div class="collapse" id="dashboard-collapse">
						<ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
							<li><a href="eliminarAlumne.php" class="link-dark rounded">Registrar nous usuaris</a></li>
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
			<!-- <a href="crearAlumne.php">Crear alumne</a><br>
			<a href="visualitzarAlumnesAdmin.php">Visualitzar alumnes</a><br>
			<a href="modificarAlumne.php">Modificar notes dels alumnes</a><br>
			<a href="eliminarAlumne.php">Eliminar alumne</a><br>
			<p>Creació d'usuaris de l'aplicació: </p>
			<p><a href="registre.php">Registrar nous usuaris</a></p><br>
			<p>Tancament de sessió: </p>
			<p><a href="logout.php">Finalitza la sessió</a></p> -->

		</div>
        <?php
			// require('./biblioteca.php');
			echo "<p>Usuari utilitzant l'agenda: ".$_SESSION['usuari']."</p>";
			// date_default_timezone_set('Europe/Andorra');
			// echo "<p>Data i hora: ".date('d/m/Y h:i:s')."</p>";
	
			// Verificar tipus d'usuari (Basic/Administrador)
			$autoritzat=fAutoritzacio($_SESSION['usuari']);
			if(!$autoritzat){
				echo "<p> Tipus d'usuari: Basic </p>";
			}else{
				echo "<p> Tipus d'usuari: Administrador </p>";
			}
        ?>
        </label>		
	</body>
</html>
