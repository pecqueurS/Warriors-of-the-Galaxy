<?php

// nouvel objet partie
$game = new Game();



// MISE A JOUR DES INFORMATIONS DE LA PAGE
if(isset($_POST["action"]) && $_POST["action"] == "search_game") {
	$req12_WAITING_GAMES = $game->waiting_games($_POST["search"]);




	$data["waiting_games"] = $req12_WAITING_GAMES;

}










?>