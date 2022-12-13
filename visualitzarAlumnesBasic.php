<?php
	ini_set('display_errors', 0);
	session_start();
	require("biblioteca.php");
	if (!isset($_SESSION['usuari'])){
		header("Location: ./errors/error_acces.php");
	}

	if (!isset($_SESSION['expira']) || (time() - $_SESSION['expira'] >= 0)){
		header("Location: ./errors/logout_expira_sessio.php");
	}

    if(fAutoritzacio($_SESSION['usuari'])){
		header("Location: ./menu_admin.php");
	}
?>
<!DOCTYPE html>
<html lang="ca">
	<head>
		<meta charset="utf-8">
		<title>Visualitzar Alumnes [BASIC]</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
		<style>
		table {
			border-collapse: collapse;
			border: 1px solid black;
			margin-left: 10px;
			margin-right: 10px;
		}
		</style>
	</head>
	<body>
	<h3><b>Llistat de tots els alumnes</b></h3>
		<table class="table table-striped">
			<thead class="thead-dark">
				<tr>
                    <th scope="col">ID</th>
					<th scope="col">Nom</th>
					<th scope="col">Primer cognom</th>
                    <th scope="col">Segon cognom</th>
                    <th scope="col">Nota M01</th>
                    <th scope="col">Nota M02</th>
                    <th scope="col">Nota M03</th>
                    <th scope="col">Nota M04</th>
                    <th scope="col">Nota M11</th>
                    <th scope="col">Nota M12</th>
				</tr>
			</thead>
			<tbody>
			<?php
				// require("biblioteca.php");
				$llista = fLlegeixFitxer(FITXER_ALUMNES);
				fCreaTaula($llista);
			?>
			</tbody>
		</table>
		
		<br>
		<form action="pdfAlumnes.php" method="POST" target="_blank">
			<input type="submit" value="Generar PDF">
		</form>
		<br>
		<!-- <form action="enviarMail.php" method="POST" target="_blank">
			<input type="submit" value="Enviar mail">
		</form> -->
		<!-- <a href="pdfAlumnes.php">Generar PDF</a> -->
		<p><a href="menu_basic.php">Torna al menú</a></p>
        <label class="diahora"> 
        <?php
			echo "<p>Has iniciat sessió amb l'usuari: ".$_SESSION['usuari']."</p>";
			date_default_timezone_set('Europe/Andorra');
			echo "<p>Data i hora: ".date('d/m/Y h:i:s')."</p>";						
        ?>
        <label class="diahora"> 
	</body>
</html>
