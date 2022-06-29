<?php
$nadpis = "Ponuka";
include('hlavicka.php');
include('funkcie.php');
include('navigacia.php');
include('udaje.php');

?>

<section>

<?php 
$date = date('Y-m-d');
$chyby = array();
//////////////////////////////////////   FILTER   ///////////////////////////////////////

//////////////// Zruš filter
if (isset($_POST['zrus_filter'])){
	if (isset($_SESSION['dest'])) {unset($_SESSION['dest']);unset($_POST['dest']);}
	if (isset($_SESSION['p'])) {unset($_SESSION['p']);unset($_POST['p']);}
	if (isset($_SESSION['odlet'])) {unset($_SESSION['odlet']);unset($_POST['odlet']);}
	if (isset($_SESSION['prestup'])) {unset($_SESSION['prestup']);unset($_POST['prestup']);}
	if (isset($_SESSION['start'])) {unset($_SESSION['start']);unset($_POST['start']);}
	if (isset($_SESSION['end'])) {unset($_SESSION['end']);unset($_POST['end']);}
	if (isset($_SESSION['max_c'])){ unset($_SESSION['max_c']);unset($_POST['max_c']);}
	if (isset($_SESSION['zorad'])){ unset($_SESSION['zorad']);unset($_POST['zorad']);}
}
/////////////////////


/////////// udrž nadstavený filter
if(isset($_SESSION['dest'])) $dest = $_SESSION['dest']; 
if(isset($_SESSION['p'])) $pct = $_SESSION['p'];
if(isset($_SESSION['odlet'])) $odlet = $_SESSION['odlet']; 
if(isset($_SESSION['prestup'])) $prestup = $_SESSION['prestup']; 
if(isset($_SESSION['max_c'])) $cena = $_SESSION['max_c']; 
if(isset($_SESSION['zorad'])) $zorad = $_SESSION['zorad']; 
if(isset($_SESSION['start'])) $start = $_SESSION['start']; 
if(isset($_SESSION['end'])) $end = $_SESSION['end'];
////////////





////////////////////////////////////////////////////   filtruj
if (isset($_POST['filtruj'])){	
	if (isset($_POST['dest']))$dest = $_POST['dest'];
	if (isset($_POST['p']))$pct = $_POST['p'];
	if (isset($_POST['odlet']))$odlet = $_POST['odlet'];
	if (isset($_POST['prestup']))$prestup = $_POST['prestup'];
	if (isset($_POST['max_c']))$cena = $_POST['max_c'];
	if (isset($_POST['zorad'])){
		if ($_POST['zorad']=='najlacnejších')$zorad = '`cena` ASC';
		if ($_POST['zorad']=='najdrahších')$zorad = '`cena` DESC';
		if ($_POST['zorad']=='najskorších')$zorad = '`datum` ASC';}
	if (isset($_POST['start']))$start = $_POST['start'];
	if (isset($_POST['end']))$end = $_POST['end'];	
	
	if (!empty($start)&&!empty($end)) if($start>$end) $chyby['datum'] = 'Zadali ste nemožné ohraničenie dátumu.';
	
}

//////////////////                     nadstav session
if(empty($chyby) && isset($_POST["filtruj"])){
	
	if(isset($_POST["dest"])){$_SESSION['dest'] = $dest;}
	if(isset($_POST["p"])){$_SESSION['p'] = $pct;}
	if(isset($_POST["odlet"])){$_SESSION['odlet'] = $odlet;}
	if(isset($_POST["prestup"])){$_SESSION['prestup'] = $prestup;}
	if(isset($_POST["max_c"])){$_SESSION['max_c'] = $cena;}
	if(isset($_POST["zorad"])){$_SESSION['zorad'] = $zorad;}
	if(isset($_POST["start"])){$_SESSION['start'] = $start;}
	if(isset($_POST["end"])){$_SESSION['end'] = $end;}
	
	
	} else { 
	if (!empty($chyby)) {
		unset($_POST['filtruj']);
		echo '<p class="chyba"><strong>Chyby:</strong>:<br>';
		foreach($chyby as $ch) {
			echo "$ch<br>\n";}
 echo '</p>';}}
 /////////////////
 
 ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	
	
///////////////////////// FORMULÁR /////////////////////////
	?>
<div class="conteiner-fluid">
<div class="row">
	
<div class = "col-xl-3" >


<form method="post">

