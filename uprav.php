<?php
$nadpis = "Uprav rezerváciu";
include('hlavicka.php');
include('funkcie.php');
include('navigacia.php');
include('udaje.php');
?>
<section>
<?php


if (isset($_SESSION['user'])) {		
	if (isset($_GET['idd']) && ((int)$_GET['idd'] >= 0) && rez_existuje($mysqli, $_GET['idd'])) {
		$rezervacia = $_GET['idd'];
	if (!$mysqli->connect_errno) {
		$sql = "SELECT * FROM rezervacie WHERE id_rezervacie=$rezervacia"; 
		if ($result = $mysqli->query($sql)) {  			
			$row = $result->fetch_assoc();
			echo '<div><a href = "konto.php"><img alt="späť" src="obrazky/back.png" width="30" height="30"></a></div></br>';
			
			if ($row['id_pouz'] != $_SESSION['id_pouz']) echo 'Ku týmto dátam NEmáš prístup.';
			else if (rez_date($mysqli, $rezervacia)) echo 'Túto rezerváciu už nie je možné upraviť.';
			else uprav_rezervaciu($mysqli,$rezervacia,$triedy,$mesta);
			
			$result->free();			
		} else return false;
	} else return false;
}else echo 'Rezervácia neexistuje';
	

?>





<?php



}  else {
?>
	Ku týmto dátam NEmáš prístup.
<?php
}
?>
</section>
<?php 
include('pata.php'); 
?>
