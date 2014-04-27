<?php
// Appel profil
require_once (PROFIL."profil.php");

// Appel game
require_once (GAME."game.php");




// Renvoi sur ACCUEIL si on est pas connecté
$profil = new Profil();

$profil->verif_connect();



if(!is_int($_SESSION["joueur"]["jou_parties_id"])) {
	header("location:".URL_PROFIL);
}



if(isset($_POST["quitGame"])) {
	
					// Destruction des unites
					$sql = "DELETE FROM total_units
							WHERE tou_joueurs_id = ? ";

						$bind = "i";
					  	$arr = array($_SESSION["joueur"]["jou_id"]);
							  
					  	$bdd->prepare($sql,$bind);
					  	$result7 = $bdd->execute($arr);

					// Destruction des deplacements
					$sql = "DELETE FROM deplacements_unites
							WHERE deu_parties_id = ? ";

						$bind = "i";
					  	$arr = array($_SESSION["partie"]["id"]);
							  
					  	$bdd->prepare($sql,$bind);
					  	$result8 = $bdd->execute($arr);

					// Destruction des equipes
					$sql = "DELETE FROM teams
							WHERE tea_joueurs_id = ? ";

						$bind = "i";
					  	$arr = array($_SESSION["joueur"]["jou_id"]);
							  
					  	$bdd->prepare($sql,$bind);
					  	$result8 = $bdd->execute($arr);

					// Destruction des ressources
					$sql = "DELETE FROM ressources
							WHERE res_joueurs_id = ? ";

						$bind = "i";
					  	$arr = array($_SESSION["joueur"]["jou_id"]);
							  
					  	$bdd->prepare($sql,$bind);
					  	$result9 = $bdd->execute($arr);
					
					// Destruction des creations_unites
					$sql = "DELETE FROM creations_unites
							WHERE cru_joueurs_id = ? ";

						$bind = "i";
					  	$arr = array($_SESSION["joueur"]["jou_id"]);
							  
					  	$bdd->prepare($sql,$bind);
					  	$result10 = $bdd->execute($arr);
					
					// Destruction des batiments
					$sql = "DELETE FROM batiments
							WHERE bat_joueurs_id = ? ";

						$bind = "i";
					  	$arr = array($_SESSION["joueur"]["jou_id"]);
							  
					  	$bdd->prepare($sql,$bind);
					  	$result11 = $bdd->execute($arr);
					
									


					// Modifications des elements du joueur
					$sql = "UPDATE joueurs SET jou_parties_id = NULL , jou_ready = 0 , jou_team = NULL 
							WHERE jou_id = ? ";

						$bind = "i";
					  	$arr = array($_SESSION["joueur"]["jou_id"]);
							  
					  	$bdd->prepare($sql,$bind);
					  	$result13 = $bdd->execute($arr);


unset($_SESSION["partie"]);
$_SESSION["joueur"]["jou_parties_id"] = NULL;
$_SESSION["joueur"]["ready"] = 0;
$_SESSION["joueur"]["team"] = NULL;


header("location:".URL_PROFIL);

	  			
	  		
}





// nouvel objet partie
$game = new Game();






/************************************************************************************************* TRAITEMENT ************************************************************************************************************/

// UPGRADE BATIMENTS

