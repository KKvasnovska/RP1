<?php
$nadpis = "Pridaj recenziu";

include('funkcie.php');
include('hlavicka.php');
include('navigacia.php');
include('udaje.php');
?>

<section>
<?php 

if (isset($_SESSION['user'])&&!isset($_SESSION['admin'])){
$chyby = array();

///////////////////
if (isset($_POST["pridaj_rec"])) {
	$pouzivatel = pouzivatel($mysqli, $_SESSION['id_pouz'],$meno=1);
	if (isset($_POST['nadpis'])) $nadpis = osetri($_POST['nadpis']); else $nadpis = '';	
	if (isset($_POST['recenzia'])) $popis = osetri($_POST['recenzia']); else $popis = '';	
	if (isset($_POST['hv'])) $hodnotenie = osetri($_POST['hv']); else $hodnotenie = '';	
		
	if (empty($nadpis)) $chyby['nadpis'] = 'Nezadali ste nadpis.';
	if (!popis_ok($popis)) $chyby['popis'] = 'Popis nemá aspoň 10 znakov.';
	if (empty($popis)) $chyby['popis'] = 'Nezadali ste popis.';
	if (empty($hodnotenie)) $chyby['hv'] = 'Nezadali ste hodnotenie.';
	
}
///////////////////




if(empty($chyby) && isset($_POST["pridaj_rec"])) {	
	pridaj_recenziu($mysqli,$pouzivatel, $nadpis, $popis, $hodnotenie); 
} else 

{ 
	if (!empty($chyby)) {
		echo '<p class="chyba"><strong>Chyby:</strong>:<br>';
		foreach($chyby as $ch) {
			echo "$ch<br>\n";}
 echo '</p>';}
?>
	<form method="post" class = "hodnotenie">
		<p>
		<label for="nadpis">Nadpis*:</label>
		<input type="text" name="nadpis" id="nadpis" size="30" value="<?php if (isset($_POST['nadpis'])) echo $_POST['nadpis'] ?>">
		<br>
		<label for="popis">Recenzia*:</label>
		<br>
		<textarea cols="100" rows="6" name="recenzia" required placeholder="(aspoň 10 znakov)"  id="recenzia"><?php if (isset($_POST['recenzia'])) echo $_POST['recenzia'] ?></textarea>
		<br>
		<label for="cena">Hodnotenie*:</label></br>
		
		
		<?php 
		if (isset($_POST['hv'])) {if ($_POST['hv'] == 1 || $_POST['hv'] == 2 ||$_POST['hv'] == 3||$_POST['hv'] == 4||$_POST['hv'] == 5) echo '<label for="img1"><img src="obrazky/star1.png" width="20" height="20"></label>';}else echo'<label for="img1"><img src="obrazky/star_outline.png" width="20" height="20"></label>'; 
		if (isset($_POST['hv'])) {if ($_POST['hv'] == 2 ||$_POST['hv'] == 3||$_POST['hv'] == 4||$_POST['hv'] == 5) echo '<label for="img2"><img src="obrazky/star1.png" width="20" height="20"></label>';}else echo'<label for="img2"><img src="obrazky/star_outline.png" width="20" height="20"></label>'; 
		if (isset($_POST['hv'])) {if ($_POST['hv'] == 3||$_POST['hv'] == 4||$_POST['hv'] == 5) echo '<label for="img3"><img src="obrazky/star1.png" width="20" height="20"></label>';}else echo'<label for="img3"><img src="obrazky/star_outline.png" width="20" height="20"></label>'; 
		if (isset($_POST['hv'])) {if ($_POST['hv'] == 4||$_POST['hv'] == 5) echo '<label for="img4"><img src="obrazky/star1.png" width="20" height="20"></label>';}else echo'<label for="img4"><img src="obrazky/star_outline.png" width="20" height="20"></label>'; 
		if (isset($_POST['hv'])) {if ($_POST['hv'] == 5) echo '<label for="img5"><img src="obrazky/star1.png" width="20" height="20"></label>';}else echo'<label for="img5"><img src="obrazky/star_outline.png" width="20" height="20"></label>'; 
			
		
		?>
		
		<input  type="radio" name="hv" id="img1" value=1<?php if (isset($_POST['hv'])) if ($_POST['hv'] == 1) echo ' checked '; ?>> 
		<input type="radio" name="hv" id="img2" value=2<?php if (isset($_POST['hv'])) if ($_POST['hv'] == 2) echo ' checked'; ?>> 
		<input type="radio" name="hv" id="img3" value=3<?php if (isset($_POST['hv'])) if ($_POST['hv'] == 3) echo ' checked'; ?>> 
		<input type="radio" name="hv" id="img4" value=4<?php if (isset($_POST['hv'])) if ($_POST['hv'] == 4) echo ' checked'; ?>> 
		<input type="radio" name="hv" id="img5" value=5<?php if (isset($_POST['hv'])) if ($_POST['hv'] == 5) echo ' checked'; ?>> 
			
		<br>
		<input type="submit" name="pridaj_rec" value="Pridaj recenziu">
		</p>  
  </form>
<?php
}}else echo 'Aby ste mohli napísať recenziu, musíte byť prihlásený do svojho uživateľského konta.'
  
?>	
</section>

<?php
include('pata.php');
?>
