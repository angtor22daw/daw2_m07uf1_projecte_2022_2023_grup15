<?php
	ini_set('display_errors', 0);
	session_start();
	if (!isset($_SESSION['usuari'])){
		header("Location: ./errors/error_acces.php");
	}
	if (!isset($_SESSION['expira']) || (time() - $_SESSION['expira'] >= 0)){
		header("Location: ./errors/logout_expira_sessio.php");
	}	
?>
<!DOCTYPE html>
<html lang="ca">
	<head>
		<meta charset="utf-8">
		<title>Interfície de l'usuari</title>
		<link rel="stylesheet" href="agenda.css">
	</head>
	<body>
		<h3><b>Menú de l'usuari</b></h3>
		<p>Visualització dels alumnes: </p>
		<a href="visualitzarAlumnesBasic.php">Visualitzar alumnes</a><br><br>
		<p>Tancament de sessió: </p>
        <p><a href="logout.php">Finalitza la sessió</a></p>

        <?php
			require('./biblioteca.php');
			echo "<p>Usuari utilitzant l'agenda: ".$_SESSION['usuari']."</p>";
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
