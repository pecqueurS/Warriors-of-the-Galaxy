<?php

			$dico = $this->page["DICO"];


// Variables
			$detailsTeams = $this->var["detailsTeams"];			






























			
			$montemplate->setFile($type,TEMPLATES.'HTML/contenu/endOfGame.html');


			$montemplate->setVar('LINK_PROFIL', URL_PROFIL);
			$montemplate->setVar('BACK',  $dico["back"]);
			$montemplate->setVar('EQUIPE_WIN',  $detailsTeams[0]["equipe"]);
			$montemplate->setVar('WON_THE_MATCH',  $dico["won_match"]);






			$montemplate->setBlock($type, 'teams', 'detailsTeams');




			// teams
			foreach ($detailsTeams as $team) {
					$montemplate->setVar('EQUIPE', $team["equipe"]);
					$montemplate->setVar('COL_TEAMS', $team["col_teams"]);
					$montemplate->setVar('POSITION', $team["position"]);
					
					$montemplate->setVar('TXT_JOUEURS', $dico["player"]);
					$montemplate->setVar('TXT_COORDS', $dico["team"]);
					$montemplate->setVar('TXT_NB_COLONIES', $dico["colonies"]);
					
					$montemplate->setVar('DETAILS_JOUEURS', $team["details_joueurs"]);

					$montemplate->parse('detailsTeams', 'teams', true);

			}







/*




*/



?>