<?php
			$dico = $this->page["DICO"];

// Variables
			$niveau = $this->var["niveau"];			
			$date = $this->var["date"];			
			$ranks = $this->var["classement_joueur"];			

/*
Class des input en cas d'erreur
$class["login"]
$class["mdp"]
*/
			$src_avatar = "../../images/avatars/".$_SESSION["joueur"]["jou_avatar"];
			$email = $_SESSION["joueur"]["jou_email"];

			$xp = $_SESSION["joueur"]["jou_xp"];

///////////////////////////////////////////////////////////////////////////////////




/*$ranks = array(
		array(
			"selected" => "",
			"pos" => "1",
			"joueur" => "Joueur2",
			"xp" => "2 012 230 546",
			),
		array(
			"selected" => "class=\"selected\"",
			"pos" => "2",
			"joueur" => "Joueur1",
			"xp" => "2 012 230 546",
			),
		array(
			"selected" => "",
			"pos" => "3",
			"joueur" => "JoueurX",
			"xp" => "2 012 230 546",
			),
	);*/

$currentGame = array(
		array(
			"name" => "Game 1",
			"nbPlayers" => "16",
			),
		array(
			"name" => "Game 2",
			"nbPlayers" => "8",
			),
		array(
			"name" => "Game 3",
			"nbPlayers" => "12",
			),
	);


$historyGames = array(
		array(
			"name" => "Game 1",
			"statutClass" => "win",
			"statut" => $dico["win"],
			"date" => "15th Feb 2014",
			),
		array(
			"name" => "Game 2",
			"statutClass" => "loose",
			"statut" => $dico["loose"],
			"date" => "14th Feb 2014",
			),
		array(
			"name" => "Game 3",
			"statutClass" => "win",
			"statut" => $dico["win"],
			"date" => "10th Feb 2014",
			),
	);













			$montemplate->setFile($type,TEMPLATES.'HTML/contenu/profil.html');

// LIEN
			$montemplate->setVar('LINK_ACCUEIL', URL_ACCUEIL);
			$montemplate->setVar('LINK_CREATE', URL_CREATE);
			$montemplate->setVar('LINK_JOIN', URL_JOIN);
			$montemplate->setVar('LINK_PROFIL', URL_PROFIL);
			
// TRAD
			$montemplate->setVar('BONJOUR_JOUEUR', $dico["hello"]." ".$_SESSION["joueur"]["jou_login"]);

			$montemplate->setVar('TXT_RANKING', $dico["ranking"]);
			$montemplate->setVar('TXT_CURRENT_GAME', $dico["current_games"]);
			$montemplate->setVar('TXT_HISTORY', $dico["history"]);
			
			$montemplate->setVar('TITRE_SERVER', $dico["server"]);
			
			$montemplate->setVar('TITRE_RANKING_POS', $dico["title_pos"]);
			$montemplate->setVar('TITRE_RANKING_PLAYER', $dico["player"]);
			$montemplate->setVar('TITRE_RANKING_XP', $dico["experience"]);
			
			$montemplate->setVar('TITRE_CURRENT_G_NAME', $dico["name"]);
			$montemplate->setVar('TITRE_CURRENT_G_NB_PLAYERS', $dico["nb_players"]);
			
			$montemplate->setVar('TITRE_HISTORY_NAME', $dico["name"]);
			$montemplate->setVar('TITRE_HISTORY_STATUT', $dico["status"]);
			$montemplate->setVar('TITRE_HISTORY_DATE', $dico["date"]);
			
			$montemplate->setVar('NEW_GAME', $dico["new_game"]);
			$montemplate->setVar('JOIN_GAME', $dico["join"]);
			
			$montemplate->setVar('TXT_AVATAR', $dico["avatar"]);
			$montemplate->setVar('TXT_PWD', $dico["pwd"]);
			$montemplate->setVar('TXT_EMAIL', $dico["email"]);
			
			$montemplate->setVar('LAB_CHANGE_AVATAR', $dico["change_avatar"]);
			$montemplate->setVar('TXT_OUTPUT', $dico["output_size"]);
			
			$montemplate->setVar('LAB_OLD_PWD', $dico["old_pwd"]);
			$montemplate->setVar('LAB_NEW_PWD', $dico["new_pwd"]);
			$montemplate->setVar('LAB_CONFIRM', $dico["confirm"]);

			$montemplate->setVar('LAB_OLD_EMAIL', $dico["old_email"]);
			$montemplate->setVar('LAB_NEW_EMAIL', $dico["new_email"]);

			$montemplate->setVar('TXT_UPDATE', $dico["update"]);



// BTN
			$montemplate->setVar('BTN_LOGOUT', $dico["logout"]);



// SRC
			$montemplate->setVar('SRC_AVATAR', $src_avatar);



// INPUT
			$montemplate->setVar('OLD_PWD', "");
			$montemplate->setVar('NEW_PWD', "");
			$montemplate->setVar('CONFIRM_PWD', "");

			$montemplate->setVar('OLD_EMAIL', $email);
			$montemplate->setVar('NEW_EMAIL', "");
			$montemplate->setVar('CONFIRM_EMAIL', "");





// AUTRES
			$montemplate->setVar('TODAY', $date);

			$montemplate->setVar('XP', $xp);
			$montemplate->setVar('LVL', $niveau);





// BLOCK

			// ranking
			$montemplate->setBlock($type, 'ranking', 'ranks');

			foreach ($ranks as $rank) {
					$montemplate->setVar('RANKING_SELECTED', $rank["selected"]);
					$montemplate->setVar('RANKING_POS', $rank["pos"]);
					$montemplate->setVar('RANKING_PLAYER', $rank["joueur"]);
					$montemplate->setVar('RANKING_XP', $rank["xp"]);

					$montemplate->parse('ranks', 'ranking', true);
			}

			


			// current_games
			$montemplate->setBlock($type, 'current_games', 'currentGame');

			$i=1;
			foreach ($currentGame as $infos) {
					$montemplate->setVar('CURRENT_COUNTER', $i);
					$montemplate->setVar('CURRENT_G_NAME', $infos["name"]);
					$montemplate->setVar('CURRENT_G_NB_PLAYERS', $infos["nbPlayers"]);

					$montemplate->parse('currentGame', 'current_games', true);
					$i++;
			}

			


			// history
			$montemplate->setBlock($type, 'history', 'historyGames');

			$i=1;
			foreach ($historyGames as $game) {
					$montemplate->setVar('HISTORY_COUNTER', $i);
					$montemplate->setVar('HISTORY_NAME', $game["name"]);
					$montemplate->setVar('HISTORY_STATUT', $game["statut"]);
					$montemplate->setVar('HISTORY_CLASS_STATUT', $game["statutClass"]);
					$montemplate->setVar('HISTORY_DATE', $game["date"]);

					$montemplate->parse('historyGames', 'history', true);
					$i++;
			}

			





?>