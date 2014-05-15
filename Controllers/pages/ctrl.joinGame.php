<?php

// Appel profil
require_once (PROFIL."profil.php");

// Appel game
require_once (GAME."game.php");




// Renvoi sur ACCUEIL si on est pas connecté
$profil = new Profil();

$profil->verif_connect();




$game = new Game();

$req12_WAITING_GAMES = $game->waiting_games();



if(isset($_POST["joinGame"])) {
	if(isset($_POST["search_hdn"]) && !empty($_POST["search_hdn"])) {
		$join_game = $game->join_game($_POST["search_hdn"],$_POST["mdp_hdn"]);
		var_dump($join_game);
		if($join_game) {
			header("location:".URL_WAIT);
		}
	}
}











$var = array(
	"waiting_games" => $req12_WAITING_GAMES,
);




?>