<?php


// Appel profil
require_once (PROFIL."profil.php");

$login="";
$email="";

$class["login"] = "";
$class["email"] = "";


if(isset($_POST["sendMail"])) {

	$verif_post = new Check_data();

	if($verif_post->check_data($_POST["login"],"login",array(5,16)) 
		&& $verif_post->check_data($_POST["email"],"email",false)) {
		
		$profil = new Profil();

		$post["login"] = $_POST["login"];
		$post["email"] = $_POST["email"];

		
		if($profil->forgot_pwd($post)){
			header("location:".URL_RECUP_PWD);
		} else {
			$login=$verif_post->xss($_POST["login"]);
			$email=$verif_post->xss($_POST["email"]);
			$message = "Le login ou l'email ne correspondent pas.";
			if(isset($_SESSION["message"])) $_SESSION["message"] .= $message;
			else $_SESSION["message"] = $message;
		}

	} else {

		if(!$verif_post->check_data($_POST["login"],"login",array(5,16))) $class["login"] = "loose";
		if(!$verif_post->check_data($_POST["email"],"email",false) ) $class["email"] = "loose";
		
			$login=$verif_post->xss($_POST["login"]);
			$email=$verif_post->xss($_POST["email"]);
			$message = "Toutes les informations ne sont pas remplies correctement. ";
			if(isset($_SESSION["message"])) $_SESSION["message"] .= $message;
			else $_SESSION["message"] = $message;
	}



}









$var = array(
	"login" => $login,
	"email" => $email,
	"class" => $class,
);


?>