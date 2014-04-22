<?php
			$dico = $this->page["DICO"];

			
			$montemplate->setFile($type,TEMPLATES.'HTML/contenu/abus.html');

			$montemplate->setVar('LINK_ACCUEIL', URL_ACCUEIL);

			$montemplate->setVar('ACCUEIL', $dico["home"]);
	

			$montemplate->setVar('TXT_SIGNAL_ABUS', $this->page["LINKS"]["abus"]);
			$montemplate->setVar('TXT_SERVER', $dico["server"]);
			$montemplate->setVar('TXT_JOUEUR', $dico["player"]);
			$montemplate->setVar('TXT_USERNAME', $dico["user_name"]);
			$montemplate->setVar('TXT_DATE', $dico["date"]);
			$montemplate->setVar('TXT_QUAND_ABUS', $dico["quand_abus"]);
			$montemplate->setVar('TXT_HEURE', $dico["hour"]);
			$montemplate->setVar('TXT_HEURE_ABUS', $dico["heure_abus"]);
			$montemplate->setVar('TXT_DESCRIPTION_ABUS', $dico["description_abus"]);
			$montemplate->setVar('TXT_SEND', $dico["send"]);










































		
?>