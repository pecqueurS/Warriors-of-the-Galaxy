<?php
			$dico = $this->page["DICO"];


// Variables
			$batiments = $this->var["batiments"];			
			$niv_bat = $this->var["niv_bat"];			
			$maps = $this->var["carte"];			
			$coord_joueur = $this->var["coord_joueur"];

			$ressources_joueur = $this->var["ressources_joueur"];

			$amelio_bat = $this->var["amelio_bat"];
			$bonus_bat = $this->var["bonus_bat"];


			$infos_unites = $this->var["infos_unites"];

			$infosTeams = $this->var["infos_teams"];

			$available_units = $this->var["available_units"];

			$teams_dispo = $this->var["teams_dispo"];

			$temps_restant = $this->var["temps_restant"];


///////////////////////////////////////////////////////////////////////////////////

// MAP

// map
/*$ligne_map = array(
		1 => '<div class="colony ennemy" data-player="joueur1" data-team="Team1" data-type="Colony"></div>',
		"",
		"",
		'<div class="colony allied" data-player="joueur1" data-team="Team1" data-type="Colony"></div>',
		"",
		"",
		'<div class="colony owned" data-player="joueur1" data-team="Team1" data-type="Colony"></div>',
		"",
		"",
		'<div class="planet allied" data-player="joueur1" data-team="Team1" data-type="Planet"></div>',
		"",
		"",
		'<div class="planet owned" data-player="joueur1" data-team="Team1" data-type="Planet"></div>',
		"",
		'<div class="planet ennemy" data-player="joueur1" data-team="Team1" data-type="Planet"></div>',
	);

$maps = array();
for ($i=1; $i <= 15 ; $i++) { 
	$maps[$i] = $ligne_map;
}

*/



// Currents Attacks
$curAttaques = array(
		array(
			"evoPercent" => '17',
			"dataType" => 'data-type="def"',
			"infoGauche" => '<span class="minB attack">Enemy Attack</span> <span>Joueur 2</span>',
			"infoDroite" => '07min35s',
			),

		array(
			"evoPercent" => '25',
			"dataType" => 'data-type="wait"',
			"infoGauche" => '<span>Team 9</span> <span>(10-10)</span>',
			"infoDroite" => 'Waiting Orders',
			),

		array(
			"evoPercent" => '80',
			"dataType" => 'data-type="back"',
			"infoGauche" => '<span>Team 9</span> <span>(10-10)</span>',
			"infoDroite" => '07min35s',
			),

		array(
			"evoPercent" => '60',
			"dataType" => '',
			"infoGauche" => '<span>Team 9</span> <span>(10-10)</span>',
			"infoDroite" => '07min35s',
			),
	);







// INFOS TEAMS
/*$infosTeams = array(
	array(
			"unit1Qty" => '10 000',
			"unit2Qty" => '50 000',
			"unit3Qty" => '2 000',
			"teamX" => '12',
			"teamY" => '15',
			"teamProgress" => '<div class="progressBar" data="17" data-type="orders"><div class="text">Support</div></div>',
			"teamBack" => '<span class="min back">Back</span>',
		),

	array(
			"unit1Qty" => '10 000',
			"unit2Qty" => '50 000',
			"unit3Qty" => '2 000',
			"teamX" => '12',
			"teamY" => '15',
			"teamProgress" => '<div class="progressBar" data="17" data-type="back"><div class="progressType">Back</div><span class="progressTime">07min35s</span></div>',
			"teamBack" => '',
		),

	array(
			"unit1Qty" => '10 000',
			"unit2Qty" => '50 000',
			"unit3Qty" => '2 000',
			"teamX" => '12',
			"teamY" => '15',
			"teamProgress" => '<div class="progressBar" data="17"><div class="progressType">Attack</div><span class="progressTime">07min35s</span></div>',
			"teamBack" => '',
		),

	array(
			"unit1Qty" => '10 000',
			"unit2Qty" => '50 000',
			"unit3Qty" => '2 000',
			"teamX" => '12',
			"teamY" => '15',
			"teamProgress" => '<div class="progressBar" data="17"><div class="progressType">Support</div><span class="progressTime">07min35s</span></div>',
			"teamBack" => '',
		),

	array(
			"unit1Qty" => '10 000',
			"unit2Qty" => '50 000',
			"unit3Qty" => '2 000',
			"teamX" => '12',
			"teamY" => '15',
			"teamProgress" => '<div class="progressBar" data="17"><div class="progressType">Transport</div><span class="progressTime">07min35s</span></div>',
			"teamBack" => '',
		),

	array(
			"unit1Qty" => '<input class="input" type="text" name="nbFighters" value="">',
			"unit2Qty" => '<input class="input" type="text" name="nbBombers" value="">',
			"unit3Qty" => '<input class="input" type="text" name="nbCruisers" value="">',
			"teamX" => '12',
			"teamY" => '15',
			"teamProgress" => '<div class="progressBar" data="17" data-type="orders"><div class="text">Waiting Orders</div></div>',
			"teamBack" => '',
		),

	);



*/






