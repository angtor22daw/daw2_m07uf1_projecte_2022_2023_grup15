<?php
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
		<title>Interfície Usuari</title>
		<link rel="stylesheet" href="agenda.css">
	</head>
	<body>
		<h3><b>Menú del visualitzador de l'agenda</b></h3>
        <!-- <a href="personal.php">Agenda personal</a><br>
        <a href="professional.php">Agenda professional</a><br>
        <a href="serveis.php">Agenda de serveis</a><br> -->
        <!-- <p><a href="registre.php">Registre de nous usuaris</a></p> -->
		
        <p><a href="logout.php">Finalitza la sessió</a></p>
        <label class="diahora"> 
        <?php
			require('./biblioteca.php');

			echo "<p>Usuari utilitzant l'agenda: ".$_SESSION['usuari']."</p>";
			// date_default_timezone_set('Europe/Andorra');
			// echo "<p>Data i hora: ".date('d/m/Y h:i:s')."</p>";
		
			// Verificar tipus d'usuari (Basic/Administrador)
			$autoritzat=fAutoritzacio($_SESSION['usuari']);
			if(!$autoritzat){
				echo "<p> Tipus d'usuari: Basic";
			}else{
				echo "<p> Tipus d'usuari: Administrador";
			}
        ?>
        </label>		
	</body>
</html>
