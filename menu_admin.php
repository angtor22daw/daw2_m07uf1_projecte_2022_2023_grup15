<?php
	session_start();
	if (!isset($_SESSION['usuari'])){
		header("Location: error_acces.php");
	}
	if (!isset($_SESSION['expira']) || (time() - $_SESSION['expira'] >= 0)){
		header("Location: logout_expira_sessio.php");
	}	
?>
<!DOCTYPE html>
<html lang="ca">
	<head>
		<meta charset="utf-8">
		<title>Visualitzador de l'agenda</title>
		<link rel="stylesheet" href="agenda.css">
	</head>
	<body>
		<h3><b>Menú del Administrador</b></h3>
		<p>Gestionament dels alumnes: </p>
        <a href="crearAlumne.php">Crear alumne</a><br>
        <a href="visualitzarAlumnesAdmin.php">Visualitzar alumnes</a><br>
        <a href="modificarAlumne.php">Modificar notes dels alumnes</a><br>
        <a href="eliminarAlumne.php">Eliminar alumne</a><br>
		<p>Creació d'usuaris de l'aplicació: </p>
        <p><a href="registre.php">Registrar nous usuaris</a></p><br>
		<p>Tancament de sessió: </p>
        <p><a href="logout.php">Finalitza la sessió</a></p>
        <!-- <label class="diahora"> -->
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
