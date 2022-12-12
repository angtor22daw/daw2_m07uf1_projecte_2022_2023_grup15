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
	if ((isset($_POST['ID_alumne']))){		
		$eliminar=fEliminarAlumne($_POST['ID_alumne']);
		$_SESSION['eliminar']=$eliminar;
	}			
?>
<!DOCTYPE html>
<html lang="ca">
	<head>
		<meta charset="utf-8">
		<title>Eliminar alumnes</title>
	</head>
	<body>
		<h3><b>Eliminar alumnes</b></h3>
		<p><b>Indica l'ID de l'alumne a eliminar: </b></p>			
		<form action="eliminarAlumne.php" method="POST">			
			<p>
				<label>ID de l'alumne:</label> 
				<input type="text" name="ID_alumne" required>
			</p>
			<input type="submit" value="Eliminar Alumne"/>
		</form>
		<p><a href="menu_admin.php">Torna al menú</a></p>
		<!-- <label class="diahora"> -->
		<?php
			echo "<p>Usuari utilitzant l'agenda: ".$_SESSION['usuari']."</p>";
			// date_default_timezone_set('Europe/Andorra');
			// echo "<p>Data i hora: ".date('d/m/Y h:i:s')."</p>";
			if (isset($_SESSION['eliminar'])){
				if ($_SESSION['eliminar']) echo "<p style='color:red'>L'alumne ha estat eliminat correctament</p>";
				else{
					echo "L'Usuari no ha estat eliminat<br>";
					echo "Comprova si hi ha algún problema del sistema per poder eliminar usuaris<br>";
					header("refresh: 10; url=menu_admin.php"); // Passats 5 segons el navegador demana menu_admin.php i es torna a menu_admin.php.
				}
				unset($_SESSION['eliminar']);
			} 
        ?>
		</label>
	</body>
</html>