<fieldset >
	<legend>Filter:</legend>	
	<div id = "filter" >
	<p>
	<label for="dest">Destinácia:</label>	
	<select name="dest" id="dest">
	<option value=''>---</option>
	<?php 	
	if (isset($dest))
	{vypis_select_doprava($destinacie, $dest);}
	else 
	vypis_select_doprava($destinacie); 	
	?>	
	  </select><br></p> 
	
	<p>
	<label for="p">minimálny počet dostupných leteniek:</label>
	 <input type="number" name = 'p' id = 'p' min="1" max="15" step="1" <?php if (isset($pct)) echo ' value ='.$pct; ?>>
	</p>
	<p>
	<label for="start">Od kedy:</label>
	<input type="date" id="start" name="start"   min= <?php echo $date; ?> max="2023-12-31" <?php if (isset($start)) echo ' value ='.$start; ?>>	
	
	<label for="end">Do kedy:</label>
	<input type="date" id="end" name="end"  min= <?php echo $date; ?> max="2023-12-31" <?php if (isset($end)) echo ' value ='.$end; ?>>
	</p>
	
	<p>
	<label for="odlet">Odlet z:</label>	
	<select name="odlet" id="odlet">
	<option value=''>---</option>
	<?php 	
	if (isset($odlet)) 
	{vypis_select_doprava($letiska, $odlet);}
	else 
	vypis_select_doprava($letiska); 		
	?>	
	  </select></p> 

	  
	 <p>
	<input type="checkbox" name="prestup" id="prestup" value="priamy let"<?php if (isset($prestup)) echo ' checked'; ?>> <label for="prestup">bez prestupov</label>
	</p>
	<div>
	<label for="max_c">Cena do:</label>
	0
	<input type="range" name = 'max_c' id = 'max_c' min="0" max="115" step="5" <?php if (isset($cena)) echo ' value ='.$cena; else echo ' value = 115' ; ?>>
	115€
	<?php if (isset($cena))echo '<p id = "cena">'.$cena.'€</p>';	?>
	</div>
	
	<p><label for="zorad">Zoradiť od: </label>
	<input type="radio" name="zorad" id="lacne" value="najlacnejších"<?php if (isset($zorad)) if ($zorad == 'najlacnejších') echo ' checked'; ?>> <label for="lacne">najlacnejších</label>
	<input type="radio" name="zorad" id="drahe" value="najdrahších"<?php if (isset($zorad)) if ($zorad == 'najdrahších') echo ' checked'; ?>> <label for="drahe">najdrahších</label>
	<input type="radio" name="zorad" id="skoro" value="najskorších"<?php if (isset($zorad)) if ($zorad == 'najskorších') echo ' checked'; ?>> <label for="skoro">najskorších termínov</label>
	</p>
  	
	
  	
</div>
	<input class = "fbutton" type="submit" name="filtruj" value="Filtruj" >
	<input class = "fbutton" type="submit" name="zrus_filter" value="Zruš filter" >
	</fieldset>

</form>

</div>
<div class="col-xl-9">
<?php
/////////   zvolená letenka
if (isset($_GET['id']) && ((int)$_GET['id'] >= 0) && letenka_existuje($mysqli, $_GET['id'])) {
$_SESSION['id'] = $_GET['id'];}
////////

if(isset($_SESSION['dest'])) $dest = $_SESSION['dest']; else $dest = -1;
if(isset($_SESSION['p'])) $pct = $_SESSION['p']; else $pct = 0;
if(isset($_SESSION['odlet'])) $odlet = $_SESSION['odlet']; else $odlet = -1;
if(isset($_SESSION['prestup'])) $prestup = $_SESSION['prestup']; else $prestup = 0;
if(isset($_SESSION['max_c'])) $cena = $_SESSION['max_c']; else $cena = -1;
if(isset($_SESSION['zorad'])) $zorad = $_SESSION['zorad']; else $zorad = '`id` ASC';
if(isset($_SESSION['start'])) $start = $_SESSION['start']; else $start = 0;
if(isset($_SESSION['end'])) $end = $_SESSION['end']; else $end = 0;
	
if(isset($_SESSION['id'])){
	
	echo '<div>Máte zvolenú letenku: <br>'.vypis_letenku($mysqli,$_SESSION['id']);
	echo'<a href = "rezervacia.php" ><input type="button" name="rezervovat" value="Prejsť na rezerváciu" class = "button"></a></div></br>';
	echo '<p></p>'	;	

			
			}

vypis_letenky($mysqli,$dest,$pct,$odlet,$prestup,$cena,$zorad,$start,$end,$letiska,$destinacie);



?>
</div>
</div></div>
</section>

<?php
include('pata.php');
?>
