<?php
			// explications
			$explic =$this->page["DESC_PAGE"];

			$dico = $this->page["DICO"];

// Variables
			$login = $this->var["login"];			
			$mdp = $this->var["mdp"];

			$class= $this->var["class"];
/*
Class des input en cas d'erreur
$class["login"]
$class["mdp"]
*/
///////////////////////////////////////////////////////////////////////////////////

			$montemplate->setFile($type,TEMPLATES.'HTML/contenu/accueil.html');
			$montemplate->setVar('ACT_FORM', URL_ACCUEIL);
			$montemplate->setVar('TITLE_LOGIN', $dico["title_login"]);
			$montemplate->setVar('TITLE_SERVER', $dico["server"]);
			$montemplate->setVar('TITLE_USER_NAME', $dico["user_name"]);
			$montemplate->setVar('TITLE_PWD', $dico["pwd"]);
			
			$montemplate->setVar('USER_NAME', "");
			$montemplate->setVar('PWD', "");


			$montemplate->setVar('SIGN_IN', $dico["sign_in"]);
			$montemplate->setVar('SIGN_UP', $dico["sign_up"]);
			$montemplate->setVar('FORGOT_PWD', $dico["forgot_pwd"]);


			$montemplate->setVar('LIEN_SIGN_UP', URL_INSCRIPT);
			$montemplate->setVar('LIEN_FORGOT_PWD', URL_FORGOT_PWD);


			$montemplate->setVar('CLASS_LOGIN', $class["login"]);
			$montemplate->setVar('CLASS_MDP', $class["mdp"]);





			// explications
			$montemplate->setBlock($type, 'explications', 'explic');

			foreach ($explic as $paragraphe) {
				//var_dump($paragraphe);
					$montemplate->setVar('PARAGRAPHE', $paragraphe);
					$montemplate->parse('explic', 'explications', true);

			}

			
?>