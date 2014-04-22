<?php
			$dico = $this->page["DICO"];
// Variables
			$name_page = $this->var["name_page"];			

			$montemplate->setFile($type,TEMPLATES.'HTML/contenu/plan.html');


// LIEN
			$montemplate->setVar('URL_ACCUEIL', URL_ACCUEIL);
			$montemplate->setVar('URL_INSCRIPT', URL_INSCRIPT);
			$montemplate->setVar('URL_FORGOT_PWD', URL_FORGOT_PWD);

			$montemplate->setVar('URL_PROFIL', URL_PROFIL);
			$montemplate->setVar('URL_CREATE', URL_CREATE);
			$montemplate->setVar('URL_JOIN', URL_JOIN);

			$montemplate->setVar('URL_ABOUT', URL_ABOUT);
			$montemplate->setVar('URL_PLAN', URL_PLAN);
			$montemplate->setVar('URL_INFO', URL_INFO);
			$montemplate->setVar('URL_ABUS', URL_ABUS);
			$montemplate->setVar('URL_BUG', URL_BUG);

// TRaduction
			$montemplate->setVar('TOUT_PUBLIC', $dico["tout_public"]);
			$montemplate->setVar('MEMBERS', $dico["members"]);
			$montemplate->setVar('OTHER_PAGES', $dico["other_pages"]);

			if($_SESSION["lang"] == 'en') {
				$info_sup = "To access these pages, thank you to log first";
			} else {
				$info_sup = "Pour accèder à ces pages, merci de vous connecter au préalable";
			}
			$montemplate->setVar('INFO_SUP', $info_sup);

// Nom pages
			$montemplate->setVar('ACCUEIL', $name_page["accueil"]);
			$montemplate->setVar('INSCRIPT', $name_page["inscription"]);
			$montemplate->setVar('FORGOT_PWD', $name_page["forgot_pwd"]);

			$montemplate->setVar('PROFIL', $name_page["profil"]);
			$montemplate->setVar('CREATE', $name_page["createGame"]);
			$montemplate->setVar('JOIN', $name_page["joinGame"]);

			$montemplate->setVar('ABOUT', $name_page["about"]);
			$montemplate->setVar('PLAN', $name_page["plan"]);
			$montemplate->setVar('INFO', $name_page["informations"]);
			$montemplate->setVar('ABUS', $name_page["abus"]);
			$montemplate->setVar('BUG', $name_page["bug"]);



?>







