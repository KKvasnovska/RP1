<?php
$nadpis = "Pouzivatel";
include('hlavicka.php');
include('funkcie.php');
include('navigacia.php');
include('udaje.php');
?>
<section>
<?php

echo '<div><a href = "konto.php"><a href = "konto.php"><img alt="späť" src="obrazky/back.png" width="30" height="30"></a></a></div></br>';
if (isset($_SESSION['admin'])) {	
	
	if (isset($_GET['idecko']) && ((int)$_GET['idecko'] > 0) && existuje($mysqli, $_GET['idecko'])) {
		$pouz = $_GET['idecko'];
	if (!$mysqli->connect_errno) {
		$sql = "SELECT * FROM pouzivatelia WHERE id_pouz=$pouz"; 
		if ($result = $mysqli->query($sql)) {  			
			$row = $result->fetch_assoc();
			echo '<div class="nadpis1"> Informácie o použivatelovi:</div>';
			echo '<div id="pouzivatel" >Meno: <strong>'.$row['meno'].' '.$row['priezvisko'].'</strong><br>';
			echo 'Email: <strong>'.$row['email'].'</strong></br>';
			echo 'Adresa: <strong>'.$row['adresa'].'</strong></br>';
			echo 'Telefón: <strong>+421'.$row['tel'].'</strong></br></div><br>';
			echo '<h4>Rezervácie:</h4>';
			vsetky_rezervacie($mysqli,$pouz,$triedy,$mesta);
			
			$result->free();			
		} else return false;
	} else {echo '<p class="chyba">NEpodarilo sa spojiť s databázovým serverom!</p>'; return false;}
} else echo 'Neexistujúci použivatel.';return false;
	

?>





<?php



}  else {
?>
	Ku týmto dátam má prístup iba admin.
<?php
}
?>
</section>
<?php 
include('pata.php'); 
?>
