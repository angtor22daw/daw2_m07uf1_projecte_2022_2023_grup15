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
		
	function fCreaTaula($llista,$tipus){
		foreach ($llista as $entrada) {
			$dadesEntrada = explode(":", $entrada);
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
			if ($tipus=="COMU"){
				
				echo "<tr><td>$id</td><td>$nom</td><td>$cognom1</td><td>$cognom2</td><td>$notaM01</td><td>$notaM02</td><td>$notaM03</td><td>$notaM04</td><td>$notaM11</td><td>$notaM12</td></tr>";
			}
			else{
				$carrec = $dadesEntrada[1];
				$tlf = $dadesEntrada[2]; 
				echo "<tr><td>$nom</td><td>$carrec</td><td>$tlf</td></tr>";
			}					
		}
		return 0;
	}
?>