if(isset($_POST["upgradeQG"]) || isset($_POST["upgradeSP"]) || isset($_POST["upgradeRes"]) || isset($_POST["upgradeWH"])) {

	if(isset($_POST["upgradeQG"])) {
		$bat = "QG";
	} 

	if(isset($_POST["upgradeSP"])) {
		$bat = "SP";
	} 

	if(isset($_POST["upgradeRes"])) {
		$bat = "Res";
	} 

	if(isset($_POST["upgradeWH"])) {
		$bat = "WH";
	} 

	// Batiments debloqués
$sql = "SELECT bat_niveau FROM batiments
		WHERE bat_joueurs_id = ? 
		AND bat_type_batiments_id = 1 ";



    $bind = "i";
  	$arr = array($_SESSION["joueur"]["jou_id"]);
				  
  	$bdd->prepare($sql,$bind);
  	$result_trait00 = $bdd->execute($arr);

  	$niv_QG = $result_trait00[0]["bat_niveau"]+1;

	$sql = "SELECT qg_deb_id, qg_deb_Niv_Spaceport, qg_deb_Niv_Ressources, qg_deb_Niv_search, qg_deb_Niv_Defense, qg_deb_Niv_Entrepot FROM qg_debloque_bat
			WHERE qg_deb_id = ? 
			ORDER BY qg_deb_id DESC
			LIMIT 0, 1";



	    $bind = "i";
	  	$arr = array($niv_QG);
					  
	  	$bdd->prepare($sql,$bind);
	  	$result_trait0 = $bdd->execute($arr);

	$restrictions["SP"] = $result_trait0[0]["qg_deb_Niv_Spaceport"];
	$restrictions["Res"] = $result_trait0[0]["qg_deb_Niv_Ressources"];
	$restrictions["RC"] = $result_trait0[0]["qg_deb_Niv_search"];
	$restrictions["DC"] = $result_trait0[0]["qg_deb_Niv_Defense"];
	$restrictions["WH"] = $result_trait0[0]["qg_deb_Niv_Entrepot"];




// Selections des informations necessaires pour l'upgrade du batiment
	$sql = "SELECT bat_id, bat_niveau, bat_amelio_debut_TS, tyb_niv_max, tyb_cout_ressource1, tyb_cout_ressource2, tyb_cout_ressource3, tyb_temps_necessaire FROM batiments
			INNER JOIN type_batiments ON (tyb_id = bat_type_batiments_id)
			WHERE bat_joueurs_id = ? 
			AND tyb_type = ? ";



	    $bind = "is";
	  	$arr = array($_SESSION["joueur"]["jou_id"], $bat);
					  
	  	$bdd->prepare($sql,$bind);
	  	$result_trait1 = $bdd->execute($arr);

	  	$r = $result_trait1[0];


	  	// Si batiment est inferieur au max et si le timestamp est null ->Aucune construction en cours sur le batiment
	  	if($r["bat_niveau"]<$r["tyb_niv_max"] && is_null($r["bat_amelio_debut_TS"]) && ($bat == "QG" || $restrictions[$bat]>$r["bat_niveau"] )) {

	  		// Cout de l'amelioration
	  		$res1 = Calculs::cout_ressources(($r["bat_niveau"]),$r["tyb_cout_ressource1"]);
	  		$res2 = Calculs::cout_ressources(($r["bat_niveau"]),$r["tyb_cout_ressource2"]);
	  		$res3 = Calculs::cout_ressources(($r["bat_niveau"]),$r["tyb_cout_ressource3"]);


	  		// Recuperation des ressources actuelles
			$sql = "SELECT res_quantite FROM ressources
					WHERE res_joueurs_id = ? ";


			    $bind = "i";
			  	$arr = array($_SESSION["joueur"]["jou_id"]);
							  
			  	$bdd->prepare($sql,$bind);
			  	$result_trait2 = $bdd->execute($arr);


			  	// Si suffisamment de ressources
			  	if($result_trait2[0]["res_quantite"]>= $res1 && $result_trait2[1]["res_quantite"]>= $res2 && $result_trait2[2]["res_quantite"]>= $res3) {
			  		$rest[1] = $result_trait2[0]["res_quantite"] - $res1;
			  		$rest[2] = $result_trait2[1]["res_quantite"] - $res2;
			  		$rest[3] = $result_trait2[2]["res_quantite"] - $res3;


			  		// Mise a jour de la table batiement avec le timestamp actuel
					$sql = "UPDATE batiments SET bat_amelio_debut_TS = CURRENT_TIMESTAMP
							WHERE bat_id = ? ";



					    $bind = "i";
					  	$arr = array($r["bat_id"]);
									  
					  	$bdd->prepare($sql,$bind);
					  	$result_trait3 = $bdd->execute($arr);


			  		// Mise a jour des ressources
					$sql = "UPDATE ressources SET res_quantite = ?
							WHERE res_joueurs_id = ? 
							AND res_types_ressources_id = ?";



					    $bind = "iii";

					  	$bdd->prepare($sql,$bind);

					  	for ($i=1; $i <= 3 ; $i++) { 
						  	$arr = array($rest[$i], $_SESSION["joueur"]["jou_id"], $i);
						  	$result_trait4 = $bdd->execute($arr);

					  	}


			  	} else {
			  		$_SESSION["message"] = "Pas assez de Ressources";
			  	}



	  	} else {
	  		$_SESSION["message"] = "Impossible d'ameliorer le batiment.";
	  		if(!($r["bat_niveau"]<$r["tyb_niv_max"])) $_SESSION["message"] .= "<br/>Niveau max atteint.";
	  		if(!is_null($r["bat_amelio_debut_TS"])) $_SESSION["message"] .= "<br/>Construction deja en cours.";
	  		if(!($bat == "QG" || $restrictions[$bat]>$r["bat_niveau"])) $_SESSION["message"] .= "<br/>Ameliorer d'abord votre QG.";
	  	}

// Evite la revalidation du formulaire en appuyant sur f5 
header("location:".URL_GAME);
exit();
}	




// UPGRADE RESSOURCES

