<?php
session_start();
define("AUTOR", "Kristína Kvasňovská");
define("ISIC", "787");

$mysqli = new mysqli('localhost', 'root', '', 'letenky');
if ($mysqli->connect_errno) {
	echo '<p class="chyba">NEpodarilo sa pripojiť! (' . $mysqli->connect_errno . ' - ' . $mysqli->connect_error . ')</p>';
} else {
	$mysqli->query("SET CHARACTER SET 'utf8'");
}




$triedy = [['typ'=>'ekonomická','percento'=>0], ['typ'=>'prémium','percento'=>10],['typ'=>'biznis','percento'=>15],['typ'=>'prvá','percento'=>20]];
$mesta = ['Bratislava','Košice','Prešov','Žilina','Nitra','Banská Bystrica','Trnava','Trenčín','Martin','Poprad','Prievidza','Zvolen','Považská Bystrica','Nové Zámky','Levice'];
$destinacie = ['Londýn','Rím','Paríž','Kanárske ostrovy','Split','Atény','Edinburg','Sicília','Barcelona','Mallorca'];
$letiska = ['Bratislava','Viedeň','Budapešť'];




?>