<?php


// Appel profil
require_once (PROFIL."profil.php");

$login="";
$mdp="";

$class["login"] = "";
$class["mdp"] = "";

if(isset($_POST["signIn"])) {

	$verif_post = new Check_data();

	if($verif_post->check_data($_POST["login"],"login",array(5,16)) 
		&& $verif_post->check_data($_POST["pwd"],"mdp",array(6,16))) {
		
		$profil = new Profil();

		$post["login"] = $_POST["login"];
		$post["mdp"] = $_POST["pwd"];

		if($profil->connexion($post)){
			header("location:".URL_PROFIL);
		} else {
			$login=$verif_post->xss($_POST["login"]);
			$mdp=$verif_post->xss($_POST["pwd"]);
			$message = "Le login ou le mot de passe ne correspondent pas.";
			if(isset($_SESSION["message"])) $_SESSION["message"] .= $message;
			else $_SESSION["message"] = $message;
		}

	} else {

		if(!$verif_post->check_data($_POST["login"],"login",array(5,16))) $class["login"] = "loose";
		if(!$verif_post->check_data($_POST["pwd"],"mdp",array(6,16)) ) $class["mdp"] = "loose";
		
			$login=$verif_post->xss($_POST["login"]);
			$mdp=$verif_post->xss($_POST["pwd"]);
			$message = "Toutes les informations ne sont pas remplies correctement. ";
			if(isset($_SESSION["message"])) $_SESSION["message"] .= $message;
			else $_SESSION["message"] = $message;
	}



}






if(isset($_POST["logout"])) {
	$profil = new Profil();
	$profil->deconnect();

}



if(isset($_SESSION["joueur"])) {
	header("location:".URL_PROFIL);

}









$var = array(
	"login" => $login,
	"mdp" => $mdp,
	"class" => $class,
);


?>