// REPORTS

// Rapports d'attaques
$AttackReports = array(
		array(
			"victoire" => "win",
			"id" => "32",
			"heure" => "22h50",
			"ennemy" => "Joueur 2",
			"team" => "Team 1",
			"enn_x" => "15",
			"enn_y" => "12",
			),

		array(
			"victoire" => "loose",
			"id" => "31",
			"heure" => "22h50",
			"ennemy" => "Joueur 2",
			"team" => "Team 1",
			"enn_x" => "15",
			"enn_y" => "12",
			),

		array(
			"victoire" => "win",
			"id" => "30",
			"heure" => "22h50",
			"ennemy" => "Joueur 2",
			"team" => "Team 1",
			"enn_x" => "15",
			"enn_y" => "12",
			),

		array(
			"victoire" => "loose",
			"id" => "29",
			"heure" => "22h50",
			"ennemy" => "Joueur 2",
			"team" => "Team 1",
			"enn_x" => "15",
			"enn_y" => "12",
			),

		array(
			"victoire" => "win",
			"id" => "28",
			"heure" => "22h50",
			"ennemy" => "Joueur 2",
			"team" => "Team 1",
			"enn_x" => "15",
			"enn_y" => "12",
			),


	);


// Rapport de defenses
$DefensesReports = array(
		array(
			"victoire" => "win",
			"id" => "32",
			"heure" => "22h50",
			"ennemy" => "Joueur 2",
			"team" => "Team 1",
			"enn_x" => "15",
			"enn_y" => "12",
			),

		array(
			"victoire" => "loose",
			"id" => "31",
			"heure" => "22h50",
			"ennemy" => "Joueur 2",
			"team" => "Team 1",
			"enn_x" => "15",
			"enn_y" => "12",
			),

		array(
			"victoire" => "win",
			"id" => "30",
			"heure" => "22h50",
			"ennemy" => "Joueur 2",
			"team" => "Team 1",
			"enn_x" => "15",
			"enn_y" => "12",
			),

		array(
			"victoire" => "loose",
			"id" => "29",
			"heure" => "22h50",
			"ennemy" => "Joueur 2",
			"team" => "Team 1",
			"enn_x" => "15",
			"enn_y" => "12",
			),

		array(
			"victoire" => "win",
			"id" => "28",
			"heure" => "22h50",
			"ennemy" => "Joueur 2",
			"team" => "Team 1",
			"enn_x" => "15",
			"enn_y" => "12",
			),


	);








// ALLIANCES

// Messages
$messagesAll = array(
		array(
			"heure" => "12:50",
			"joueur" => "Joueur 1",
			"team" => "Team 1",
			"message" => "qdfkjmdfk mkfjq mskdfj qmskdfj mqlkjdf qmskdfj qmlksdjf qmlksdjf mqkdfj qmlskdfjqmlkdjf mqlkdjf qmldjfqmlkdjfmqlkdjf mqlksfj mqlkfdj mqlksdfj qmklfdj qmkdfj",
			),
		array(
			"heure" => "12:50",
			"joueur" => "Joueur 1",
			"team" => "Team 1",
			"message" => "qdfkjmdfk mkfjq mskdfj qmskdfj mqlkjdf qmskdfj qmlksdjf qmlksdjf mqkdfj qmlskdfjqmlkdjf mqlkdjf qmldjfqmlkdjfmqlkdjf mqlksfj mqlkfdj mqlksdfj qmklfdj qmkdfj",
			),
		array(
			"heure" => "12:50",
			"joueur" => "Joueur 1",
			"team" => "Team 1",
			"message" => "qdfkjmdfk mkfjq mskdfj qmskdfj mqlkjdf qmskdfj qmlksdjf qmlksdjf mqkdfj qmlskdfjqmlkdjf mqlkdjf qmldjfqmlkdjfmqlkdjf mqlksfj mqlkfdj mqlksdfj qmklfdj qmkdfj",
			),
		array(
			"heure" => "12:50",
			"joueur" => "Joueur 1",
			"team" => "Team 1",
			"message" => "qdfkjmdfk mkfjq mskdfj qmskdfj mqlkjdf qmskdfj qmlksdjf qmlksdjf mqkdfj qmlskdfjqmlkdjf mqlkdjf qmldjfqmlkdjfmqlkdjf mqlksfj mqlkfdj mqlksdfj qmklfdj qmkdfj",
			),
		array(
			"heure" => "12:50",
			"joueur" => "Joueur 1",
			"team" => "Team 1",
			"message" => "qdfkjmdfk mkfjq mskdfj qmskdfj mqlkjdf qmskdfj qmlksdjf qmlksdjf mqkdfj qmlskdfjqmlkdjf mqlkdjf qmldjfqmlkdjfmqlkdjf mqlksfj mqlkfdj mqlksdfj qmklfdj qmkdfj",
			),
	);

