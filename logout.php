<?php
	if ((isset($_POST['resp'])) && ($_POST['resp']=="y")){
		session_start();
		//Alliberant variables de sessió. Esborra el contingut de les variables de sessió del fitxer de sessió. Buida l'array $_SESSION. No esborra cookies
		session_unset();
		//Destrucció de la cookie de sessió dins del navegador
		$cookie_sessio = session_get_cookie_params();
		setcookie("PHPSESSID","",time()-3600,$cookie_sessio['path'], $cookie_sessio['domain'], $cookie_sessio['secure'], $cookie_sessio['httponly']); //Neteja cookie de sessió
		//Destrucció de la informació de sessió (per exemple, el fitxer de sessió  o l'identificador de sessió) 
		session_destroy();
		header("Location: index.html");
	}
	else{
		require('./biblioteca.php');	
		session_start();
		if (!isset($_SESSION['expira']) || (time() - $_SESSION['expira'] >= 0)){
			header("Location: logout_expira_sessio.php");
		}
		if ((isset($_POST['resp'])) && ($_POST['resp']=="n")){
			$autoritzat=fAutoritzacio($_SESSION['usuari']);
			if(!$autoritzat){
				header("Location: menu_basic.php");
			}else{
				header("Location: menu_admin.php");
			}
		}
	}	
?>
<!DOCTYPE html>
<html lang="ca">
	<head>
		<meta charset="utf-8">
		<title>Tancar sessió</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sidebars/">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bitter:400,700">
		<link href="css/sidebars.css" rel="stylesheet">
	</head>
	<body>
		<br><br>
		<h5 class="display-6">Vols finalitzar la sessió?</h5><br>
		<div class="card-custom" style="width: 18rem;">
			<img src="https://cdn-icons-png.flaticon.com/512/59/59399.png"  width="200px"><br>
			<div class="card-body-custom">
				<form action="logout.php" method="POST">
					<div class="form-check">
						<input class="form-check-input" type="radio" name="resp" value="y" id="resp1" checked>
							<label class="form-check-label" for="resp1">Sí</label>
						</input>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="radio" name="resp" value="n" id="resp2">
							<label class="form-check-label" for="resp2">No</label>
						</input>
					</div>
					<br>
					<input type="submit" value="Valida" class="btn btn-dark"><br><br>
				</form>
			</div>
		</div>
	</body>
</html>  
