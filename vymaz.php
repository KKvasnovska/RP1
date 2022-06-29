<?php
$nadpis = "Vymaž recenziu";
include('hlavicka.php');
include('funkcie.php');
include('navigacia.php');
include('udaje.php');
?>
<section>
<?php


if (isset($_SESSION['admin'])) {	
	
	if (isset($_GET['iddd']) && ((int)$_GET['iddd'] >= 0) && rec_existuje($mysqli, $_GET['iddd'])) {
		$recenzia = $_GET['iddd'];
	if (!$mysqli->connect_errno) {
		$sql = "SELECT * FROM recenzie WHERE id=$recenzia"; 
		if ($result = $mysqli->query($sql)) {  			
			$row = $result->fetch_assoc();
			echo '<div><a href = "recenzie.php"><img alt="späť" src="obrazky/back.png" width="30" height="30"></a></div></br>';
			
			 odstran_recenziu($mysqli, $recenzia);
			 
			$result->free();			
		} else return false;
	} else echo '<p class="chyba">NEpodarilo sa spojiť s databázou!</p>';
}else echo 'Recenzia neexistuje';
	

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
