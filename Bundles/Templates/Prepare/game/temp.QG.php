<?php
// Details colonies
$detColonies = array(
	array(
		"col_x" => "2",
		"col_y" => "2",
		"col_res" => "Ore",
		"col_win" => "+ 5%",
	),

	array(
		"col_x" => "5",
		"col_y" => "9",
		"col_res" => "Organic",
		"col_win" => "+ 2%",
	),

	array(
		"col_x" => "10",
		"col_y" => "12",
		"col_res" => "Organic",
		"col_win" => "+ 7%",
	),

	array(
		"col_x" => "2",
		"col_y" => "4",
		"col_res" => "Energy",
		"col_win" => "+ 5%",
	),

);


// Detail d'une colonie
$detailCol = array(
	array(
		"team" => "1",
		"unit1" => "1 000",
		"unit2" => "9 000",
		"unit3" => "10 000",
	),

	array(
		"team" => "2",
		"unit1" => "1 000",
		"unit2" => "29 000",
		"unit3" => "10 000",
	),

	array(
		"team" => "3",
		"unit1" => "15 000",
		"unit2" => "9 000",
		"unit3" => "10 000",
	),

);


// Construction en cours
$constructActu = array(
	array(
		"percent" => "25",
		"bat" => "Research Center Lvl 12",
		"time" => "07min35s",
	),

);

// Action en cours
$actionActu = array(
	array(
		"percent" => "75",
		"bat" => "Upgrade Resources Lvl 10",
		"time" => "03min50s",
	),

);

