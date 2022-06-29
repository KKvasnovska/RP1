<?php
$nadpis = "Recenzie";
include('funkcie.php');
include('hlavicka.php');
include('navigacia.php');
include('udaje.php');
?>

<section>


<?php
if(isset($_SESSION['user'])&& !isset($_SESSION['admin'])) echo'<p><a href="pridaj.php" class="pridaj">pridaj recenziu</a></p>';
?>
	

<?php
echo '<div class = "odsek"><form method="post">';

///////////////////////////////////////  zoradiť
echo 'Zoradiť podľa: ';
  	echo'<input type="submit" name="dobre_hodnotenie" value="najlepšieho hodnotenia"> ';
	echo'<input type="submit" name="zle_hodnotenie" value="najhoršieho hodnotenia"> ';
	echo'<input type="submit" name="nove" value="od najnovších"> ';
	echo'<input type="submit" name="stare" value="od najstarších"> ';  	
 echo '</form></div>'; 



	$zorad =' `id` DESC';
	
	if (isset($_POST["zle_hodnotenie"])){$zorad = ' `hodnotenie` ASC';}
	else if (isset($_POST["dobre_hodnotenie"])){$zorad = ' `hodnotenie` DESC';}
	else if (isset($_POST["stare"])){$zorad = ' `id` ASC';}
	else if (isset($_POST["nove"])){$zorad = ' `id` DESC';}

//////////////////////////////////////
	
	
	$sql = "SELECT * FROM `recenzie` ORDER BY " . $zorad ;  
	if ($result = $mysqli->query($sql)) {  
		while ($row = $result->fetch_assoc()) {			
			echo '<h2 class = "nadpis">' . $row['nadpis'].'</h2>';
			echo '<div class = "recenzie">';
			echo ' <p ><u>' . $row['pouzivatel'].'  </u>';
			for($i = 1; $i <= $row['hodnotenie']; $i++) {echo '<img alt="*" src="obrazky/star1.png" width="25" height="25">';}
			for($i = 1; $i <= (5-$row['hodnotenie']); $i++) {echo '<img alt="*" src="obrazky/star_outline.png" width="25" height="25">';}
			echo "</p>";
			echo '<p>' . $row['recenzia'] . "</p>\n";
			
			if (isset($_SESSION['admin'])){				
				echo  '<a href="vymaz.php?iddd=' . $row['id'] . '" class = "button"  >Vymaž</a>';	}
			echo '</div>';		
		
			echo '</br>';
		}
				
		
		$result->free();
	} else 	echo '<p class="chyba">NEpodarilo sa vykonať dopyt! (' . $mysqli->error . ')</p>';
	


?>
</section>

<?php
include('pata.php');
?>
