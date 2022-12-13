<?php
	session_start();
	session_unset();
	$cookie_sessio = session_get_cookie_params();
	setcookie("PHPSESSID","",time()-3600,$cookie_sessio['path'], $cookie_sessio['domain'], $cookie_sessio['secure'], $cookie_sessio['httponly']); 
	session_destroy();	
?>
<!DOCTYPE html>
<html lang="ca">
	<head>
		<meta charset="utf-8">
		<title>Visualitzador de l'agenda</title>
		<link rel="stylesheet" href="agenda.css">
	</head>
	<body>
		<h3><b>Ha finalitzat el temps d'expiració de la teva sessió</b></h3>
        <p>L'aplicació finalitza la sessió automàticament si es superen els 15 minuts de sessió</p>
        <p>Per poder continuar treballant cal tornar a iniciar una sessió</p><br>
		<p><a href="../index.html">Torna a la pàgina inicial</a></p>
		<p><a href="../login.php">Torna a la pàgina d'inici de sessió</a></p>
		<!-- <label class="diahora">  -->
        <!-- <php
			date_default_timezone_set('Europe/Andorra');
			echo "<p>Data i hora: ".date('d/m/Y h:i:s')."</p>";						
        ?>
         <label class="diahora">  -->
	</body>
</html> 
