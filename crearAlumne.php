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

    // FUNCIO QUE ENVIE LES DADES DEL FORM
	if ((isset($_POST['nom_nou_alumne'])) && (isset($_POST['primerCognom_nou_alumne'])) && (isset($_POST['segonCognom_nou_alumne'])) && (isset($_POST['nota_M01'])) && (isset($_POST['nota_M02'])) && (isset($_POST['nota_M03'])) && (isset($_POST['nota_M04'])) && (isset($_POST['nota_M11'])) && (isset($_POST['nota_M12']))){		
		$afegitAlumne=fActualitzaAlumnes($_POST['nom_nou_alumne'],$_POST['primerCognom_nou_alumne'],$_POST['segonCognom_nou_alumne'],$_POST['nota_M01'],$_POST['nota_M02'],$_POST['nota_M03'],$_POST['nota_M04'],$_POST['nota_M11'],$_POST['nota_M12']);
		$_SESSION['afegitAlumne']=$afegitAlumne;
	};
	// RETORNA EN 10 SEGONS
	if (isset($_SESSION['afegitAlumne'])){
		if ($_SESSION['afegitAlumne']);
		else{
			header("refresh: 10; url=menu_admin.php");
		}
		//unset($_SESSION['afegitAlumne']);
	}
?>
<!DOCTYPE html>
<html lang="ca">
	<head>
		<meta charset="utf-8">
		<title>Crear Alumnes</title>
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
				<input type="text" name="primerCognom_nou_alumne" required>
			</p>
            <p>
				<label>Segon cognom:</label> 
				<input type="text" name="segonCognom_nou_alumne" required>
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
				<label>Nota del M11:</label> 
				<input type="text" name="nota_M11" required>
			</p>
            <p>
				<label>Nota del M12:</label> 
				<input type="text" name="nota_M12" required>
			</p>
			<input type="submit" value="Enregistra el nou alumne"/>
		</form>
		<p><a href="menu_admin.php">Torna al menú</a></p>
		<!-- <label class="diahora"> -->
		<?php
			// NOM I TIPUS D USUARI 
			echo "<p>Usuari utilitzant l'agenda: ".$_SESSION['usuari']."</p>";
            $autoritzat=fAutoritzacio($_SESSION['usuari']);
			if(!$autoritzat){
				echo "<p> Tipus d'usuari: Basic</p>";
			}else{
				echo "<p> Tipus d'usuari: Administrador</p>";
			}
			if (isset($_SESSION['afegitAlumne'])){
				if ($_SESSION['afegitAlumne']) echo "<p style='color:red'>L'Usuari ha estat registrat correctament</p>";
				else{
					echo "<p style='color:red'>L'Usuari no ha estat registrat</p><br>";
					echo "<p style='color:red'>Comprova si hi ha algún problema del sistema per poder enregistrar nous usuaris</p><br>";
					//header("refresh: 10; url=menu_admin.php");
				}
				unset($_SESSION['afegitAlumne']);
			}
        ?>
		</label>
	</body>
</html>