if(isset($_POST["upgradeRes1"]) || isset($_POST["upgradeRes2"]) || isset($_POST["upgradeRes3"])) {

	if(isset($_POST["upgradeRes1"])) {
		$res = "ore";
	}

	if(isset($_POST["upgradeRes2"])) {
		$res = "organic";
	}

	if(isset($_POST["upgradeRes3"])) {
		$res = "energy";
	}


	$sql = "SELECT res_id, res_quantite, res_niveau, res_amelio_debut_TS, tyr_id, tyr_cout_res1, tyr_cout_res2, tyr_cout_res3, tyr_tps_nec FROM ressources
			INNER JOIN types_ressources ON (tyr_id = res_types_ressources_id)
			WHERE res_joueurs_id = ? 
			AND tyr_type = ? ";



	    $bind = "is";
	  	$arr = array($_SESSION["joueur"]["jou_id"], $res);
		
		$bdd->prepare($sql,$bind);
	  	$result_trait5 = $bdd->execute($arr);

	$r = $result_trait5[0];

	$sql = "SELECT bat_niveau FROM batiments
			WHERE bat_joueurs_id = ? 
			AND bat_type_batiments_id = 3 ";



	    $bind = "i";
	  	$arr = array($_SESSION["joueur"]["jou_id"]);
		
		$bdd->prepare($sql,$bind);
	  	$result_trait6 = $bdd->execute($arr);


	if($result_trait6[0]["bat_niveau"]>$r["res_niveau"] && is_null($r["res_amelio_debut_TS"])) {


	  		// Cout de l'amelioration
	  		$res1 = Calculs::cout_ressources(($r["res_niveau"]),$r["tyr_cout_res1"]);
	  		$res2 = Calculs::cout_ressources(($r["res_niveau"]),$r["tyr_cout_res2"]);
	  		$res3 = Calculs::cout_ressources(($r["res_niveau"]),$r["tyr_cout_res3"]);


	  		// Recuperation des ressources actuelles
			$sql = "SELECT res_quantite FROM ressources
					WHERE res_joueurs_id = ? ";


			    $bind = "i";
			  	$arr = array($_SESSION["joueur"]["jou_id"]);
							  
			  	$bdd->prepare($sql,$bind);
			  	$result_trait7 = $bdd->execute($arr);


			  	// Si suffisamment de ressources
			  	if($result_trait7[0]["res_quantite"]>= $res1 && $result_trait7[1]["res_quantite"]>= $res2 && $result_trait7[2]["res_quantite"]>= $res3) {
			  		$rest[1] = $result_trait7[0]["res_quantite"] - $res1;
			  		$rest[2] = $result_trait7[1]["res_quantite"] - $res2;
			  		$rest[3] = $result_trait7[2]["res_quantite"] - $res3;




			  		// Mise a jour de la table batiement avec le timestamp actuel
					$sql = "UPDATE ressources SET res_amelio_debut_TS = CURRENT_TIMESTAMP
							WHERE res_id = ? ";



					    $bind = "i";
					  	$arr = array($r["res_id"]);
									  
					  	$bdd->prepare($sql,$bind);
					  	$result_trait8 = $bdd->execute($arr);



			  		// Mise a jour des ressources
					$sql = "UPDATE ressources SET res_quantite = ?
							WHERE res_joueurs_id = ? 
							AND res_types_ressources_id = ?";



					    $bind = "iii";

					  	$bdd->prepare($sql,$bind);

					  	for ($i=1; $i <= 3 ; $i++) { 
						  	$arr = array($rest[$i], $_SESSION["joueur"]["jou_id"], $i);
						  	$result_trait9 = $bdd->execute($arr);

					  	}


				} else {
			  		$_SESSION["message"] = "Pas assez de Ressources";
			  	}



	  	} else {
	  		$_SESSION["message"] = "Impossible d'ameliorer cette ressource pour le moment.";
	  		if(!($result_trait6[0]["bat_niveau"]>$r["res_niveau"])) $_SESSION["message"] .= "<br/>Améliorer le batiment ressources d'abord.";
	  		if(!is_null($r["res_amelio_debut_TS"])) $_SESSION["message"] .= "<br/>Construction deja en cours.";
	  	}


// Evite la revalidation du formulaire en appuyant sur f5
header("location:".URL_GAME);
exit();
}	



// CREER UNITES

