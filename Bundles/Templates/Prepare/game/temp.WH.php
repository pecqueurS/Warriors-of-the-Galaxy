<?php

		// TRAD
			$montemplate->setVar('TXT_UP_BUILD', $dico["upgrade_building"]);

			$montemplate->setVar('TXT_NEXT_LVL', $dico["next_level"]);
			$montemplate->setVar('TXT_NEC_TIME', $dico["nec_time"]);
			$montemplate->setVar('TXT_COST_CONSTR', $dico["cost_construct"]);
			$montemplate->setVar('TXT_ORE', $dico["ore"]);
			$montemplate->setVar('TXT_ORGANIC', $dico["organic"]);
			$montemplate->setVar('TXT_ENERGY', $dico["energy"]);
			$montemplate->setVar('TXT_BONUS', $dico["bonus"]);
			$montemplate->setVar('TXT_UPGRADE', $dico["upgrade"]);


			$montemplate->setVar('TXT_DESCR_BUILD', "Améliorer vos batiments et très important car ils vous permettront d'accéder à de nouvelles technologies.");


		// AUTRES
			$montemplate->setVar('UPGRADE_WH_NEXT_LVL', ($amelio_bat["WH"]["niv"]==$amelio_bat["WH"]["max"]) ? "" : intval($amelio_bat["WH"]["niv"])+1 );
			$montemplate->setVar('UPGRADE_WH_NEC_TIME', ($amelio_bat["WH"]["niv"]==$amelio_bat["WH"]["max"]) ? "-" : Calculs::convert_time(Calculs::cout_ressources($amelio_bat["WH"]["niv"],$amelio_bat["WH"]["cout_tps"])) );

			$montemplate->setVar('UPGRADE_WH_COST_ORE', ($amelio_bat["WH"]["niv"]==$amelio_bat["WH"]["max"]) ? "-" : Calculs::cout_ressources($amelio_bat["WH"]["niv"],$amelio_bat["WH"]["cout_res1"]) );
			$montemplate->setVar('UPGRADE_WH_COST_ORGANIC', ($amelio_bat["WH"]["niv"]==$amelio_bat["WH"]["max"]) ? "-" : Calculs::cout_ressources($amelio_bat["WH"]["niv"],$amelio_bat["WH"]["cout_res2"]) );
			$montemplate->setVar('UPGRADE_WH_COST_ENERGY', ($amelio_bat["WH"]["niv"]==$amelio_bat["WH"]["max"]) ? "-" : Calculs::cout_ressources($amelio_bat["WH"]["niv"],$amelio_bat["WH"]["cout_res3"]) );

			$montemplate->setVar('UPGRADE_WH_BONUS_STOCK_MAX', ($amelio_bat["WH"]["niv"]==$amelio_bat["WH"]["max"]) ? "-" : $bonus_bat["WH"]["max"]);





?>
