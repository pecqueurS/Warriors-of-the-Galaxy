<?php
			$dico = $this->page["DICO"];

// Variables
			$parties = $this->var["waiting_games"];			




///////////////////////////////////////////////////////////////////////////////////



/*		$parties = array(
				array(
					"pwd" => "<div class=\"link mdp\" title=\"protected\"></div>",
					"name" => "Partie 1 créée par joueur 1",
					"players" => "10/16",
					"creator" => "Joueur 1",
				),
				array(
					"pwd" => "<div class=\"link empty1\"></div>",
					"name" => "Partie 2 créée par joueur 2",
					"players" => "2/8",
					"creator" => "Joueur 2",
				),
				array(
					"pwd" => "<div class=\"link empty1\"></div>",
					"name" => "Partie 2 créée par joueur 2",
					"players" => "2/8",
					"creator" => "Joueur 2",
				),
				array(
					"pwd" => "<div class=\"link mdp\" title=\"protected\"></div>",
					"name" => "Partie 1 créée par joueur 1",
					"players" => "10/16",
					"creator" => "Joueur 1",
				),
				array(
					"pwd" => "<div class=\"link empty1\"></div>",
					"name" => "Partie 2 créée par joueur 2",
					"players" => "2/8",
					"creator" => "Joueur 2",
				),

			);
*/










			$montemplate->setFile($type,TEMPLATES.'HTML/contenu/joinGame.html');




// LIEN
			$montemplate->setVar('LINK_ACCUEIL', URL_ACCUEIL);
			$montemplate->setVar('LINK_JOIN', URL_JOIN);
			$montemplate->setVar('LINK_PROFIL', URL_PROFIL);
			
// TRADUCTION
			$montemplate->setVar('TITRE_JOIN_GAME', $dico["join_game"]);
			$montemplate->setVar('TITRE_SEARCH', $dico["search"]);

			$montemplate->setVar('TITRE_PROTECTED', $dico["title_pwd"]);
			$montemplate->setVar('TITRE_GAME_NAME', $dico["name"]);
			$montemplate->setVar('TITRE_GAME_PLAYERS', $dico["players"]);
			$montemplate->setVar('TITRE_GAME_CREATOR', $dico["creator"]);
	

// INPUT	
			$montemplate->setVar('SEARCH', "");

			$montemplate->setVar('SEARCH_HDN', $parties[0]["id"]);
			$montemplate->setVar('MDP_HDN', "");

// BTN	
			$montemplate->setVar('BTN_LOGOUT', $dico["logout"]);
			$montemplate->setVar('BTN_JOIN', $dico["join"]);
			$montemplate->setVar('BTN_BACK', $dico["back"]);



// BLOCK

			$montemplate->setBlock($type, 'parties_en_attente', 'parties');




			// parties_en_attente
			foreach ($parties as $partie) {
					$montemplate->setVar('ID_GAME', $partie["id"]);
					
					$montemplate->setVar('PROTECTED', $partie["pwd"]);
					$montemplate->setVar('GAME_NAME', $partie["name"]);
					$montemplate->setVar('GAME_PLAYERS', $partie["players"]);
					$montemplate->setVar('GAME_CREATOR', $partie["creator"]);

					$montemplate->parse('parties', 'parties_en_attente', true);

			}

			



?>