// Partie
$joueurs = array(
		array(
			"nom" => "joueur 1",
			"equipe" => "Team 1",
			"x" => "10",
			"y" => "12",
			"colonies" => "15",

			),

		array(
			"nom" => "joueur 2",
			"equipe" => "Team 1",
			"x" => "10",
			"y" => "12",
			"colonies" => "15",

			),

		array(
			"nom" => "joueur 3",
			"equipe" => "Team 1",
			"x" => "10",
			"y" => "12",
			"colonies" => "15",

			),

		array(
			"nom" => "joueur 4",
			"equipe" => "Team 1",
			"x" => "10",
			"y" => "12",
			"colonies" => "15",

			),

		array(
			"nom" => "joueur 5",
			"equipe" => "Team 1",
			"x" => "10",
			"y" => "12",
			"colonies" => "15",

			),

	);

// Alliance Reports
$AllianceReports = array(
		array(
			"victoire" => "win",
			"id" => "32",
			"heure" => "22h50",
			"attaquant" => "Joueur 1",
			"att_x" => "10",
			"att_y" => "12",
			"defenseur" => "Joueur 2",
			"team" => "Team 2",
			"def_x" => "12",
			"def_y" => "12",
			),

		array(
			"victoire" => "loose",
			"id" => "31",
			"heure" => "22h50",
			"attaquant" => "Joueur 1",
			"att_x" => "10",
			"att_y" => "12",
			"defenseur" => "Joueur 3",
			"team" => "Team 2",
			"def_x" => "15",
			"def_y" => "12",
			),

		array(
			"victoire" => "win",
			"id" => "30",
			"heure" => "22h50",
			"attaquant" => "Joueur 1",
			"att_x" => "10",
			"att_y" => "12",
			"defenseur" => "Joueur 2",
			"team" => "Team 2",
			"def_x" => "12",
			"def_y" => "12",
			),

		array(
			"victoire" => "loose",
			"id" => "29",
			"heure" => "22h50",
			"attaquant" => "Joueur 2",
			"att_x" => "10",
			"att_y" => "12",
			"defenseur" => "Joueur 1",
			"team" => "Team 2",
			"def_x" => "12",
			"def_y" => "12",
			),

	);

















// BATIMENTS
/*$batiments = array(
	// QG
		array(
			"type" => "QG",
			"icon" => "qg",
			"title" => $dico["qg"],
			"description" => "Votre Quartier Général est le coeur de toute la planète. Cette structure est à l'origine de la création de tous les autres bâtiments. Plus son niveau augmentera plus vous aurez accès à des batiments sofistiqués.",
			"niveau" => "8",
			"actions" => array(
							"colonies" => array(
								"icon" => "colon",
								"data" => "Colon",
								"type" => $dico["colonies"]
								),
							"inProgress" => array(
								"icon" => "update",
								"data" => "Progress",
								"type" => $dico["in_progress"]
								),
							"upgradeBuilding" => array(
								"icon" => "upgrade",
								"data" => "UpgradeQG",
								"type" => $dico["upgrade_building"]
								),
						),
			
			),

	// SPACEPORT
		array(
			"type" => "SP",
			"icon" => "units",
			"title" => $dico["spaceport"],
			"description" => "L'aviation et l'espace ont un rôle primordial dans la gestion des batailles. Différents Vaisseaux comme le chasseur, le bombardier, ou encore le croiseur vous aideront dans votre quête.",
			"niveau" => "8",
			"actions" => array(
							"unit1" => array(
								"icon" => "unit1",
								"data" => "Fighter",
								"type" => $dico["create_fighters"]
								),
							"unit2" => array(
								"icon" => "unit2",
								"data" => "Bomber",
								"type" => $dico["create_bombers"]
								),
							"unit3" => array(
								"icon" => "unit3",
								"data" => "Cruiser",
								"type" => $dico["create_cruisers"]
								),
							"upgradeBuilding" => array(
								"icon" => "upgrade",
								"data" => "UpgradeSP",
								"type" => $dico["upgrade_building"]
								),
						),
			
			),

	// RESOURCES
		array(
			"type" => "Res",
			"icon" => "resources",
			"title" => $dico["resources"],
			"description" => "Comme dans tout grand empire, vous aurez besoin de collecter des ressources présentes sur votre planète pour vous développer. Celles-ci vous permettront de rechercher de nouvelles technlogies ou de contruire des batiments ou des unités. ",
			"niveau" => "8",
			"actions" => array(
							"ore" => array(
								"icon" => "ore",
								"data" => "Ore",
								"type" => $dico["ore"]
								),
							"organic" => array(
								"icon" => "organic",
								"data" => "Organic",
								"type" => $dico["organic"]
								),
							"energy" => array(
								"icon" => "energy",
								"data" => "Energy",
								"type" => $dico["energy"]
								),
							"upgradeBuilding" => array(
								"icon" => "upgrade",
								"data" => "UpgradeRes",
								"type" => $dico["upgrade_building"]
								),
						),
			
			),

	// WAREHOUSE
		array(
			"type" => "WH",
			"icon" => "warehouse",
			"title" => $dico["warehouse"],
			"description" => "Le stockage des ressources reste primordial pour le développement constant de votre Empire. Agrandir vos entrepôts permet ainsi de stocker plus de ressources, en bâtissant de vastes réservoirs sur, et au dessous de la surface.",
			"niveau" => "8",
			"actions" => array(
							"upgradeBuilding" => array(
								"icon" => "upgrade",
								"data" => "UpgradeWH",
								"type" => $dico["upgrade_building"]
								),
						),
			
			),

	);
*/


