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
	if ((isset($_POST['ID_alumne']))){		
		$eliminar=fEliminarAlumne($_POST['ID_alumne']);
		$_SESSION['eliminar']=$eliminar;
	}
	// RETORNA EN 10 SEGONS
	if (isset($_SESSION['eliminar'])){
		if ($_SESSION['eliminar']);
		else{
			header("refresh: 10; url=menu_admin.php"); // Passats 5 segons el navegador demana menu_admin.php i es torna a menu_admin.php.
		}
		//unset($_SESSION['eliminar']);
	}	
?>
<!DOCTYPE html>
<html lang="ca">
	<head>
		<meta charset="utf-8">
		<title>Eliminar alumnes</title>
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
		<h5 class="display-6">Eliminar alumnes</h5>
		<div class="card-custom" style="width: 18rem;">
			<img src="http://estudioalfa.com/wp-content/uploads/2012/11/vbulletin_borrar_mensajes_usuario.png"  width="200px">
			<div class="card-body-custom">
				<form action="eliminarAlumne.php" method="POST">
					<div class="form-floating mb-3 mt-3">
						<input type="text" class="form-control" name="ID_alumne" required>
						<label>ID de l'alumne</label>
					</div>
					<br>
					<input type="submit" value="Eliminar Alumne" class="btn btn-danger"><br><br>
					<button id="button-tornar" type="button" class="btn btn-secondary" onclick=window.location.href="menu_admin.php">Torna al menú</button>
				</form>
			</div>
		</div>	
		<?php
			if (isset($_SESSION['eliminar'])){
				if ($_SESSION['eliminar']) echo "<p style='color:red'>L'alumne ha estat eliminat correctament</p>";
				else{
					echo "<p style='color:red'>L'Usuari no ha estat eliminat</p><br>";
					echo "<p style='color:red'>Comprova si hi ha algún problema del sistema per poder eliminar usuaris</p><br>";
					// header("refresh: 10; url=menu_admin.php"); // Passats 5 segons el navegador demana menu_admin.php i es torna a menu_admin.php.
				}
				unset($_SESSION['eliminar']);
			} 
        ?>
		</label>
	</body>
</html>

