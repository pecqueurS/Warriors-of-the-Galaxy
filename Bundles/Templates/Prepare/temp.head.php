<?php

			// Liste des feuilles de style
			// Jquery ui
			$stylesheet = ($this->page["PAGE_EN_COURS"] == "abus" || $this->page["PAGE_EN_COURS"] == "bug") ? array('../js/jquery-ui/css/custom-theme/jquery-ui.css') : array();

			
			$stylesheet[] = 'style.css'; 
			$stylesheet[] = $this->page["PAGE_HEAD_INFO"]["template"].".css"; 
			$stylesheet[] = "profil/".$this->page["PAGE_HEAD_INFO"]["page"].".css";
			$stylesheet[] = "resize.css";
			$stylesheet[] = "resize/".$this->page["PAGE_HEAD_INFO"]["page"].".css";


			// Liste des scripts
			$scripts = array('jquery.js');

			// Jquery ui
			if($this->page["PAGE_EN_COURS"] == "abus" || $this->page["PAGE_EN_COURS"] == "bug") $scripts[] = 'jquery-ui/js/jquery-ui.js';
			

			$scripts[] = 'style.js';
			$scripts[] = $this->page["PAGE_HEAD_INFO"]["page"].".js";
			$scripts[] = 'ajax/ajax.'.$this->page["PAGE_HEAD_INFO"]["page"].".js";
								

			// Ajax Gestion des sessions
			$arrSessionPages = array("createGame", "game", "joinGame", "profil", "waitGame", "endOfGame"); 
			if(in_array($this->page["PAGE_EN_COURS"], $arrSessionPages)) {
				$scripts[] = 'ajax/ajax.session.js';
			}



				// HEADER
			$montemplate->setFile($type,TEMPLATES.'HTML/structure/head.html');
			$montemplate->setVar('TITRE_PAGE', $this->page["PAGE_HEAD_INFO"]["traduction"]);

			$selected_fr = ($_SESSION["lang"]=="fr") ? "selected" : "";
			$selected_en = ($_SESSION["lang"]=="en") ? "selected" : "";
			$montemplate->setVar('TXT_LANG', "langue");
			$montemplate->setVar('ACT_FLAG', URL_BASE.$this->page["PAGE_EN_COURS"]);
			$montemplate->setVar('SELECTED_FR', $selected_fr);
			$montemplate->setVar('SELECTED_EN', $selected_en);








			$montemplate->setBlock('head', 'stylesheet', 'styleCSS');
			$montemplate->setBlock('head', 'scripts', 'styleJS');

			// Stylesheets
			foreach ($stylesheet as $css) {
				if(is_file("css/".$css)) {
					$montemplate->setVar('CSS', $css);
					
					$montemplate->parse('styleCSS', 'stylesheet', true);
				}

			}

			// Scripts
			foreach ($scripts as $js) {
				if(is_file("js/".$js)) {
					$montemplate->setVar('JS', $js);
					
					$montemplate->parse('styleJS', 'scripts', true);
				}
			}


			// NOSCRIPTS
			$montemplate->setVar('NOSCRIPT', $this->page["NOSCRIPT"]);




			// Error
			if(isset($_SESSION["message"])) {
				$erreur = "<p class='error'>{$_SESSION['message']}</p>";
				
				unset($_SESSION["message"]);
			} else {
				$erreur = "";
			}

			$montemplate->setVar('ERROR', $erreur);

			
?>