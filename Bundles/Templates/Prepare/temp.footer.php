<?php

			// liens
			$liens =array( 
				array(	"lien" => URL_ABOUT, "trad_lien" => $this->page["LINKS"]["about"]),
				array(	"lien" => URL_PLAN, "trad_lien" => $this->page["LINKS"]["plan"]),
				array(	"lien" => URL_INFO, "trad_lien" => $this->page["LINKS"]["informations"]),

					);


			// signalement
			$signal =array( 
				array(	"lien" => URL_ABUS, "trad_lien" => $this->page["LINKS"]["abus"]),
				array(	"lien" => URL_BUG, "trad_lien" => $this->page["LINKS"]["bug"]),

					);


				// FOOTER
			$montemplate->setFile($type,TEMPLATES.'HTML/structure/footer.html');
			$montemplate->setVar('TRAD_TITRE_LIEN', $this->page["DICO"]["liens"]);
			$montemplate->setBlock('footer', 'liens', 'links');
			$montemplate->setBlock('footer', 'signal', 'signalement');

			// liens
			foreach ($liens as $lien) {
					$montemplate->setVar('LIEN', $lien["lien"]);
					$montemplate->setVar('TRAD_LIEN', $lien["trad_lien"]);
					
					$montemplate->parse('links', 'liens', true);

			}

			// signalement
			foreach ($signal as $sign) {
					$montemplate->setVar('LIEN', $sign["lien"]);
					$montemplate->setVar('TRAD_LIEN', $sign["trad_lien"]);
					
					$montemplate->parse('signalement', 'signal', true);
			}


			
?>