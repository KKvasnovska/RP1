<?php

date_default_timezone_set('Europe/Bratislava');

function vypis_select_pocet($min, $max, $oznac = -1) {
	if ($oznac === '') {$oznac = -1;}
	for($i = $min; $i <= $max; $i++) {
		echo "<option value='$i'";
		if ($i == $oznac) echo ' selected';
		echo ">$i</option>\n";	
	}	
}	

function vypis_letenku($mysqli, $id) {
	$mysqli = new mysqli('localhost', 'root', '', 'letenky');
	if (!$mysqli->connect_errno) {
	$sql = "SELECT * FROM `letenky` WHERE `id` = $id"; 		
	if ($result = $mysqli->query($sql)) { 	
			while ($row = $result->fetch_assoc()){
				$_SESSION['max_pocet'] = $row['pocet'];
				$_SESSION['cena_letenky'] = $row['cena'];	
			return "<strong> {$row['destinacia']} ({$row['cena']} &euro;) + {$row['batožina']}  </strong></br>";						
				
			} 
	}else {echo '<p class="chyba">NEpodarilo sa získať údaje z databázy!</p>';}
	}echo '<p class="chyba">NEpodarilo sa spojiť s databázou! </p>';
	}
	
function vypis_letenky($mysqli,$dest,$pocet,$odlet,$prestup,$cena,$zorad,$start,$end,$letiska,$destinacie){
	if ($mysqli->connect_errno) {echo '<p class="chyba">NEpodarilo sa pripojiť! (' . $mysqli->connect_errno . ' - ' . $mysqli->connect_error . ')</p>';
} else {
	$pct = 0;
	echo '<div >';
	
	//////////////////////////////////// vykonávam dopyt podľa zvolených položiek filtra
	$sql = "SELECT * FROM letenky ";  
	if($dest != -1 && $dest != ''){$pct++; $sql .= "WHERE `destinacia` = '$destinacie[$dest]' ";}
	
	if($pocet != 0 && $pocet != ''){if ($pct > 0) $sql .= "AND ";else $sql .= "WHERE ";
		$pct++; $sql .= "`pocet` >= '$pocet' ";}		
		else{if ($pct > 0) $sql .= "AND ";else $sql .= "WHERE ";
			$pct++; $sql .= "`pocet` >= '1' ";}	
		
	if($odlet != -1 && $odlet != ''){if ($pct > 0) $sql .= "AND ";else $sql .= "WHERE ";
		$pct++; $sql .= "`odlet` = '$letiska[$odlet]' ";}
	if($prestup != 0 && $prestup != ''){if ($pct > 0) $sql .= "AND ";else $sql .= "WHERE ";
		$pct++; $sql .= "`prestup` = 'priamy let' ";}
	if($cena != -1 && $cena != ''){if ($pct > 0) $sql .= "AND ";else $sql .= "WHERE ";
		$pct++; $sql .= "`cena` <= {$cena} ";}
	if($start != 0 && $start != ''){if ($pct > 0) $sql .= "AND ";else $sql .= "WHERE ";
		$pct++; $sql .= "`datum` >= '$start' ";}		
		else {if ($pct > 0) $sql .= "AND ";else $sql .= "WHERE ";
		$pct++; $sql .= "`datum` >= NOW() ";}
		
		
	if($end != 0 && $end != ''){if ($pct > 0) $sql .= "AND ";else $sql .= "WHERE ";
		$pct++; $sql .= "`datum` <= '$end' ";}
		
	$sql .= " ORDER BY {$zorad}";
	///////////////////////////////////////////////////
	
	/////////////////////////////// vypíš jednu letenku  
	if ($result = $mysqli->query($sql)) { 
		while ($row = $result->fetch_assoc()) {
			if(isset($_SESSION['id'])&&($_SESSION['id'] == $row['id'])){
				echo '<div id = "vybrata_letenka">';
				echo '<h2 id = "vybrata_destinacia"><img alt="airplane" src="obrazky/lietadielko.png" width="25" height="25">' . $row['destinacia'].'<img alt="airplane" src="obrazky/lietadielko.png" width="25" height="25"></h2>';
				
				}
			else {echo '<div id = "letenka">';
			
			echo '<h2 id = "destinacia">' . $row['destinacia']."</h2>";}
			echo  "<h3>Informácie o letenke:</h3>";
			
			$date = date_create_from_format('Y-m-d', $row['datum']);			
			echo  '<div class = "ponuka"><small>'. date_format($date, "j.n.Y").' </small></br>' ;
					
			echo  '</br><strong>Cena:</strong> '.$row['cena'] . "&euro;";
			
			
			$times = date_create_from_format('H:i:s', $row['cas_odletu']);
			$timee = date_create_from_format('H:i:s', $row['cas_priletu']);
									
			echo  '<p><strong>Odlet:</strong> '.date_format($times, "H:i") . " - ".$row['odlet'] .'</br> <strong>Prílet:</strong> '.date_format($timee, "H:i").' - '.$row['destinacia'] ;
			echo  '<p><strong>Batožina: </strong>'.$row['batožina'] ;
			if ($row['prestup'] != 'priamy let')echo  '<p><strong>Prestup: </strong>'.$row['prestup'] ;
			
			echo '</p></div>';			
			
			if(!isset($_SESSION['id'])||($_SESSION['id'] != $row['id'])) echo'<a href="ponuka.php?id=' . $row['id'] . '" class = "link">Vybrať</a>';
						
			echo '</div>';		
			
		}
	//////////////////////////////////////
		$result->free();
	} elseif ($mysqli->errno) echo '<p class="chyba">NEpodarilo sa vykonať dopyt! (' . $mysqli->error . ')</p>';
		echo'</div>';}
	}

