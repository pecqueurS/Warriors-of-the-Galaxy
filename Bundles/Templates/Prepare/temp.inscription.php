<?php
			$dico = $this->page["DICO"];

			$niveau_secu = "HIGH";

			$src_avatar = "../../images/avatarDefault.png";



// Variables
			$login = $this->var["login"];			
			$mdp = $this->var["mdp"];
			$confirm = $this->var["confirm"];			
			$email = $this->var["email"];

			$class= $this->var["class"];
/*
Class des input en cas d'erreur
$class["login"]
$class["pwd"]
$class["email"]
*/

///////////////////////////////////////////////////////////////////////////////////


			$montemplate->setFile($type,TEMPLATES.'HTML/contenu/inscription.html');
// LINKS
			$montemplate->setVar('LINK_ACCUEIL', URL_ACCUEIL);
			$montemplate->setVar('LINK_ENV_MAIL', URL_INSCRIPT);

// TRAD
			$montemplate->setVar('ACCUEIL', $dico["home"]);
			$montemplate->setVar('TITRE_INSCRIPTION', $dico["sign_up"]);

			$montemplate->setVar('TITRE_SERVER', $dico["server"]);
			$montemplate->setVar('TITRE_LOGIN', $dico["login"]);
			$montemplate->setVar('TITRE_USER_NAME', $dico["user_name"]);

			$montemplate->setVar('TITRE_PWD', $dico["pwd"]);
			$montemplate->setVar('TITRE_CONFIRM_PWD', $dico["confirm"]);
			$montemplate->setVar('TITRE_SECU_PWD', $dico["secu_lvl"]);
			$montemplate->setVar('NIVEAU_SECU_PWD', $niveau_secu);

			$montemplate->setVar('TITRE_CHANGE_AVATAR', $dico["change_avatar"]);
			$montemplate->setVar('TXT_TAILLE_IMG', $dico["output_size"]);







// INPUTS (cf mod.inscription.php)
			$montemplate->setVar('USER_NAME', $login);
			$montemplate->setVar('PWD', $mdp);
			$montemplate->setVar('CONFIRM_PWD', $confirm);
			$montemplate->setVar('EMAIL', $email);
	
			$montemplate->setVar('CLASS_LOGIN', $class["login"]);
			$montemplate->setVar('CLASS_MDP', $class["pwd"]);
			$montemplate->setVar('CLASS_EMAIL', $class["email"]);
	


// IMAGES
			$montemplate->setVar('SRC_AVATAR', $src_avatar);


// BTN
			$montemplate->setVar('BTN_CREATE', $dico["create"]);



?>