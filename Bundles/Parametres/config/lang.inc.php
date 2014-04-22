<?php
// Mise en place de la session "lang" qui permet de definir la langue lors de l'affichage
if(!isset($_SESSION['lang'])) {
	$_SESSION['lang'] = "fr";
}


if(isset($_POST["lang_fr"])) {
	$_SESSION["lang"] = "fr";
	$monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; 
	header("location:".$monUrl);
	exit();
	
}

if(isset($_POST["lang_en"])) {
	$_SESSION["lang"] = "en";
	$monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; 
	header("location:".$monUrl);
	exit();
}


?>