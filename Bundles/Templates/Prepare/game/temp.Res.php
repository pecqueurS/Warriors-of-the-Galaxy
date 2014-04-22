<?php

		// TRAD
			$montemplate->setVar('TXT_ORE', $dico["ore"]);
			$montemplate->setVar('TXT_ORGANIC', $dico["organic"]);
			$montemplate->setVar('TXT_ENERGY', $dico["energy"]);
			$montemplate->setVar('TXT_NEXT_LVL', $dico["next_level"]);
			$montemplate->setVar('TXT_EXPLOITATION', $dico["exploitation"]);
			$montemplate->setVar('TXT_COST',$dico["cost"]);
			$montemplate->setVar('TXT_NEC_TIME', $dico["nec_time"]);
			$montemplate->setVar('TXT_UPGRADE', $dico["upgrade"]);




			$montemplate->setVar('TXT_UP_BUILD', $dico["upgrade_building"]);

			$montemplate->setVar('TXT_COST_CONSTR', $dico["cost_construct"]);
			$montemplate->setVar('TXT_ORE', $dico["ore"]);
			$montemplate->setVar('TXT_ORGANIC', $dico["organic"]);
			$montemplate->setVar('TXT_ENERGY', $dico["energy"]);
			$montemplate->setVar('TXT_BONUS', $dico["bonus"]);



		// AUTRES
			$montemplate->setVar('ORE_LVL', $ressources_joueur["ore"]["niv"]);
			$montemplate->setVar('ORE_QTE', $ressources_joueur["ore"]["qte"]);
			$montemplate->setVar('ORE_MAX', $ressources_joueur["ore"]["max"]);

			$montemplate->setVar('ORE_EXPLOITATION_PROD', intval(Calculs::gain_ressources($ressources_joueur["ore"]["niv"],$ressources_joueur["ore"]["prod"])));
			$montemplate->setVar('ORE_EXPLOITATION_NEXT', "+ ".intval((Calculs::gain_ressources($ressources_joueur["ore"]["niv"]+1,$ressources_joueur["ore"]["prod"])) - (Calculs::gain_ressources($ressources_joueur["ore"]["niv"],$ressources_joueur["ore"]["prod"])) ));

			$montemplate->setVar('ORE_BONUS_PROD', "-");
			$montemplate->setVar('ORE_BONUS_NEXT', "-");

			$montemplate->setVar('ORE_TOTAL_PROD', intval(Calculs::gain_ressources($ressources_joueur["ore"]["niv"],$ressources_joueur["ore"]["prod"]))."/min");
			$montemplate->setVar('ORE_TOTAL_NEXT', "+ ".intval((Calculs::gain_ressources($ressources_joueur["ore"]["niv"]+1,$ressources_joueur["ore"]["prod"])) - (Calculs::gain_ressources($ressources_joueur["ore"]["niv"],$ressources_joueur["ore"]["prod"])) ));

			$montemplate->setVar('ORE_NEXT_LVL', ($ressources_joueur["ore"]["niv"]+1));

			$montemplate->setVar('ORE_COST_ORE', $ressources_joueur["ore"]["cout_res1"]);
			$montemplate->setVar('ORE_COST_ORGANIC', $ressources_joueur["ore"]["cout_res2"]);
			$montemplate->setVar('ORE_COST_ENERGY', $ressources_joueur["ore"]["cout_res3"]);
			$montemplate->setVar('ORE_COST_NEC_TIME', $ressources_joueur["ore"]["tps_nec"]);



			$montemplate->setVar('ORGANIC_LVL', $ressources_joueur["organic"]["niv"]);
			$montemplate->setVar('ORGANIC_QTE', $ressources_joueur["organic"]["qte"]);
			$montemplate->setVar('ORGANIC_MAX', $ressources_joueur["organic"]["max"]);

			$montemplate->setVar('ORGANIC_EXPLOITATION_PROD', intval(Calculs::gain_ressources($ressources_joueur["organic"]["niv"],$ressources_joueur["organic"]["prod"])));
			$montemplate->setVar('ORGANIC_EXPLOITATION_NEXT',  "+ ".intval((Calculs::gain_ressources($ressources_joueur["organic"]["niv"]+1,$ressources_joueur["organic"]["prod"])) - (Calculs::gain_ressources($ressources_joueur["organic"]["niv"],$ressources_joueur["organic"]["prod"])) ));

			$montemplate->setVar('ORGANIC_BONUS_PROD', "-");
			$montemplate->setVar('ORGANIC_BONUS_NEXT', "-");

			$montemplate->setVar('ORGANIC_TOTAL_PROD', intval(Calculs::gain_ressources($ressources_joueur["organic"]["niv"],$ressources_joueur["organic"]["prod"]))."/min");
			$montemplate->setVar('ORGANIC_TOTAL_NEXT',  "+ ".intval((Calculs::gain_ressources($ressources_joueur["organic"]["niv"]+1,$ressources_joueur["organic"]["prod"])) - (Calculs::gain_ressources($ressources_joueur["organic"]["niv"],$ressources_joueur["organic"]["prod"])) ));

			$montemplate->setVar('ORGANIC_NEXT_LVL', ($ressources_joueur["organic"]["niv"]+1));

			$montemplate->setVar('ORGANIC_COST_ORE', $ressources_joueur["organic"]["cout_res1"]);
			$montemplate->setVar('ORGANIC_COST_ORGANIC', $ressources_joueur["organic"]["cout_res2"]);
			$montemplate->setVar('ORGANIC_COST_ENERGY', $ressources_joueur["organic"]["cout_res3"]);
			$montemplate->setVar('ORGANIC_COST_NEC_TIME', $ressources_joueur["organic"]["tps_nec"]);



			$montemplate->setVar('ENERGY_LVL', $ressources_joueur["energy"]["niv"]);
			$montemplate->setVar('ENERGY_QTE', $ressources_joueur["energy"]["qte"]);
			$montemplate->setVar('ENERGY_MAX', $ressources_joueur["energy"]["max"]);

			$montemplate->setVar('ENERGY_EXPLOITATION_PROD', intval(Calculs::gain_ressources($ressources_joueur["energy"]["niv"],$ressources_joueur["energy"]["prod"])));
			$montemplate->setVar('ENERGY_EXPLOITATION_NEXT',  "+ ".intval((Calculs::gain_ressources($ressources_joueur["energy"]["niv"]+1,$ressources_joueur["energy"]["prod"])) - (Calculs::gain_ressources($ressources_joueur["energy"]["niv"],$ressources_joueur["energy"]["prod"])) ));

			$montemplate->setVar('ENERGY_BONUS_PROD', "-");
			$montemplate->setVar('ENERGY_BONUS_NEXT', "-");

			$montemplate->setVar('ENERGY_TOTAL_PROD', intval(Calculs::gain_ressources($ressources_joueur["energy"]["niv"],$ressources_joueur["energy"]["prod"]))."/min");
			$montemplate->setVar('ENERGY_TOTAL_NEXT',  "+ ".intval((Calculs::gain_ressources($ressources_joueur["energy"]["niv"]+1,$ressources_joueur["energy"]["prod"])) - (Calculs::gain_ressources($ressources_joueur["energy"]["niv"],$ressources_joueur["energy"]["prod"])) ));

			$montemplate->setVar('ENERGY_NEXT_LVL', ($ressources_joueur["energy"]["niv"]+1));

			$montemplate->setVar('ENERGY_COST_ORE', $ressources_joueur["energy"]["cout_res1"]);
			$montemplate->setVar('ENERGY_COST_ORGANIC', $ressources_joueur["energy"]["cout_res2"]);
			$montemplate->setVar('ENERGY_COST_ENERGY', $ressources_joueur["energy"]["cout_res3"]);
			$montemplate->setVar('ENERGY_COST_NEC_TIME', $ressources_joueur["energy"]["tps_nec"]);



			$montemplate->setVar('UPGRADE_RES_NEXT_LVL', ($amelio_bat["Res"]["niv"]==$amelio_bat["Res"]["max"]) ? "" : intval($amelio_bat["Res"]["niv"])+1 );
			$montemplate->setVar('UPGRADE_RES_NEC_TIME', ($amelio_bat["Res"]["niv"]==$amelio_bat["Res"]["max"]) ? "-" : Calculs::convert_time(Calculs::cout_ressources($amelio_bat["Res"]["niv"],$amelio_bat["Res"]["cout_tps"])) );

			$montemplate->setVar('UPGRADE_RES_COST_ORE', ($amelio_bat["Res"]["niv"]==$amelio_bat["Res"]["max"]) ? "-" : Calculs::cout_ressources($amelio_bat["Res"]["niv"],$amelio_bat["Res"]["cout_res1"]) );
			$montemplate->setVar('UPGRADE_RES_COST_ORGANIC', ($amelio_bat["Res"]["niv"]==$amelio_bat["Res"]["max"]) ? "-" : Calculs::cout_ressources($amelio_bat["Res"]["niv"],$amelio_bat["Res"]["cout_res2"]) );
			$montemplate->setVar('UPGRADE_RES_COST_ENERGY', ($amelio_bat["Res"]["niv"]==$amelio_bat["Res"]["max"]) ? "-" : Calculs::cout_ressources($amelio_bat["Res"]["niv"],$amelio_bat["Res"]["cout_res3"]) );

			$montemplate->setVar('UPGRADE_RES_BONUS_LVL_ORE', ($amelio_bat["Res"]["niv"]==$amelio_bat["Res"]["max"]) ? "-" : $amelio_bat["Res"]["niv"]+1);
			$montemplate->setVar('UPGRADE_RES_BONUS_LVL_ORGANIC', ($amelio_bat["Res"]["niv"]==$amelio_bat["Res"]["max"]) ? "-" : $amelio_bat["Res"]["niv"]+1);
			$montemplate->setVar('UPGRADE_RES_BONUS_LVL_ENERGY', ($amelio_bat["Res"]["niv"]==$amelio_bat["Res"]["max"]) ? "-" : $amelio_bat["Res"]["niv"]+1);





//var_dump($amelio_bat);





			$montemplate->setVar('TXT_DESCR_BUILD', "Améliorer vos batiments et très important car ils vous permettront d'accéder à de nouvelles technologies.");


















?>
