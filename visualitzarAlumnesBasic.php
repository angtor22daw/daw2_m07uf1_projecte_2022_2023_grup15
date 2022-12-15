<?php
	ini_set('display_errors', 0);
	session_start();
	require("biblioteca.php");
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
		<title>Visualitzar Alumnes [BASIC]</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sidebars/">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bitter:400,700">
		<link href="css/sidebars.css" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
	</head>
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
		<h5 class="display-6">Llistat de tots els alumnes</h5><br>

		<table class="table table-striped">
			<thead class="thead-dark">
				<tr>
                    <th scope="col">ID</th>
					<th scope="col">Nom</th>
					<th scope="col">Primer cognom</th>
                    <th scope="col">Segon cognom</th>
                    <th scope="col">Nota M01</th>
                    <th scope="col">Nota M02</th>
                    <th scope="col">Nota M03</th>
                    <th scope="col">Nota M04</th>
                    <th scope="col">Nota M11</th>
                    <th scope="col">Nota M12</th>
				</tr>
			</thead>
			<tbody>
			<?php
				// movem require biblioteca a l'inici del fitxer
				$llista = fLlegeixFitxer(FITXER_ALUMNES);
				fCreaTaula($llista);
			?>
			</tbody>
		</table>
		
		<br>
		<form action="pdfAlumnes.php" method="POST" target="_blank">
			<input id="PDF" type="submit" class="btn btn-info" value="Generar PDF">
		</form>
		<br>
		<button id="PDF" type="button" class="btn btn-secondary" onclick=window.location.href="menu_basic.php">Torna al menú</button><br><br>
		<br>
	</body>
</html>
