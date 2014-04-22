<?php

// nouvel objet partie
$game = new Game();

$date_actu = time();

// MISE A JOUR DES INFORMATIONS DE LA PAGE
if(isset($_POST["action"]) && $_POST["action"] == "maj") {
	$data["recharge"] = false;
	$data["fin"] = false;




	// Temps de la partie restant
	$sql = "SELECT par_H_debut, par_type_end, par_wait FROM parties 
			WHERE par_id = ? 
			AND par_H_debut IS NOT NULL";

	    $bind = "i";
	  	$arr = array($_SESSION["partie"]["id"]);
					  
	  	$bdd->prepare($sql,$bind);
	  	$result14 = $bdd->execute($arr);


	  	

	// Fin de partie
	if(is_null($result14[0]["par_wait"])) {
		$_SESSION["partie"]["is_finish"] = true;
		$data["fin"] = true;
		$data["url"] = URL_FIN;

		
	} 

if($data["fin"] !== true) {


	$temps_restant = Calculs::convert_time( (strtotime($result14[0]["par_H_debut"]) + 6000) - (time()) );



	// TRADUCTIONS NECESSAIRES
		$sql = "SELECT dic_designation,dic_traduction FROM `dictionnaire`
			    INNER JOIN `langues` ON (lan_id = dic_langues_id)
			    WHERE dic_designation 
			    IN (
			    	'qg', 'spaceport', 'resources', 'research_center', 'defense_center', 'warehouse', 
			    	'ore', 'organic', 'energy',
			    	'fighters', 'bombers', 'cruisers', 'waiting', 'in_progress', 
			    	'team' , 'waiting_orders' , 'attack' , 'back' , 'support' , 'transport',
			    	'planet' , 'colony'
			    )
			    AND `lan_designation` = ? ";

		    $bind = "s";
		    $arr = array($_SESSION["lang"]);
						  
		  	$bdd->prepare($sql,$bind);
		  	$result0 = $bdd->execute($arr);


	$req4_DICO = array();
	foreach ($result0 as $dico) {
	  $req4_DICO[$dico["dic_designation"]] = $dico["dic_traduction"];
	}

	$trad_bat = array("QG"=>$req4_DICO["qg"],"SP"=>$req4_DICO["spaceport"],"Res"=>$req4_DICO["resources"],"RC"=>$req4_DICO["research_center"],"DC"=>$req4_DICO["defense_center"],"WH"=>$req4_DICO["warehouse"]);
	$trad_act = array("ore"=>$req4_DICO["ore"],"organic"=>$req4_DICO["organic"],"energy"=>$req4_DICO["energy"]);



	// RESSOURCES
		$sql = "SELECT res_quantite, res_derniere_maj, res_niveau, tyr_productionH, tyr_max_niv1 FROM ressources
				INNER JOIN types_ressources ON (tyr_id = res_types_ressources_id)
				WHERE res_joueurs_id = ? ";



		    $bind = "i";
		  	$arr = array($_SESSION["joueur"]["jou_id"]);
						  
		  	$bdd->prepare($sql,$bind);
		  	$result1 = $bdd->execute($arr);



		$sql = "SELECT bat_niveau FROM batiments
				WHERE bat_joueurs_id = ? 
				AND bat_type_batiments_id = 6 ";



		    $bind = "i";
		  	$arr = array($_SESSION["joueur"]["jou_id"]);
						  
		  	$bdd->prepare($sql,$bind);
		  	$result2 = $bdd->execute($arr);



		// CALCULS POUR METTRE A JOUR LES RESSOURCES
		$max_ore = Calculs::max_ressources($result2[0]["bat_niveau"],$result1[0]["tyr_max_niv1"]);
		$max_organic = Calculs::max_ressources($result2[0]["bat_niveau"],$result1[1]["tyr_max_niv1"]);
		$max_energy = Calculs::max_ressources($result2[0]["bat_niveau"],$result1[2]["tyr_max_niv1"]);

		$ore = $result1[0]["res_quantite"];
		$organic = $result1[1]["res_quantite"];
		$energy = $result1[2]["res_quantite"];

		$max_ore = ($ore>=$max_ore)? $ore:$max_ore ;
		$max_organic = ($organic>=$max_organic)? $organic:$max_organic ;
		$max_energy = ($energy>=$max_energy)? $ore:$max_energy ;

		$ore_temps_ecoule = $date_actu - strtotime($result1[0]["res_derniere_maj"]);
		$org_temps_ecoule = $date_actu - strtotime($result1[1]["res_derniere_maj"]);
		$ene_temps_ecoule = $date_actu - strtotime($result1[2]["res_derniere_maj"]);


		$ore_augmentation_par_sec = intval(Calculs::gain_ressources($result1[0]["res_niveau"],$result1[0]["tyr_productionH"])/60);
		$org_augmentation_par_sec = intval(Calculs::gain_ressources($result1[1]["res_niveau"],$result1[1]["tyr_productionH"])/60);
		$ene_augmentation_par_sec = intval(Calculs::gain_ressources($result1[2]["res_niveau"],$result1[2]["tyr_productionH"])/60);


		$ore += $ore_temps_ecoule*$ore_augmentation_par_sec;
		$organic += $org_temps_ecoule*$org_augmentation_par_sec;
		$energy += $ene_temps_ecoule*$ene_augmentation_par_sec;


		$ore = ($ore<=$max_ore) ? $ore : $max_ore;
		$organic = ($organic<=$max_organic) ? $organic : $max_organic;
		$energy = ($energy<=$max_energy) ? $energy : $max_energy;

		$ressources = array(
									"ore"=> $ore,
									"organic"=> $organic,
									"energy"=> $energy
				);


		// MISE A JOUR DES RESSOURCES DANS LA TABLE
		$sql = "UPDATE ressources SET res_quantite = ? 
				WHERE res_joueurs_id = ? 
				AND res_types_ressources_id = ? ";



		    $bind = "iii";
	   	  	$bdd->prepare($sql,$bind);

	   	  	$i=0;
	   	  	foreach ($ressources as $res) {
	   	  		$i++;
			  	$arr = array($res, $_SESSION["joueur"]["jou_id"], $i);
			  	$result3 = $bdd->execute($arr);
	   	  	}


	// BATIMENTS
		$sql = "SELECT bat_id, tyb_type, tyb_temps_necessaire, bat_niveau, bat_amelio_debut_TS FROM batiments
				INNER JOIN type_batiments ON (tyb_id = bat_type_batiments_id)
				WHERE bat_joueurs_id = ? 
				AND bat_amelio_debut_TS IS NOT NULL ";



		    $bind = "i";
		  	$arr = array($_SESSION["joueur"]["jou_id"]);
						  
		  	$bdd->prepare($sql,$bind);
		  	$result4 = $bdd->execute($arr);

			$amelio_bat = array();
			$i = 0;
		  	foreach ($result4 as $bat) {
				  	$tps_nec = Calculs::cout_ressources($bat["bat_niveau"],$bat["tyb_temps_necessaire"]);
					$depart = strtotime($bat["bat_amelio_debut_TS"]);
					$arrive = $depart + $tps_nec;

					if($date_actu<$arrive) {
						$bat_tps_ecoule = $date_actu - $depart;
						$percent = $bat_tps_ecoule*100/$tps_nec;

						$bat_tps_restant = Calculs::convert_time($tps_nec - $bat_tps_ecoule);

						$amelio_bat[$i]["pourcent"] = $percent;
						$amelio_bat[$i]["temps"] = $bat_tps_restant;
						$amelio_bat[$i]["bat"] = $trad_bat[$bat["tyb_type"]]." Lvl ".($bat["bat_niveau"]+1);
						$i++;

					} else {
						$sql = "UPDATE batiments SET bat_niveau = ? , bat_amelio_debut_TS = NULL
								WHERE bat_id = ? ";

						    $bind = "ii";
						  	$arr = array(($bat["bat_niveau"]+1),$bat["bat_id"]);
										  
						  	$bdd->prepare($sql,$bind);
						  	$result5 = $bdd->execute($arr);

						  	if($result5 == 1) {
						  		if($bat["tyb_type"] == "SP") {
									$sql = "SELECT car_pos_x, car_pos_y FROM carte 
											WHERE car_joueur_id = ? 
											AND car_parties_id = ? 
											AND car_type = 'base'";

									    $bind = "ii";
									  	$arr = array($_SESSION["joueur"]["jou_id"], $_SESSION["partie"]["id"]);
													  
									  	$bdd->prepare($sql,$bind);
									  	$result6 = $bdd->execute($arr);


									$sql = "INSERT INTO teams VALUES (NULL, ? , 0 , 0 , 0 , ? , ? , ? )";

									    $bind = "iiii";
									  	$arr = array($_SESSION["joueur"]["jou_id"], $result6[0]["car_pos_x"], $result6[0]["car_pos_y"], ($bat["bat_niveau"]+1));
													  
									  	$bdd->prepare($sql,$bind);
									  	$result7 = $bdd->execute($arr);
								}

						  		$data["recharge"] = true;
						  	}

					}
		  			
		  	}







		  	$amelio_act = array();
	// AMELIORATIONS RESSOURCES
		$sql = "SELECT res_id, tyr_type, tyr_tps_nec, res_niveau, res_amelio_debut_TS FROM ressources
				INNER JOIN types_ressources ON (tyr_id = res_types_ressources_id)
				WHERE res_joueurs_id = ? 
				AND res_amelio_debut_TS IS NOT NULL ";



		    $bind = "i";
		  	$arr = array($_SESSION["joueur"]["jou_id"]);
						  
		  	$bdd->prepare($sql,$bind);
		  	$result4 = $bdd->execute($arr);

			$amelio_res = array();
			$i = 0;
		  	foreach ($result4 as $res) {
				  	$tps_nec = Calculs::cout_ressources($res["res_niveau"],$res["tyr_tps_nec"]);
					$depart = strtotime($res["res_amelio_debut_TS"]);
					$arrive = $depart + $tps_nec;

					if($date_actu<$arrive) {
						$res_tps_ecoule = $date_actu - $depart;
						$percent = $res_tps_ecoule*100/$tps_nec;

						$res_tps_restant = Calculs::convert_time($tps_nec - $res_tps_ecoule);

						$amelio_res[$i]["pourcent"] = $percent;
						$amelio_res[$i]["temps"] = $res_tps_restant;
						$amelio_res[$i]["act"] = $trad_act[$res["tyr_type"]]." Lvl ".($res["res_niveau"]+1);
						$i++;

					} else {
						$sql = "UPDATE ressources SET res_niveau = ? , res_amelio_debut_TS = NULL
								WHERE res_id = ? ";

						    $bind = "ii";
						  	$arr = array(($res["res_niveau"]+1),$res["res_id"]);
										  
						  	$bdd->prepare($sql,$bind);
						  	$result5 = $bdd->execute($arr);

						  	if($result5 == 1) $data["recharge"] = true;

					}
		  			
		  	}
		  	$amelio_act = array_merge($amelio_act,$amelio_res);












	// MAJ UNITES
		$sql = "SELECT cru_id, cru_unites_id, cru_quantite, cru_deb_construct, cru_nec_time  FROM creations_unites
				WHERE cru_joueurs_id = ? 
				AND (cru_deb_construct IS NULL || cru_deb_construct != 0) ";



		    $bind = "i";
		  	$arr = array($_SESSION["joueur"]["jou_id"]);
						  
		  	$bdd->prepare($sql,$bind);
		  	$result6 = $bdd->execute($arr);


		  	$launch_new = true;
		foreach ($result6 as $liste) {
				if(!is_null($liste["cru_deb_construct"]) && $date_actu>(strtotime($liste["cru_deb_construct"])+$liste["cru_nec_time"]) ) {
						$sql = "UPDATE creations_unites SET cru_deb_construct = 0 
								WHERE cru_id = ? ";

						    $bind = "i";
						  	$arr = array($liste["cru_id"]);
										  
						  	$bdd->prepare($sql,$bind);
						  	$result7 = $bdd->execute($arr);

						  	
						$unit = "tou_units".$liste["cru_unites_id"];  	

						$sql = "SELECT $unit FROM total_units
								WHERE tou_joueurs_id = ? ";



						    $bind = "i";
						  	$arr = array($_SESSION["joueur"]["jou_id"]);
										  
						  	$bdd->prepare($sql,$bind);
						  	$result8 = $bdd->execute($arr);
						  	$tot_unit = $result8[0][$unit];

						$sql = "UPDATE total_units SET $unit = ? 
								WHERE tou_joueurs_id = ? ";

						    $bind = "ii";
						  	$arr = array($liste["cru_quantite"]+$tot_unit, $_SESSION["joueur"]["jou_id"]);
										  
						  	$bdd->prepare($sql,$bind);
						  	$result8bis = $bdd->execute($arr);

						  	

						  	$launch_new = true;

				}elseif(!is_null($liste["cru_deb_construct"])) {
					$launch_new = false;
				} else {
					if($launch_new){

						$sql = "UPDATE creations_unites SET cru_deb_construct = CURRENT_TIMESTAMP 
								WHERE cru_id = ? ";

						    $bind = "i";
						  	$arr = array($liste["cru_id"]);
										  
						  	$bdd->prepare($sql,$bind);
						  	$result9 = $bdd->execute($arr);
						  	
					}

					$launch_new = false;
				}
		}
			
		

// INFOS UNITES
		$sql = "SELECT tou_units1, tou_units2, tou_units3 FROM total_units
				WHERE tou_joueurs_id = ? ";



		    $bind = "i";
		  	$arr = array($_SESSION["joueur"]["jou_id"]);
						  
		  	$bdd->prepare($sql,$bind);
		  	$result10 = $bdd->execute($arr);

			$req3_TOTAL_UNITS = array(1=>$result10[0]['tou_units1'], $result10[0]['tou_units2'], $result10[0]['tou_units3'] );








// INFOS CONSTRUCT UNITS		
		$sql = "SELECT cru_id, cru_unites_id, cru_quantite, cru_deb_construct, cru_nec_time  FROM creations_unites
				WHERE cru_joueurs_id = ? 
				AND (cru_deb_construct IS NULL || cru_deb_construct != 0) ";



		    $bind = "i";
		  	$arr = array($_SESSION["joueur"]["jou_id"]);
						  
		  	$bdd->prepare($sql,$bind);
		  	$result6 = $bdd->execute($arr);
			$trad_units = array( 1=>"fighters", "bombers", "cruisers");

		$i = 0;	
		$req2_LIST_UNITS_CONSTRUCT = array();
		foreach ($result6 as $liste) {
				if(!is_null($liste["cru_deb_construct"]) ) {
					$fin = strtotime($liste["cru_deb_construct"])+$liste["cru_nec_time"];
					$req2_LIST_UNITS_CONSTRUCT[$i]["percent"] = ($date_actu - strtotime($liste["cru_deb_construct"]))*100/$liste["cru_nec_time"];
					$req2_LIST_UNITS_CONSTRUCT[$i]["etat"] = $req4_DICO["in_progress"];
					$req2_LIST_UNITS_CONSTRUCT[$i]["nbUnits"] = $liste["cru_quantite"]." ".$trad_units[$liste["cru_unites_id"]];
					$req2_LIST_UNITS_CONSTRUCT[$i]["timeLeft"] = Calculs::convert_time($fin - $date_actu);
				} else {
					$req2_LIST_UNITS_CONSTRUCT[$i]["percent"] = 0;
					$req2_LIST_UNITS_CONSTRUCT[$i]["etat"] = $req4_DICO["waiting"];
					$req2_LIST_UNITS_CONSTRUCT[$i]["nbUnits"] = $liste["cru_quantite"]." ".$trad_units[$liste["cru_unites_id"]];
					$req2_LIST_UNITS_CONSTRUCT[$i]["timeLeft"] = Calculs::convert_time($liste["cru_nec_time"]);



				}
				$i++;
		}










// INFOS TEAMS - ATTAQUES
		//carte
		$sql = "SELECT car_joueur_id, car_pos_x, car_pos_y, car_type FROM carte
				WHERE car_parties_id = ? ";

		    $bind = "i";
		  	$arr = array($_SESSION["partie"]["id"]);
						  
		  	$bdd->prepare($sql,$bind);
		  	$result7 = $bdd->execute($arr);






		//attaques en cours
		$sql = "SELECT deu_id, deu_deplacements_id, deu_def_x, deu_def_y, deu_deb_depl_ts, deu_duree, deu_charge_max, deu_etat, tea_id, tea_joueurs_id, tea_unit1, tea_unit2, tea_unit3, jou_team, bat_niveau FROM deplacements_unites
				INNER JOIN teams ON (tea_id = deu_teams_id)
				INNER JOIN joueurs ON (jou_id = tea_joueurs_id)
				INNER JOIN batiments ON (jou_id = bat_joueurs_id)
				WHERE deu_etat IN (0,2) 
				AND bat_type_batiments_id = 2
				AND deu_parties_id = ?";// 0: attaque en cours, 2: Attaque sur le retour, 1: Attaque finie

		    $bind = "i";
		  	$arr = array($_SESSION["partie"]["id"]);
						  
		  	$bdd->prepare($sql,$bind);
		  	$result8 = $bdd->execute($arr);

	foreach ($result8 as $deplacement) {
		$debut_depl = strtotime($deplacement["deu_deb_depl_ts"]);
		$fin_depl = $debut_depl+$deplacement["deu_duree"];

		if($date_actu > $fin_depl) {
			switch ($deplacement["deu_deplacements_id"]) {
				case '1': // Attaque

					if ($date_actu > $fin_depl+$deplacement["deu_duree"] && $deplacement["deu_etat"] == 2) { // L'attaque a fini son aller / retour


						//selection des coordonnes du joueur
						$sql = "SELECT car_pos_x, car_pos_y FROM carte
								WHERE car_type = 'base'
								AND car_joueur_id = ?
								AND car_parties_id = ? ";

						    $bind = "ii";
						  	$arr = array($deplacement["tea_joueurs_id"], $_SESSION["partie"]["id"]);
										  
						  	$bdd->prepare($sql,$bind);
						  	$result9 = $bdd->execute($arr);
						
						//Update teams pour la rendre de nouveau opérationnelle
						$sql = "UPDATE teams SET tea_pos_x = ? , tea_pos_y = ? 
								WHERE tea_id = ? ";

						    $bind = "iii";
						  	$arr = array($result9[0]["car_pos_x"], $result9[0]["car_pos_y"], $deplacement["tea_id"]);
										  
						  	$bdd->prepare($sql,$bind);
						  	$result10 = $bdd->execute($arr);

						//Update deplacements unites pour mettre à 1 l'etat
						$sql = "UPDATE deplacements_unites SET deu_etat = 1 
								WHERE deu_id = ? ";

						    $bind = "i";
						  	$arr = array($deplacement["deu_id"]);
										  
						  	$bdd->prepare($sql,$bind);
						  	$result11 = $bdd->execute($arr);


					} elseif($date_actu > $fin_depl && $deplacement["deu_etat"] == 0) { // L'attaque n'a pas fini son aller / retour -> deu_etat = 0






						// Selection des equipes ennemies sur la planete
						$sql = "SELECT tea_id, tea_unit1, tea_unit2, tea_unit3, jou_id FROM teams
								INNER JOIN joueurs ON (tea_joueurs_id = jou_id)
								WHERE jou_parties_id = ?
								AND jou_team != ? 
								AND tea_pos_x = ?
								AND tea_pos_y = ? ";

						    $bind = "iiii";
						  	$arr = array($_SESSION["partie"]["id"], $deplacement["jou_team"], $deplacement["deu_def_x"], $deplacement["deu_def_y"]);
										  
						  	$bdd->prepare($sql,$bind);
						  	$result12 = $bdd->execute($arr);


						  	$defense = array(
						  		"u1"=>array(),
						  		"u2"=>array(),
						  		"u3"=>array(),
						  		);
						  	$nb_unites = 0;
						  	$defense["u1"]["unite"] = 0 ;
							$defense["u2"]["unite"] = 0 ;
							$defense["u3"]["unite"] = 0 ;

						  	foreach ($result12 as $team_enn) {
						  		$defense["u1"]["unite"] += $team_enn["tea_unit1"];
						  		$defense["u2"]["unite"] += $team_enn["tea_unit2"];
						  		$defense["u3"]["unite"] += $team_enn["tea_unit3"];
						  		$nb_unites++;
						  	}


						  	
							// Regarde si la planete est conquise ou pas
								$sql = "SELECT car_joueur_id, car_type FROM carte
										WHERE car_parties_id = ?
										AND car_pos_x = ?
										AND car_pos_y = ? ";

								    $bind = "iii";
								  	$arr = array($_SESSION["partie"]["id"], $deplacement["deu_def_x"], $deplacement["deu_def_y"]);


											  
								  	$bdd->prepare($sql,$bind);
								  	$result13 = $bdd->execute($arr);
								  	
								  	


								  	


								// infos unites
								$sql = "SELECT uni_attaque, uni_defense, uni_life FROM unites";

								    $bdd->prepare($sql);
								  	$result14 = $bdd->execute();


								  	if(empty($result13)) { // Planete libre


								  		$defense["u1"]["unite"] = rand(0,pow(10,$deplacement["bat_niveau"]));
								  		$defense["u1"]["att"] = $result14[0]["uni_attaque"];
								  		$defense["u1"]["def"] = $result14[0]["uni_defense"];
								  		$defense["u1"]["life"] = $result14[0]["uni_life"];
								  		$defense["u2"]["unite"] = rand(0,pow(5,$deplacement["bat_niveau"]));
								  		$defense["u2"]["att"] = $result14[1]["uni_attaque"];
								  		$defense["u2"]["def"] = $result14[1]["uni_defense"];
								  		$defense["u2"]["life"] = $result14[1]["uni_life"];
								  		$defense["u3"]["unite"] = rand(0,pow(2,$deplacement["bat_niveau"]));
								  		$defense["u3"]["att"] = $result14[2]["uni_attaque"];
								  		$defense["u3"]["def"] = $result14[2]["uni_defense"];
								  		$defense["u3"]["life"] = $result14[2]["uni_life"];

									  		

									  	$conquete_allie = false;


								  	} else { // La planete n'est pas libre
								  	
										$sql = "SELECT bat_niveau FROM batiments
												WHERE bat_joueurs_id = ? 
												AND bat_type_batiments_id = 2 ";

										    $bind = "i";
										  	$arr = array($result13[0]["car_joueur_id"]);


													  
										  	$bdd->prepare($sql,$bind);
										  	$result15 = $bdd->execute($arr);


									// Regarde l'alliance du joueur pour verifier de ne pas attaquer un allié
										$sql = "SELECT jou_team FROM joueurs
												WHERE jou_id = ? ";

										    $bind = "i";
										  	$arr = array($result13[0]["car_joueur_id"]);

												  
										  	$bdd->prepare($sql,$bind);
										  	$result16 = $bdd->execute($arr);
										  	

										  	if($result16[0]["jou_team"] == $deplacement["jou_team"]) {
										  		$conquete_allie = true;
										  	} else {
										  		$conquete_allie = false;
										  	}
										  	
									  		$defense["u1"]["att"] = $result14[0]["uni_attaque"]*(1+(0.10*$result15[0]["bat_niveau"]));
									  		$defense["u1"]["def"] = $result14[0]["uni_defense"]*(1+(0.10*$result15[0]["bat_niveau"]));
									  		$defense["u1"]["life"] = $result14[0]["uni_life"]*(1+(0.10*$result15[0]["bat_niveau"]));

									  		$defense["u2"]["att"] = $result14[1]["uni_attaque"]*(1+(0.10*$result15[0]["bat_niveau"]));
									  		$defense["u2"]["def"] = $result14[1]["uni_defense"]*(1+(0.10*$result15[0]["bat_niveau"]));
									  		$defense["u2"]["life"] = $result14[1]["uni_life"]*(1+(0.10*$result15[0]["bat_niveau"]));

									  		$defense["u3"]["att"] = $result14[2]["uni_attaque"]*(1+(0.10*$result15[0]["bat_niveau"]));
									  		$defense["u3"]["def"] = $result14[2]["uni_defense"]*(1+(0.10*$result15[0]["bat_niveau"]));
									  		$defense["u3"]["life"] = $result14[2]["uni_life"]*(1+(0.10*$result15[0]["bat_niveau"]));


								  	}

								  	// Prepartion de l'attaque
							  		$attaque["u1"]["unite"] = $deplacement["tea_unit1"];
							  		$attaque["u1"]["att"] = $result14[0]["uni_attaque"]*(1+(0.10*$deplacement["bat_niveau"]));
							  		$attaque["u1"]["def"] = $result14[0]["uni_defense"]*(1+(0.10*$deplacement["bat_niveau"]));
							  		$attaque["u1"]["life"] = $result14[0]["uni_life"]*(1+(0.10*$deplacement["bat_niveau"]));

							  		$attaque["u2"]["unite"] = $deplacement["tea_unit2"];
							  		$attaque["u2"]["att"] = $result14[1]["uni_attaque"]*(1+(0.10*$deplacement["bat_niveau"]));
							  		$attaque["u2"]["def"] = $result14[1]["uni_defense"]*(1+(0.10*$deplacement["bat_niveau"]));
							  		$attaque["u2"]["life"] = $result14[1]["uni_life"]*(1+(0.10*$deplacement["bat_niveau"]));

							  		$attaque["u3"]["unite"] = $deplacement["tea_unit3"];
							  		$attaque["u3"]["att"] = $result14[2]["uni_attaque"]*(1+(0.10*$deplacement["bat_niveau"]));
							  		$attaque["u3"]["def"] = $result14[2]["uni_defense"]*(1+(0.10*$deplacement["bat_niveau"]));
							  		$attaque["u3"]["life"] = $result14[2]["uni_life"]*(1+(0.10*$deplacement["bat_niveau"]));



							  	if(!$conquete_allie) {
									$combat = Calculs::combat($attaque, $defense);
									if($combat["winner"] == "att") { // Le gagnant est l'attaquant

										if(!empty($result13) && $result13[0]["car_type"] == 'base') { // Planete mère d'un joueur possibilité de recupere des ressources en fonction de la capacité de charge des unites restantes.

											$sql = "SELECT uni_capacite_charge FROM unites";

											    $bdd->prepare($sql);
											  	$result17 = $bdd->execute();

									  		$chargemax = 0;
									  		for ($i=0; $i < count($result17); $i++) { 
									  			$chargemax += intval($combat["att"]["u".($i+1)]*$result17[$i]["uni_capacite_charge"]*(1+($deplacement["deu_charge_max"]/100)));
									  		}
											  		
											// Selection des ressources du perdant
											$sql = "SELECT res_id, res_types_ressources_id, res_quantite FROM ressources
													WHERE res_joueurs_id = ? ";

											    $bind = "i";
											  	$arr = array($result13[0]["car_joueur_id"]);
															  
											  	$bdd->prepare($sql,$bind);
											  	$result18 = $bdd->execute($arr);

											$charge_par_ressources = intval($chargemax/3);

											foreach ($result18 as $ressource) {
												$ressources_prises[$ressource["res_types_ressources_id"]] = ($charge_par_ressources<= $ressource["res_quantite"]) ? $charge_par_ressources : $ressource["res_quantite"];
												$ressources_restantes[$ressource["res_types_ressources_id"]] = $ressource["res_quantite"] - $ressources_prises[$ressource["res_types_ressources_id"]];
												//Enleve au joueur perdant
												$sql = "UPDATE ressources SET res_quantite = ? 
														WHERE res_id = ? ";

												    $bind = "ii";
												  	$arr = array($ressources_restantes[$ressource["res_types_ressources_id"]], $ressource["res_id"] );
																  
												  	$bdd->prepare($sql,$bind);
												  	$result19 = $bdd->execute($arr);

												//Ajoute au joueur gagnant
												$sql = "SELECT res_id, res_quantite FROM ressources
														WHERE res_joueurs_id = ? 
														AND res_types_ressources_id = ? ";

												    $bind = "ii";
												  	$arr = array($deplacement["tea_joueurs_id"], $ressource["res_types_ressources_id"]);
																	  
												  	$bdd->prepare($sql,$bind);
												  	$result20 = $bdd->execute($arr);


												$nouvelles_ressources = $result20[0]["res_quantite"] + $ressources_prises[$ressource["res_types_ressources_id"]];
												


												$sql = "UPDATE ressources SET res_quantite = ? 
														WHERE res_id = ? ";

												    $bind = "ii";
												  	$arr = array($nouvelles_ressources, $result20[0]["res_id"] );
																  
												  	$bdd->prepare($sql,$bind);
												  	$result21 = $bdd->execute($arr);

											}





										} elseif(!empty($result13) && $result13[0]["car_type"] == 'conquete') { // Planete conquise à un autre joueur
											// Modification dans carte de la nouvelle colonie
											$sql = "UPDATE carte SET car_joueur_id = ? 
													WHERE car_parties_id = ? 
													AND car_pos_x = ? 
													AND car_pos_y = ? ";

											    $bind = "iiii";
											  	$arr = array($deplacement["tea_joueurs_id"], $_SESSION["partie"]["id"], $deplacement["deu_def_x"], $deplacement["deu_def_y"]);
															  
											  	$bdd->prepare($sql,$bind);
											  	$result22 = $bdd->execute($arr);


										} else { // Planete nouvellement conquise
											// Insertion dans carte de la nouvelle colonie
											$sql = "INSERT INTO carte VALUES (NULL, ? , ? , ? , ? , 'conquete' )";

											    $bind = "iiii";
											  	$arr = array($deplacement["tea_joueurs_id"], $_SESSION["partie"]["id"], $deplacement["deu_def_x"], $deplacement["deu_def_y"]);
															  
											  	$bdd->prepare($sql,$bind);
											  	$result23 = $bdd->execute($arr);

										}


									} 

									// Met à jour toutes les unites des teams alliées et ennemies et unites totales
									// Team en cours
									$sql = "UPDATE teams SET tea_unit1 = ? , tea_unit2 = ? , tea_unit3 = ? 
											WHERE tea_id = ? ";

									    $bind = "iiii";
									  	$arr = array($combat["att"]["u1"], $combat["att"]["u2"], $combat["att"]["u3"], $deplacement["tea_id"]);
															  
									  	$bdd->prepare($sql,$bind);
									  	$result24 = $bdd->execute($arr);

									$difference["u1"] = $deplacement["tea_unit1"] - $combat["att"]["u1"];
									$difference["u2"] = $deplacement["tea_unit2"] - $combat["att"]["u2"];
									$difference["u3"] = $deplacement["tea_unit3"] - $combat["att"]["u3"];

									// unites totales du joueur gagnant
									$sql = "SELECT tou_id, tou_units1, tou_units2, tou_units3 FROM total_units
											WHERE tou_joueurs_id = ? ";

									    $bind = "i";
									  	$arr = array($deplacement["tea_joueurs_id"]);
															  
									  	$bdd->prepare($sql,$bind);
									  	$result25 = $bdd->execute($arr);

									$nvlle_qte_unit["u1"] = ($result25[0]["tou_units1"] - $difference["u1"]);
									$nvlle_qte_unit["u2"] = ($result25[0]["tou_units2"] - $difference["u2"]);
									$nvlle_qte_unit["u3"] = ($result25[0]["tou_units3"] - $difference["u3"]);

									// Mise a jour unites totales
									$sql = "UPDATE total_units SET tou_units1 = ? , tou_units2 = ? , tou_units3 = ? 
											WHERE tou_id = ? ";

									    $bind = "iiii";
									  	$arr = array($nvlle_qte_unit["u1"], $nvlle_qte_unit["u2"], $nvlle_qte_unit["u3"], $result25[0]["tou_id"]);
															  
									  	$bdd->prepare($sql,$bind);
									  	$result26 = $bdd->execute($arr);

									 
									// TEAMS ADVERSES
									$z = 0;
									while(count($result12)!=$z) {
										// units1
										if($combat["def"]["u1"]<=$result12[$z]["tea_unit1"]) {
											$u1 = $result12[$z]["tea_unit1"] - $combat["def"]["u1"]; //nb de morts
											$rest_unit1 = $combat["def"]["u1"]; // Unites restantes dans l'unite
											$combat["def"]["u1"] = 0;
										} else {
											$u1 = 0; //nb de morts
											$rest_unit1 = $result12[$z]["tea_unit1"]; // Unites restantes dans l'unite
											$combat["def"]["u1"] = $combat["def"]["u1"] - $result12[$z]["tea_unit1"];
										}
										
										// units2
										if($combat["def"]["u2"]<=$result12[$z]["tea_unit2"]) {
											$u2 = $result12[$z]["tea_unit2"] - $combat["def"]["u2"]; //nb de morts
											$rest_unit2 = $combat["def"]["u2"]; // Unites restantes dans l'unite
											$combat["def"]["u2"] = 0;
										} else {
											$u2 = 0; //nb de morts
											$rest_unit2 = $result12[$z]["tea_unit2"]; // Unites restantes dans l'unite
											$combat["def"]["u2"] = $combat["def"]["u2"] - $result12[$z]["tea_unit2"];
										}
										
										// units3
										if($combat["def"]["u3"]<=$result12[$z]["tea_unit3"]) {
											$u3 = $result12[$z]["tea_unit3"] - $combat["def"]["u3"]; //nb de morts
											$rest_unit3 = $combat["def"]["u3"]; // Unites restantes dans l'unite
											$combat["def"]["u3"] = 0;
										} else {
											$u3 = 0; //nb de morts
											$rest_unit3 = $result12[$z]["tea_unit3"]; // Unites restantes dans l'unite
											$combat["def"]["u3"] = $combat["def"]["u3"] - $result12[$z]["tea_unit3"];
										}
										
									
									// Mise a jour de la team	
									$sql = "UPDATE teams SET tea_unit1 = ? , tea_unit2 = ? , tea_unit3 = ? 
											WHERE tea_id = ? ";

									    $bind = "iiii";
									  	$arr = array($rest_unit1, $rest_unit2, $rest_unit3, $result12[$z]["tea_id"]);
															  
									  	$bdd->prepare($sql,$bind);
									  	$result27 = $bdd->execute($arr);
									


									// Mise du total des units	
									$sql = "SELECT tou_id, tou_units1, tou_units2, tou_units3 FROM total_units
											WHERE tou_joueurs_id = ? ";

									    $bind = "i";
									  	$arr = array($result12[$z]["jou_id"]);
															  
									  	$bdd->prepare($sql,$bind);
									  	$result28 = $bdd->execute($arr);

									$reste["u1"] = $result28[0]["tou_units1"] - $u1;
									$reste["u2"] = $result28[0]["tou_units2"] - $u2;
									$reste["u3"] = $result28[0]["tou_units3"] - $u3;

									$sql = "UPDATE total_units SET tou_units1 = ? , tou_units2 = ? , tou_units3 = ? 
											WHERE tou_id = ? ";

									    $bind = "iiii";
									  	$arr = array($reste["u1"], $reste["u2"], $reste["u3"], $result28[0]["tou_id"]);
															  
									  	$bdd->prepare($sql,$bind);
									  	$result29 = $bdd->execute($arr);

									

										$z++;
									}

							  	}


					//Update deplacements unites pour mettre à 2 l'etat
						$sql = "UPDATE deplacements_unites SET deu_etat = 2 
								WHERE deu_id = ? ";

							    $bind = "i";
							  	$arr = array($deplacement["deu_id"]);
												  
							  	$bdd->prepare($sql,$bind);
							  	$result11 = $bdd->execute($arr);



					}

					break;
				
				default:
					//Update deplacements unites pour mettre à 1 l'etat
					// Gestion des autres types de deplacements (A venir)
						$sql = "UPDATE deplacements_unites SET deu_etat = 1 
								WHERE deu_id = ? ";

							    $bind = "i";
							  	$arr = array($deplacement["deu_id"]);
												  
							  	$bdd->prepare($sql,$bind);
							  	$result11 = $bdd->execute($arr);
					break;
			}


						



		}
	}












// AFFICHAGE DES TEAMS (carte)

	// Liste des equipes
	$sql = "SELECT tea_id, tea_joueurs_id, tea_unit1, tea_unit2, tea_unit3, tea_pos_x, tea_pos_y, tea_num, deu_id, deu_def_x, deu_def_y, deu_deb_depl_ts, deu_duree, deu_charge_max, deu_etat, dep_id, dep_deplacement FROM 
			(
				SELECT * FROM teams
				LEFT JOIN deplacements_unites ON (tea_id = deu_teams_id)
				LEFT JOIN deplacements ON (dep_id = deu_deplacements_id)
				WHERE tea_joueurs_id = ? 
				AND deu_parties_id = ?
				ORDER BY tea_id, deu_id DESC
			) AS equipes
			GROUP BY tea_id";

    $bind = "ii";
  	$arr = array($_SESSION["joueur"]["jou_id"], $_SESSION["partie"]["id"]);
				  
  	$bdd->prepare($sql,$bind);
  	$result13 = $bdd->execute($arr);

if (empty($result13)) {
	$sql = "SELECT  tea_id, tea_joueurs_id, tea_unit1, tea_unit2, tea_unit3, tea_pos_x, tea_pos_y, tea_num FROM teams
			WHERE tea_joueurs_id = ?
			ORDER BY tea_id";

    $bind = "i";
  	$arr = array($_SESSION["joueur"]["jou_id"]);
				  
  	$bdd->prepare($sql,$bind);
  	$result13 = $bdd->execute($arr);
}


	// coordonnées joueur
	$sql = "SELECT car_pos_x, car_pos_y FROM carte 
			WHERE car_joueur_id = ? 
			AND car_parties_id = ? 
			AND car_type = 'base'";

	    $bind = "ii";
	  	$arr = array($_SESSION["joueur"]["jou_id"], $_SESSION["partie"]["id"]);
												  
	  	$bdd->prepare($sql,$bind);
	  	$result6 = $bdd->execute($arr);

	  	$req9_COORD_JOUEUR["X"] = $result6[0]["car_pos_x"];
	  	$req9_COORD_JOUEUR["Y"] = $result6[0]["car_pos_y"];



	$req16_TEAMS = array();
	$req17_AVAILABLE_UNITS = array(
		"units1" => 0,
		"units2" => 0,
		"units3" => 0,
		);
	$req18_TEAMS_DISPO = array();

	foreach ($result13 as $team) {
		$equipe = $req4_DICO["team"]." ".$team["tea_num"];
		$coord_x = $team["tea_pos_x"];
		$coord_y = $team["tea_pos_y"];

		$req17_AVAILABLE_UNITS["units1"] += $team['tea_unit1'];
		$req17_AVAILABLE_UNITS["units2"] += $team['tea_unit2'];
		$req17_AVAILABLE_UNITS["units3"] += $team['tea_unit3'];


		if((!isset($team['deu_etat'])) || ($req9_COORD_JOUEUR["X"]==$coord_x && $req9_COORD_JOUEUR["Y"]==$coord_y && (is_null($team['deu_etat']) || $team['deu_etat']== 1))) {
			$nb_unit1 = "<input class=\"input\" type=\"text\" name=\"nbFighters\" value=\"{$team['tea_unit1']}\">";
			$nb_unit2 = "<input class=\"input\" type=\"text\" name=\"nbBombers\" value=\"{$team['tea_unit2']}\">";
			$nb_unit3 = "<input class=\"input\" type=\"text\" name=\"nbCruisers\" value=\"{$team['tea_unit3']}\">";
			$teamBack = "";

			$teamProgress["type"] = "orders";
			$teamProgress["name"] = $req4_DICO['waiting_orders'];
			$teamProgress["data"] = 0;
			$teamProgress["progression"] = "orders";
			$teamProgress["width_progression"] = 100;
			$teamProgress["progressTime"] = "";


			//$teamProgress = "<div class=\"progressBar\" data=\"0\" data-type=\"orders\"><div class=\"text\">{$req4_DICO['waiting_orders']}</div></div>";
			$req18_TEAMS_DISPO[] = $team["tea_num"];

		} else {
			$nb_unit1 = $team['tea_unit1'];
			$nb_unit2 = $team['tea_unit2'];
			$nb_unit3 = $team['tea_unit3'];

			$teamBack = ($team['dep_deplacement'] != "soutien") ? "" : "<span class=\"min back\">Back</span>";

			switch ($team['dep_deplacement']) {
				case 'attaque':
					
					$debut = strtotime($team["deu_deb_depl_ts"]);
					$fin_attaque = intval($debut+$team["deu_duree"]);
					$actu_ts = time();

					$fin_retour = $fin_attaque+$team["deu_duree"];
					if($actu_ts<=$fin_attaque) {
						$percent = intval(($actu_ts-$debut)*100/$team["deu_duree"]);
						$tempsRest = Calculs::convert_time(($fin_attaque-$actu_ts));

						$teamProgress["type"] = "att";
						$teamProgress["name"] = $req4_DICO['attack'];
						$teamProgress["data"] = $percent;
						$teamProgress["progression"] = "att";
						$teamProgress["width_progression"] = $percent;
						$teamProgress["progressTime"] = $tempsRest;

						//$teamProgress = "<div class=\"progressBar\" data=\"$percent\"><div class=\"progressType\">{$req4_DICO['attack']}</div><span class=\"progressTime\">$tempsRest</span></div>";

					} elseif ($actu_ts<=$fin_retour) {
						$percent = intval(($actu_ts-$fin_attaque)*100/$team["deu_duree"]);
						$tempsRest = Calculs::convert_time(($fin_retour-$actu_ts));

						$teamProgress["type"] = "back";
						$teamProgress["name"] = $req4_DICO['back'];
						$teamProgress["data"] = $percent;
						$teamProgress["progression"] = "back";
						$teamProgress["width_progression"] = $percent;
						$teamProgress["progressTime"] = $tempsRest;

						//$teamProgress = "<div class=\"progressBar\" data=\"$percent\" data-type=\"back\"><div class=\"progressType\">{$req4_DICO['back']}</div><span class=\"progressTime\">$tempsRest</span></div>";

					} else {
						$teamProgress = "";
					}



					break;
				
				case 'soutien':
					
						$teamProgress["type"] = "support";
						$teamProgress["name"] = $req4_DICO['support'];
						$teamProgress["data"] = $percent;
						$teamProgress["progression"] = "green";
						$teamProgress["width_progression"] = $percent;
						$teamProgress["progressTime"] = $tempsRest;

					//$teamProgress = "<div class=\"progressBar\" data=\"$percent\"><div class=\"progressType\">{$req4_DICO['support']}</div><span class=\"progressTime\">$tempsRest</span></div>";

					break;
				
				case 'transport':
					
						$teamProgress["type"] = "att";
						$teamProgress["name"] = $req4_DICO['transport'];
						$teamProgress["data"] = $percent;
						$teamProgress["progression"] = "transport";
						$teamProgress["width_progression"] = $percent;
						$teamProgress["progressTime"] = $tempsRest;

					//$teamProgress = "<div class=\"progressBar\" data=\"$percent\"><div class=\"progressType\">{$req4_DICO['transport']}</div><span class=\"progressTime\">$tempsRest</span></div>";

					break;
				
				default:
					$teamProgress = "";

					break;
			}
			

		}

		$req16_TEAMS[] = array(	"equipe"=>$equipe,
								"teamX"=>$coord_x,
								"teamY"=>$coord_y,
								"unit1Qty"=>$nb_unit1, 
								"unit2Qty"=>$nb_unit2, 
								"unit3Qty"=>$nb_unit3,
								"teamBack"=>$teamBack,
								"teamProgress"=>$teamProgress
		);
	}

	// Available units
	$req17_AVAILABLE_UNITS["units1"] = $req3_TOTAL_UNITS[1] - $req17_AVAILABLE_UNITS["units1"];
	$req17_AVAILABLE_UNITS["units2"] = $req3_TOTAL_UNITS[2] - $req17_AVAILABLE_UNITS["units2"];
	$req17_AVAILABLE_UNITS["units3"] = $req3_TOTAL_UNITS[3] - $req17_AVAILABLE_UNITS["units3"];





/*
	type : "orders", "att", "back", "wait", "def"
	data : orders, wait : 0 , percent
	progression : orders, att, back,  green, red
	width_progression : orders, wait : 100% , percent
	team : equipe concernée, sauf def : <span class="minB attack" style="width: 24px; height: 24px; background-image: url('../../imag…es/tileset24B.png" title="Enemy Attack"></span> =>(ATT EN COURS)
	coord : (10-10) sauf def : joueur =>(ATT EN COURS)

	progressTime : 07min35s , waiting orders, support

*/
// AFFICHAGE DES ATTAQUES EN COURS
	// attaques en cours envoyées
	$sql = "SELECT tea_id, tea_num, deu_deplacements_id, deu_def_x, deu_def_y, deu_deb_depl_ts, deu_duree, deu_etat FROM deplacements_unites 
			INNER JOIN teams on (tea_id = deu_teams_id)
			WHERE tea_joueurs_id = ? 
			AND deu_parties_id = ? 
			AND deu_etat IN (0,2)";

	    $bind = "ii";
	  	$arr = array($_SESSION["joueur"]["jou_id"], $_SESSION["partie"]["id"]);
												  
	  	$bdd->prepare($sql,$bind);
	  	$result14 = $bdd->execute($arr);

	// attaques en cours reçu
	$sql = "SELECT tea_id, jou_login, deu_deb_depl_ts, deu_duree FROM deplacements_unites 
			INNER JOIN teams on (tea_id = deu_teams_id)
			INNER JOIN joueurs on (jou_id = tea_joueurs_id)
			WHERE deu_parties_id = ? 
			AND deu_def_x = ? 
			AND deu_def_y = ? 
			AND deu_etat = 0 
			AND deu_deplacements_id = 1 ";

	    $bind = "iii";
	  	$arr = array($_SESSION["partie"]["id"], $req9_COORD_JOUEUR["X"], $req9_COORD_JOUEUR["Y"]);
												  
	  	$bdd->prepare($sql,$bind);
	  	$result15 = $bdd->execute($arr);
$att_en_cours = array();
$i = 0;
	foreach ($result15 as $attaque) {
		
			$att_en_cours[$i]["type"] = "def";

			$date_debut = strtotime($attaque["deu_deb_depl_ts"]);
			$date_fin = $date_debut + $attaque["deu_duree"];
			$sec_ecoule = $date_actu - $date_debut;
			$sec_restant = $date_fin - $date_actu;


			$att_en_cours[$i]["data"] = intval( $sec_ecoule * 100 / $attaque["deu_duree"] );
			$att_en_cours[$i]["progression"] = "red";
			$att_en_cours[$i]["width_progression"] = intval( $sec_ecoule * 100 / $attaque["deu_duree"] );
			$att_en_cours[$i]["progressTime"] = Calculs::convert_time($sec_restant);
			$att_en_cours[$i]["team"] = "<span class=\"minB attack\" style=\"width: 24px; height: 24px; background-image: url('../../images/tileset24B.png')\" title=\"Enemy Attack\"></span>";
			$att_en_cours[$i]["coord"] = $attaque["jou_login"];

	$i++;
	}


	foreach ($result14 as $attaque) {
		
		if($attaque["deu_etat"]==2){
			$att_en_cours[$i]["type"] = "back";

			$date_debut = strtotime($attaque["deu_deb_depl_ts"]);
			$date_fin = $date_debut + $attaque["deu_duree"];
			$date_fin_retour = $date_fin + $attaque["deu_duree"];
			$sec_ecoule = $date_actu - $date_fin;
			$sec_restant = $date_fin_retour - $date_actu;


		} else {
			$att_en_cours[$i]["type"] = "att";

			$date_debut = strtotime($attaque["deu_deb_depl_ts"]);
			$date_fin = $date_debut + $attaque["deu_duree"];
			$sec_ecoule = $date_actu - $date_debut;
			$sec_restant = $date_fin - $date_actu;

		} 

			$att_en_cours[$i]["data"] = intval( $sec_ecoule * 100 / $attaque["deu_duree"] );
			$att_en_cours[$i]["progression"] = $att_en_cours[$i]["type"];
			$att_en_cours[$i]["width_progression"] = intval( $sec_ecoule * 100 / $attaque["deu_duree"] );
			$att_en_cours[$i]["progressTime"] = Calculs::convert_time($sec_restant);
			$att_en_cours[$i]["team"] = $req4_DICO["team"]." ".$attaque["tea_num"];
			$att_en_cours[$i]["coord"] = "(".$attaque["deu_def_x"]."-".$attaque["deu_def_y"].")";

	$i++;
	}





	// EVOLUTION DE LA CARTE
	$sql = "SELECT jou_id, jou_login, jou_team, car_pos_x, car_pos_y, car_type  FROM carte
			INNER JOIN joueurs ON(jou_id = car_joueur_id)
			WHERE car_parties_id = ? ";



	    $bind = "i";
	  	$arr = array($_SESSION["partie"]["id"]);
					  
	  	$bdd->prepare($sql,$bind);
	  	$result3 = $bdd->execute($arr);



	// Tableau representant la carte
	$req8_CARTE= array();
	for ($i=1; $i <= 15; $i++) { 
		for ($j=1; $j <= 15; $j++) { 
			$req8_CARTE[$i][$j] = "";
			foreach ($result3 as $coord) {
				if($coord["car_pos_x"] == $j && $coord["car_pos_y"] == $i) {
					$joueur = $coord["jou_login"];
					$team = $req4_DICO["team"]." ".$coord["jou_team"];
					$type = ($coord["car_type"]== "base") ? $req4_DICO["planet"]: $req4_DICO["colony"];
					$class_type = ($coord["car_type"]== "base") ? "planet": "colony";
					$class_team = ($coord["jou_team"]== $_SESSION["joueur"]["jou_team"]) ? "allied": "ennemy";
					if($coord["jou_id"]== $_SESSION["joueur"]["jou_id"]) $class_team = "owned";

					$req8_CARTE[$i][$j] = "<div class=\"$class_type $class_team\" data-player=\"$joueur\" data-team=\"$team\" data-type=\"$type\"></div>";
				}
			}
		}
	}













































	$data["ressources"] = $ressources;
	$data["amelio_bat"] = $amelio_bat;
	$data["amelio_act"] = $amelio_act;
	$data["list_units_construct"] = $req2_LIST_UNITS_CONSTRUCT;
	$data["total_units"] = $req3_TOTAL_UNITS;


	$data["infos_teams"] = $req16_TEAMS; 
	$data["available_units"] = $req17_AVAILABLE_UNITS;

	$data["att_en_cours"] = $att_en_cours;
	$data["carte"] = $req8_CARTE;

	$data["temps_restant"] = $temps_restant;

} // FIN DE IF FIN IS FALSE
}









