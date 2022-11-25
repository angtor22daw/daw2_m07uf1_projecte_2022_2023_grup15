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
			header("Location: error_login.php");
		}					
	}		
?>
?>
<!DOCTYPE html>
<html lang="ca">
	<head>
		<meta charset="utf-8">
		<title>Visualitzador de l'aplicació</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
	</head>
	<body>
		<h3><b>Inici de sessió del visualitzador de l'aplicació</b></h3>
       <form action="login.php" method="POST">
			<p>Indica el teu nom d'usuari: <input type="text" name="usuari"></p>
			<p>Indica la teva contrasenya: <input type="password" name="password"></p>
			<input type="submit" value="Envia">
		</form>
		<p><a href="index.php">Torna a la pàgina inicial</a></p>
        <label class="diahora"> 
        <?php
			date_default_timezone_set('Europe/Andorra');
			echo "<p>Data i hora: ".date('d/m/Y h:i:s')."</p>";						
        ?>
         <label class="diahora"> 
	</body>
</html>
  