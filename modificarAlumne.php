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
    if ((isset($_POST['ID_alumne'])) && (isset($_POST['moduls'])) && (isset($_POST['novaNota']))){	
		$modificat=fModificarAlumne($_POST['ID_alumne'],$_POST['moduls'],$_POST['novaNota']);
		$_SESSION['modificat']=$modificat;
	}
	// RETORNA EN 10 SEGONS
	if (isset($_SESSION['modificat'])){
		if ($_SESSION['modificat']);
		else{
			header("refresh: 10; url=menu_admin.php"); // Passats 5 segons el navegador demana menu_admin.php i es torna a menu_admin.php.
		}
	} 		
?>
<!DOCTYPE html>
<html lang="ca">
	<head>
		<meta charset="utf-8">
		<title>Modificació de notes</title>
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

		<h5 class="display-6">Modificació de notes dels alumnes</h5>
		<div class="card-custom" style="width: 18rem;">
			<img src="https://cdn-icons-png.flaticon.com/512/38/38905.png?w=360"  width="200px">
			<div class="card-body-custom">
				<form action="modificarAlumne.php" method="POST">
					<div class="form-floating mb-3 mt-3">
						<input type="text" class="form-control" name="ID_alumne" required>
						<label>ID del alumne</label>
					</div>
					<p>Selecciona el modul que vols modificar la nota: </p>
					<select class="form-select" name="moduls">
						<option value="M01">M01</option>
						<option value="M02">M02</option>
						<option value="M03">M03</option>
						<option value="M04">M04</option>
						<option value="M11">M11</option>
						<option value="M12">M12</option>
					</select>
					<div class="form-floating mb-3 mt-3">
						<input type="text" class="form-control" name="novaNota" required>
						<label>Nota modificada</label>
					</div>
					<br>
					<input type="submit" value="Modificar Nota" class="btn btn-warning"><br><br>
					<button id="button-tornar" type="button" class="btn btn-secondary" onclick=window.location.href="menu_admin.php">Torna al menú</button><br><br>
				</form>
			</div>
		</div>
        <?php
			if (isset($_SESSION['modificat'])){
				if ($_SESSION['modificat']) echo "<p style='color:red'>L'Usuari ha estat modificat correctament</p>";
				else{
					echo "<p style='color:red'>L'Usuari no ha estat registrat</p><br>";
					echo "<p style='color:red'>Comprova si hi ha algún problema del sistema per poder enregistrar nous usuaris</p><br>";
				}
				unset($_SESSION['modificat']);
			} 
        ?>

	</body>
</html>