// Units en cours
$unitsActu = array(
	array(
		"percent" => "17",
		"bat" => "500 Fighters",
		"time" => "07min35s",
	),

);




		// TRAD

			$montemplate->setVar('TXT_ORE', $dico["ore"]);
			$montemplate->setVar('TXT_ORGANIC', $dico["organic"]);
			$montemplate->setVar('TXT_ENERGY', $dico["energy"]);

			$montemplate->setVar('TXT_UNIT1', $dico["fighters"]);
			$montemplate->setVar('TXT_UNIT2', $dico["bombers"]);
			$montemplate->setVar('TXT_UNIT3', $dico["cruisers"]);

			$montemplate->setVar('TXT_SEND_NEW_TEAM', $dico["send_new_team"]);

			$montemplate->setVar('TXT_IN_PROGRESS', $dico["in_progress"]);

			$montemplate->setVar('TXT_UNITS', $dico["units"]);


			$montemplate->setVar('TXT_UP_BUILD', $dico["upgrade_building"]);

			$montemplate->setVar('TXT_NEXT_LVL', $dico["next_level"]);
			$montemplate->setVar('TXT_NEC_TIME', $dico["nec_time"]);
			$montemplate->setVar('TXT_COST_CONSTR', $dico["cost_construct"]);
			$montemplate->setVar('TXT_BONUS', $dico["bonus"]);
			$montemplate->setVar('TXT_SP', $dico["spaceport"]);
			$montemplate->setVar('TXT_RES', $dico["resources"]);
			$montemplate->setVar('TXT_RC', $dico["research_center"]);
			$montemplate->setVar('TXT_DC', $dico["defense_center"]);
			$montemplate->setVar('TXT_WH', $dico["warehouse"]);
			$montemplate->setVar('TXT_UPGRADE', $dico["upgrade"]);




			$montemplate->setVar('DESCR_ACT', "Permet de gérer les colonies conquises grâce à vos équipes.");

			$montemplate->setVar('TXT_DESCR_BUILD', "Améliorer vos batiments et très important car ils vous permettront d'accéder à de nouvelles technologies.");





		// AUTRES
			$montemplate->setVar('TITRE_DETAILS', "Equipes sur 2-2");

			$montemplate->setVar('UPGRADE_QG_NEXT_LVL', ($amelio_bat["QG"]["niv"]==$amelio_bat["QG"]["max"]) ? "" : intval($amelio_bat["QG"]["niv"])+1 );
			$montemplate->setVar('UPGRADE_QG_NEC_TIME', ($amelio_bat["QG"]["niv"]==$amelio_bat["QG"]["max"]) ? "-" : Calculs::convert_time(Calculs::cout_ressources($amelio_bat["QG"]["niv"],$amelio_bat["QG"]["cout_tps"])) );
			$montemplate->setVar('UPGRADE_QG_COST_ORE', ($amelio_bat["QG"]["niv"]==$amelio_bat["QG"]["max"]) ? "-" : Calculs::cout_ressources($amelio_bat["QG"]["niv"],$amelio_bat["QG"]["cout_res1"]) );
			$montemplate->setVar('UPGRADE_QG_COST_ORGANIC', ($amelio_bat["QG"]["niv"]==$amelio_bat["QG"]["max"]) ? "-" : Calculs::cout_ressources($amelio_bat["QG"]["niv"],$amelio_bat["QG"]["cout_res2"]) );
			$montemplate->setVar('UPGRADE_QG_COST_ENERGY', ($amelio_bat["QG"]["niv"]==$amelio_bat["QG"]["max"]) ? "-" : Calculs::cout_ressources($amelio_bat["QG"]["niv"],$amelio_bat["QG"]["cout_res3"]) );
			$montemplate->setVar('UPGRADE_QG_BONUS_SP', $bonus_bat["QG"]["SP"]);
			$montemplate->setVar('UPGRADE_QG_BONUS_RES', $bonus_bat["QG"]["Res"]);
			$montemplate->setVar('UPGRADE_QG_BONUS_RC', $bonus_bat["QG"]["RC"]);
			$montemplate->setVar('UPGRADE_QG_BONUS_DC', $bonus_bat["QG"]["DC"]);
			$montemplate->setVar('UPGRADE_QG_BONUS_WH', $bonus_bat["QG"]["WH"]);






		// BLOCK
			// colonies
			$montemplate->setBlock($bat['type'], 'colonies', 'detColonies');

			foreach ($detColonies as $colonie) {
					$montemplate->setVar('COL_X', $colonie["col_x"]);
					$montemplate->setVar('COL_Y', $colonie["col_y"]);
					$montemplate->setVar('COL_RES', $colonie["col_res"]);
					$montemplate->setVar('COL_WIN', $colonie["col_win"]);
					
					$montemplate->parse('detColonies', 'colonies', true);
			}


			// detailsColonie
			$montemplate->setBlock($bat['type'], 'detailsColonie', 'detailCol');

			foreach ($detailCol as $detail) {
					$montemplate->setVar('DET_BACK', "Back");

					$montemplate->setVar('DET_TEAM', $detail["team"]);
					$montemplate->setVar('DET_UNIT1', $detail["unit1"]);
					$montemplate->setVar('DET_UNIT2', $detail["unit2"]);
					$montemplate->setVar('DET_UNIT3', $detail["unit3"]);
					
					$montemplate->parse('detailCol', 'detailsColonie', true);
			}


			// constructionEnCours
			$montemplate->setBlock($bat['type'], 'constructionEnCours', 'constructActu');

			foreach ($constructActu as $construction) {
					$montemplate->setVar('CONSTR_PERCENT_PROGRESS', $construction["percent"]);
					$montemplate->setVar('CONSTR_BAT', $construction["bat"]);
					$montemplate->setVar('CONSTR_TIME_LEFT', $construction["time"]);
					
					$montemplate->parse('constructActu', 'constructionEnCours', true);
			}


			// actionsEnCours
			$montemplate->setBlock($bat['type'], 'actionsEnCours', 'actionActu');

			foreach ($actionActu as $action) {
					$montemplate->setVar('CONSTR_PERCENT_PROGRESS', $action["percent"]);
					$montemplate->setVar('CONSTR_BAT', $action["bat"]);
					$montemplate->setVar('CONSTR_TIME_LEFT', $action["time"]);
					
					$montemplate->parse('actionActu', 'actionsEnCours', true);
			}


			// unitsEnCours
			$montemplate->setBlock($bat['type'], 'unitsEnCours', 'unitsActu');

			foreach ($unitsActu as $units) {
					$montemplate->setVar('CONSTR_PERCENT_PROGRESS', $units["percent"]);
					$montemplate->setVar('CONSTR_BAT', $units["bat"]);
					$montemplate->setVar('CONSTR_TIME_LEFT', $units["time"]);
					
					$montemplate->parse('unitsActu', 'unitsEnCours', true);
			}




















?>