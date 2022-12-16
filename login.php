<?php
	require('./biblioteca.php');

	if ((isset($_POST['usuari'])) && (isset($_POST['password']))){
		$autenticat = fAutenticacio($_POST['usuari']);
		if($autenticat){
			session_start(); // Inici de sessió
			$_SESSION['usuari'] = $_POST['usuari'];
			$_SESSION['expira'] = time() + TEMPS_EXPIRACIO;
			if (fAutoritzacio($_POST['usuari'])){
				header("Location: menu_admin.php");		
			} else {
				header("Location: menu_basic.php");		
			}
		}

		if (!isset($_SESSION['usuari'])){
			header("Location: ./errors/error_login.php");
		}	
	}
?>
<!DOCTYPE html>
<html lang="ca">
	<head>
		<meta charset="utf-8">
		<title>Iniciar Sessió</title>
		<!-- CSS only -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
		<link rel="stylesheet" href="css/estils.css">
	</head>
	<body>
		<!-- JavaScript Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	<section class="vh-100 gradient-custom">
		<div class="container py-5 h-100">
			<div class="row d-flex justify-content-center align-items-center h-100">
			<div class="col-12 col-md-8 col-lg-6 col-xl-5">
				<div class="card shadow-2-strong" style="border-radius: 1rem;">
				<div class="card-body p-5 text-center">

					<h3 class="mb-5">Iniciar Sessió</h3>

					<form action="login.php" method="POST">
						<div class="form-outline mb-4">
							<input type="text" name="usuari" id="typeEmailX-2" class="form-control form-control-lg" placeholder="Usuari"/>
						</div>

						<div class="form-outline mb-4">
							<input type="password" name="password" id="typePasswordX-2" class="form-control form-control-lg" placeholder="Contrasenya"/>
						</div>

						<button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
					</form>
					<hr class="my-4">
					
					<p><a href="index.html">Torna a la pàgina inicial</a></p>

				</div>	
				</div>
			</div>
			</div>
		</div>
		</section>
	</body>
</html>
  