<?php
$nadpis = "Rezervácia leteniek";
include('hlavicka.php');
include('funkcie.php');
include('navigacia.php');
include('udaje.php');
?>

<section>
<?php

if (isset($_POST["submit"]) && over_pouzivatela($mysqli, $_POST["prihlasmeno"], $_POST["heslo"])){$_SESSION['user'] = $_POST['prihlasmeno'];}


/////////////////////////////////  zruš session - rezevácie
if (isset($_POST['zrus'])){
	if(isset($_SESSION["id"]))unset($_SESSION['id']);
	if(isset($_SESSION["pocet"]))unset($_SESSION['pocet']);
	if(isset($_SESSION["poistenie"]))unset($_SESSION['poistenie']);
	if(isset($_SESSION["trieda"]))unset($_SESSION['trieda']);
	if(isset($_SESSION["doprava"]))unset($_SESSION['doprava']);
	if(isset($_SESSION["batozina"]))unset($_SESSION['batozina']);	
}/////////////////////////////////

///////////////////////////////// nadstav hodnoty uložené v session
	if(isset($_SESSION["pocet"]))$pocet = $_SESSION['pocet'];
	if(isset($_SESSION["poistenie"]))$poistenie = $_SESSION['poistenie'];
	if(isset($_SESSION["trieda"]))$trieda = $_SESSION['trieda'];
	if(isset($_SESSION["doprava"])){$doprava = $_SESSION['doprava'];}
	if(isset($_SESSION["batozina"])){$batozina = $_SESSION['batozina'];}
//////////////////////////////

		

///////////////////////// skontroluj povinné položky
if (isset($_POST["prehlad"])) {
	if (!isset($_SESSION['user'])) $chyby['pouzivatel'] ='Nie ste prihásený.';
	else if (isset($_SESSION['admin'])) $chyby['pouzivatel'] ='Admin nemôže vytoriť rezerváciu.';
	
	else{		
	if (isset($_POST["trieda"]))$trieda = ($_POST['trieda']);
	if (isset($_POST["pocet"]))$pocet = ($_POST['pocet']); 
	if (isset($_POST["poistenie"])) $poistenie = ($_POST['poistenie']);
	if (isset($_POST["doprava"])) $doprava = ($_POST['doprava']);
	if (isset($_POST["batozina"])) $batozina = ($_POST['batozina']);
	
	if (!isset($_SESSION['id'])) $chyby['letenka'] = 'Nezvolili ste si letenku.';
	if (empty($pocet)) $chyby['pocet'] = 'Nezvolili ste si počet.';
	
	if ($trieda!=0) if(empty($trieda)) $chyby['trieda'] = 'Nezvolili ste si triedu.';
	if (empty($poistenie)) $chyby['poistenie'] = 'Nezvolili ste si poistenie.';
	}	
}  
//////////////////////////////

///////////////////////////////// uchovaj zvolené položky
if (isset($_POST['zmen'])) {
	unset($_POST["prehlad"]);
	$pocet = $_SESSION['pocet'];
	$poistenie = $_SESSION['poistenie'];
	$trieda = $_SESSION['trieda'];
	if(isset($_SESSION["doprava"])){$doprava = $_SESSION['doprava'];}
	if(isset($_SESSION["batozina"])){$batozina = $_SESSION['batozina'];}
}
/////////////////////////////////////////



////////////////////////////////////   prebehne rezervácia

else if ((isset($_POST['zarezervuj']))&&(isset($_SESSION['user']))) {
	if(!(isset($_SESSION['doprava']))&&!(isset($_SESSION['batozina'])))pridaj_rezervaciu($mysqli, $_SESSION['id_pouz'], $_SESSION['id'], $_SESSION['cena'], $_SESSION['pocet'], $_SESSION['trieda'], $_SESSION['poistenie'], 0 ,0);
	else if(!(isset($_SESSION['doprava'])))pridaj_rezervaciu($mysqli, $_SESSION['id_pouz'], $_SESSION['id'], $_SESSION['cena'], $_SESSION['pocet'], $_SESSION['trieda'], $_SESSION['poistenie'], 0 ,$_SESSION['batozina']);
	else if(!(isset($_SESSION['batozina'])))pridaj_rezervaciu($mysqli, $_SESSION['id_pouz'], $_SESSION['id'], $_SESSION['cena'], $_SESSION['pocet'], $_SESSION['trieda'], $_SESSION['poistenie'], $_SESSION['doprava'] ,0);
	if((isset($_SESSION['doprava']))&&(isset($_SESSION['batozina'])))pridaj_rezervaciu($mysqli, $_SESSION['id_pouz'], $_SESSION['id'], $_SESSION['cena'], $_SESSION['pocet'], $_SESSION['trieda'], $_SESSION['poistenie'], $_SESSION['doprava'],$_SESSION['batozina'] );
	
	zmen_dostupne_letenky($mysqli, $_SESSION['id'], ($_SESSION['max_pocet']-$_SESSION['pocet']));
	
	//////////// zruš session pre vybavenú rezerváciu
	unset($_POST["prehlad"]);
	unset($_SESSION["id"]);
	unset($_SESSION['poistenie']);
	unset($_SESSION['pocet']);
	if (isset($_SESSION['doprava'])) unset($_SESSION['doprava']);
	if (isset($_SESSION['batozina'])) unset($_SESSION['batozina']);
	unset($_SESSION['trieda']);
	unset($_SESSION['cena']);
	/////////////////////////////
}	
///////////////////////////////////////////////////