function vypis_select_trieda($triedy, $oznac = -1) {
	if ($oznac === '') {$oznac = -1;}
	foreach($triedy as $ind => $hodn) {
		echo "<option value='$ind'";
		if ($ind == $oznac) echo ' selected';		
		echo ">" . $hodn['typ'] . ' (+ ' . $hodn['percento'] . "%)</option>\n";
	}
}

function vypis_select_doprava($mesta, $oznac = -1) {
	if ($oznac === '') {$oznac = -1;}
	foreach($mesta as $ind => $hodn) {
		echo "<option value='$ind'";
		if ($ind == $oznac) echo ' selected';		
		echo ">" . $hodn .  "</option>\n";
	}
}

function spravne_meno($m) {
  $medzera = strpos($m, ' ');
  if (!$medzera) return false;       
  $priezvisko = substr($m, $medzera+1);  
  return ($medzera > 2 && (strpos($priezvisko, ' ') === FALSE) && strlen($priezvisko) > 2);
}

function mail_ok($email) {
   $zavinac = strpos($email, '@');
   $bodka = strpos($email, '.');
   return ($zavinac !== false && $bodka !== false && $bodka > $zavinac);
}

function spravna_adresa($a) {return strlen($a) >= 10;}

function osetri($co) {return addslashes(trim(strip_tags($co)));}

function prihlas_meno_ok($mysqli, $prihlasmeno){
	/////////////////// existuje prihlas meno? ak áno ->  false (nemôžem ho použiť lebo už existuje)
	$return = true;
	if (!$mysqli->connect_errno) {
	$sql = "SELECT * FROM pouzivatelia";  		
	if (($result = $mysqli->query($sql)) && ($result->num_rows > 0)) {	
	while ($row = $result->fetch_assoc()){
		if ($row['prihlasmeno'] == $prihlasmeno) $return = false;						
	}return $return;
	}else return $return;
	
	}else echo '<p class="chyba">NEpodarilo sa spojiť s databázou!</p>';
}

function existuje($mysqli, $id){/////////    existuje použivateľ?
	$return = false;
	if (!$mysqli->connect_errno) {
	$sql = "SELECT * FROM pouzivatelia";  		
	if (($result = $mysqli->query($sql)) && ($result->num_rows > 0)) {	
	while ($row = $result->fetch_assoc()){
		if ($row['id_pouz'] == $id) $return = true;
						
	}return $return;
	}else return false;
	
	}else echo '<p class="chyba">NEpodarilo sa spojiť s databázou!</p>';
}

function rez_existuje($mysqli, $id){/////////    existuje rezervácia?
	$return = false;
	if (!$mysqli->connect_errno) {
	$sql = "SELECT * FROM rezervacie";  		
	if (($result = $mysqli->query($sql)) && ($result->num_rows > 0)) {	
	while ($row = $result->fetch_assoc()){
		if ($row['id_rezervacie'] == $id) $return = true;
						
	}return $return;
	}else return false;
	
	}else echo '<p class="chyba">NEpodarilo sa spojiť s databázou!</p>';
}

function rez_date($mysqli, $id){/////////    nie je neplatná (dátum starší ako dnešný)
	$return = false;
	if (!$mysqli->connect_errno) {
	$sql = "SELECT * FROM rezervacie, letenky WHERE rezervacie.id_letenky=letenky.id";  		
	if (($result = $mysqli->query($sql)) && ($result->num_rows > 0)) {	
	while ($row = $result->fetch_assoc()){
		if ($row['id_rezervacie'] == $id){ 
			if ($row['datum'] < date('Y-m-d'))$return = true;
		}
	}return $return;
	}else return false;
	
	}else echo '<p class="chyba">NEpodarilo sa spojiť s databázou!</p>';
}

function rec_existuje($mysqli, $id){/////////    existuje recenzia?
	if (!$mysqli->connect_errno) {
	$sql = "SELECT * FROM recenzie";  		
	if (($result = $mysqli->query($sql)) && ($result->num_rows > 0)) {	
	while ($row = $result->fetch_assoc()){
		if ($row['id'] == $id) $return = true;
						
	}return $return;
	}else return false;
	
	}else echo '<p class="chyba">NEpodarilo sa spojiť s databázou!</p>';
}

function letenka_existuje($mysqli, $id){/////////    existuje letenka?
	$return = false;
	if (!$mysqli->connect_errno) {
	$sql = "SELECT * FROM letenky";  		
	if (($result = $mysqli->query($sql)) && ($result->num_rows > 0)) {	
	while ($row = $result->fetch_assoc()){
		if ($row['id'] == $id) $return = true;
						
	}return $return;
	}else return false;
	
	}else echo '<p class="chyba">NEpodarilo sa spojiť s databázou!</p>';
}

function prihlas_meno_ok_dlzka ($nazov) {return strlen($nazov) >= 5 && strlen($nazov) <= 30;}

function nazov_ok ($nazov) {return strlen($nazov) >= 3 && strlen($nazov) <= 30;}

function popis_ok ($popis) {return strlen($popis) >= 10;}

function heslo_ok ($heslo) {return strlen($heslo) >= 5 && strlen($heslo) <= 30;}

function tel_num ($tel) {return is_numeric($tel);}

function tel_ok ($tel) {return (strlen($tel)) == 9 && ((int) $tel) > 900000000;}

function over_pouzivatela($mysqli, $username, $pass) {
	if (!$mysqli->connect_errno) {
		$sql = "SELECT * FROM pouzivatelia WHERE prihlasmeno='$username' AND heslo=MD5('$pass')"; 
		if (($result = $mysqli->query($sql)) && ($result->num_rows > 0)) {  			
			$row = $result->fetch_assoc();
			$_SESSION['id_pouz'] = $row['id_pouz'];	         /// zapamätaj prihláseného použivatela do session
			$_SESSION['user'] = $row['prihlasmeno'];
			if ($row['admin']==1){$_SESSION['admin'] = true;}
			$result->free();
			return $row;
		} else {echo'<p class="chyba">Nepodaril sa pokus o prihlásenie. Skontrolujte, či ste zadali správne údaje.</p>';return false;}
	} else {echo '<p class="chyba">NEpodarilo sa spojiť s databázou! </p>';return false;}
}

