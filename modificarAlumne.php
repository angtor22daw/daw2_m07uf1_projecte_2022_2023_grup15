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
		<h3><b>Modificació de notes dels alumnes</b></h3>

        <form action="modificarAlumne.php" method="POST">
            <label for="id">ID del alumne</label>
            <input type="text" name="id" id="id" required><br><br>
            <label for="nota">Selecciona el modul que vols modificar la nota: </label>
            <select name="moduls" id="moduls">
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
            <label for="nuevaNota">Nota Modificada</label>
            <input type="text" name="nuevaNota" id="nuevaNota" required><br><br>
            <input type="submit" value="Modificar">
        </form>
		<p><a href="menu_admin.php">Torna al menú</a></p>

        <?php
			require('./biblioteca.php');	
			echo "<p>Usuari utilitzant l'agenda: ".$_SESSION['usuari']."</p>";

			$autoritzat=fAutoritzacio($_SESSION['usuari']);
			if(!$autoritzat){
				echo "<p> Tipus d'usuari: Basic";
			}else{
				echo "<p> Tipus d'usuari: Administrador";
			}

            if(isset($_POST['id']) && isset($_POST['moduls']) && isset($_POST['nuevaNota'])){
                $id = $_POST['id'];
                $modul = $_POST['moduls'];
                $nota = $_POST['nuevaNota'];

                switch($modul){
                    case "M01":
                        $modul = "modul1";
                        break;
                    case "M02":
                        $modul = "modul2";
                        break;
                    case "M03":
                        $modul = "modul3";
                        break;
                    case "M04":
                        $modul = "modul4";
                        break;
                    case "M11":
                        $modul = "modul11";
                        break;
                    case "M12":
                        $modul = "modul12";
                        break;
                }
                // no se hacerlo :C

            }
        ?>

	</body>
</html>
