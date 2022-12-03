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

    // FUNCIO QUE ENVIE LES DADES DEL FORM
	if ((isset($_POST['nom_nou_alumne'])) && (isset($_POST['cts_nou_usuari'])) && (isset($_POST['tipus_nou_usuari']))){		
		$afegit=fActualitzaUsuaris($_POST['nom_nou_usuari'],$_POST['cts_nou_usuari'],$_POST['tipus_nou_usuari']);
		$_SESSION['afegit']=$afegit;
		header("refresh: 5; url=menu_admin.php"); // Passats 5 segons el navegador demana menu_admin.php i es torna a menu_admin.php.
	}			
?>
<!DOCTYPE html>
<html lang="ca">
	<head>
		<meta charset="utf-8">
		<title>Visualitzador de l'agenda</title>
	</head>
	<body>
		<h3><b>Registre de nous Alumnes</b></h3>
		<p><b>Indica les dades del nou alumne: </b></p>			
		<form action="crearAlumne.php" method="POST">			
			<p>
				<label>Nom del alumne:</label> 
				<input type="text" name="nom_nou_alumne" required>
			</p>
            <p>
				<label>Primer cognom:</label> 
				<input type="text" name="1rcognom_nou_alumne" required>
			</p>
            <p>
				<label>Segon cognom:</label> 
				<input type="text" name="2ncognom_nou_alumne" required>
			</p>
            <p>
				<label>Nota del M01:</label> 
				<input type="text" name="nota_M01" required>
			</p>
            <p>
				<label>Nota del M02:</label> 
				<input type="text" name="nota_M02" required>
			</p>
            <p>
				<label>Nota del M03:</label> 
				<input type="text" name="nota_M03" required>
			</p>
            <p>
				<label>Nota del M04:</label> 
				<input type="text" name="nota_M04" required>
			</p>
            <p>
				<label>Nota del M011:</label> 
				<input type="text" name="nota_M011" required>
			</p>
            <p>
				<label>Nota del M012:</label> 
				<input type="text" name="nota_M012" required>
			</p>
		</form>
		<p><a href="menu_admin.php">Torna al menú</a></p>
		<!-- <label class="diahora"> -->
		<?php
			echo "<p>Usuari utilitzant l'agenda: ".$_SESSION['usuari']."</p>";
            $autoritzat=fAutoritzacio($_SESSION['usuari']);
			if(!$autoritzat){
				echo "<p> Tipus d'usuari: Basic</p>";
			}else{
				echo "<p> Tipus d'usuari: Administrador</p>";
			}
        ?>
		</label>
	</body>
</html>