function vypis_rezervaciu($mysqli, $triedy, $mesta) {  

//////////////// prehlad zvolených položiek (rezervácie) + počíta sa výsledná cena  ///////////
	
	$cena = $_SESSION['cena_letenky'] * $_SESSION['pocet'];
	echo '<p id ="rnadpis">Skontroluj si rezerváciu:</p>';
	echo '<p>Letenka: <strong>'.$_SESSION['pocet'] .'x</strong> - ';
	echo  vypis_letenku($mysqli, $_SESSION['id']).'</p>';		
	
	foreach($triedy as $ind => $hodn) {		
		if ($ind == $_SESSION['trieda']) {$cena = $cena*(1+($hodn['percento']/100));
			echo '<p>Trieda: <strong>' . $hodn['typ'] .  '</strong></p>';				
	}}
	
	if (isset($_SESSION['batozina'])) {
	echo '<p>Batožina za príplatok: <strong>'.$_SESSION['batozina'].'</strong></p>';
	
	if (($_SESSION['batozina'])=='+ príručná(do 15kg)') $cena=$cena+15;
	if (($_SESSION['batozina'])=='+ podaná(do 25kg)') $cena=$cena+30;
	if (($_SESSION['batozina'])=='+ podaná(do 35kg)') $cena=$cena+50;	
	}
	
	if (($_SESSION['poistenie'])=='s poistením') {$cena = $cena+(($_SESSION['pocet'])*4.2);
	echo '<p>Poistenie: <strong>Áno</strong></p>';
	}
	else echo '<p>Poistenie: <strong>Nie</strong></p>';
	
	if (isset($_SESSION['doprava'])) {
		if ($_SESSION['doprava']!=''){
		$cena = $cena+(($_SESSION['pocet'])*6);
		foreach($mesta as $ind => $hodn) {		
		if ($ind == $_SESSION['doprava']) {
			echo '<p>Doprava na letisko: autobus z <strong>' . $hodn .  '</strong></p>';			
	}}
}}
	  echo '<p>Cena: <strong>' .$cena . '</strong> &euro;</p>';
	  $_SESSION['cena']=$cena;

?>
	<form method="post">
		<p>
		
		<input class = "fbutton" type="submit" name="zmen" value="Zmeniť rezerváciu">
		<input class = "fbutton" type="submit" name="zarezervuj" value="Zarezervuj">
		</p>
	</form>
<?php
}

function pridaj_pouzivatela($mysqli, $prihlasmeno, $heslo, $meno, $priezvisko, $email, $adresa, $tel, $admin=0) { //// pridaj do databázy
	if (!$mysqli->connect_errno) {
		$prihlasmeno = $mysqli->real_escape_string($prihlasmeno);
		$heslo = $mysqli->real_escape_string($heslo);
		$meno = $mysqli->real_escape_string($meno);
		$priezvisko = $mysqli->real_escape_string($priezvisko);
		$email = $mysqli->real_escape_string($email);
		$adresa = $mysqli->real_escape_string($adresa);
		$tel = $mysqli->real_escape_string($tel);
		
		$sql = "INSERT INTO pouzivatelia SET heslo=MD5('$heslo'), prihlasmeno='$prihlasmeno', meno='$meno', priezvisko='$priezvisko', email='$email', adresa='$adresa', tel='$tel', admin='$admin'"; 
		$_SESSION['user'] = $prihlasmeno;  /// po registrácii zostane prihlásený
						
		if ($result = $mysqli->query($sql)) {  
	    echo '<p>Registrácia prebehla úspešne.</p>'. "\n";
		 echo '<a href="konto.php">moje konto</a>';
		
			return true;
	 	} else {			
			echo '<p class="chyba">Nastala chyba pri registrácii.';
			if ($mysqli->errno == 1062) echo ' (zadané prihlasovacie meno už existuje)';
			echo '.</p>' . "\n";
			return false;
	  }
	} else {echo '<p class="chyba">NEpodarilo sa spojiť s databázovým serverom!</p>';
		return false;
	}
}

function pridaj_rezervaciu($mysqli, $id_pouz, $id_letenky, $cena, $pocet_ks, $trieda, $poistenie, $doprava ,$batozina) {  //// pridaj do databázy
	if (!$mysqli->connect_errno) {
		$id_pouz = $mysqli->real_escape_string($id_pouz);
		$id_letenky = $mysqli->real_escape_string($id_letenky);
		$cena = $mysqli->real_escape_string($cena);
		$pocet_ks = $mysqli->real_escape_string($pocet_ks);
		$trieda = $mysqli->real_escape_string($trieda);
		$poistenie = $mysqli->real_escape_string($poistenie);		
		$doprava = $mysqli->real_escape_string($doprava);
		$batozina = $mysqli->real_escape_string($batozina);		
		
		$sql = "INSERT INTO rezervacie SET id_pouz='$id_pouz', id_letenky='$id_letenky', pocet_ks='$pocet_ks', doprava='$doprava', poistenie='$poistenie', batozina ='$batozina', trieda='$trieda', cena_spolu='$cena'"; 
				
		
		if ($result = $mysqli->query($sql)) {  
	    echo '<p>Rezervácia prebehla úspešne.</p>'. "\n"; 
		echo '<p>Môžeš si prezrieť rezervácie na svojom <a href="konto.php">konte</a>.</p>'. "\n"; 
			return true;
	 	} else {			
			echo '<p class="chyba">Nastala chyba pri spracovaní rezervácie.';			
			echo '.</p>' . "\n";
			return false;  }
	} else {
		echo '<p class="chyba">NEpodarilo sa spojiť s databázovým serverom!</p>';
		return false;}
}

