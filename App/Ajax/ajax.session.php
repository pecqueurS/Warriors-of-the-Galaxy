<?php




	// Mise a jour de la connection pour verifier que le joueur est toujours connecté
	$sql = "UPDATE connectes SET con_last_update = CURRENT_TIMESTAMP 
			WHERE con_joueurs_id = ? ";

	    $bind = "i";
	  	$arr = array($_SESSION["joueur"]["jou_id"]);
			  
	  	$bdd->prepare($sql,$bind);
	  	$result1 = $bdd->execute($arr);



	// Verification des dernieres connections des joeuurs
	$sql = "SELECT con_joueurs_id, con_last_update FROM connectes";

	  	$bdd->prepare($sql);
	  	$result2 = $bdd->execute();

	$date_actu = time();
	for ($i=0; $i < count($result2); $i++) { 
		$last_update = strtotime($result2[$i]["con_last_update"]);
		if($date_actu > ($last_update+600)) {
			$sql = "UPDATE verif_connections SET vec_deconnect = CURRENT_TIMESTAMP 
					WHERE vec_deconnect IS NULL AND vec_joueurs_id = ? ";

			    $bind = "i";
			  	$arr = array($result2[$i]["con_joueurs_id"]);
					  
			  	$bdd->prepare($sql,$bind);
			  	$result3 = $bdd->execute($arr);

			$sql = "DELETE FROM connectes WHERE con_joueurs_id = ? ";

			    $bind = "i";
			  	$arr = array($result2[$i]["con_joueurs_id"]);
					  
			  	$bdd->prepare($sql,$bind);
			  	$result4 = $bdd->execute($arr);

		}
	}

















	// VERFICATION DES FINS DE PARTIES
	$sql = "SELECT par_id, par_H_debut FROM parties 
			WHERE par_type_end = 'TIME'
			AND par_H_debut IS NOT NULL
			AND par_wait = 1";

	  	$bdd->prepare($sql);
	  	$result5 = $bdd->execute();

	  	foreach ($result5 as $debut_partie) {
	  		if($date_actu > (strtotime($debut_partie["par_H_debut"]) + 6000)) {
	  			
				$sql = "SELECT jou_id, jou_xp, jou_team FROM joueurs
						WHERE jou_parties_id = ? ";

					$bind = "i";
				  	$arr = array($debut_partie["par_id"]);
						  
				  	$bdd->prepare($sql,$bind);
				  	$result6 = $bdd->execute($arr);

				foreach ($result6 as $joueur) {
					// Destruction des unites
					$sql = "DELETE FROM total_units
							WHERE tou_joueurs_id = ? ";

						$bind = "i";
					  	$arr = array($joueur["jou_id"]);
							  
					  	$bdd->prepare($sql,$bind);
					  	$result7 = $bdd->execute($arr);

					// Destruction des deplacements
					$sql = "DELETE FROM deplacements_unites
							WHERE deu_parties_id = ? ";

						$bind = "i";
					  	$arr = array($debut_partie["par_id"]);
							  
					  	$bdd->prepare($sql,$bind);
					  	$result8 = $bdd->execute($arr);

					// Destruction des equipes
					$sql = "DELETE FROM teams
							WHERE tea_joueurs_id = ? ";

						$bind = "i";
					  	$arr = array($joueur["jou_id"]);
							  
					  	$bdd->prepare($sql,$bind);
					  	$result8 = $bdd->execute($arr);

					// Destruction des ressources
					$sql = "DELETE FROM ressources
							WHERE res_joueurs_id = ? ";

						$bind = "i";
					  	$arr = array($joueur["jou_id"]);
							  
					  	$bdd->prepare($sql,$bind);
					  	$result9 = $bdd->execute($arr);
					
					// Destruction des creations_unites
					$sql = "DELETE FROM creations_unites
							WHERE cru_joueurs_id = ? ";

						$bind = "i";
					  	$arr = array($joueur["jou_id"]);
							  
					  	$bdd->prepare($sql,$bind);
					  	$result10 = $bdd->execute($arr);
					
					// Destruction des batiments
					$sql = "DELETE FROM batiments
							WHERE bat_joueurs_id = ? ";

						$bind = "i";
					  	$arr = array($joueur["jou_id"]);
							  
					  	$bdd->prepare($sql,$bind);
					  	$result11 = $bdd->execute($arr);
					
					// RESULTAT PARTIE
					$sql = "SELECT nb_colonies FROM 
							(
								SELECT count(*) AS nb_colonies FROM carte 
								WHERE car_joueur_id = ?
								AND car_parties_id = ?
								AND car_type = 'conquete'
							) AS colonies";

						$bind = "ii";
					  	$arr = array($debut_partie["par_id"], $joueur["jou_id"]);
							  
					  	$bdd->prepare($sql,$bind);
					  	$result13 = $bdd->execute($arr);

					$xp_partie = $result13[0]["nb_colonies"] * 50 * Calculs::niveau_joueur($joueur["jou_xp"]);
					$xp_total = $joueur["jou_xp"] + $xp_partie ;
					$sql = "INSERT INTO resultats_parties VALUES (NULL , ? , ? , ? , ? , ? )";

						$bind = "iiiii";
					  	$arr = array($debut_partie["par_id"], $joueur["jou_id"], $joueur["jou_team"], $result13[0]["nb_colonies"], $xp_partie);
							  
					  	$bdd->prepare($sql,$bind);
					  	$result12 = $bdd->execute($arr);

					


					// Modifications des elements du joueur
					$sql = "UPDATE joueurs SET jou_parties_id = NULL , jou_ready = 0 , jou_team = NULL , jou_xp = ?
							WHERE jou_id = ? ";

						$bind = "ii";
					  	$arr = array($xp_total, $joueur["jou_id"]);
							  
					  	$bdd->prepare($sql,$bind);
					  	$result13 = $bdd->execute($arr);







				}

				// Destruction des creations_unites
				$sql = "UPDATE parties SET par_wait = NULL 
						WHERE par_id = ? ";

					$bind = "i";
				  	$arr = array($debut_partie["par_id"]);
							  
				  	$bdd->prepare($sql,$bind);
				  	$result14 = $bdd->execute($arr);
					



	  			
	  		}
	  	}














?>