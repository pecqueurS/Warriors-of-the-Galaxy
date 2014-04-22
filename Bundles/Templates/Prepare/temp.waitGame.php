<?php
			$dico = $this->page["DICO"];







// Variables
			$humans = $this->var["race_info"]["humains"];			
			$reptils = $this->var["race_info"]["reptiliens"];			
			$arachnids = $this->var["race_info"]["arachnides"];			

			$informations = $this->var["joueurs_partie"];
			$messages = $this->var["chat"];
///////////////////////////////////////////////////////////////////////////////////





/*$informations = array(
					array(
						"selected" => "",
						"ready" => "<div class=\"link valid\"></div>",
						"player" => "Joueur 1",
						"race" => "Reptilians",
						"team" => "team 2",
					),
					array(
						"selected" => " class=\"selected\"",
						"ready" => "<div class=\"link empty1\"></div>",
						"player" => "Joueur 1",
						"race" => "Reptilians",
						"team" => "test",
					),
					array(
						"selected" => "",
						"ready" => "<div class=\"link valid\"></div>",
						"player" => "Joueur 1",
						"race" => "Reptilians",
						"team" => "team 2",
					),
					array(
						"selected" => "",
						"ready" => "<div class=\"link empty1\"></div>",
						"player" => "Joueur 1",
						"race" => "Reptilians",
						"team" => "team 2",
					),
					array(
						"selected" => "",
						"ready" => "<div class=\"link empty1\"></div>",
						"player" => "Joueur 1",
						"race" => "Reptilians",
						"team" => "team 2",
					),
					array(
						"selected" => "",
						"ready" => "<div class=\"link valid\"></div>",
						"player" => "Joueur 1",
						"race" => "Reptilians",
						"team" => "team 2",
					),

				);*/


/*$messages = array(
					array(
						"joueur" => "Joueur 1",
						"message" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. bla bla bla à la suite du message pour le faire passer sur 3 lignes...",
					),

					array(
						"joueur" => "Joueur 2",
						"message" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. bla bla bla à la suite du message pour le faire passer sur 3 lignes...",
					),

					array(
						"joueur" => "Joueur 3",
						"message" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. bla bla bla à la suite du message pour le faire passer sur 3 lignes...",
					),

					array(
						"joueur" => "Joueur 4",
						"message" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. bla bla bla à la suite du message pour le faire passer sur 3 lignes...",
					),

				);
*/



			$montemplate->setFile($type,TEMPLATES.'HTML/contenu/waitGame.html');



// LINKS
			$montemplate->setVar('LINK_ACCUEIL', URL_ACCUEIL);
			$montemplate->setVar('LINK_WAIT', URL_WAIT);
			$montemplate->setVar('LINK_PROFIL', URL_PROFIL);
	


// TRAD
			$montemplate->setVar('TXT_LOGOUT', $dico["logout"]);

			$montemplate->setVar('TXT_ON_LOAD', $dico["game_load"]." ...");

			$montemplate->setVar('TXT_GAME_OPTION', $dico["opt_game"]);
			$montemplate->setVar('TXT_NAME', $dico["name"]);
			$montemplate->setVar('TXT_PWD', $dico["pwd"]);
			$montemplate->setVar('TXT_OPTION', $dico["opt"]);

			$montemplate->setVar('TXT_RACE1', $dico["humans"]);
			$montemplate->setVar('TXT_RACE2', $dico["reptils"]);
			$montemplate->setVar('TXT_RACE3', $dico["arachnids"]);

			$montemplate->setVar('TXT_CURRENT_GAME', $dico["current_games"]);



			$montemplate->setVar('BTN_READY', (($_SESSION['joueur']['jou_ready']==1)?$dico["waiting"]." ...":$dico["ready"]." ?")); 
			$montemplate->setVar('COLOR', (($_SESSION['joueur']['jou_ready']==1)?"green":"red"));
			$montemplate->setVar('BTN_TYPE', (($_SESSION['joueur']['jou_ready']==1)?"button":"submit"));

			$montemplate->setVar('TH_READY', $dico["ready"]);
			$montemplate->setVar('TH_PLAYERS', $dico["player"]);
			$montemplate->setVar('TH_RACE', $dico["race"]);
			$montemplate->setVar('TH_TEAM', $dico["team"]);

			$montemplate->setVar('TXT_SEND', $dico["send"]);
			$montemplate->setVar('CHAT_TH_JOUEUR', $dico["player"]);
			$montemplate->setVar('CHAT_TH_MESSAGE', $dico["message"]);

			$montemplate->setVar('TXT_BACK', $dico["back"]);














			$montemplate->setVar('DESCRIPTION_RACE1', $humans);
			$montemplate->setVar('DESCRIPTION_RACE2', $reptils);
			$montemplate->setVar('DESCRIPTION_RACE3', $arachnids);








// AUTRES

			$montemplate->setVar('GAME_NAME', $_SESSION["partie"]["nom"]);
			$montemplate->setVar('GAME_PWD', $_SESSION["partie"]["pwd"]);
			$montemplate->setVar('GAME_MAX_PLAY', $dico["max_players"]." : ".$_SESSION["partie"]["max_play"]);
			$montemplate->setVar('GAME_END', $dico["end"]." : ".$_SESSION["partie"]["end"]);






// BLOCK

			// infos_joueurs
			$montemplate->setBlock($type, 'infos_joueurs', 'informations');

			foreach ($informations as $infos) {
					$montemplate->setVar('CLASS_SELECTED', $infos["selected"]);
					$montemplate->setVar('CURRENT_READY', $infos["ready"]);
					$montemplate->setVar('CURRENT_PLAYERS', $infos["player"]);
					$montemplate->setVar('CURRENT_RACE', $infos["race"]);
					$montemplate->setVar('CURRENT_TEAM', $infos["team"]);
					
					$montemplate->parse('informations', 'infos_joueurs', true);
			}

	


			// chat
			$montemplate->setBlock($type, 'chat', 'messages');
			if(empty($messages)) {
					$montemplate->setVar('CHAT_JOUEUR', "");
					$montemplate->setVar('CHAT_MESSAGE', "");
					
					$montemplate->parse('messages', 'chat', true);

			}
			foreach ($messages as $message) {
					$montemplate->setVar('ID_CHAT', $message["id"]);
					$montemplate->setVar('CHAT_JOUEUR', $message["joueur"]);
					$montemplate->setVar('CHAT_MESSAGE', $message["message"]);
					
					$montemplate->parse('messages', 'chat', true);
			}

			







?>