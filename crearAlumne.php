<?php
	require("biblioteca.php");
	session_start();

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

    // FUNCIO QUE ENVIE LES DADES DEL FORM
	if ((isset($_POST['nom_nou_alumne'])) && (isset($_POST['primerCognom_nou_alumne'])) && (isset($_POST['segonCognom_nou_alumne'])) && (isset($_POST['nota_M01'])) && (isset($_POST['nota_M02'])) && (isset($_POST['nota_M03'])) && (isset($_POST['nota_M04'])) && (isset($_POST['nota_M11'])) && (isset($_POST['nota_M12']))){		
		$afegitAlumne=fActualitzaAlumnes($_POST['nom_nou_alumne'],$_POST['primerCognom_nou_alumne'],$_POST['segonCognom_nou_alumne'],$_POST['nota_M01'],$_POST['nota_M02'],$_POST['nota_M03'],$_POST['nota_M04'],$_POST['nota_M11'],$_POST['nota_M12']);
		$_SESSION['afegitAlumne']=$afegitAlumne;
	};
	// RETORNA EN 10 SEGONS
	if (isset($_SESSION['afegitAlumne'])){
		if ($_SESSION['afegitAlumne']);
		else{
			header("refresh: 10; url=menu_admin.php");
		}
		//unset($_SESSION['afegitAlumne']);
	}
?>
<!DOCTYPE html>
<html lang="ca">
	<head>
		<meta charset="utf-8">
		<title>Crear Alumnes</title>
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
		<h5 class="display-6">Registre de nous Alumnes</h5>
		<div class="card-custom" style="width: 18rem;">
			<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/12/User_icon_2.svg/1200px-User_icon_2.svg.png"  width="200px">
			<div class="card-body-custom">
				<form action="crearAlumne.php" method="POST">
					<div class="form-floating mb-3 mt-3">
						<input type="text" class="form-control" name="nom_nou_alumne" required>
						<label>Nom del alumne</label>
					</div>
					<div class="form-floating mb-3 mt-3">
						<input type="text" class="form-control" name="primerCognom_nou_alumne" required>
						<label>Primer cognom</label>
					</div>
					<div class="form-floating mb-3 mt-3">
						<input type="text" class="form-control" name="segonCognom_nou_alumne" required>
						<label>Segon cognom</label>
					</div>
					<div class="form-floating mb-3 mt-3">
						<input type="text" class="form-control" name="nota_M01" required>
						<label>Nota del M01</label>
					</div>
					<div class="form-floating mb-3 mt-3">
						<input type="text" class="form-control" name="nota_M02" required>
						<label>Nota del M02</label>
					</div>
					<div class="form-floating mb-3 mt-3">
						<input type="text" class="form-control" name="nota_M03" required>
						<label>Nota del M03</label>
					</div>
					<div class="form-floating mb-3 mt-3">
						<input type="text" class="form-control" name="nota_M04" required>
						<label>Nota del M04</label>
					</div>
					<div class="form-floating mb-3 mt-3">
						<input type="text" class="form-control" name="nota_M11" required>
						<label>Nota del M11</label>
					</div>
					<div class="form-floating mb-3 mt-3">
						<input type="text" class="form-control" name="nota_M12" required>
						<label>Nota del M12</label>
					</div>
					<input type="submit" value="Enregistra el nou alumne" class="btn btn-primary"><br><br>
					<button id="button-tornar" type="button" class="btn btn-secondary" onclick=window.location.href="menu_admin.php">Torna al menú</button><br><br>
				</form>
			</div>
		</div>	
		
		<?php
			if (isset($_SESSION['afegitAlumne'])){
				if ($_SESSION['afegitAlumne']) echo "<p style='color:red'>L'Usuari ha estat registrat correctament</p>";
				else{
					echo "<p style='color:red'>L'Usuari no ha estat registrat</p><br>";
					echo "<p style='color:red'>Comprova si hi ha algún problema del sistema per poder enregistrar nous usuaris</p><br>";
					//header("refresh: 10; url=menu_admin.php");
				}
				unset($_SESSION['afegitAlumne']);
			}
        ?>
		</label>
	</body>
</html>

