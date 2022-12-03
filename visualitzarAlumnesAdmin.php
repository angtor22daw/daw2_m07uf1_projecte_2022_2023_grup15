<?php
	session_start();
	if (!isset($_SESSION['usuari'])){
		header("Location: errors/error_acces.php");
	}
	if (!isset($_SESSION['expira']) || (time() - $_SESSION['expira'] >= 0)){
		header("Location: errors/logout_expira_sessio.php");
	}		
?>
<!DOCTYPE html>
<html lang="ca">
	<head>
		<meta charset="utf-8">
		<title>Visualitzador de l'agenda</title>
		<link rel="stylesheet" href="css/estils.css">
	</head>
	<body>
		<h3><b>Llistat de tots els alumnes</b></h3>
		<table>
			<thead>
				<tr>
                    <th>ID</th>
					<th>Nom</th>
					<th>Primer cognom</th>
                    <th>Segon cognom</th>
                    <th>Nota M01</th>
                    <th>Nota M02</th>
                    <th>Nota M03</th>
                    <th>Nota M04</th>
                    <th>Nota M11</th>
                    <th>Nota M12</th>
				</tr>
			</thead>
			<tbody>
			<?php
				require("biblioteca.php");
				$llista = fLlegeixFitxer(FITXER_ALUMNES);
				fCreaTaula($llista,COMU);
			?>
			</tbody>
		</table>
		<p><a href="menu_admin.php">Torna al menú</a></p>
        <label class="diahora"> 
        <?php
			echo "<p>Has iniciat sessió amb l'usuari: ".$_SESSION['usuari']."</p>";
			date_default_timezone_set('Europe/Andorra');
			echo "<p>Data i hora: ".date('d/m/Y h:i:s')."</p>";						
        ?>
        <label class="diahora"> 
	</body>
</html>