if(isset($_POST["constructU1"]) || isset($_POST["constructU2"]) || isset($_POST["constructU3"]) ) {

	$sql = "SELECT bat_niveau, dea_niv_debloque FROM batiments
			INNER JOIN type_batiments ON (tyb_id = bat_type_batiments_id)
			INNER JOIN debloque_act ON (tyb_id=dea_type_batiments_id)
			WHERE bat_type_batiments_id = 2
			AND bat_joueurs_id = ? ";
	    
	    $bind = "i";
	  	$arr = array($_SESSION["joueur"]["jou_id"]);
					  
	  	$bdd->prepare($sql,$bind);
	  	$result_trait10 = $bdd->execute($arr);	

	
	$verif_post = new Check_data();

	if(isset($_POST["constructU1"])) {
		$type_unit = 0;
		if($verif_post->check_data($_POST["constructFighter"],"num",true)) {
			$nb_unit = $_POST["constructFighter"];
		}
	}

	if(isset($_POST["constructU2"]) && $result_trait10[1]["bat_niveau"]>=$result_trait10[1]["dea_niv_debloque"]) {
		$type_unit = 1;
		if($verif_post->check_data($_POST["constructBomber"],"num",true)) {
			$nb_unit = $_POST["constructBomber"];
		}
	}

	if(isset($_POST["constructU3"]) && $result_trait10[2]["bat_niveau"]>=$result_trait10[2]["dea_niv_debloque"]) {
		$type_unit = 2;
		if($verif_post->check_data($_POST["constructCruiser"],"num",true)) {
			$nb_unit = $_POST["constructCruiser"];
		}
	}




	if(isset($nb_unit)) {




		$sql = "SELECT bob_type_bonus, bob_bonus_percent FROM bonus_batiment WHERE bob_type_batiments_id = ? ";



		    $bind = "i";
		  	$arr = array(2);
						  
		  	$bdd->prepare($sql,$bind);
		  	$result8 = $bdd->execute($arr);
		$req13_BONUS_SP = array();
		foreach ($result8 as $bonus) {
			$req13_BONUS_SP[$bonus["bob_type_bonus"]] = $bonus["bob_bonus_percent"]*$result_trait10[0]["bat_niveau"];
		}





		// Infos sur les unites
		$sql = "SELECT  uni_id, uni_type, uni_cout_ressource1, uni_cout_ressource2, uni_cout_ressource3, uni_temps_necessaire, uni_vitesse, uni_capacite_charge, uni_attaque, uni_defense, uni_life, uni_portee FROM unites";

					  
		  	$bdd->prepare($sql);
		  	$result11 = $bdd->execute();


	



		$cout_res1 = intval(($result11[$type_unit]["uni_cout_ressource1"] - ($result11[$type_unit]["uni_cout_ressource1"]*$req13_BONUS_SP["COST"]/100))*$nb_unit);
		$cout_res2 = intval(($result11[$type_unit]["uni_cout_ressource2"] - ($result11[$type_unit]["uni_cout_ressource2"]*$req13_BONUS_SP["COST"]/100))*$nb_unit);
		$cout_res3 = intval(($result11[$type_unit]["uni_cout_ressource3"] - ($result11[$type_unit]["uni_cout_ressource3"]*$req13_BONUS_SP["COST"]/100))*$nb_unit);

		$nec_time_sec = intval(($result11[$type_unit]["uni_temps_necessaire"] - ($result11[$type_unit]["uni_temps_necessaire"]*$req13_BONUS_SP["TIME"]/100))*$nb_unit);
		$nec_time = Calculs::convert_time($nec_time_sec);

	  		// Recuperation des ressources actuelles
			$sql = "SELECT res_quantite FROM ressources
					WHERE res_joueurs_id = ? ";


			    $bind = "i";
			  	$arr = array($_SESSION["joueur"]["jou_id"]);
							  
			  	$bdd->prepare($sql,$bind);
			  	$result_trait2 = $bdd->execute($arr);


			  	// Si suffisamment de ressources
			  	if($result_trait2[0]["res_quantite"]>= $cout_res1 && $result_trait2[1]["res_quantite"]>= $cout_res2 && $result_trait2[2]["res_quantite"]>= $cout_res3) {
			  		$rest[1] = $result_trait2[0]["res_quantite"] - $cout_res1;
			  		$rest[2] = $result_trait2[1]["res_quantite"] - $cout_res2;
			  		$rest[3] = $result_trait2[2]["res_quantite"] - $cout_res3;


			  		// Mise a jour des ressources
					$sql = "UPDATE ressources SET res_quantite = ?
							WHERE res_joueurs_id = ? 
							AND res_types_ressources_id = ?";



					    $bind = "iii";

					  	$bdd->prepare($sql,$bind);

					  	for ($i=1; $i <= 3 ; $i++) { 
						  	$arr = array($rest[$i], $_SESSION["joueur"]["jou_id"], $i);
						  	$result_trait9 = $bdd->execute($arr);

					  	}




			  		// Mise a jour de la liste des creations d'unités
					$sql = "INSERT INTO creations_unites VALUES ( NULL, ? , ? , ? , NULL, ? )";



					    $bind = "iiii";

					  	$bdd->prepare($sql,$bind);

					  	$arr = array($_SESSION["joueur"]["jou_id"], ($type_unit+1), $nb_unit, $nec_time_sec);
						$result_trait10 = $bdd->execute($arr);

						if($result_trait10!=1) {
							$_SESSION["message"] = "Un probleme est survenu.";
						} else {
							$_SESSION["message"] = "La commande a été mise dans la file d'attente.";
						}

			  	} else {
		$_SESSION["message"] = "Pas assez de ressources.";
	}



	} else {
		$_SESSION["message"] = "Entrer un nombre. Merci";
	}



// Evite la revalidation du formulaire en appuyant sur f5
header("location:".URL_GAME);
exit();
}