///////////////////////////     prehlad rezervácie	
if(empty($chyby) && isset($_POST["prehlad"])){
	$_SESSION['pocet'] = $pocet;
	$_SESSION['poistenie'] = $poistenie;
	$_SESSION['trieda'] = $trieda;
	if(isset($_POST["doprava"])){$_SESSION['doprava'] = $doprava;}
	if(isset($_POST["batozina"])){$_SESSION['batozina'] = $batozina;}	
	echo '<div id="rezerv">';
	vypis_rezervaciu($mysqli, $triedy, $mesta);	
	echo '</div>';
	}	
		
 else { 
	if (!empty($chyby)) {
		unset($_POST['prehlad']);
		echo '<p class="chyba"><strong>Chyby:</strong>:<br>';
		foreach($chyby as $ch) {
			echo "$ch<br>\n";}
 echo '</p>';}}
 
 
 /////////////////////////
		
		
if(!isset($_SESSION['user'])){
	echo '<p> Aby ste mohli vytvoriť rezerváciu, musíte byť prihlásený. Ak ešte nemáte konto, môžete si ho vytvoriť.</p>';
	registracia($mysqli);}



////////////////////////////      FORMULÁR            /////////////////////////////
if(!(isset($_POST['prehlad']))&&!(isset($_POST['zarezervuj']))){
?>

<form method="post">

<fieldset class="bgw">
	<legend>Rezervácia</legend>	
	<div id="rezervacia">
	<label for="tovar">Letenka*:</label> 
	<?php 
	if (isset($_SESSION['id'])) echo '<p>'.vypis_letenku($mysqli, $_SESSION['id']).'</p>';	
	else echo'<br><small>Ešte nemáte zvolenú letenku, tu si môžeš vybrať: </small> <a href = "ponuka.php" ><input type="button" name="ponuka2" value="Letenky" ></a>';
	?>	
	
	<p>	
	<label for="pocet">počet kusov*:</label>
	<select name="pocet" id="pocet">
<?php 
if (isset($pocet)) vypis_select_pocet(0, $_SESSION['max_pocet'], $pocet); 
else {
	if (isset($_SESSION['id']))vypis_select_pocet(0, $_SESSION['max_pocet']);else vypis_select_pocet(0,0); }
	
?>
  </select><br></p>	
	<p>
	<label for="trieda">trieda*:</label>
	<select name="trieda" id="trieda">
	<option value=''>---</option>
	<?php 
	
	if (isset($trieda)) {
		vypis_select_trieda($triedy, $trieda);}
	else 	vypis_select_trieda($triedy);	
	?>
	
	  </select><br></p>  
	  
	   <p>
	 *
	<input type="radio" name="poistenie" id="bez_poistenia" value="bez poistenia"<?php if (isset($poistenie) && $poistenie=="bez poistenia") echo ' checked'; ?>> <label for="bez_poistenia">bez poistenia</label>
	<input type="radio" name="poistenie" id="s_poistenim" value="s poistením"<?php if (isset($poistenie) && $poistenie=="s poistením") echo ' checked'; ?>> <label for="s_poistenim">s poistením  (4,20€)</label>
	<br></p>
	  
	  <p>
	<label for="batozina">Batožina za príplatok:</label>
	<br><input type="radio" name="batozina" id="bat0" value="+ príručná(do 15kg)"<?php if (isset($batozina) && $batozina=="+ príručná(do 15kg)") echo ' checked'; ?>> <label for="bat1">+ príručná(do 15kg) - 15€  </label>
    <br><input type="radio" name="batozina" id="bat1" value="+ podaná(do 25kg)"<?php if (isset($batozina) && $batozina=="+ podaná(do 25kg)") echo ' checked'; ?>> <label for="bat1">+ podaná(do 25kg) - 30€</label>
	<br><input type="radio" name="batozina" id="bat2" value="+ podaná(do 35kg)"<?php if (isset($batozina) && $batozina=="+ podaná(do 35kg)") echo ' checked'; ?>> <label for="bat2">+ podaná(do 35kg) - 50€</label>
	</p> 
  <p>
	<label for="doprava">Doprava na letisko: (6€)</label>	
	<select name="doprava" id="doprava">
	<option value=''>-- vlastná --</option>
	<?php 	
	
	if (isset($doprava)) 
	{vypis_select_doprava($mesta, $doprava);}
	else 
	vypis_select_doprava($mesta); 		
	?>	
	  </select><br></p>  

	</div>
	</fieldset>
	<small>* povinné položky</small></br>
<input type="submit" name="prehlad" value="Prehľad rezervácie" class = "fbutton">
<input type="submit" name="zrus" value="Zruš" class = "fbutton">
</form>

<?php
}
	
?>
</section>

<?php
include('pata.php');
?>