<?php

// Appel profil
require_once (PROFIL."profil.php");

// Appel profil
require_once (GAME."game.php");


$game_name = "";

$class["game_name"] = "";


// Renvoi sur ACCUEIL si on est pas connecté
$profil = new Profil();

$profil->verif_connect();

$game = new Game();


if(isset($_POST["createGame"])) {
		$verif_post = new Check_data();


		if(isset($_POST["checkPwd"]) && $_POST["checkPwd"]=="on" && isset($_POST["pwd"]) && !empty($_POST["pwd"]) ) {
			$post["mdp"] = $_POST["pwd"];
		}



		if($verif_post->check_data($_POST["game_name"],"str",48) 
			&& $verif_post->check_data($_POST["players"],"num",16) 
			&& $verif_post->check_data($_POST["end"],"login",48) ) {



			$post["game_name"] = $_POST["game_name"];
			$post["players"] = $_POST["players"];
			$post["end"] = $_POST["end"];

			if($game->create_game($post)) {

				header("location:".URL_WAIT);
			} else {
				$game_name = $verif_post->xss($_POST["game_name"]);
			}

		} else {
			if(!$verif_post->check_data($_POST["game_name"],"login",array(5,16))) $class["game_name"] = "loose";

			$game_name = $verif_post->xss($_POST["game_name"]);

		}



}






















$var = array(
	"game_name" => $game_name,
	"class" => $class,
);



?>