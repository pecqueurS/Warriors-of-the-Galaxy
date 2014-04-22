<?php


// Appel profil
require_once (PROFIL."profil.php");

$login="";
$mdp="";
$confirm="";
$email="";

$class["login"] = "";
$class["pwd"] = "";
$class["email"] = "";

if(isset($_POST["createLog"])) {



	$verif_post = new Check_data();

	if($verif_post->check_data($_POST["login"],"login",array(5,16)) 
		&& $verif_post->check_data($_POST["pwd"],"mdp",array(6,16)) 
		&& $verif_post->check_data($_POST["email"],"email",false) 
		&& $_POST["pwd"]==$_POST["confirm"] ) {

		$profil = new Profil();

		$post["login"] = $_POST["login"];
		$post["mdp"] = $_POST["pwd"];
		$post["email"] = $_POST["email"];

		if($profil->inscription($post)){
			header("location:".URL_ENV_MAIL);
		} else {
			$login=$verif_post->xss($_POST["login"]);
			$mdp=$verif_post->xss($_POST["pwd"]);
			$confirm=$verif_post->xss($_POST["confirm"]);
			$email=$verif_post->xss($_POST["email"]);
		}

	} else {

		if(!$verif_post->check_data($_POST["login"],"login",array(5,16))) $class["login"] = "loose";
		if(!$verif_post->check_data($_POST["pwd"],"mdp",array(6,16)) ) $class["pwd"] = "loose";
		if(!$verif_post->check_data($_POST["email"],"email",false) ) $class["email"] = "loose";
		if($_POST["pwd"]!=$_POST["confirm"]) $class["pwd"] = "loose";

			$login=$verif_post->xss($_POST["login"]);
			$mdp=$verif_post->xss($_POST["pwd"]);
			$confirm=$verif_post->xss($_POST["confirm"]);
			$email=$verif_post->xss($_POST["email"]);
			$message = "Toutes les informations ne sont pas remplies correctement. <br/>Les caractères authorisés pour le login et le mot de passe sont : Les chiffres et les lettres minuscules et majuscules. Le login doit comporter au max 16 caracteres. <br/>Le mot de passe doit comporter entre 6 et 16 caractères et avoir au moins un chiffre une minuscule et une majuscule. <br/>L'email doit être valide pour pouvoir confirmer votre inscription. De plus il doit être identique dans les 2 champs reservés. <br/>Tous les champs sont obligatoires sauf l'ajout de l'avatar.";
			if(isset($_SESSION["message"])) $_SESSION["message"] .= $message;
			else $_SESSION["message"] = $message;
	}



}









$var = array(
	"login" => $login,
	"mdp" => $mdp,
	"confirm" => $confirm,
	"email" => $email,
	"class" => $class,
);

?>