// LANCER LES DEPLACEMENTS
if(isset($_POST["actionMapLaunch"])) {


	$verif_post = new Check_data();
	if($verif_post->check_data($_POST["actionMapAtt"],"login",3)
		&& $verif_post->check_data($_POST["actionMapTeam"],"num",true) 
		&& $verif_post->check_data($_POST["actionMapX"],"num",15)
		&& $verif_post->check_data($_POST["actionMapY"],"num",15)
	) {

		$sql = "SELECT tea_id, tea_unit1, tea_unit2, tea_unit3, tea_pos_x, tea_pos_y FROM teams 
				WHERE tea_joueurs_id = ? 
				AND tea_num = ? ";

		    $bind = "ii";
		  	$arr = array($_SESSION["joueur"]["jou_id"], $_POST["actionMapTeam"]);
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


		// L'equipe doit avoir au moins une unite
		if($result1[0]["tea_unit1"] != 0 || $result1[0]["tea_unit2"] != 0 || $result1[0]["tea_unit3"] != 0) {

			// Carte
			$sql = "SELECT jou_id, jou_team, jou_races_id, car_pos_x, car_pos_y, car_type FROM carte
					INNER JOIN joueurs ON (jou_id = car_joueur_id)
					WHERE car_parties_id = ? ";

			    $bind = "i";
			  	$arr = array($_SESSION["partie"]["id"]);
				$bdd->prepare($sql,$bind);
			  	$result5 = $bdd->execute($arr);

			  	$_SESSION["problemes"] = ($result5);
			  	

			  	$planete_libre = true;
			  	$meme_equipe = false;
			  	$meme_joueur = false;
			  	foreach ($result5 as $planete) {
			  		if($planete["car_pos_x"]==$_POST["actionMapX"] && $planete["car_pos_y"]==$_POST["actionMapY"]) { // planete Occupée
			  			$planete_libre = false;

			  			if($planete['jou_team']==$_SESSION["joueur"]["jou_team"]) {
			  				$meme_equipe = true;

			  				if($planete["jou_id"]==$_SESSION["joueur"]["jou_id"]) {
			  					$meme_joueur = true;

			  					$is_colony = ($planete['car_type']=='base')? false:true;
			  				}
			  			}
			  		} 
			  	}



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

				$arrivee["x"] = $_POST["actionMapX"];
				$arrivee["y"] = $_POST["actionMapY"];
				$distance = Calculs::distance($origine, $arrivee);


				// temps trajet
				$temps = intval(Calculs::temps_trajet($vit, $distance));
				

				// Capacite
				$capacite = ($result3[0]["bob_bonus_percent"]*$result4[0]["bat_niveau"]);
				
				/*for ($i=0; $i < count($result2); $i++) { 
				
					$capacite += $result2[$i]['uni_capacite_charge']*$result1[0]["tea_unit".($i+1)]*(1+($result3[0]["bob_bonus_percent"]*$result4[0]["bat_niveau"]/100));
				}*/

				// empeche le deplacement si c'est la planete mere du joueur qui est selectionné
				if(isset($is_colony) && $is_colony == false) {
					$launch_att = false;
				} else {
					$launch_att = true;
				}
				
				// Type de deplacement
				switch ($_POST["actionMapAtt"]) {
					case 'att':
						$deplacement = 1;
						if($meme_equipe) {
							$launch_att = false;
							$_SESSION["message"] = "Impossible d'attaquer un membre de votre equipe.";
						}
						break;
					
					case 'sup':
						$deplacement = 2;
						if(!$meme_equipe) {
							$launch_att = false;
							$_SESSION["message"] = "Veuillez selectionner une planete alliée.";
						}
						break;
					
					default:
						$deplacement = 3;
						break;
				}


				if($launch_att){
					
					$sql = "INSERT INTO deplacements_unites VALUES (NULL, ? , ? , ? , ? , ? , CURRENT_TIMESTAMP , ? , ? , 0 )";

					    $bind = "iiiiiii";
					  	$arr = array($result1[0]["tea_id"], $deplacement, $_SESSION["partie"]["id"], $arrivee["x"], $arrivee["y"], $temps, $capacite );
						$bdd->prepare($sql,$bind);
					  	$result6 = $bdd->execute($arr);

					$sql = "UPDATE teams SET tea_pos_x = ? , tea_pos_y = ? 
							WHERE tea_id = ? ";

					    $bind = "iii";
					  	$arr = array($arrivee["x"], $arrivee["y"], $result1[0]["tea_id"]);
						$bdd->prepare($sql,$bind);
					  	$result7 = $bdd->execute($arr);

				}



		} else {
			$_SESSION["message"] = "Veuillez affecter des unites à votre equipe avant de lancer votre déplacement.";
		}


	} else {
		$_SESSION["message"] = "Veuillez choisir une destination et une e^quipe avant de lancer votre déplacement.";
	}


// Evite la revalidation du formulaire en appuyant sur f5
header("location:".URL_GAME);
exit();
}



























/************************************************************************************************* AFFICHAGE ************************************************************************************************************/


// INFO BATIMENTS
$batiments_trad = array($req4_DICO['qg'], $req4_DICO['spaceport'], $req4_DICO['resources'], $req4_DICO['research_center'], $req4_DICO['defense_center'], $req4_DICO['warehouse'] );

$sql = "SELECT tyb_id, tyb_type, tyb_icon, tra_nom, bat_niveau, tyb_niv_max, tyb_cout_ressource1, tyb_cout_ressource2, tyb_cout_ressource3, tyb_temps_necessaire  FROM batiments
		INNER JOIN type_batiments ON (tyb_id = bat_type_batiments_id)
		INNER JOIN elem_a_trad ON (eat_id = tyb_elem_a_trad_id)
		INNER JOIN traductions ON (eat_id = tra_elem_a_trad_id)
		INNER JOIN langues ON (lan_id = tra_langues_id)
		WHERE bat_joueurs_id = ? 
		AND lan_designation = ? ";



    $bind = "is";
  	$arr = array($_SESSION["joueur"]["jou_id"], $_SESSION["lang"]);
				  
  	$bdd->prepare($sql,$bind);
  	$result = $bdd->execute($arr);

