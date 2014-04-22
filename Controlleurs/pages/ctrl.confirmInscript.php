<?php


// Appel profil
require_once (PROFIL."profil.php");


if(!isset($_GET["log"]) || !isset($_GET["code"])) {
	header("location:".URL_ACCUEIL);
} else {
	$code = $_GET["code"];
	$login = $_GET["log"];

	$profil = new Profil();
	if(!$profil->active_compte($login,$code)) header("location:".URL_ACCUEIL);


}



?>