<?php


$message = $this->page["DESC_PAGE"][0];

$dico = $this->page["DICO"];

// Variables
			$login = $this->var["login"];			
			$email = $this->var["email"];

			$class= $this->var["class"];
/*
Class des input en cas d'erreur
$class["login"]
$class["email"]
*/
///////////////////////////////////////////////////////////////////////////////////

			$montemplate->setFile($type,TEMPLATES.'HTML/contenu/forgot_pwd.html');


			$montemplate->setVar('FORGOT_PWD', URL_FORGOT_PWD);

			$montemplate->setVar('TITLE_FORGOT_PWD', $dico["forgot_pwd"]);

			$montemplate->setVar('TITLE_SERVER', $dico["server"]);

			$montemplate->setVar('TITLE_USER_NAME', $dico["user_name"]);
			$montemplate->setVar('USER_NAME', $login);

			$montemplate->setVar('TITLE_USER_EMAIL', $dico["email"]);
			$montemplate->setVar('EMAIL', $email);

			$montemplate->setVar('BTN_SEND_PWD', $dico["send_new_pwd"]);

			$montemplate->setVar('BTN_BACK', $dico["back"]);
			$montemplate->setVar('LINK_ACCUEIL', URL_ACCUEIL);

			$montemplate->setVar('PARAGRAPHE', $message);


	
			$montemplate->setVar('CLASS_LOGIN', $class["login"]);
			$montemplate->setVar('CLASS_EMAIL', $class["email"]);




			
?>