$i = 0;
$batimentsHTML = "";
foreach ($batiments as $bat) {
$i++;
	if(is_file(TEMPLATES."HTML/batiments/{$bat['type']}.html")){
		// ACTIONS
			$montemplate->setFile($bat['type'],TEMPLATES."HTML/batiments/{$bat['type']}.html");

			if(is_file(TEMPLATES."Prepare".DS."game".DS."temp.".$bat['type'].".php")) {
				include(TEMPLATES."Prepare".DS."game".DS."temp.".$bat['type'].".php");
			}

			$actions = $montemplate->finish($montemplate->parse('OUT', $bat['type']));





	
	// BATIMENTS
			$montemplate->setFile('batiments'.$i,TEMPLATES.'HTML/batiments/batiments.html');

		// TRAD 
			$montemplate->setVar('TITLE_BAT', $bat["title"]);
			
			$montemplate->setVar('BAT_DESCRIPTION', $bat["description"]);


		// AUTRES 
			$montemplate->setVar('ONGLET_BAT', $bat["type"]);
			$montemplate->setVar('BAT_NIV', $bat["niveau"]);
			$montemplate->setVar('BAT_ICON', $bat["icon"]);



		// BLOCK
			// actions
			$montemplate->setBlock('batiments'.$i, 'actions', 'bat_actions'.$i);

			foreach ($bat["actions"] as $action) {
					$montemplate->setVar('ICON_ACTION', $action["icon"]);
					$montemplate->setVar('DATA_ACTION', $action["data"]);
					$montemplate->setVar('TYPE_ACTION', $dico[$action["type"]]);
					
					$montemplate->parse('bat_actions'.$i, 'actions', true);
			}



		// ACTIONS
			$montemplate->setVar('ACTIONS', $actions);





			$batimentsHTML .= $montemplate->finish($montemplate->parse('OUT', 'batiments'.$i));


	}
}












// ONGLET PLANET
			$montemplate->setFile('planet',TEMPLATES.'HTML/game/ongletPlanet.html');

			// HTML des Batiments
			$montemplate->setVar('BATIMENTS', $batimentsHTML);

	// TRAD 
			$montemplate->setVar('TXT_QG', $dico["qg"]);
			$montemplate->setVar('TXT_SP', $dico["spaceport"]);
			$montemplate->setVar('TXT_RES', $dico["resources"]);
			$montemplate->setVar('TXT_WH', $dico["warehouse"]);
			$montemplate->setVar('TXT_RC', $dico["research_center"]);
			$montemplate->setVar('TXT_DC', $dico["defense_center"]);

			$montemplate->setVar('TXT_COORDS', $dico["coords"]);


	// AUTRES 
			$montemplate->setVar('QG', $niv_bat["QG"]);
			$montemplate->setVar('SP', $niv_bat["SP"]);
			$montemplate->setVar('RES', $niv_bat["Res"]);
			$montemplate->setVar('WH', $niv_bat["WH"]);
			$montemplate->setVar('RC', $niv_bat["RC"]);
			$montemplate->setVar('DC', $niv_bat["DC"]);

			$montemplate->setVar('COORDS', $coord_joueur["X"]." - ".$coord_joueur["Y"]);


	// IMG 
			$montemplate->setVar('IMG_PLANET', "../../images/planete_race1.png");
			$montemplate->setVar('IMG_PLANET_ALT', $dico["planet"]);







			$planet = $montemplate->finish($montemplate->parse('OUT', 'planet'));


