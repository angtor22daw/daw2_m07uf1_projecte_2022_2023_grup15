<?php
	require("biblioteca.php");
	session_start();
	if (!isset($_SESSION['usuari'])){
		header("Location: ./errors/error_acces.php");
	}
	if (!isset($_SESSION['expira']) || (time() - $_SESSION['expira'] >= 0)){
		header("Location: ./errors/logout_expira_sessio.php");
	}
    if ((isset($_POST['ID_alumne'])) && (isset($_POST['moduls'])) && (isset($_POST['novaNota']))){	
		$modificat=fModificarAlumne($_POST['ID_alumne'],$_POST['moduls'],$_POST['novaNota']);
		$_SESSION['modificat']=$modificat;
		header("refresh: 5; url=menu_admin.php"); // Passats 5 segons el navegador demana menu_admin.php i es torna a menu_admin.php.
	}		
?>
<!DOCTYPE html>
<html lang="ca">
	<head>
		<meta charset="utf-8">
		<title>Modificació de notes</title>
        <link rel="stylesheet" href="css/estils.css">
	</head>
	<body>
		<h3><b>Modificació de notes dels alumnes</b></h3>

        <form action="modificarAlumne.php" method="POST">
            <p>ID del alumne</p>
            <input type="text" name="ID_alumne" required><br><br>
            <p>Selecciona el modul que vols modificar la nota: </p>
            <select name="moduls">
                <option value="M01">M01</option>
                <option value="M02">M02</option>
                <option value="M03">M03</option>
                <option value="M04">M04</option>
                <option value="M11">M11</option>
                <option value="M12">M12</option>
            </select>
            <br>
            <!-- <label for="nota">Nota</label>
            <input type="text" name="nota" id="nota" required><br> -->
            <br>
            <p>Nota Modificada</p>
            <input type="text" name="novaNota" required><br><br>
            <input type="submit" value="Modificar Nota">
        </form>
		<p><a href="menu_admin.php">Torna al menú</a></p>

        <?php
			// require('./biblioteca.php');	
			echo "<p>Usuari utilitzant l'agenda: ".$_SESSION['usuari']."</p>";

			$autoritzat=fAutoritzacio($_SESSION['usuari']);
			if(!$autoritzat){
				echo "<p> Tipus d'usuari: Basic";
			}else{
				echo "<p> Tipus d'usuari: Administrador";
			}

			if (isset($_SESSION['modificat'])){
				if ($_SESSION['modificat']) echo "<p style='color:red'>L'Usuari ha estat modificat correctament</p>";
				else{
					echo "L'Usuari no ha estat registrat<br>";
					echo "Comprova si hi ha algún problema del sistema per poder enregistrar nous usuaris<br>";
				}
				unset($_SESSION['modificat']);
			} 
        ?>

	</body>
</html>
