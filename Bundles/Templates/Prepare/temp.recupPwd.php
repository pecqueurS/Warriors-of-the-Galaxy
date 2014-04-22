<?php


$message = $this->page["DESC_PAGE"][0];

$dico = $this->page["DICO"];

///////////////////////////////////////////////////////////////////////////////////

			$montemplate->setFile($type,TEMPLATES.'HTML/contenu/recupPwd.html');

			$montemplate->setVar('MESSAGE', $message);
			$montemplate->setVar('LINK_ACCUEIL', URL_ACCUEIL);
			$montemplate->setVar('TXT_BACK', $dico["back"]);
			
?>