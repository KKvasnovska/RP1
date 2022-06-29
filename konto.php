<?php
$nadpis = "Moje konto";
include('hlavicka.php');
include('funkcie.php');
include('navigacia.php');
include('udaje.php');
?>
<section>
<?php

if (isset($_POST["submit"]) && over_pouzivatela($mysqli, $_POST["prihlasmeno"], $_POST["heslo"])) {
  echo '<p>Úspešne ste sa prihlásili do systému. </p>';	
} elseif (isset($_POST['odhlas'])) { 
	session_unset();
	session_destroy();
}

if (!isset($_SESSION['user'])) registracia($mysqli);
else {	
	echo '<div><strong>'.pouzivatel($mysqli, $_SESSION['id_pouz']).'</strong></div></br>' ;
?>

<form method="post"> 
  <p> 
    <input name="odhlas" type="submit" id="odhlas" value="Odhlás ma"> 
  </p> 
</form> 

<?php

if(isset($_SESSION['admin']))vypis_vsetky_rezervacie($mysqli, $triedy, $mesta);
else rezervacie($mysqli,$_SESSION['id_pouz'],$triedy,$mesta);

}  


?>
</section>
<?php 
include('pata.php'); 
?>
