<?php
// Liste des unites en construction
$constructUnitsList = array(
	array(
		"percent" => "25",
		"status" => "En cours",
		"nbUnits" => "500 Fighters",
		"timeLeft" => "07min35s",
		),

	array(
		"percent" => "0",
		"status" => "En attente",
		"nbUnits" => "1000 Bombers",
		"timeLeft" => "15min35s",
		),

	array(
		"percent" => "0",
		"status" => "En attente",
		"nbUnits" => "10 000 Cruisers",
		"timeLeft" => "25min35s",
		),

	array(
		"percent" => "0",
		"status" => "En attente",
		"nbUnits" => "1000 Bombers",
		"timeLeft" => "15min35s",
		),
);


		// TRAD
			$montemplate->setVar('TXT_CREATE_FIGHTER', $dico["create_fighters"]);
			$montemplate->setVar('TXT_CREATE_BOMBER', $dico["create_bombers"]);
			$montemplate->setVar('TXT_CREATE_CRUISER', $dico["create_cruisers"]);

			$montemplate->setVar('TXT_UNIT1', $dico["fighters"]);
			$montemplate->setVar('TXT_UNIT2', $dico["bombers"]);
			$montemplate->setVar('TXT_UNIT3', $dico["cruisers"]);

			$montemplate->setVar('TXT_ATT', $dico["attack"]);
			$montemplate->setVar('TXT_DEF', $dico["defense"]);
			$montemplate->setVar('TXT_CHARGE', $dico["charge"]);
			$montemplate->setVar('TXT_VIT', $dico["speed"]);
			$montemplate->setVar('TXT_LIFE', $dico["life"]);
			$montemplate->setVar('TXT_OWNED', $dico["owned"]);
			$montemplate->setVar('TXT_COST', $dico["cost"]);
			$montemplate->setVar('TXT_ORE', $dico["ore"]);
			$montemplate->setVar('TXT_ORGANIC', $dico["organic"]);
			$montemplate->setVar('TXT_ENERGY', $dico["energy"]);
			$montemplate->setVar('TXT_NEC_TIME', $dico["nec_time"]);
			$montemplate->setVar('TXT_CUR_CONSTR', $dico["current_construct"]);

			$montemplate->setVar('TXT_CONSTRUCT', $dico["construct"]);


			$montemplate->setVar('TXT_UP_BUILD', $dico["upgrade_building"]);

			$montemplate->setVar('TXT_NEXT_LVL', $dico["next_level"]);
			$montemplate->setVar('TXT_NEC_TIME', $dico["nec_time"]);
			$montemplate->setVar('TXT_COST_CONSTR', $dico["cost_construct"]);
			$montemplate->setVar('TXT_ORE', $dico["ore"]);
			$montemplate->setVar('TXT_ORGANIC', $dico["organic"]);
			$montemplate->setVar('TXT_ENERGY', $dico["energy"]);
			$montemplate->setVar('TXT_BONUS', $dico["bonus"]);

			$montemplate->setVar('TXT_DEBLOQUE', $dico["unlocked"]);



			$montemplate->setVar('TXT_UPGRADE', $dico["upgrade"]);
			





			$montemplate->setVar('TXT_DESCR_BUILD', "Améliorer vos batiments et très important car ils vous permettront d'accéder à de nouvelles technologies.");



		// AUTRES
			$montemplate->setVar('UNIT1_ATT', $infos_unites["fighter"]["ATT"]);
			$montemplate->setVar('UNIT1_DEF', $infos_unites["fighter"]["DEF"]);
			$montemplate->setVar('UNIT1_CHARGE', $infos_unites["fighter"]["CHARGE"]);
			$montemplate->setVar('UNIT1_VIT', $infos_unites["fighter"]["VIT"]);
			$montemplate->setVar('UNIT1_LIFE', $infos_unites["fighter"]["VIE"]);

			$montemplate->setVar('UNIT1_OWNED', $infos_unites["fighter"]["STOCK"]);

			$montemplate->setVar('UNIT1_MAX', $infos_unites["fighter"]["MAX"]);

			$montemplate->setVar('UNIT1_MIN', ($infos_unites["fighter"]["MAX"] == 0)?0:1);

			$montemplate->setVar('UNIT1_ORE', $infos_unites["fighter"]["ORE"]);
			$montemplate->setVar('UNIT1_ORGANIC', $infos_unites["fighter"]["ORGANIC"]);
			$montemplate->setVar('UNIT1_ENERGY', $infos_unites["fighter"]["ENERGY"]);
			$montemplate->setVar('UNIT1_NEC_TIME', $infos_unites["fighter"]["NEC_TIME"]);
			$montemplate->setVar('UNIT1_NEC_TIME_REAL', $infos_unites["fighter"]["NEC_TIME_REAL"]);



			$montemplate->setVar('UNIT2_ATT', $infos_unites["bomber"]["ATT"]);
			$montemplate->setVar('UNIT2_DEF', $infos_unites["bomber"]["DEF"]);
			$montemplate->setVar('UNIT2_CHARGE', $infos_unites["bomber"]["CHARGE"]);
			$montemplate->setVar('UNIT2_VIT', $infos_unites["bomber"]["VIT"]);
			$montemplate->setVar('UNIT2_LIFE', $infos_unites["bomber"]["VIE"]);

			$montemplate->setVar('UNIT2_OWNED', $infos_unites["bomber"]["STOCK"]);

			$montemplate->setVar('UNIT2_MAX', $infos_unites["bomber"]["MAX"]);

			$montemplate->setVar('UNIT2_MIN', ($infos_unites["bomber"]["MAX"] == 0)?0:1);

			$montemplate->setVar('UNIT2_ORE', $infos_unites["bomber"]["ORE"]);
			$montemplate->setVar('UNIT2_ORGANIC', $infos_unites["bomber"]["ORGANIC"]);
			$montemplate->setVar('UNIT2_ENERGY', $infos_unites["bomber"]["ENERGY"]);
			$montemplate->setVar('UNIT2_NEC_TIME', $infos_unites["bomber"]["NEC_TIME"]);
			$montemplate->setVar('UNIT2_NEC_TIME_REAL', $infos_unites["bomber"]["NEC_TIME_REAL"]);



			$montemplate->setVar('UNIT3_ATT', $infos_unites["cruiser"]["ATT"]);
			$montemplate->setVar('UNIT3_DEF', $infos_unites["cruiser"]["DEF"]);
			$montemplate->setVar('UNIT3_CHARGE', $infos_unites["cruiser"]["CHARGE"]);
			$montemplate->setVar('UNIT3_VIT', $infos_unites["cruiser"]["VIT"]);
			$montemplate->setVar('UNIT3_LIFE', $infos_unites["cruiser"]["VIE"]);

			$montemplate->setVar('UNIT3_OWNED', $infos_unites["cruiser"]["STOCK"]);

			$montemplate->setVar('UNIT3_MAX', $infos_unites["cruiser"]["MAX"]);

			$montemplate->setVar('UNIT3_MIN', ($infos_unites["cruiser"]["MAX"] == 0)?0:1);

			$montemplate->setVar('UNIT3_ORE', $infos_unites["cruiser"]["ORE"]);
			$montemplate->setVar('UNIT3_ORGANIC', $infos_unites["cruiser"]["ORGANIC"]);
			$montemplate->setVar('UNIT3_ENERGY', $infos_unites["cruiser"]["ENERGY"]);
			$montemplate->setVar('UNIT3_NEC_TIME', $infos_unites["cruiser"]["NEC_TIME"]);
			$montemplate->setVar('UNIT3_NEC_TIME_REAL', $infos_unites["cruiser"]["NEC_TIME_REAL"]);


			$montemplate->setVar('UPGRADE_SP_NEXT_LVL', ($amelio_bat["SP"]["niv"]==$amelio_bat["SP"]["max"]) ? "" : intval($amelio_bat["SP"]["niv"])+1 );
			$montemplate->setVar('UPGRADE_SP_NEC_TIME', ($amelio_bat["SP"]["niv"]==$amelio_bat["SP"]["max"]) ? "-" : Calculs::convert_time(Calculs::cout_ressources($amelio_bat["SP"]["niv"],$amelio_bat["SP"]["cout_tps"])) );
			$montemplate->setVar('UPGRADE_SP_COST_ORE', ($amelio_bat["SP"]["niv"]==$amelio_bat["SP"]["max"]) ? "-" : Calculs::cout_ressources($amelio_bat["SP"]["niv"],$amelio_bat["SP"]["cout_res1"]) );
			$montemplate->setVar('UPGRADE_SP_COST_ORGANIC', ($amelio_bat["SP"]["niv"]==$amelio_bat["SP"]["max"]) ? "-" : Calculs::cout_ressources($amelio_bat["SP"]["niv"],$amelio_bat["SP"]["cout_res2"]) );
			$montemplate->setVar('UPGRADE_SP_COST_ENERGY', ($amelio_bat["SP"]["niv"]==$amelio_bat["SP"]["max"]) ? "-" : Calculs::cout_ressources($amelio_bat["SP"]["niv"],$amelio_bat["SP"]["cout_res3"]) );


			$montemplate->setVar('UPGRADE_SP_BONUS_UNIT', ($amelio_bat["Res"]["niv"]==$amelio_bat["Res"]["max"]) ? "-" : $bonus_bat["SP"]["bonus_act"] );
			$montemplate->setVar('UPGRADE_SP_BONUS_ATT', ($amelio_bat["Res"]["niv"]==$amelio_bat["Res"]["max"]) ? "-" : "+".$bonus_bat["SP"]["ATT"]."%");
			$montemplate->setVar('UPGRADE_SP_BONUS_DEF', ($amelio_bat["Res"]["niv"]==$amelio_bat["Res"]["max"]) ? "-" : "+".$bonus_bat["SP"]["DEF"]."%");
			$montemplate->setVar('UPGRADE_SP_BONUS_CHARGE', ($amelio_bat["Res"]["niv"]==$amelio_bat["Res"]["max"]) ? "-" : "+".$bonus_bat["SP"]["CHARGE"]."%");
			$montemplate->setVar('UPGRADE_SP_BONUS_VIT', ($amelio_bat["Res"]["niv"]==$amelio_bat["Res"]["max"]) ? "-" : "+".$bonus_bat["SP"]["VIT"]."%");
			$montemplate->setVar('UPGRADE_SP_BONUS_LIFE',($amelio_bat["Res"]["niv"]==$amelio_bat["Res"]["max"]) ? "-" : "+".$bonus_bat["SP"]["VIE"]."%");
			$montemplate->setVar('UPGRADE_SP_BONUS_NEC_TIME', ($amelio_bat["Res"]["niv"]==$amelio_bat["Res"]["max"]) ? "-" : "-".$bonus_bat["SP"]["TIME"]."%");
			$montemplate->setVar('UPGRADE_SP_BONUS_COST', ($amelio_bat["Res"]["niv"]==$amelio_bat["Res"]["max"]) ? "-" : "-".$bonus_bat["SP"]["COST"]."%");






	






		// BLOCKS
			// listeConstrUnits
			$montemplate->setBlock($bat['type'], 'listeConstrUnits', 'constructUnitsList');

			foreach ($constructUnitsList as $construction) {
					$montemplate->setVar('LIST_UNITS_PERCENT', $construction["percent"]);
					$montemplate->setVar('LIST_UNITS_STATUS', $construction["status"]);
					$montemplate->setVar('LIST_UNITS_NB', $construction["nbUnits"]);
					$montemplate->setVar('LIST_UNITS_TIME_LEFT', $construction["timeLeft"]);
					
					$montemplate->parse('constructUnitsList', 'listeConstrUnits', true);
			}






















?>