// ONGLET MAP
			$montemplate->setFile('map',TEMPLATES.'HTML/game/ongletMap.html');


	// TRAD 
			$montemplate->setVar('TXT_PLAYER', $dico["player"]);
			$montemplate->setVar('TXT_TEAM', $dico["team"]);
			$montemplate->setVar('TXT_TYPE', $dico["type"]);
			$montemplate->setVar('TXT_UNITS', $dico["units"]);

			$montemplate->setVar('TXT_COORD', $dico["coords"]);

			$montemplate->setVar('TXT_ATT', $dico["attack"]);
			$montemplate->setVar('TXT_SUPPORT', $dico["support"]);
			$montemplate->setVar('TXT_TRANS', $dico["transport"]);

			$montemplate->setVar('TXT_UNIT1', $dico["fighters"]);
			$montemplate->setVar('TXT_UNIT2', $dico["bombers"]);
			$montemplate->setVar('TXT_UNIT3', $dico["cruisers"]);

			$montemplate->setVar('TXT_TIME', $dico["time"]);
			$montemplate->setVar('TXT_CAPACITY', $dico["capacity"]);

			$montemplate->setVar('TXT_LAUNCH', $dico["launch"]);

			$montemplate->setVar('TXT_CUR_ATT', $dico["current_attacks"]);

			$montemplate->setVar('TXT_AVAIL_UNITS', $dico["available_units"]);
			$montemplate->setVar('TXT_TEAMS', $dico["teams"]);
			$montemplate->setVar('TXT_ORDERS', $dico["orders"]);











	// AUTRES
			//MAP
			$map_entete = "";
			for ($i=0; $i <= 15; $i++) { 
				$nb = ($i==0) ? "" : $i;
				$map_entete .= "<div class=\"cellMap header\">$nb</div>";
			}
			$montemplate->setVar('MAP_ENTETE', $map_entete);



			$montemplate->setVar('UNIT1_DISPO', $available_units["units1"]);
			$montemplate->setVar('UNIT2_DISPO', $available_units["units2"]);
			$montemplate->setVar('UNIT3_DISPO', $available_units["units3"]);












	// INPUTS
			$montemplate->setVar('COORD_X', "");
			$montemplate->setVar('COORD_Y', "");




	// BLOCKS
			// carte
			$montemplate->setBlock('map', 'carte', 'maps');

			$i=0;
			foreach ($maps as $cell) {
				$i++;
					$montemplate->setVar('COLONNE', $i);
					for ($j=1; $j <= 15; $j++) { 
						$montemplate->setVar('INFO_'.$j, $cell[$j]);
					}


					$montemplate->parse('maps', 'carte', true);
					
			}

			


			// team
			$montemplate->setBlock('map', 'team', 'teams');
			$i=0;
			foreach ($teams_dispo as $team) {
				$selected = ($i==0) ? "selected" : "" ;
				$montemplate->setVar('SELECTED', $selected);
				$montemplate->setVar('TEAM_NB', $team);

				$montemplate->parse('teams', 'team', true);
				$i++;
			}
			/*for ($i=1; $i <= $niv_bat["SP"]; $i++) { 

					$selected = ($i==1) ? "selected" : "" ;
					$montemplate->setVar('SELECTED', $selected);

					$montemplate->setVar('TEAM_NB', $i);

					$montemplate->parse('teams', 'team', true);
			}*/




			
			// currentAttacks
			$montemplate->setBlock('map', 'currentAttacks', 'curAttaques');

			foreach ($curAttaques as $attaque) {
					$montemplate->setVar('CUR_ATT_EVO_PERCENT', $attaque["evoPercent"]);
					$montemplate->setVar('CUR_ATT_DATA_TYPE', $attaque["dataType"]);
					$montemplate->setVar('CUR_ATT_INFO_GAUCHE', $attaque["infoGauche"]);
					$montemplate->setVar('CUR_ATT_INFO_DROITE', $attaque["infoDroite"]);

				
				$montemplate->parse('curAttaques', 'currentAttacks', true);
					
			}

			

			// teamsVisuel
			$montemplate->setBlock('map', 'teamsVisuel', 'infosTeams');

			$i = 0;
			foreach ($infosTeams as $team) {
				$i++;
					$montemplate->setVar('TEAM_NB', $team['equipe']);
					$montemplate->setVar('TEAM_UNIT1', $dico["fighters"]);
					$montemplate->setVar('TEAM_UNIT2', $dico["bombers"]);
					$montemplate->setVar('TEAM_UNIT3', $dico["cruisers"]);

					$montemplate->setVar('TEAM_UNIT1_QTY', $team['unit1Qty']);
					$montemplate->setVar('TEAM_UNIT2_QTY', $team['unit2Qty']);
					$montemplate->setVar('TEAM_UNIT3_QTY', $team['unit3Qty']);
					$montemplate->setVar('TEAM_X', $team['teamX']);
					$montemplate->setVar('TEAM_Y', $team['teamY']);
					$montemplate->setVar('TEAM_PROGRESS', $team['teamProgress']);
					$montemplate->setVar('TEAM_BACK', $team['teamBack']);

				


				$montemplate->parse('infosTeams', 'teamsVisuel', true);
					
			}

			

			












			$map = $montemplate->finish($montemplate->parse('OUT', 'map'));


















