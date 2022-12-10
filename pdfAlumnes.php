<?php
	session_start();
	if (!isset($_SESSION['usuari'])){
		header("Location: ./errors/error_acces.php");
	}
	if (!isset($_SESSION['expira']) || (time() - $_SESSION['expira'] >= 0)){
		header("Location: ./errors/logout_expira_sessio.php");
	}
    include_once "./vendor/autoload.php";
    use Dompdf\Dompdf;
    $dompdf = new Dompdf();
    ob_start();
    include "./visualitzarAlumnesAdmin.php";
    $html = ob_get_clean();
    $dompdf->loadHtml($html);
    $dompdf->render();
    header("Content-type: application/pdf");
    header("Content-Disposition: inline; filename=alumnes.pdf");
    echo $dompdf->output();
?>