function registracia($mysqli){
	$legenda = "Prihlásiť sa";
	$registracia = false;
	$chyby = array();
	
////////////////////////////////////////////////	prečítaj a skontroluj zadané údaje
if (isset($_POST["registrovat"])) {
	$prihlasmeno = osetri($_POST['prihlasmeno']);
	$heslo = $_POST['heslo'];
	$heslo2 = $_POST['heslo2'];
	$meno = osetri($_POST['meno']);
	$priezvisko = osetri($_POST['priezvisko']);
	$email = osetri($_POST['email']);
	$tel = osetri($_POST['tel']);
	$adresa = osetri($_POST['adresa']); 
	$registracia = true;
	
	
	if (!mail_ok($email)) $chyby['email'] = 'Email je v nesprávnom formáte.'; 
	if (empty($email)) $chyby['email'] = 'Nezadali ste email.';
	if (!nazov_ok($meno)) $chyby['meno'] = 'Meno nie je v správnom formáte';
	if (empty($meno)) $chyby['meno'] = 'Nezadali ste meno';	
	if (!nazov_ok($priezvisko)) $chyby['priezvisko'] = 'Priezvisko nie je v správnom formáte';
	if (empty($priezvisko)) $chyby['priezvisko'] = 'Nezadali ste priezvisko';	
	if ((!tel_num($tel))||(!tel_ok ($tel))) $chyby['tel'] = 'Telefónne číslo ste zadali v NEsprávnom formáte';
	if (empty($tel)) $chyby['tel'] = 'Nezadali ste telefónne číslo.';
	if (!spravna_adresa($adresa)) $chyby['adresa'] = 'Nezadali ste adresu v správnom formáte';
	if (empty($adresa)) $chyby['adresa'] = 'Nezadali ste adresu';	
	if (!prihlas_meno_ok_dlzka($prihlasmeno)) $chyby['prihlasmeno'] = 'Prihlasovacie meno nie je v správnom formáte';
	if (!prihlas_meno_ok($mysqli, $prihlasmeno)) $chyby['prihlasmeno'] = 'Prihlasovacie meno už existuje!';
	if (empty($prihlasmeno)) $chyby['prihlasmeno'] = 'Nezadali ste prihlasovacie meno';
	if (!heslo_ok($heslo)) $chyby['heslo'] = 'Heslo nie je v správnom formáte';
	if (empty($heslo)) $chyby['heslo'] = 'Nezadali ste heslo';
	if ($heslo2 != $heslo) $chyby['heslo2'] = 'Heslo (znovu) sa nezhoduje s heslom.';	
	if (empty($heslo2)) $chyby['heslo2'] = 'Nezopakovali ste heslo';
		
}

///////////////////////////////////////


if(empty($chyby) && isset($_POST["registrovat"])) {	
	pridaj_pouzivatela($mysqli, $prihlasmeno, $heslo, $meno, $priezvisko, $email, $adresa, $tel, $admin=0);
	over_pouzivatela($mysqli,$prihlasmeno,$heslo);
} 
else {
	
	if (!empty($chyby)) {	unset($_POST["registrovat"]);
		
		echo '<p class="chyba"><strong>Chyby pri registrácii</strong>:<br>';
		foreach($chyby as $ch) {
			echo "$ch<br>\n";
		}
		echo '</p>';
	}
}


if (!isset($_POST["registrovat"])){
	if($registracia||(isset($_POST['nemam'])&&(!isset($_SESSION['user'])))&&(!isset($_POST['mam'])))$legenda = "Zaregistrovať sa";   /// nadpis :D
?>
	<legend><?php echo $legenda;?></legend>	
	<form method="post">
		<p>
		<?php 
		
// podla toho, ktoré tlačítko je stlačené    mám / nemám    sa zobrazuje buď registrácia alebo prihlásenie
		
		if (isset($_POST['mam']))unset($_POST['nemam']);
		if (isset($_POST['nemam']))unset($_POST['mam']);
		
		
		if (isset($_POST['nemam'])||$registracia)echo'<input type="submit" name="mam" value="Mam už konto">';
				else echo'<input type="submit" name="nemam" value="Ešte nemám konto">';
		
		?></p>
	</form>
	
<?php
if($registracia||(isset($_POST['nemam'])&&(!isset($_SESSION['user'])))&&(!isset($_POST['mam']))){
	
////////////////////////////////     FORMULÁR registrácie      ///////////////////
?>
	
	<form method="post">  
	
		<div  >		
		<label for="priezvisko">Email:</label>
		<input type="text"   name="email" id="email" size="40" required placeholder="meno@adresa.com" value="<?php if (isset($email)) echo $email; ?>">
		</div>
		<div>		
		<label for="meno">Meno:</label>
		<input type="text" name="meno" id="meno" size="20" required placeholder="(3-30 znakov)" value="<?php if (isset($meno)) echo $meno; ?>">
		</div>
		<div>
		<label for="priezvisko">Priezvisko:</label>
		<input type="text" name="priezvisko" id="priezvisko" size="30" required placeholder="(3-30 znakov)" value="<?php if (isset($priezvisko)) echo $priezvisko; ?>">
		</div>		
		<div>
		<label for="tel">Kontakt: (+421)</label>
		<input type="text" name="tel" id="tel" size="30" required placeholder="9xxxxxxxx" value="<?php if (isset($tel)) echo $tel; ?>">
		</div>
		<div>		
		<label for="adresa">Adresa:</label><br>
		<textarea name="adresa" id="adresa" required placeholder="(min.10 znakov)" rows="3" cols="35"><?php if (isset($_POST["adresa"])){echo $_POST["adresa"]; }?></textarea>
		</div>
		<div>
		<label for="prihlasmeno">Prihlasovacie meno:</label> 
		<input name="prihlasmeno" type="text" size="20" maxlength="30" id="prihlasmeno" placeholder="(5-30 znakov)" value="<?php if (isset($prihlasmeno)) echo $prihlasmeno; ?>" ><br>
		</div>
		<div>
		<label for="heslo">Heslo:</label> 
		<input name="heslo" type="password" size="30" maxlength="30" placeholder="(5-30 znakov)" id="heslo"> 
		</div>	
		<div>
		<label for="heslo2">Heslo:</label> 
		<input name="heslo2" type="password" size="30" maxlength="30" placeholder="(znovu)" id="heslo2">
		</div> 			
		<br>
		<p>
			<input name="registrovat" type="submit" id="registrovat" value="Registrovať">
		</p>
	</form>

<?php
/////////////////////////////////////////////////////////////////////////////



/////////////////////////////     FORMULÁR prihlasovania ////////////////////////////
}else if(isset($_POST['mam'])||(!isset($_SESSION['user']))||(!isset($_POST['nemam']))){
	$registracia = false;
	?>	
	<form method="post">
		<p><label for="prihlasmeno">Prihlasovacie meno:</label> 
		<input name="prihlasmeno" type="text" size="30" maxlength="30" id="prihlasmeno" value="<?php if (isset($_POST["prihlasmeno"])) echo $_POST["prihlasmeno"]; ?>" ><br>
		<label for="heslo">Heslo:</label> 
		<input name="heslo" type="password" size="30" maxlength="30" id="heslo"> 
		</p>
		<p>
			<input name="submit" type="submit" id="submit" value="Prihlás ma">
		</p>
	</form>
	
	
	<?php
//////////////////////////////////////////////////////////////////////

}

}}