$req6_INFOS_BAT = array();
for ($i=0; $i < count($result) ; $i++) { 
	$req6_INFOS_BAT[$i]["type"] = $result[$i]["tyb_type"];
	$req6_INFOS_BAT[$i]["icon"] = $result[$i]["tyb_icon"];
	$req6_INFOS_BAT[$i]["title"] = $batiments_trad[$i];
	$req6_INFOS_BAT[$i]["description"] = $result[$i]["tra_nom"];
	$req6_INFOS_BAT[$i]["niveau"] = $result[$i]["bat_niveau"];


	// INFOS_ACTIONS
	$sql = "SELECT dea_action, dea_icon, dea_onglet FROM debloque_act
			WHERE dea_type_batiments_id = ? 
			AND dea_niv_debloque <= ? ";



	    $bind = "ii";
	  	$arr = array($result[$i]["tyb_id"], $result[$i]["bat_niveau"]);
					  
	  	$bdd->prepare($sql,$bind);
	  	$result2 = $bdd->execute($arr);


	for ($j=0; $j < count($result2); $j++) { 
		$req6_INFOS_BAT[$i]["actions"][$j]["icon"] = $result2[$j]["dea_icon"];
		$req6_INFOS_BAT[$i]["actions"][$j]["data"] = $result2[$j]["dea_onglet"];
		$req6_INFOS_BAT[$i]["actions"][$j]["type"] = $result2[$j]["dea_action"];
	}

	$req7_BAT_NIV[$req6_INFOS_BAT[$i]["type"]] = $req6_INFOS_BAT[$i]["niveau"];


}


// CARTE
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


// COORDONNEES
$sql = "SELECT car_pos_x, car_pos_y FROM carte
		WHERE car_parties_id = ? 
		AND car_joueur_id = ? ";



    $bind = "ii";
  	$arr = array($_SESSION["partie"]["id"], $_SESSION["joueur"]["jou_id"]);
				  
  	$bdd->prepare($sql,$bind);
  	$result4 = $bdd->execute($arr);



$req9_COORD_JOUEUR["X"] = $result4[0]["car_pos_x"];
$req9_COORD_JOUEUR["Y"] = $result4[0]["car_pos_y"];



// RESSOURCES
$sql = "SELECT res_quantite, res_niveau, tyr_type, tyr_productionH, tyr_max_niv1, tyr_cout_res1, tyr_cout_res2, tyr_cout_res3, tyr_tps_nec  FROM ressources
		INNER JOIN types_ressources ON (tyr_id = res_types_ressources_id)
		WHERE res_joueurs_id = ? ";



    $bind = "i";
  	$arr = array($_SESSION["joueur"]["jou_id"]);
				  
  	$bdd->prepare($sql,$bind);
  	$result5 = $bdd->execute($arr);



$sql = "SELECT bat_niveau FROM batiments
		WHERE bat_joueurs_id = ? 
		AND bat_type_batiments_id = 6 ";



    $bind = "i";
  	$arr = array($_SESSION["joueur"]["jou_id"]);
				  
  	$bdd->prepare($sql,$bind);
  	$result6 = $bdd->execute($arr);



$req10_RESSOURCES_JOUEUR = array();
foreach ($result5 as $res) {
	$req10_RESSOURCES_JOUEUR[$res["tyr_type"]] = array(
													"qte" => $res["res_quantite"],
													"niv" => $res["res_niveau"],
													"prod" => $res["tyr_productionH"],
													"max" => Calculs::max_ressources($result6[0]["bat_niveau"],$res["tyr_max_niv1"]),
													"cout_res1" => Calculs::cout_ressources($res["res_niveau"],$res["tyr_cout_res1"]),
													"cout_res2" => Calculs::cout_ressources($res["res_niveau"],$res["tyr_cout_res2"]),
													"cout_res3" => Calculs::cout_ressources($res["res_niveau"],$res["tyr_cout_res3"]),
													"tps_nec" => Calculs::convert_time(Calculs::cout_ressources($res["res_niveau"],$res["tyr_tps_nec"])),
													
		);

}





// AMELIORATION BAT
$req11_AMELIORER_BAT = array();
for ($i=0; $i < count($result) ; $i++) { 
	$req11_AMELIORER_BAT[$result[$i]["tyb_type"]]["niv"] = $result[$i]["bat_niveau"];
	$req11_AMELIORER_BAT[$result[$i]["tyb_type"]]["max"] = $result[$i]["tyb_niv_max"];
	$req11_AMELIORER_BAT[$result[$i]["tyb_type"]]["cout_res1"] = $result[$i]["tyb_cout_ressource1"];
	$req11_AMELIORER_BAT[$result[$i]["tyb_type"]]["cout_res2"] = $result[$i]["tyb_cout_ressource2"];
	$req11_AMELIORER_BAT[$result[$i]["tyb_type"]]["cout_res3"] = $result[$i]["tyb_cout_ressource3"];
	$req11_AMELIORER_BAT[$result[$i]["tyb_type"]]["cout_tps"] = $result[$i]["tyb_temps_necessaire"];
}



// BONUS BATIMENTS
// QG
$sql = "SELECT qg_deb_id, qg_deb_Niv_Spaceport, qg_deb_Niv_Ressources, qg_deb_Niv_search, qg_deb_Niv_Defense, qg_deb_Niv_Entrepot FROM qg_debloque_bat
		WHERE qg_deb_id <= ? 
		ORDER BY qg_deb_id DESC
		LIMIT 0, 1";



    $bind = "i";
  	$arr = array($req11_AMELIORER_BAT["QG"]["niv"]+1);
				  
  	$bdd->prepare($sql,$bind);
  	$result7 = $bdd->execute($arr);

