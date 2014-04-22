<?php


$end_desc = $this->page["DESC_PAGE"][0];

$dico = $this->page["DICO"];




			$game_name = $this->var["game_name"];			
			$class = $this->var["class"];			



///////////////////////////////////////////////////////////////////////////////////





$selectNbJoueurs = "";
for ($i=16; $i > 1 ; $i--) { 
	if($i==16) {
		$selectNbJoueurs .= "<option value=\"$i\" selected>$i</option>";
	} else {
		$selectNbJoueurs .= "<option value=\"$i\">$i</option>";
	}
}


$endsType = array(
			"timeLapse" => $dico["time_lapse"],
	);
$selectEnd = "";
foreach ($endsType as $key => $value) {
	if($key == "timeLapse") {
		$selectEnd .= "<option value=\"$key\" selected>$value</option>";
	} else {
		$selectEnd .= "<option value=\"$key\">$value</option>";
	}
}




			$montemplate->setFile($type,TEMPLATES.'HTML/contenu/createGame.html');

			$montemplate->setVar('LINK_PROFIL', URL_PROFIL);
			$montemplate->setVar('LINK_ACCUEIL', URL_ACCUEIL);
			$montemplate->setVar('NEW_GAME', $dico["new_game"]);
			$montemplate->setVar('LOGOUT', $dico["logout"]);

			$montemplate->setVar('TITRE_INFO_PARTIE', $dico["game_info"]);
			$montemplate->setVar('ACT_FORM2', URL_CREATE);

			$montemplate->setVar('TITLE_NAME', $dico["name"]);
			$montemplate->setVar('TITLE_GAME_NAME', $dico["game_name"]);
			$montemplate->setVar('TITLE_PWD', $dico["pwd"]);
			$montemplate->setVar('LAB_MAX_PLAYERS', $dico["max_players"]);


			$montemplate->setVar('CLASS_GAME_NAME', $class["game_name"]);

			$montemplate->setVar('LIST_NB_JOUEURS', $selectNbJoueurs);


			$montemplate->setVar('TITLE_END', $dico["end"]);
			$montemplate->setVar('LIST_FIN', $selectEnd);

			$montemplate->setVar('END_DESC', $end_desc);

			$montemplate->setVar('TXT_CREATE', $dico["create"]);

			$montemplate->setVar('TXT_BACK', $dico["back"]);







			
?>