function uprav_rezervaciu($mysqli, $id_rezervacie, $triedy, $mesta) {	
	if (!$mysqli->connect_errno) {	
	$sql = "SELECT * FROM rezervacie, letenky, pouzivatelia WHERE rezervacie.id_letenky = letenky.id AND rezervacie.id_rezervacie = $id_rezervacie AND pouzivatelia.id_pouz = rezervacie.id_pouz"; 		
		
	if (($result = $mysqli->query($sql)) && ($result->num_rows > 0)) {			
	
	while ($row = $result->fetch_assoc()){

	if ($row['id_rezervacie']==$id_rezervacie){


//////////////////      vymaž
		if (isset($_POST['vymaz'])){odstran_rezervaciu($mysqli, $id_rezervacie) ;
		zmen_dostupne_letenky($mysqli, $row['id'], ($row['pocet']+$row['pocet_ks']));}
//////////////////

		else{
			
///////////////////////////      prečítaj údaje odoslané formulárom a uprav rezerváciu
		if (isset($_POST['hotovo'])){
		
		if ($row['batozina']!=0) $nbatozina = $row['batozina']; else $nbatozina = 0;
		if ($row['doprava']!='')$ndoprava = $row['doprava']; else $ndoprava = '';
		$cena = $row['cena_spolu'];
		$poist = $_POST['nove_poistenie'];
		if (isset($_POST['nova_doprava'])) {$ndoprava = $_POST['nova_doprava'] ;}		
		if (isset($_POST['nova_batozina'])){if ($_POST['nova_batozina'] == "+ príručná(do 15kg)")$cena += 15;else if($_POST['nova_batozina'] == "+ podaná(do 25kg)")$cena += 30;else if($_POST['nova_batozina'] == "+ podaná(do 35kg)")$cena += 50;}

		if (isset($_POST["nova_batozina"])) $nbatozina = ($_POST['nova_batozina']); 
		
		if (isset($_POST['nove_poistenie'])){if ($_POST['nove_poistenie']=='Nie'&&$row['poistenie']=='s poistením'){$cena -= 4.2;}}
		if (isset($_POST['nove_poistenie'])){if ($_POST['nove_poistenie']=='Áno'&&$row['poistenie']=='bez poistenia'){$cena += 4.2;}}		
		if (isset($_POST['nova_doprava'])&&$row['doprava']==''){ if ($_POST['nova_doprava']!=''){$cena += 6;}};
		if (isset($_POST['nova_doprava'])&&$row['doprava']!=''){ if ($_POST['nova_doprava']==''){$cena -= 6;}};
		if (isset($_POST['nove_poistenie'])){if ($_POST['nove_poistenie']=='Áno'){$poist='s poistením';}else $poist = 'bez poistenia';}
				  
		  zmen_rezervaciu($mysqli, $id_rezervacie, $cena, $ndoprava, $poist, $nbatozina);
		   }
		   
///////////////////////////////
		else{
		   
		   
//////////////    Výpis rezervácie a položiek, ktoré je možné upraviť(FORMULÁR) - upraviť rezerváciu:
		   
		   
			echo'<div>';	
			echo '<form method = "post">';
		echo '<h4>Rezervácia:</h4>';	
		
		echo '<table>';
			echo '<tr><th>Meno</th> <td>'.$row['meno'].' '.$row['priezvisko'].'</td></tr>';
			echo '<tr><th>Počet leteniek</th> <td>'.$row['pocet_ks'].'</td></tr>';
			
			echo '<tr><th>Doprava na letisko z</th><td class = "uprav">';			
			echo '<select name="nova_doprava" id="nova_doprava">';
			echo '<option value="">----</option>';			
				if (isset($_POST['nova_doprava'])) 	{vypis_select_doprava($mesta, $_POST['nova_doprava']);}
				else if ($row['doprava'] != '' )	{vypis_select_doprava($mesta, $row['doprava']);}
				else {vypis_select_doprava($mesta);}
				echo '</select>';
				echo '</td></tr>';
									
									
			$date = date_create_from_format('Y-m-d', $row['datum']);			
			$times = date_create_from_format('H:i:s', $row['cas_odletu']);
			$timee = date_create_from_format('H:i:s', $row['cas_priletu']);
												
			
			echo '<tr><th>Datum odletu</th> <td>'.date_format($date, "j.n.Y").'</td></tr>';
			echo '<tr><th>Odlet z</th> <td>'.$row['odlet'].'</td></tr>';
			echo '<tr><th>Čas odletu</th> <td>'.date_format($times, "H:i").'</td></tr>';
			
			if ($row['prestup'] != 0 && $row['prestup'] != '' && $row['prestup'] != 'priamy let')  echo '<tr><th>Prestup v</th> <td>'.$row['prestup'].'</td></tr>';
			echo '<tr><th>Prílet do</th> <td>'.$row['destinacia'].'</td></tr>';
			echo '<tr><th>Čas príletu</th> <td>'.date_format($timee, "H:i").'</td></tr>';
			
			
			if ($row['batozina'] == 0)echo '<tr><th>Batožina</th> <td class = "uprav">'.$row['batožina'];
			else echo '<tr><th>Batožina</th> <td>'.$row['batožina'];
			if ($row['batozina'] != 0) echo '<br>  '. $row['batozina'].'</td></tr>';
				
		   else if ($row['batozina'] == 0){
			   ?>
			   <br><strong><label for="batozina">Pridať batožinu:</label></strong>
				<br><input type="radio" name="nova_batozina" id="bat0" value="+ príručná(do 15kg)"> <label for="bat1">+ príručná(do 15kg) - 15€ </label>
				<br><input type="radio" name="nova_batozina" id="bat1" value="+ podaná(do 25kg)"> <label for="bat1">+ podaná(do 25kg) - 30€</label>
				<br><input type="radio" name="nova_batozina" id="bat2" value="+ podaná(do 35kg)"> <label for="bat2">+ podaná(do 35kg) - 50€</label>
	
			   <?php
			   echo '</td></tr>';
		   }
			foreach($triedy as $ind => $hodn) {if ($ind == $row['trieda']) echo '<tr><th>Trieda</th> <td>'.$hodn['typ'].'</td></tr>';}
			
			echo '<tr><th>Poistenie</th><td class = "uprav">';
			?>		
			<input type="radio" name="nove_poistenie" id="nie" value="Nie"<?php if ((isset($_POST['nove_poistenie']) && $_POST['nove_poistenie']=="Nie")||($row['poistenie']=='bez poistenia')) echo ' checked'; ?>> <label for="nie">Nie</label>
			<input type="radio" name="nove_poistenie" id="ano" value="Áno"<?php if ((isset($_POST['nove_poistenie']) && $_POST['nove_poistenie']=="Áno")||($row['poistenie']=='s poistením')) echo ' checked'; ?>> <label for="ano">Áno</label>
						
			<?php
			echo '</td></tr>';
			echo '<tr><th>Cena</th><td>'.$row['cena_spolu']. '&euro;</td></tr>';
					
		echo '</table>';
		echo '<p><small>Vyznačené položky JE možné upraviť.</small></p>';
		echo '<div class = "mx-2 my-2"><input type="submit" class ="fbutton"  name="hotovo" value="Hotovo">';
						
		
		echo '<input type="submit" id="vymaz" class ="fbutton" name="vymaz" value="Vymaž rezerváciu"></form></div>';
		echo '</div></br>';		
/////////////////////////////////////////
		   }
	}}
	
							
	}}else {echo '<p class="chyba">NEpodarilo sa nájsť rezerváciu!</p>';}
	
	}else echo '<p class="chyba">NEpodarilo sa spojiť s databázou!</p>';
}