// ONGLET REPORTS
			$montemplate->setFile('reports',TEMPLATES.'HTML/game/ongletReports.html');


	// TRAD
			$montemplate->setVar('TXT_RAPPORT_DE', $dico["rapport_de"]);
			$montemplate->setVar('TXT_UNITS', $dico["units"]);
			$montemplate->setVar('TXT_REST', $dico["remaining"]);

			$montemplate->setVar('TXT_UNIT1', $dico["fighters"]);
			$montemplate->setVar('TXT_UNIT2', $dico["bombers"]);
			$montemplate->setVar('TXT_UNIT3', $dico["cruisers"]);

			$montemplate->setVar('TXT_RESOURCES', $dico["resources"]);
			$montemplate->setVar('TXT_ORE', $dico["ore"]);
			$montemplate->setVar('TXT_ORGANIC', $dico["organic"]);
			$montemplate->setVar('TXT_ENERGY', $dico["energy"]);


			$montemplate->setVar('TXT_TIME', $dico["hour"]);
			$montemplate->setVar('TXT_ENNEMY', $dico["enemy"]);
			$montemplate->setVar('TXT_TEAM', $dico["team"]);


			$montemplate->setVar('TXT_ATT', $dico["attacks"]);
			$montemplate->setVar('TXT_DEF', $dico["defenses"]);



	// AUTRES
			$montemplate->setVar('REPORT_TIME', $AllianceReports[0]["heure"]);
			$montemplate->setVar('REPORT_ATT', $AllianceReports[0]["attaquant"]);
			$montemplate->setVar('REPORT_DEF', $AllianceReports[0]["defenseur"]);

			$montemplate->setVar('REPORT_ATT_UNIT1_DEB', "10 000");
			$montemplate->setVar('REPORT_ATT_UNIT1_RES', "10 000");
			$montemplate->setVar('REPORT_ATT_UNIT2_DEB', "10 000");
			$montemplate->setVar('REPORT_ATT_UNIT2_RES', "10 000");
			$montemplate->setVar('REPORT_ATT_UNIT3_DEB', "10 000");
			$montemplate->setVar('REPORT_ATT_UNIT3_RES', "10 000");

			$montemplate->setVar('REPORT_DEF_UNIT1_DEB', "10 000");
			$montemplate->setVar('REPORT_DEF_UNIT1_RES', "10 000");
			$montemplate->setVar('REPORT_DEF_UNIT2_DEB', "10 000");
			$montemplate->setVar('REPORT_DEF_UNIT2_RES', "10 000");
			$montemplate->setVar('REPORT_DEF_UNIT3_DEB', "10 000");
			$montemplate->setVar('REPORT_DEF_UNIT3_RES', "10 000");

			$montemplate->setVar('REPORT_ATT_RESULT', "LOOSER");
			$montemplate->setVar('REPORT_DEF_RESULT', "WINNER");

			$montemplate->setVar('REPORT_CLASS_ATT_RESULT', "loose");
			$montemplate->setVar('REPORT_CLASS_DEF_RESULT', "win");


			$montemplate->setVar('REPORT_ORE', "10 000");
			$montemplate->setVar('REPORT_ORGANIC', "10 000");
			$montemplate->setVar('REPORT_ENERGY', "10 000");




	// BLOCKS
			// attackReports
			$montemplate->setBlock('reports', 'attackReports', 'AttackReports');

			$i=0;
			foreach ($AttackReports as $report) {
				if($i==0) { $report["victoire"] .= " selected"; }

					$montemplate->setVar('ATT_REP_VICTORY', $report["victoire"]);
					$montemplate->setVar('ATT_REP_ID', $report["id"]);
					$montemplate->setVar('ATT_REP_TIME', $report["heure"]);
					$montemplate->setVar('ATT_REP_ENNEMY', $report["ennemy"]);
					$montemplate->setVar('ATT_REP_TEAM', $report["team"]);
					$montemplate->setVar('ATT_REP_X', $report["enn_x"]);
					$montemplate->setVar('ATT_REP_Y', $report["enn_y"]);
					
					$montemplate->parse('AttackReports', 'attackReports', true);
					$i++;
			}

			
			// defenseReports
			$montemplate->setBlock('reports', 'defenseReports', 'DefensesReports');

			foreach ($DefensesReports as $report) {
					$montemplate->setVar('DEF_REP_VICTORY', $report["victoire"]);
					$montemplate->setVar('DEF_REP_ID', $report["id"]);
					$montemplate->setVar('DEF_REP_TIME', $report["heure"]);
					$montemplate->setVar('DEF_REP_ENNEMY', $report["ennemy"]);
					$montemplate->setVar('DEF_REP_TEAM', $report["team"]);
					$montemplate->setVar('DEF_REP_X', $report["enn_x"]);
					$montemplate->setVar('DEF_REP_Y', $report["enn_y"]);
					
					$montemplate->parse('DefensesReports', 'defenseReports', true);
					$i++;
			}

			

			$reports = $montemplate->finish($montemplate->parse('OUT', 'reports'));
