$req12_BONUS_QG["SP"] = $result7[0]["qg_deb_Niv_Spaceport"];
$req12_BONUS_QG["Res"] = $result7[0]["qg_deb_Niv_Ressources"];
$req12_BONUS_QG["RC"] = $result7[0]["qg_deb_Niv_search"];
$req12_BONUS_QG["DC"] = $result7[0]["qg_deb_Niv_Defense"];
$req12_BONUS_QG["WH"] = $result7[0]["qg_deb_Niv_Entrepot"];


// SP
$niv_SP = $req11_AMELIORER_BAT["SP"]["niv"];
$sql = "SELECT bob_type_bonus, bob_bonus_percent FROM bonus_batiment WHERE bob_type_batiments_id = ? ";



    $bind = "i";
  	$arr = array(2);
				  
  	$bdd->prepare($sql,$bind);
  	$result8 = $bdd->execute($arr);
$req13_BONUS_SP = array();
foreach ($result8 as $bonus) {
	$req13_BONUS_SP[$bonus["bob_type_bonus"]] = $bonus["bob_bonus_percent"]*$niv_SP;
}



$sql = "SELECT dea_onglet FROM debloque_act WHERE dea_type_batiments_id = 2 AND dea_niv_debloque = ?";



    $bind = "i";
  	$arr = array($niv_SP+1);
				  
  	$bdd->prepare($sql,$bind);
  	$result9 = $bdd->execute($arr);
  	if(empty($result9)) {$req13_BONUS_SP["bonus_act"] = "";}
  	else {
  		switch ($result9[0]["dea_onglet"]) {
  			case 'Bomber':
  				$req13_BONUS_SP["bonus_act"] = "<div><span class=\"min unit2\">{$req4_DICO['bombers']}</span> : <span>{$req4_DICO['unlocked']}</span></div>";
  				break;
  			
  			case 'Cruiser':
  				$req13_BONUS_SP["bonus_act"] = "<div><span class=\"min unit3\">{$req4_DICO['cruisers']}</span> : <span>{$req4_DICO['unlocked']}</span></div>";
  				break;
  			
  			default:
  				$req13_BONUS_SP["bonus_act"] = "";
  				break;
  		}
  	}


// WH
$niv_WH = $result6[0]["bat_niveau"];
$niv_max_WH = $result5[0]["tyr_max_niv1"];


$req14_BONUS_WH["max"] = Calculs::max_ressources($niv_WH+1,$niv_max_WH);
















// SPACEPORT
	// Total des unites
	$sql = "SELECT tou_id, tou_units1, tou_units2, tou_units3 FROM total_units
			WHERE tou_joueurs_id = ? ";



    $bind = "i";
  	$arr = array($_SESSION["joueur"]["jou_id"]);
				  
  	$bdd->prepare($sql,$bind);
  	$result10 = $bdd->execute($arr);


	// Infos sur les unites
	$sql = "SELECT  uni_id, uni_type, uni_cout_ressource1, uni_cout_ressource2, uni_cout_ressource3, uni_temps_necessaire, uni_vitesse, uni_capacite_charge, uni_attaque, uni_defense, uni_life, uni_portee FROM unites";

				  
  	$bdd->prepare($sql);
  	$result11 = $bdd->execute();



	// Liste des unites en construction
	$sql = "SELECT cru_id, cru_unites_id, cru_quantite, cru_deb_construct FROM creations_unites
			WHERE cru_joueurs_id = ? ";



    $bind = "i";
  	$arr = array($_SESSION["joueur"]["jou_id"]);
				  
  	$bdd->prepare($sql,$bind);
  	$result12 = $bdd->execute($arr);


	
	$i = 0;
	foreach ($result11 as $units) {
		$i++;
		$req15_INFOS_UNITES[$units["uni_type"]]["ATT"] = intval($units["uni_attaque"] + ($units["uni_attaque"]*$req13_BONUS_SP["ATT"]/100));
		$req15_INFOS_UNITES[$units["uni_type"]]["DEF"] = intval($units["uni_attaque"] + ($units["uni_attaque"]*$req13_BONUS_SP["DEF"]/100));
		$req15_INFOS_UNITES[$units["uni_type"]]["CHARGE"] = intval($units["uni_attaque"] + ($units["uni_attaque"]*$req13_BONUS_SP["CHARGE"]/100));
		$req15_INFOS_UNITES[$units["uni_type"]]["VIT"] = intval($units["uni_attaque"] + ($units["uni_attaque"]*$req13_BONUS_SP["VIT"]/100));
		$req15_INFOS_UNITES[$units["uni_type"]]["VIE"] = intval($units["uni_attaque"] + ($units["uni_attaque"]*$req13_BONUS_SP["VIE"]/100));

		$req15_INFOS_UNITES[$units["uni_type"]]["STOCK"] = $result10[0]['tou_units'.$i];

		$req15_INFOS_UNITES[$units["uni_type"]]["ORE"] = intval($units["uni_cout_ressource1"] - ($units["uni_cout_ressource1"]*$req13_BONUS_SP["COST"]/100));
		$req15_INFOS_UNITES[$units["uni_type"]]["ORGANIC"] = intval($units["uni_cout_ressource2"] - ($units["uni_cout_ressource2"]*$req13_BONUS_SP["COST"]/100));
		$req15_INFOS_UNITES[$units["uni_type"]]["ENERGY"] = intval($units["uni_cout_ressource3"] - ($units["uni_cout_ressource3"]*$req13_BONUS_SP["COST"]/100));

		$req15_INFOS_UNITES[$units["uni_type"]]["NEC_TIME"] = Calculs::convert_time(intval($units["uni_temps_necessaire"] - ($units["uni_temps_necessaire"]*$req13_BONUS_SP["TIME"]/100)));

		$req15_INFOS_UNITES[$units["uni_type"]]["NEC_TIME_REAL"] = $units["uni_temps_necessaire"] - ($units["uni_temps_necessaire"]*$req13_BONUS_SP["TIME"]/100);
		
		$qte_max = array();
		$qte_max[] = floor($req10_RESSOURCES_JOUEUR["ore"]["qte"]/($units["uni_cout_ressource1"] - ($units["uni_cout_ressource1"]*$req13_BONUS_SP["COST"]/100)));
		$qte_max[] = floor($req10_RESSOURCES_JOUEUR["organic"]["qte"]/($units["uni_cout_ressource2"] - ($units["uni_cout_ressource2"]*$req13_BONUS_SP["COST"]/100)));
		$qte_max[] = floor($req10_RESSOURCES_JOUEUR["energy"]["qte"]/($units["uni_cout_ressource3"] - ($units["uni_cout_ressource3"]*$req13_BONUS_SP["COST"]/100)));
		sort($qte_max, SORT_NUMERIC);

		$req15_INFOS_UNITES[$units["uni_type"]]["MAX"] = $qte_max[0];


	}