function rezervacie($mysqli, $id, $triedy, $mesta) {	

///// všetky rezervácie konkrétneho použivatela - pohlad použivatela

	if (!$mysqli->connect_errno) {
	$sql = "SELECT * FROM rezervacie, letenky, pouzivatelia WHERE rezervacie.id_letenky = letenky.id AND rezervacie.id_pouz = $id AND pouzivatelia.id_pouz = $id ORDER BY letenky.datum DESC"; 		
		
	if (($result = $mysqli->query($sql)) && ($result->num_rows > 0)) {
				
	while ($row = $result->fetch_assoc()){	
			
		echo'<div>';
		if ($row['datum'] <=  date('Y-m-d'))echo '<h4>Neplatná rezervácia:</h4>';
		else echo '<h4>Rezervácia:</h4>';
		if ($row['datum'] <= date('Y-m-d')) echo '<table class="vyprsana">'; 
		else echo '<table>';
			echo '<tr><th>Meno</th> <td>'.$row['meno'].' '.$row['priezvisko'].'</td></tr>';
			echo '<tr><th>Počet leteniek</th> <td>'.$row['pocet_ks'].'</td></tr>';
			
			if ($row['doprava'] != '') {
				foreach($mesta as $ind => $hodn) {				
			if ($ind == $row['doprava']) echo '<tr><th>Doprava na letisko z </th> <td>'.$hodn .'</td></tr>';}}
									
			$date = date_create_from_format('Y-m-d', $row['datum']);			
			$times = date_create_from_format('H:i:s', $row['cas_odletu']);
			$timee = date_create_from_format('H:i:s', $row['cas_priletu']);
												
			
			echo '<tr><th>Datum odletu</th> <td>'.date_format($date, "j.n.Y").'</td></tr>';
			echo '<tr><th>Odlet z</th> <td>'.$row['odlet'].'</td></tr>';
			echo '<tr><th>Čas odletu</th> <td>'.date_format($times, "H:i").'</td></tr>';
			
			if ($row['prestup'] != 0 && $row['prestup'] != '' && $row['prestup'] != 'priamy let')  echo '<tr><th>Prestup v</th> <td>'.$row['prestup'].'</td></tr>';
			echo '<tr><th>Prílet do</th> <td>'.$row['destinacia'].'</td></tr>';
			echo '<tr><th>Čas príletu</th> <td>'.date_format($timee, "H:i").'</td></tr>';
			echo '<tr><th>Batožina</th> <td>'.$row['batožina'];
			if ($row['batozina'] != 0) echo '<br>  '.$row['batozina'].'</td></tr>';	else echo'</td></tr>';
			foreach($triedy as $ind => $hodn) {if ($ind == $row['trieda']) echo '<tr><th>Trieda</th> <td>'.$hodn['typ'].'</td></tr>';}
			if($row['poistenie']=='bez poistenia') echo '<tr><th>Poistenie</th> <td>Nie</td></tr>'; else  echo '<tr><th>Poistenie</th> <td>Áno</td></tr>';
			echo '<tr><th>Cena</th><td>'.$row['cena_spolu']. '&euro;</td></tr>';
			
			
	echo '</table> <p> ';
		if ($row['datum'] >  date('Y-m-d'))echo  '<a href="uprav.php?idd=' . $row['id_rezervacie'] . '" class = "uprav_link"  >Uprav</a>';
								
		echo '</div>';			
	}			
						
	}else {echo '<p class="chyba">NEmáte žiadne rezervácie!</p>';
	echo 'Vyberte si z našej pestrej <a href = "ponuka.php">ponuky</a>';}

	}else {echo '<p class="chyba">NEpodarilo sa spojiť s databázou!</p>';}
}

