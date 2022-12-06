<?php
	define('TEMPS_EXPIRACIO',900); #TEMPS D'EXPIRACIÓ DE LA SESSIÓ EN SEGONS
	define('TIMEOUT',5); #TEMPS DE VISUALITZACIÓ DEL MISSATGE INFORMATIU SOBRE LA CREACIÓ D'USUARIS
	define('COMU',"COMU");
	define('PROFESSIONAL',"PROFESSIONAL");
	define('ADMIN','1');
	define('USR','0');
	define('FITXER_USUARIS','./usuaris/usuaris');
	define('FITXER_ALUMNES','./alumnes/alumnes');
	
	
	function fLlegeixFitxer($nomFitxer){
		if ($fp=fopen($nomFitxer,"r")) {
			$midaFitxer=filesize($nomFitxer);
			$dades = explode(PHP_EOL, fread($fp,$midaFitxer));
			fclose($fp);
		}
		return $dades;
	}
	
	function fAutoritzacio($nomUsuariComprova){
		$usuaris = fLlegeixFitxer(FITXER_USUARIS);
		foreach ($usuaris as $usuari) {
			$dadesUsuari = explode(":", $usuari);
			$nomUsuari = $dadesUsuari[0];
			$ctsUsuari = $dadesUsuari[1];
			$tipusUsuari = $dadesUsuari[2];
			if(($nomUsuari == $nomUsuariComprova) && ($tipusUsuari==ADMIN)){
				$autoritzat=true;
				break;	
			}
			else  $autoritzat=false;
		}
		return $autoritzat;
	}
	
	function fAutenticacio($nomUsuariComprova){
		$usuaris = fLlegeixFitxer(FITXER_USUARIS);
		foreach ($usuaris as $usuari) {
			$dadesUsuari = explode(":", $usuari);
			$nomUsuari = $dadesUsuari[0];
			$ctsUsuari = $dadesUsuari[1];
			if(($nomUsuari == $nomUsuariComprova) && (password_verify($_POST['password'],$ctsUsuari))){
				$autenticat=true;
				break;
			}
			else  $autenticat=false;
		}
		return $autenticat;
	}
	
	function fActualitzaUsuaris($nomUsuari,$ctsnya,$tipus){
		$ctsnya_hash=password_hash($ctsnya,PASSWORD_DEFAULT);
		$dades_nou_usuari=$nomUsuari.":".$ctsnya_hash.":".$tipus."\n";
		if ($fp=fopen(FITXER_USUARIS,"a")) {
			if (fwrite($fp,$dades_nou_usuari)){
				$afegit=true;
			}
			else{
				$afegit=false;
			}				
			fclose($fp);
		}
		else{
			$afegit=false;
		}
		return $afegit;
	}

	function fActualitzaAlumnes($nom_nou_alumne,$primerCognom_nou_alumne,$segonCognom_nou_alumne,$nota_M01,$nota_M02,$nota_M03,$nota_M04,$nota_M11,$nota_M12){
		$alumnes = fLlegeixFitxer(FITXER_ALUMNES);

		$identificador=count($alumnes)+1;
		$dades_nou_alumne="\n".$identificador.":".$nom_nou_alumne.":".$primerCognom_nou_alumne.":".$segonCognom_nou_alumne.":".$nota_M01.":".$nota_M02.":".$nota_M03.":".$nota_M04.":".$nota_M11.":".$nota_M12;
		
		if ($fp=fopen(FITXER_ALUMNES,"a")) {
			if (fwrite($fp,$dades_nou_alumne)){
				$afegitAlumne=true;
			}
			else{
				$afegitAlumne=false;
			}				
			fclose($fp);
		}
		else{
			$afegitAlumne=false;
		}
		return $afegitAlumne;
	}

	function fEliminarAlumne($idAlumne){
		$alumnes = fLlegeixFitxer(FITXER_ALUMNES);
		$llistaAlumnes = array();
		foreach ($alumnes as $alumne) {
			$dadesAlumne = explode(":", $alumne);
			if($dadesAlumne[0] != $idAlumne){
				array_push($llistaAlumnes, $alumne);
			}
		}
		$llistaAlumnes = implode(PHP_EOL, $llistaAlumnes);
		if ($fp=fopen(FITXER_ALUMNES,"w")) {
			if (fwrite($fp,$llistaAlumnes)){
				$eliminat=true;
			}
			else{
				$eliminat=false;
			}				
			fclose($fp);
		}
		else{
			$eliminat=false;
		}
		return $eliminat;
	}
	

	function fModificarAlumne($idAlumne,$notaAntiga,$notaNova){
		$alumnes = fLlegeixFitxer(FITXER_ALUMNES);
		$llistaAlumnes = array();
		foreach ($alumnes as $alumne) {
			$dadesAlumne = explode(":", $alumne);
			if($dadesAlumne[0] == $idAlumne){
				switch($notaAntiga){
					case "M01":
						$dadesAlumne[4] = $notaNova;
						break;
					case "M02":
						$dadesAlumne[5] = $notaNova;
						break;
					case "M03":
						$dadesAlumne[6] = $notaNova;
						break;
					case "M04":
						$dadesAlumne[7] = $notaNova;
						break;
					case "M11":
						$dadesAlumne[8] = $notaNova;
						break;
					case "M12":
						$dadesAlumne[9] = $notaNova;
						break;
				}
				$alumneModificat = $dadesAlumne[0].":".$dadesAlumne[1].":".$dadesAlumne[2].":".$dadesAlumne[3].":".$dadesAlumne[4].":".$dadesAlumne[5].":".$dadesAlumne[6].":".$dadesAlumne[7].":".$dadesAlumne[8].":".$dadesAlumne[9];
				$alumneModificat = str_replace($notaAntiga, $notaNova, $alumneModificat);
				array_push($llistaAlumnes, $alumneModificat);
			}
			else{
				array_push($llistaAlumnes, $alumne);
			}
		}
		$llistaAlumnes = implode(PHP_EOL, $llistaAlumnes);
		if ($fp=fopen(FITXER_ALUMNES,"w")) {
			if (fwrite($fp,$llistaAlumnes)){
				$modificat=true;
			}
			else{
				$modificat=false;
			}				
			fclose($fp);
		}
		else{
			$modificat=false;
		}
		return $modificat;
	}

	function fCreaTaula($llista){
		foreach ($llista as $entrada) {
			$dadesEntrada = explode(":", $entrada);
			echo '<pre>'; print_r($entrada); echo '</pre>';
			$id = $dadesEntrada[0];
			$nom = $dadesEntrada[1];
			$cognom1 = $dadesEntrada[2];
			$cognom2 = $dadesEntrada[3];
			$notaM01 = $dadesEntrada[4];
			$notaM02 = $dadesEntrada[5];
			$notaM03 = $dadesEntrada[6];
			$notaM04 = $dadesEntrada[7];
			$notaM11 = $dadesEntrada[8];
			$notaM12 = $dadesEntrada[9];

			echo "<tr><td>$id</td><td>$nom</td><td>$cognom1</td><td>$cognom2</td><td>$notaM01</td><td>$notaM02</td><td>$notaM03</td><td>$notaM04</td><td>$notaM11</td><td>$notaM12</td></tr>";
				
		}
		return 0;
	}
?>