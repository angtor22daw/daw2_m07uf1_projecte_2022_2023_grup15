<?php
	require("biblioteca.php");
	session_start();
	if (!isset($_SESSION['usuari'])){
		header("Location: ./errors/error_acces.php");
	}
	else{
		$autoritzat=fAutoritzacio($_SESSION['usuari']);
		if(!$autoritzat){
			header("Location: ./errors/error_autoritzacio.php");
		}
	}
	if (!isset($_SESSION['expira']) || (time() - $_SESSION['expira'] >= 0)){
		header("Location: ./errors/logout_expira_sessio.php");
	}
	if ((isset($_POST['nom_nou_usuari'])) && (isset($_POST['cts_nou_usuari'])) && (isset($_POST['tipus_nou_usuari']))){		
		$afegit=fActualitzaUsuaris($_POST['nom_nou_usuari'],$_POST['cts_nou_usuari'],$_POST['tipus_nou_usuari']);
		$_SESSION['afegit']=$afegit;
		header("refresh: 5; url=menu_admin.php"); // Passats 5 segons el navegador demana menu_admin.php i es torna a menu_admin.php.
	}			
?>
<!DOCTYPE html>
<html lang="ca">
	<head>
		<meta charset="utf-8">
		<title>Registrarse</title>
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
		<h5 class="display-6">Registre d'usuaris</h5>
		<div class="card-custom" style="width: 18rem;">
			<img src="https://cdn.icon-icons.com/icons2/2104/PNG/512/manager_icon_129392.png"  width="200px">
			<div class="card-body-custom">
				<form action="registre.php" method="POST">
					<div class="form-floating mb-3 mt-3">
						<input type="text" class="form-control" name="nom_nou_usuari" required>
						<label>Nom del nou usuari</label>
					</div>
					<div class="form-floating mb-3 mt-3">
						<input type="password" class="form-control" name="cts_nou_usuari" pattern="(?=^.{8,}$)(?=.*\d)(?=.*[!@#$%^&*]+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" title="Mínims: 8 caràcters, una majúscula, una minúscula, un número i un caràter especial" requiredrequired>
						<label>Contrasenya del nou usuari</label>
					</div>
					<label><b>Rol de l'usuari</b></label><br><br>
					<div class="form-check">
						<input class="form-check-input" type="radio" name="tipus_nou_usuari" value=<?php echo USR ?> checked>Basic
						</div>
						<div class="form-check">
						<input class="form-check-input" type="radio" name="tipus_nou_usuari" value=<?php echo ADMIN ?> >Administrador
					</div><br>
					<input type="submit" value="Enregistra el nou usuari" class="btn btn-primary"><br><br>
					<button id="button-tornar" type="button" class="btn btn-secondary" onclick=window.location.href="menu_admin.php">Torna al menú</button>
					<br><br>
				</form>
			</div>
		</div>
		<?php
			if (isset($_SESSION['afegit'])){
				if ($_SESSION['afegit']) echo "<br><p style='color:red' class='text-center'>L'Usuari ha estat registrat correctament</p>";
				else{
					echo "<br><p style='color:red' class='text-center'>L'Usuari no ha estat registrat</p>";
					echo "<p style='color:red' class='text-center'>Comprova si hi ha algún problema del sistema per poder enregistrar nous usuaris</p>";
				}
				unset($_SESSION['afegit']);
			} 
        ?>
		</label>
	</body>
</html>

