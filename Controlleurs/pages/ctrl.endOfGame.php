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



$detailsTeams = array();
if(isset($_SESSION["partie"])) {
	if(isset($_SESSION["partie"]["is_finish"])) {
		// Recupération des resultats de la partie
		$sql = "SELECT jou_login, rep_team, rep_nb_colonies, rep_xp FROM resultats_parties 
				INNER JOIN joueurs ON (jou_id = rep_joueurs_id)
				WHERE rep_parties_id = ? ";

		    $bind = "i";
		  	$arr = array($_SESSION["partie"]["id"]);
							  
		  	$bdd->prepare($sql,$bind);
		  	$result1 = $bdd->execute($arr);


		
		$teams = array();
		foreach ($result1 as $key => $joueur) {
			$teams[$joueur["rep_team"]]["details_joueurs"][] = array(
				"joueur"=> $joueur["jou_login"], 
				"team"=> $joueur["rep_team"], 
				"nb_col"=> $joueur["rep_nb_colonies"], 
				"xp"=> $joueur["rep_xp"]
			);

			$teams[$joueur["rep_team"]]["equipe"] = $joueur["rep_team"];
			$teams[$joueur["rep_team"]]["col_teams"] = (!isset($teams[$joueur["rep_team"]]["col_teams"])) ? $joueur["rep_nb_colonies"] : ($teams[$joueur["rep_team"]]["col_teams"] + $joueur["rep_nb_colonies"]);
			
		}

		foreach ($teams as $key => $row) {
			$nb_col[$key] = $row["col_teams"];
		}

		array_multisort($nb_col, SORT_NUMERIC, SORT_DESC, $teams);

		for ($i=0; $i < count($teams) ; $i++) { 
			$detailsTeams[$i]["equipe"] = $req4_DICO["team"]." ".$teams[$i]["equipe"];
			$detailsTeams[$i]["col_teams"] = $teams[$i]["col_teams"];
			$detailsTeams[$i]["position"] = Calculs::position($i+1, $_SESSION["lang"]);

			$detailsTeams[$i]["details_joueurs"] = "";
			foreach ($teams[$i]["details_joueurs"] as $player) {
				$detailsTeams[$i]["details_joueurs"] .= "<tr>";
				foreach ($player as $value) {
					$detailsTeams[$i]["details_joueurs"] .= "<td>".$value."</td>";
				}
				$detailsTeams[$i]["details_joueurs"] .= "</tr>";

			}


			
			

			
		}






		} else {
			header("location:".URL_GAME);
		}


} else {
	header("location:".URL_PROFIL);
}






















$var = array(
	"detailsTeams" => $detailsTeams,
);

	unset($_SESSION["partie"]);
	$_SESSION["joueur"]["jou_parties_id"] = NULL;
	$_SESSION["joueur"]["jou_ready"] = 0;
	$_SESSION["joueur"]["jou_team"] = NULL;


?>