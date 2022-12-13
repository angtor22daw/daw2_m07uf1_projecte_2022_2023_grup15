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
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
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

			$autoritzat=fAutoritzacio($_SESSION['usuari']);
			if(!$autoritzat){
				echo "<p> Tipus d'usuari: Basic </p>";
			}else{
				echo "<p> Tipus d'usuari: Administrador </p>";
			}
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