// ONGLET ALLIANCE
			$montemplate->setFile('alliance',TEMPLATES.'HTML/game/ongletAlliance.html');

		// TRAD
			$montemplate->setVar('ALL_MESS_TH_HEURE', $dico["hour"]);
			$montemplate->setVar('ALL_MESS_TH_JOUEUR', $dico["player"]);
			$montemplate->setVar('ALL_MESS_TH_MESSAGE', $dico["message"]);

			$montemplate->setVar('TXT_NAME', $dico["name"]);
			$montemplate->setVar('TXT_NB_PLAYERS', $dico["nb_players"]);
			$montemplate->setVar('TXT_END', $dico["end"]);

			$montemplate->setVar('TXT_PLAYERS', $dico["players"]);
			$montemplate->setVar('TXT_PLAYER', $dico["player"]);
			$montemplate->setVar('TXT_TEAM', $dico["team"]);

			$montemplate->setVar('TXT_ATT_REPORTS', $dico["att_reports"]);
			$montemplate->setVar('TXT_ALLI_PLAYER', $dico["ally_player"]);
			$montemplate->setVar('TXT_ENMY_PLAYER', $dico["enemy_player"]);

			$montemplate->setVar('TXT_RAPPORT_DE', $dico["rapport_de"]);
			$montemplate->setVar('TXT_UNITS', $dico["units"]);
			$montemplate->setVar('TXT_REST', $dico["remaining"]);

			$montemplate->setVar('TXT_UNIT1', $dico["fighters"]);
			$montemplate->setVar('TXT_UNIT2', $dico["bombers"]);
			$montemplate->setVar('TXT_UNIT3', $dico["cruisers"]);

			$montemplate->setVar('TXT_RESOURCES', $dico["resources"]);
			$montemplate->setVar('TXT_ORE', $dico["ore"]);
			$montemplate->setVar('TXT_ORGANIC', $dico["organic"]);
			$montemplate->setVar('TXT_ENERGY', $dico["energy"]);


			$montemplate->setVar('TXT_GAME_INFO', $dico["game_info"]);
			$montemplate->setVar('TXT_ALLI_REP', $dico["alliance_reports"]);

			$montemplate->setVar('TXT_SEND', $dico["send"]);



		// AUTRES
			$montemplate->setVar('GAME_NAME', "Nom de la Partie");
			$montemplate->setVar('GAME_NB_PLAYERS', "16");
			$montemplate->setVar('GAME_END', "Time Lapse");


			$montemplate->setVar('REPORT_TIME', $AllianceReports[0]["heure"]);
			$montemplate->setVar('REPORT_ATT', $AllianceReports[0]["attaquant"]);
			$montemplate->setVar('REPORT_DEF', $AllianceReports[0]["defenseur"]);

			$montemplate->setVar('REPORT_ATT_UNIT1_DEB', "10 000");
			$montemplate->setVar('REPORT_ATT_UNIT1_RES', "10 000");
			$montemplate->setVar('REPORT_ATT_UNIT2_DEB', "10 000");
			$montemplate->setVar('REPORT_ATT_UNIT2_RES', "10 000");
			$montemplate->setVar('REPORT_ATT_UNIT3_DEB', "10 000");
			$montemplate->setVar('REPORT_ATT_UNIT3_RES', "10 000");

			$montemplate->setVar('REPORT_DEF_UNIT1_DEB', "10 000");
			$montemplate->setVar('REPORT_DEF_UNIT1_RES', "10 000");
			$montemplate->setVar('REPORT_DEF_UNIT2_DEB', "10 000");
			$montemplate->setVar('REPORT_DEF_UNIT2_RES', "10 000");
			$montemplate->setVar('REPORT_DEF_UNIT3_DEB', "10 000");
			$montemplate->setVar('REPORT_DEF_UNIT3_RES', "10 000");

			$montemplate->setVar('REPORT_ATT_RESULT', "LOOSER");
			$montemplate->setVar('REPORT_DEF_RESULT', "WINNER");

			$montemplate->setVar('REPORT_CLASS_ATT_RESULT', "loose");
			$montemplate->setVar('REPORT_CLASS_DEF_RESULT', "win");


			$montemplate->setVar('REPORT_ORE', "10 000");
			$montemplate->setVar('REPORT_ORGANIC', "10 000");
			$montemplate->setVar('REPORT_ENERGY', "10 000");



		// BLOCK
			// allianceMessages
			$montemplate->setBlock('alliance', 'allianceMessages', 'messagesAll');

			foreach ($messagesAll as $message) {
					$montemplate->setVar('ALL_MESS_HEURE', $message["heure"]);
					$montemplate->setVar('ALL_MESS_JOUEUR', $message["joueur"]);
					$montemplate->setVar('ALL_MESS_TEAM', $message["team"]);
					$montemplate->setVar('ALL_MESS_MESSAGE', $message["message"]);

					$montemplate->parse('messagesAll', 'allianceMessages', true);
			}

			
			// joueurGame
			$montemplate->setBlock('alliance', 'joueurGame', 'joueurs');

			foreach ($joueurs as $joueur) {
					$montemplate->setVar('PLAYER_NAME', $joueur["nom"]);
					$montemplate->setVar('PLAYER_TEAM', $joueur["equipe"]);
					$montemplate->setVar('PLAYER_X', $joueur["x"]);
					$montemplate->setVar('PLAYER_Y', $joueur["y"]);
					$montemplate->setVar('PLAYER_COLONIES', $joueur["colonies"]);

					$montemplate->parse('joueurs', 'joueurGame', true);
			}

			
			// allianceReports
			$montemplate->setBlock('alliance', 'allianceReports', 'AllianceReports');

			$i=0;
			foreach ($AllianceReports as $report) {
				if($i==0) { $report["victoire"] .= " selected"; }

					$montemplate->setVar('ALL_REP_VICTORY', $report["victoire"]);
					$montemplate->setVar('ALL_REP_ID', $report["id"]);
					$montemplate->setVar('ALL_REP_HOUR', $report["heure"]);
					$montemplate->setVar('ALL_REP_ATT', $report["attaquant"]);
					$montemplate->setVar('ALL_REP_ATT_X', $report["att_x"]);
					$montemplate->setVar('ALL_REP_ATT_Y', $report["att_y"]);
					$montemplate->setVar('ALL_REP_DEF', $report["defenseur"]);
					$montemplate->setVar('ALL_REP_TEAM', $report["team"]);
					$montemplate->setVar('ALL_REP_DEF_X', $report["def_x"]);
					$montemplate->setVar('ALL_REP_DEF_Y', $report["def_y"]);

					$montemplate->parse('AllianceReports', 'allianceReports', true);
					$i++;
			}

			



			$alliance = $montemplate->finish($montemplate->parse('OUT', 'alliance'));















