<?php
	session_start();
	require("biblioteca.php");
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
?>
<!DOCTYPE html>
<html lang="ca">
	<head>
		<meta charset="utf-8">
		<title>Menú del administrador</title>
		<link rel="stylesheet" href="agenda.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bitter:400,700">
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

        <?php
			// require('./biblioteca.php');
			echo "<p>Usuari utilitzant l'agenda: ".$_SESSION['usuari']."</p>";
			// date_default_timezone_set('Europe/Andorra');
			// echo "<p>Data i hora: ".date('d/m/Y h:i:s')."</p>";
	
			// Verificar tipus d'usuari (Basic/Administrador)
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