// TEAMS (carte)

	// Liste des equipes
	$sql = "SELECT  tea_id, tea_joueurs_id, tea_unit1, tea_unit2, tea_unit3, tea_pos_x, tea_pos_y, tea_num, deu_id, deu_def_x, deu_def_y, deu_deb_depl_ts, deu_duree, deu_charge_max, deu_etat, dep_id, dep_deplacement FROM 
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
		$teamProgress = "<div class=\"progressBar\" data-info=\"0\" data-type=\"orders\"><div class=\"text\">{$req4_DICO['waiting_orders']}</div></div>";
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

					$teamProgress = "<div class=\"progressBar\" data-info=\"$percent\"><div class=\"progressType\">{$req4_DICO['attack']}</div><span class=\"progressTime\">$tempsRest</span></div>";

				} elseif ($actu_ts<=$fin_retour) {
					$percent = intval(($actu_ts-$fin_attaque)*100/$team["deu_duree"]);
					$tempsRest = Calculs::convert_time(($fin_retour-$actu_ts));

					$teamProgress = "<div class=\"progressBar\" data-info=\"$percent\" data-type=\"back\"><div class=\"progressType\">{$req4_DICO['back']}</div><span class=\"progressTime\">$tempsRest</span></div>";

				} else {
					$teamProgress = "";
				}



				break;
			
			case 'soutien':
				
				$teamProgress = "<div class=\"progressBar\" data-info=\"$percent\"><div class=\"progressType\">{$req4_DICO['support']}</div><span class=\"progressTime\">$tempsRest</span></div>";

				break;
			
			case 'transport':
				
				$teamProgress = "<div class=\"progressBar\" data-info=\"$percent\"><div class=\"progressType\">{$req4_DICO['transport']}</div><span class=\"progressTime\">$tempsRest</span></div>";

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
$req17_AVAILABLE_UNITS["units1"] = $req15_INFOS_UNITES["fighter"]["STOCK"] - $req17_AVAILABLE_UNITS["units1"];
$req17_AVAILABLE_UNITS["units2"] = $req15_INFOS_UNITES["bomber"]["STOCK"] - $req17_AVAILABLE_UNITS["units2"];
$req17_AVAILABLE_UNITS["units3"] = $req15_INFOS_UNITES["cruiser"]["STOCK"] - $req17_AVAILABLE_UNITS["units3"];





// Temps de la partie restant
	$sql = "SELECT par_H_debut FROM parties 
			INNER JOIN joueurs ON (par_id = jou_parties_id)
			WHERE jou_id = ? ";

	    $bind = "i";
	  	$arr = array($_SESSION["joueur"]["jou_id"]);
					  
	  	$bdd->prepare($sql,$bind);
	  	$result14 = $bdd->execute($arr);


	  	$temps_restant = Calculs::convert_time( (strtotime($result14[0]["par_H_debut"]) + 6000) - (time()) );



































$var = array(
	"batiments" => $req6_INFOS_BAT,
	"niv_bat" => $req7_BAT_NIV,
	"carte" => $req8_CARTE,
	"coord_joueur" => $req9_COORD_JOUEUR,
	"ressources_joueur" => $req10_RESSOURCES_JOUEUR,

	"amelio_bat" => $req11_AMELIORER_BAT,
	"bonus_bat" => array(
					"QG" => $req12_BONUS_QG,
					"SP" => $req13_BONUS_SP,
					"WH" => $req14_BONUS_WH
		),
	"infos_unites" => $req15_INFOS_UNITES, 
	"infos_teams" => $req16_TEAMS, 
	"available_units" => $req17_AVAILABLE_UNITS,
	"teams_dispo" => $req18_TEAMS_DISPO, 
	"temps_restant" => $temps_restant

);


?>