// Page Générale GAME
			$montemplate->setFile($type,TEMPLATES.'HTML/contenu/game.html');

// LINK
			$montemplate->setVar('LINK_GAME', URL_GAME);






// TRAD
			$montemplate->setVar('TXT_QUIT_GAME', $dico["quitGame"]);

			$montemplate->setVar('TXT_ORE', $dico["ore"]);
			$montemplate->setVar('TXT_ORGANIC', $dico["organic"]);
			$montemplate->setVar('TXT_ENERGY', $dico["energy"]);

			$montemplate->setVar('TXT_TIME_LEFT', $dico["time_left"]);

			$montemplate->setVar('TXT_PLANET', $dico["planet"]);
			$montemplate->setVar('TXT_MAP', $dico["map"]);
			$montemplate->setVar('TXT_REPORTS', $dico["reports"]);

			$montemplate->setVar('TXT_TEAM', $dico["team"]);
			$montemplate->setVar('TXT_COORDS',$dico["coords"]);
			$montemplate->setVar('TXT_INFOS_PLAYER', $dico["player_info"]);

			$montemplate->setVar('TXT_UNIT1', $dico["fighters"]);
			$montemplate->setVar('TXT_UNIT2', $dico["bombers"]);
			$montemplate->setVar('TXT_UNIT3', $dico["cruisers"]);

			$montemplate->setVar('TXT_QG', $dico["qg"]);
			$montemplate->setVar('TXT_SP', $dico["spaceport"]);
			$montemplate->setVar('TXT_RES', $dico["resources"]);
			$montemplate->setVar('TXT_RS', $dico["research_center"]);
			$montemplate->setVar('TXT_DC', $dico["defense_center"]);
			$montemplate->setVar('TXT_WH', $dico["warehouse"]);

















// AUTRES
			$montemplate->setVar('STOCK_ORE', $ressources_joueur["ore"]["qte"]);
			$montemplate->setVar('MAX_ORE', $ressources_joueur["ore"]["max"]);
			$montemplate->setVar('STOCK_ORGANIC', $ressources_joueur["organic"]["qte"]);
			$montemplate->setVar('MAX_ORGANIC', $ressources_joueur["organic"]["max"]);
			$montemplate->setVar('STOCK_ENERY', $ressources_joueur["energy"]["qte"]);
			$montemplate->setVar('MAX_ENERY', $ressources_joueur["energy"]["max"]);

			$montemplate->setVar('TIME_LEFT', $temps_restant);


			$montemplate->setVar('TEAM', $_SESSION["joueur"]["jou_team"]);
			$montemplate->setVar('COORDS', $coord_joueur["X"]." - ".$coord_joueur["Y"]);

			$montemplate->setVar('UNIT1', $infos_unites["fighter"]["STOCK"]);
			$montemplate->setVar('UNIT2', $infos_unites["bomber"]["STOCK"]);
			$montemplate->setVar('UNIT3', $infos_unites["cruiser"]["STOCK"]);

			$montemplate->setVar('QG', $niv_bat["QG"]);
			$montemplate->setVar('SP', $niv_bat["SP"]);
			$montemplate->setVar('RES', $niv_bat["Res"]);
			$montemplate->setVar('RS', $niv_bat["RC"]);
			$montemplate->setVar('DC', $niv_bat["DC"]);
			$montemplate->setVar('WH', $niv_bat["WH"]);
















// ONGLETS
			$montemplate->setVar('ONGLET_PLANET', $planet);
			$montemplate->setVar('ONGLET_MAP', $map);
			$montemplate->setVar('ONGLET_REPORTS', $reports);
			$montemplate->setVar('ONGLET_ALLIANCE', $alliance);







			
?>