function vsetky_rezervacie($mysqli, $id, $triedy, $mesta) {	
///// adminov pohlad na rezervácie konkrétneho použivatela

	if (!$mysqli->connect_errno) {
	$sql = "SELECT * FROM rezervacie, letenky, pouzivatelia WHERE rezervacie.id_letenky = letenky.id AND rezervacie.id_pouz = $id AND pouzivatelia.id_pouz = $id ORDER BY letenky.datum DESC"; 		
		
	if (($result = $mysqli->query($sql)) && ($result->num_rows > 0)) {			
	echo'<div>';	
				
	while ($row = $result->fetch_assoc()){	
		if (isset($_SESSION['admin'])){			
			
			if ($row['datum'] < date('Y-m-d')) echo '<table class="vyprsana">'; 
			else echo '<table>';
			echo '<tr><th>Meno</th> <td>'.$row['meno'].' '.$row['priezvisko'].'</td></tr>';
			echo '<tr><th>Počet leteniek</th> <td>'.$row['pocet_ks'].'</td></tr>';
			
			if ($row['doprava'] != 0 && $row['doprava'] != '') {
				foreach($mesta as $ind => $hodn) {				
			if ($ind == $row['doprava']) echo '<tr><th>Doprava na letisko z </th> <td>'.$hodn .'</td></tr>';}}
									
			$date = date_create_from_format('Y-m-d', $row['datum']);			
			$times = date_create_from_format('H:i:s', $row['cas_odletu']);
			$timee = date_create_from_format('H:i:s', $row['cas_priletu']);
												
			
			echo '<tr><th>Datum odletu</th>';
			if ($row['datum']<date('Y-m-d')) echo'<td class = "chyba"><strong>'.date_format($date, "j.n.Y").'<strong></td></tr>';
			else echo'<td>'.date_format($date, "j.n.Y").'</td></tr>';
			
			echo '<tr><th>Odlet z</th> <td>'.$row['odlet'].'</td></tr>';
			echo '<tr><th>Čas odletu</th> <td>'.date_format($times, "H:i").'</td></tr>';
			
			if ($row['prestup'] != 0 && $row['prestup'] != '' && $row['prestup'] != 'priamy let')  echo '<tr><th>Prestup v</th> <td>'.$row['prestup'].'</td></tr>';
			echo '<tr><th>Prílet do</th> <td>'.$row['destinacia'].'</td></tr>';
			echo '<tr><th>Čas príletu</th> <td>'.date_format($timee, "H:i").'</td></tr>';
			echo '<tr><th>Batožina</th> <td>'.$row['batožina'];
			if ($row['batozina'] != 0) echo '<br>  '.$row['batozina'].'</td></tr>';	else echo'</td></tr>';
			foreach($triedy as $ind => $hodn) {if ($ind == $row['trieda']) echo '<tr><th>Trieda</th> <td>'.$hodn['typ'].'</td></tr>';}
			if($row['poistenie']=='bez poistenia') echo '<tr><th>Poistenie</th> <td>Nie</td></tr>'; else  echo '<tr><th>Poistenie</th> <td>Áno</td></tr>';
			echo '<tr><th>Cena</th><td>'.$row['cena_spolu']. '&euro;</td></tr>';
			
			
	echo '</table></p>';
		
		echo '</div></br>';	
		
	}
	}			
						
	}else { if ($id==1)echo '<p class="chyba">Admin nemôže vytvárať rezervácie!</p>';
			else echo '<p class="chyba">Žiadne rezervácie!</p>';}

	}else {echo '<p class="chyba">NEpodarilo sa spojiť s databázou!</p>';}
}