// Mise a jour des teams actuellement sur la planete
if(isset($_POST["action"]) && $_POST["action"] == "update_teams") {

$data["message"] = "";
$data["available_units"] = "";
$data["team_unites"] = "";
	$verif_post = new Check_data();
	if(	$verif_post->check_data($_POST["id"],"num",true) 
		&& $verif_post->check_data($_POST["units1"],"num",false) || $_POST["units1"] === "0"
		&& $verif_post->check_data($_POST["units2"],"num",false) || $_POST["units2"] === "0"
		&& $verif_post->check_data($_POST["units3"],"num",false) || $_POST["units3"] === "0"
	) {	
		$id = $_POST["id"];
		$units1 = intval($_POST["units1"]);
		$units2 = intval($_POST["units2"]);
		$units3 = intval($_POST["units3"]);


		// Toutes les unites du joueur
		$sql = "SELECT tou_units1, tou_units2, tou_units3 FROM total_units 
				WHERE tou_joueurs_id = ? ";

		    $bind = "i";
		  	$arr = array($_SESSION["joueur"]["jou_id"]);
						  
		  	$bdd->prepare($sql,$bind);
		  	$result1 = $bdd->execute($arr);


		// Somme des unites reparties dans les differnetes equipes du joueur
		$sql = "SELECT units1, units2, units3 FROM 
				(
					SELECT SUM(tea_unit1) AS units1, SUM(tea_unit2) AS units2, SUM(tea_unit3) AS units3 FROM teams
					WHERE tea_joueurs_id = ? 
				) AS total_utilise";

		    $bind = "i";
		  	$arr = array($_SESSION["joueur"]["jou_id"]);
						  
		  	$bdd->prepare($sql,$bind);
		  	$result2 = $bdd->execute($arr);

		// ANCIENNE VALEUR DE L'UNITE EN COURS DE MODIFICATION
		$sql = "SELECT units1, units2, units3 FROM 
				(
					SELECT SUM(tea_unit1) AS units1, SUM(tea_unit2) AS units2, SUM(tea_unit3) AS units3 FROM teams
					WHERE tea_joueurs_id = ? 
					AND tea_num = ? 
				) AS total_utilise";

		    $bind = "ii";
		  	$arr = array($_SESSION["joueur"]["jou_id"], $id);
						  
		  	$bdd->prepare($sql,$bind);
		  	$result3 = $bdd->execute($arr);

		  	$tou_units1 = $result1[0]["tou_units1"] - $result2[0]["units1"] + $result3[0]["units1"];
		  	$tou_units2 = $result1[0]["tou_units2"] - $result2[0]["units2"] + $result3[0]["units2"];
		  	$tou_units3 = $result1[0]["tou_units3"] - $result2[0]["units3"] + $result3[0]["units3"];


		if(	$units1<=$tou_units1 
			&& $units2<=$tou_units2 
			&& $units3<=$tou_units3
		) {


			$sql = "UPDATE teams SET tea_unit1 = ? , tea_unit2 = ? , tea_unit3 = ? 
					WHERE tea_joueurs_id = ?
					AND tea_num = ? ";



			    $bind = "iiiii";
			  	$arr = array($units1, $units2, $units3, $_SESSION["joueur"]["jou_id"], $id);
							  
			  	$bdd->prepare($sql,$bind);
			  	$result3 = $bdd->execute($arr);
			  	if($result3 == 1) {
			  		$data["message"] = "Equipe $id mise à jour";
			  		$data["message"] .= "<br/>Unites 1 : ".$units1;
			  		$data["message"] .= "<br/>Unites 2 : ".$units2;
			  		$data["message"] .= "<br/>Unites 3 : ".$units3;

					$sql = "SELECT units1, units2, units3 FROM 
							(
								SELECT SUM(tea_unit1) AS units1, SUM(tea_unit2) AS units2, SUM(tea_unit3) AS units3 FROM teams
								WHERE tea_joueurs_id = ? 
							) AS total_utilise";

					    $bind = "i";
					  	$arr = array($_SESSION["joueur"]["jou_id"]);
									  
					  	$bdd->prepare($sql,$bind);
					  	$result2 = $bdd->execute($arr);

					$data["available_units"]["units1"] = $result1[0]["tou_units1"] - $result2[0]["units1"];
					$data["available_units"]["units2"] = $result1[0]["tou_units2"] - $result2[0]["units2"];
					$data["available_units"]["units3"] = $result1[0]["tou_units3"] - $result2[0]["units3"];

			  	}

		} else {
			$data["message"] = "Pas assez d'unités :";
			$data["message"] .= ($units1<=$tou_units1) ? "" : "<br/>Max Unités 1 : ".$tou_units1;
			$data["message"] .= ($units2<=$tou_units2) ? "" : "<br/>Max Unités 2 : ".$tou_units2;
			$data["message"] .= ($units3<=$tou_units3) ? "" : "<br/>Max Unités 3 : ".$tou_units3;
			$data["team_unites"] = array(
				"id_team"=> $id, 
				"unites1"=> "<input class=\"input\" type=\"text\" name=\"nbFighters\" value=\"".$result3[0]["units1"]."\">", 
				"unites2"=> "<input class=\"input\" type=\"text\" name=\"nbBombers\" value=\"".$result3[0]["units2"]."\">", 
				"unites3"=> "<input class=\"input\" type=\"text\" name=\"nbCruisers\" value=\"".$result3[0]["units3"]."\">", 
			);
		}

	} else {
		$data["message"] = "Veuillez entrer un nombre dans chacune des cases de l'équipe que vous souhaitez modifier.";
		$data["message"].= ( $verif_post->check_data($_POST["id"],"num",true) ) ? "": "</br>id" ;
		$data["message"].= ( $verif_post->check_data($_POST["units1"],"num",false) ) ? "": "<br/>Unités 1";
		$data["message"].= ( $verif_post->check_data($_POST["units2"],"num",false) ) ? "": "<br/>Unités 2";
		$data["message"].= ( $verif_post->check_data($_POST["units3"],"num",false) ) ? "": "<br/>Unités 3";
		$data["team_unites"] = array(
			"id_team"=> $id, 
			"unites1"=> "<input class=\"input\" type=\"text\" name=\"nbFighters\" value=\"".$result3[0]["units1"]."\">", 
			"unites2"=> "<input class=\"input\" type=\"text\" name=\"nbBombers\" value=\"".$result3[0]["units2"]."\">", 
			"unites3"=> "<input class=\"input\" type=\"text\" name=\"nbCruisers\" value=\"".$result3[0]["units3"]."\">", 
		);
	}


}











