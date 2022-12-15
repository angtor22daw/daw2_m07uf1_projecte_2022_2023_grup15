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

    // if(fAutoritzacio($_SESSION['usuari'])){
	// 	header("Location: ./menu_admin.php");
	// }
?>
<!DOCTYPE html>
<html lang="ca">
	<head>
		<meta charset="utf-8">
		<title>Visualitzar Alumnes</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sidebars/">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bitter:400,700">
		<link href="css/sidebars.css" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
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
	</body>
</html>