function vypis_vsetky_rezervacie($mysqli, $triedy, $mesta){
	///// adminov pohlad - všetky aktívne rezervácie všetkých použivatelov
	
	
	if (!$mysqli->connect_errno) {
	$sql = "SELECT * FROM `rezervacie`,`letenky` WHERE rezervacie.id_letenky=letenky.id AND letenky.datum>NOW()"; 		
	if ($result = $mysqli->query($sql)) {		
			echo '<h3>Aktívne rezervácie:</h3>';	
			echo  '<table>';
			while ($row = $result->fetch_assoc()){	
			
			echo  '<tr><th><a href="pouzivatel.php?idecko=' . $row['id_pouz'] . '" class="pouzivatel">'.pouzivatel($mysqli, $row['id_pouz']).'</a></th>';
			
			echo  '<td>'.vypis_letenku($mysqli ,$row['id_letenky']);
			echo $row['pocet_ks'].'X';
			if ($row['batozina'] != 0) echo '<br>  '.$row['batozina'];			
			foreach($triedy as $ind => $hodn) {				
			if ($ind == $row['trieda']) echo '<br> trieda: '.$hodn['typ'];}
			echo '<br>'.$row['poistenie'];	
			if ($row['doprava'] != 0) {
				foreach($mesta as $ind => $hodn) {				
			if ($ind == $row['doprava']) echo '<br> doprava z: '.$hodn ;}}
			
		echo '<br> Cena: '.$row['cena_spolu'].'€</td></tr>';}
		echo '</table>';
	}else {
		echo '<p class="chyba">NEexisutú žiadne rezervácie!</p>';
		echo 'Vyberte si z našej pestrej <a href = "ponuka.php">ponuky</a>';
	
	}
	}else {echo '<p class="chyba">NEpodarilo sa spojiť s databázou!</p>';}
}

function pouzivatel($mysqli, $id, $m=0) { //// daj meno
	if (!$mysqli->connect_errno) {
		$sql = "SELECT * FROM pouzivatelia WHERE id_pouz=$id"; 
		if ($result = $mysqli->query($sql)) {  			
			$row = $result->fetch_assoc();
			if ($m == 1) return $row['meno'];
			else return $row['meno'].' '.$row['priezvisko'];
						
			$result->free();			
		} else {echo'Nepodaril sa pokus o prihlásenie. Skontrolujte, či ste zadali správne údaje.';return false;}
	} else {return false;}
}

function vypis_pouzivatela($mysqli, $id){ /// daj informácie
	if (!$mysqli->connect_errno) {
		$sql = "SELECT * FROM pouzivatelia WHERE id_pouz=$id"; 
		if ($result = $mysqli->query($sql)) {  			
			$row = $result->fetch_assoc();
			echo $row['meno'].' '.$row['priezvisko'];
			echo $row['email'];
			echo $row['adresa'];
			echo '+421'.$row['tel'];			
			
			$result->free();			
		} else {echo'Nepodaril sa pokus o prihlásenie. Skontrolujte, či ste zadali správne údaje.';return false;}
	} else {echo '<p class="chyba">NEpodarilo sa spojiť s databázovým serverom!</p>';return false;}
}

function pridaj_recenziu($mysqli, $pouzivatel, $nadpis, $popis, $hodnotenie) {
	if (!$mysqli->connect_errno) {
		$pouzivatel = $mysqli->real_escape_string($pouzivatel);
		$nadpis = $mysqli->real_escape_string($nadpis);
		$popis = $mysqli->real_escape_string($popis);
		$hodnotenie = $mysqli->real_escape_string($hodnotenie);
		
		
		$sql = "INSERT INTO recenzie SET  pouzivatel='$pouzivatel', hodnotenie='$hodnotenie', nadpis='$nadpis', recenzia='$popis'"; 
				
		
		if ($result = $mysqli->query($sql)) {  
	    echo '<p>Recenzia bola pridaná.</p>'. "\n"; 
			return true;
	 	} else {			
			echo '<p class="chyba">Nastala chyba pri pridávaní recenzie.';			
			echo '.</p>' . "\n";
			return false;  }
	} else {
		echo '<p class="chyba">NEpodarilo sa spojiť s databázovým serverom!</p>';
		return false;}
}

function odstran_recenziu($mysqli, $id) {
	if (!$mysqli->connect_errno) {
		$sql="DELETE FROM recenzie WHERE id='{$mysqli->real_escape_string($id)}'"; 
		if ($result = $mysqli->query($sql) && ($mysqli->affected_rows > 0)) { 
			
	    echo "<p>Recenzia bola vymazaná.</p>\n"; 
  	} else {
			
    	echo "<p class='chyba'>Nastala chyba pri vymazávaní recenzie.</p>\n";
    }
	}
} 

function odstran_rezervaciu($mysqli, $id) {
	if (!$mysqli->connect_errno) {
		$sql="DELETE FROM rezervacie WHERE id_rezervacie='{$mysqli->real_escape_string($id)}'"; 
		if ($result = $mysqli->query($sql) && ($mysqli->affected_rows > 0)) { 
			
	    echo "<p>Rezervácia bola vymazaná.</p>\n"; 
  	} else {			
    	echo "<p class='chyba'>Nastala chyba pri vymazávaní rezervácie.</p>\n";
    }
	}
} 

function zmen_rezervaciu($mysqli, $id, $cena, $dop, $poistenie, $batozina) {
	if (!$mysqli->connect_errno) {
	  $sql="UPDATE rezervacie SET doprava='$dop', poistenie='$poistenie', batozina='$batozina', cena_spolu='$cena' WHERE id_rezervacie='$id'";   
		if ($result = $mysqli->query($sql)) {  			
      echo '<p>Zmeny boli uložené.</p>'. "\n"; 
    } else {			
      echo '<p class="chyba">Nastala chyba pri zmene rezervácie.</p>'. "\n"; 		}
	} else {		
		echo '<p class="chyba">NEpodarilo sa spojiť s databázovým serverom!</p>';
	}
}	

function zmen_dostupne_letenky($mysqli, $id, $pocet) {
	if (!$mysqli->connect_errno) {
	  $sql="UPDATE letenky SET pocet='$pocet' WHERE id='$id'";   
		if ($result = $mysqli->query($sql) && ($mysqli->affected_rows > 0)) {  			
      return true;
    } else {			
      echo '<p class="chyba">Nastala chyba - nepodarilo sa zmeniť počet dostupných leteniek.</p>'. "\n"; 		}
	} else {		
		echo '<p class="chyba">NEpodarilo sa spojiť s databázovým serverom!</p>';
	}
}



?>