// Mise a jour de la preparation de l'attaque
if(isset($_POST["action"]) && $_POST["action"] == "info_prepa_att") {
	$data["temps"] = " - ";
	$data["capacite"] = 0;
	$data["message"] = "";
	$verif_post = new Check_data();
	if($verif_post->check_data($_POST["deplacement"],"login",3)
		&& $verif_post->check_data($_POST["team"],"num",true) 
		&& $verif_post->check_data($_POST["x"],"num",15)
		&& $verif_post->check_data($_POST["y"],"num",15)
	) {

		$sql = "SELECT tea_unit1, tea_unit2, tea_unit3, tea_pos_x, tea_pos_y FROM teams 
				WHERE tea_joueurs_id = ? 
				AND tea_num = ? ";

		    $bind = "ii";
		  	$arr = array($_SESSION["joueur"]["jou_id"], $_POST["team"]);
			$bdd->prepare($sql,$bind);
		  	$result1 = $bdd->execute($arr);



		$sql = "SELECT uni_vitesse, uni_capacite_charge FROM unites";

		    $bdd->prepare($sql);
		  	$result2 = $bdd->execute();

		$sql = "SELECT bob_type_bonus, bob_bonus_percent FROM bonus_batiment
				WHERE bob_type_batiments_id = 2 
				AND bob_type_bonus IN ('CHARGE', 'VIT')";

		    $bdd->prepare($sql);
		  	$result3 = $bdd->execute();

		$sql = "SELECT bat_niveau FROM batiments
				WHERE bat_joueurs_id = ? 
				AND bat_type_batiments_id = 2";

		    $bind = "i";
		  	$arr = array($_SESSION["joueur"]["jou_id"]);
			$bdd->prepare($sql,$bind);
		  	$result4 = $bdd->execute($arr);




		if($result1[0]["tea_unit1"] != 0 || $result1[0]["tea_unit2"] != 0 || $result1[0]["tea_unit3"] != 0) {
			// Vitesse de l'equipe
			if($result1[0]["tea_unit3"] != 0) {
				$vit = $result2[2]["uni_vitesse"]*(1+($result3[1]["bob_bonus_percent"]*$result4[0]["bat_niveau"]/100));
			}
			if($result1[0]["tea_unit2"] != 0) {
				$vit = $result2[1]["uni_vitesse"]*(1+($result3[1]["bob_bonus_percent"]*$result4[0]["bat_niveau"]/100));
			}
			if($result1[0]["tea_unit1"] != 0) {
				$vit = $result2[0]["uni_vitesse"]*(1+($result3[1]["bob_bonus_percent"]*$result4[0]["bat_niveau"]/100));
			}

			// Distance
			$origine["x"] = $result1[0]["tea_pos_x"];
			$origine["y"] = $result1[0]["tea_pos_y"];

			$arrivee["x"] = $_POST["x"];
			$arrivee["y"] = $_POST["y"];
			$distance = Calculs::distance($origine, $arrivee);


			// temps trajet
			$temps = Calculs::temps_trajet($vit, $distance);
			$tps_formate = Calculs::convert_time(intval($temps));
			
			$data["temps"] = $tps_formate;


			// Capacite
			$capacite = 0;
			
			for ($i=0; $i < count($result2); $i++) { 
			
				$capacite += $result2[$i]['uni_capacite_charge']*$result1[0]["tea_unit".($i+1)]*(1+($result3[0]["bob_bonus_percent"]*$result4[0]["bat_niveau"]/100));
			}
			$data["capacite"] = $capacite;


			

		} else {
			$data["message"] = "Veuillez affecter des unites à votre équipe avant de l'envoyer.";
		}


	} else {
		$data["message"] = "Veuillez entrer des informations correctes dans les champs d'attaque.";
	}





















}













?>