<?php


class Game {


	private $post;


	public function create_game($post) {
		$mdp = (isset($post["mdp"])) ? $post["mdp"] : false;
		$game_name = $post["game_name"];
		$players = $post["players"];
		$end = $post["end"];




		$bdd = new BDD();



		$sql = "INSERT INTO parties VALUES ( NULL , ? , ? , ? , 'TIME' , NULL , FALSE, ? )";



	    $bind = "ssis";
	  	$arr = array($game_name,$mdp,$players,$_SESSION["joueur"]["jou_login"]);
	  
	  	$bdd->prepare($sql,$bind);
	  	$result = $bdd->execute($arr);
	  	$last_id = $bdd->get_last_id();
	
	  	if($result) {

			$sql = "UPDATE joueurs SET jou_parties_id = $last_id WHERE jou_id = ? ";

		    $bind = "i";
		  	$arr = array($_SESSION["joueur"]["jou_id"]);
		  
		  	$bdd->prepare($sql,$bind);
		  	$result2 = $bdd->execute($arr);

		  	
		  	if($result2) {

		  		$_SESSION["joueur"]["jou_parties_id"] = $last_id;
		  		return true;

		  	}

	  	}

	  	return false;
		
	}




// Information sur la partie
	public function info_partie($req4_DICO){
		$bdd = new BDD();
		
	/*REQUETE 6 : informations partie en attente -> $req6_INFO_WAIT_GAME */
		$sql = "SELECT par_id, par_nom, par_pwd, par_nb_joueurs, par_type_end, par_H_debut, par_wait, par_creator FROM parties WHERE par_id = ? ";

	    $bind = "i";
	    $arr = array($_SESSION["joueur"]["jou_parties_id"]);
	  
	    $bdd->prepare($sql,$bind);
	    $result = $bdd->execute($arr);



	    if(empty($result)) {
	    	header("location:".URL_PROFIL);
	    } else {
			$_SESSION["partie"]["id"] = $result[0]["par_id"];
			$_SESSION["partie"]["nom"] = $result[0]["par_nom"];
			$_SESSION["partie"]["pwd"] = ($result[0]!="") ? "YES" : "NO";
			$_SESSION["partie"]["max_play"] = $result[0]["par_nb_joueurs"];
			$_SESSION["partie"]["end"] = $req4_DICO["time_lapse"];
	    }

	    return $result;


	}




 
// Inforamtion sur les différentes races
	public function info_race(){
		$bdd = new BDD();
		
	/*Requete 7 : Les races -> req7_RACE_INFO*/

		$sql = "SELECT rac_designation, tra_nom FROM races
				INNER JOIN elem_a_trad ON (eat_id= rac_elem_a_trad_id)
				INNER JOIN traductions ON (eat_id=tra_elem_a_trad_id)
				INNER JOIN langues ON (lan_id=tra_langues_id)
				WHERE lan_designation = ? ";

		    $bind = "s";
		    $arr = array($_SESSION["lang"]);
		  
		    $bdd->prepare($sql,$bind);
		    $result = $bdd->execute($arr);

		$req7_RACE_INFO = array();
		foreach ($result as $race) {
			$req7_RACE_INFO[$race["rac_designation"]] = $race['tra_nom'];
		}

	    return $req7_RACE_INFO;


	}




 

// Information sur les joueurs participant à la partie
	public function players_in_game($req4_DICO){
		$bdd = new BDD();
		
		/*Requete 8 : Les joueurs ->req8_JOUEURS_PARTIE*/

		$sql = "SELECT jou_id, jou_ready, jou_login, jou_races_id, jou_team FROM joueurs WHERE jou_parties_id = ? ";

		    $bind = "i";
		    $arr = array($_SESSION["partie"]["id"]);
		  
		    $bdd->prepare($sql,$bind);
		    $result = $bdd->execute($arr);


		$select = "<select name=\"team\">";
		for ($i=1; $i <= 8; $i++) { 
			if($i==1){ $select .= "<option value=\"$i\" selected>{$req4_DICO['team']} $i</option>";} 
			else { $select .= "<option value=\"$i\">{$req4_DICO['team']} $i</option>";}
		}
		$select .= "</select>";

		$racestab = array("",$req4_DICO["humans"],$req4_DICO["reptils"],$req4_DICO["arachnids"]);

		$i=0;
		foreach ($result as $joueur) {
			$req8_JOUEURS_PARTIE[$i]["selected"] = ($joueur['jou_id']==$_SESSION["joueur"]["jou_id"]) ? " class=\"selected\"" : "" ;
			$req8_JOUEURS_PARTIE[$i]["ready"] = ($joueur['jou_ready']==0) ? "<div class=\"link empty1\"></div>" : "<div class=\"link valid\"></div>";
			$req8_JOUEURS_PARTIE[$i]["player"] = $joueur['jou_login'];
			$req8_JOUEURS_PARTIE[$i]["race"] = (is_null($joueur['jou_races_id'])) ? $racestab[0] : $racestab[$joueur['jou_races_id']];
			

			if ($joueur['jou_id']==$_SESSION["joueur"]["jou_id"] && $_SESSION["joueur"]["jou_ready"] == 0) $req8_JOUEURS_PARTIE[$i]["team"] = $select;
			else $req8_JOUEURS_PARTIE[$i]["team"] = (is_null($joueur['jou_team'])) ? 0 : $req4_DICO["team"]." ".$joueur['jou_team'] ;
			$i++;
		}


	    return $req8_JOUEURS_PARTIE;


	}




 
// Affiche les messages du chat
	public function affiche_msg($last_id=""){
		$bdd = new BDD();
		

		if($last_id != "") {
			$the_lasts = "AND cha_id > ".$last_id;
		} else {
			$the_lasts = "";
		}


		/*Requete 9 : Le chat -> $req9_CHAT*/

		$sql = "SELECT cha_id, jou_login, cha_message FROM joueurs 
				INNER JOIN chat ON (jou_id=cha_joueurs_id)
				WHERE cha_parties_id = ? 
				$the_lasts
				ORDER BY cha_time DESC";

		    $bind = "i";
		    $arr = array($_SESSION["partie"]["id"]);
		  
		    $bdd->prepare($sql,$bind);
		    $result = $bdd->execute($arr);

		    $req9_CHAT = array();
		    $i = 0;
		    foreach ($result as $message) {
		    	$req9_CHAT[$i]["id"] = $message["cha_id"];
		    	$req9_CHAT[$i]["joueur"] = $message["jou_login"];
		    	$req9_CHAT[$i]["message"] = $message["cha_message"];
		    	$i++;
		    }



	    return $req9_CHAT;


	}




// Envoi un message sur le chat chat
	public function send_msg($post){
		$bdd = new BDD();
		
		/*Requete 9 : Le chat -> $req9_CHAT*/

		$sql = "INSERT INTO chat VALUES (NULL, ? , CURRENT_TIMESTAMP , ? , ? )";

		    $bind = "isi";
		    $arr = array($_SESSION["joueur"]["jou_id"], $post["message"], $_SESSION["partie"]["id"] );
		  
		    $bdd->prepare($sql,$bind);
		    $result = $bdd->execute($arr);



	    return $result;


	}




 




// Met a jour les informations du joueur quand il est pret
	public function player_ready($post){
		$bdd = new BDD();
		
		/*Requete 10 : Update des joueurs quand ready*/
		$sql = "UPDATE joueurs SET jou_ready = 1 , jou_team = ? , jou_races_id = ? WHERE jou_id = ? ";

		    $bind = "iii";
		    $arr = array($post["team"], $post["race"], $_SESSION["joueur"]["jou_id"]);
		  
		    $bdd->prepare($sql,$bind);
		    $result = $bdd->execute($arr);


			if($result==1) {
				$_SESSION["joueur"]["jou_ready"] = 1;
				$_SESSION["joueur"]["jou_team"] = $post["team"];
				$_SESSION["joueur"]["jou_races_id"] = $post["race"];

			}



	    return $result;


	}






// Met a jour les informations du joueur quand il est pret
	public function change_team($post){
		$bdd = new BDD();
		
		/*Requete 10 : Update des joueurs quand ready*/
		$sql = "UPDATE joueurs SET jou_team = ? WHERE jou_id = ? ";

		    $bind = "ii";
		    $arr = array($post["team"], $_SESSION["joueur"]["jou_id"]);
		  
		    $bdd->prepare($sql,$bind);
		    $result = $bdd->execute($arr);


			if($result==1) {
				$_SESSION["joueur"]["jou_team"] = $post["team"];
			}



	    return $result;


	}







// Met a jour les informations du joueur quand il est pret
	public function change_race($post){
		$bdd = new BDD();
		
		/*Requete 10 : Update des joueurs quand ready*/
		$sql = "UPDATE joueurs SET jou_races_id = ? WHERE jou_id = ? ";

		    $bind = "ii";
		    $arr = array($post["race"], $_SESSION["joueur"]["jou_id"]);
		  
		    $bdd->prepare($sql,$bind);
		    $result = $bdd->execute($arr);


			if($result==1) {
				$_SESSION["joueur"]["jou_races_id"] = $post["race"];
			}



	    return $result;


	}















	public function launch() {
		$bdd = new BDD();


		$sql = "SELECT par_wait, par_H_debut FROM parties WHERE par_id= ? ";

		    $bind = "i";
		  	$arr = array($_SESSION["partie"]["id"]);
		  
		  	$bdd->prepare($sql,$bind);
		  	$result = $bdd->execute($arr);

	
		  	if($result[0]["par_wait"] == 1 ) {
		  		return true;
		  	} else {

		  		// MISE EN ROUTE DE LA PARTIE
				$sql = "UPDATE parties SET par_wait = 1 , par_H_debut = CURRENT_TIMESTAMP WHERE par_id = ? ";

				    $bind = "i";
				  	$arr = array($_SESSION["partie"]["id"]);
				  
				  	$bdd->prepare($sql,$bind);
				  	$result = $bdd->execute($arr);

				  	if($result == 1) {

				  		// SELECTION DES JOUEURS DE LA PARTIE
						$sql = "SELECT jou_id FROM joueurs WHERE jou_parties_id = ? ";

						    $bind = "i";
						  	$arr = array($_SESSION["partie"]["id"]);
						  
						  	$bdd->prepare($sql,$bind);
						  	$result2 = $bdd->execute($arr);

						  	$count_joueurs = count($result2);
						  	//$_SESSION["test"] = $count_joueurs;

						  	// INITIALISATION DES PARAMETRES DE CHAQUE JOUEUR
						  	for ($i=0; $i < $count_joueurs; $i++) { 
						  		// INITIALISATION DES BATIMENTS
						  		$sql = "INSERT INTO batiments VALUES (NULL, {$result2[$i]['jou_id']}, ? , 1 , NULL )";

								    $bind = "i";
								  
								  	$bdd->prepare($sql,$bind);
						  		for ($j=1; $j <= 6; $j++) { 
						  			
								  	$arr = array($j);

								  	$result3 = $bdd->execute($arr);

						  		}
								
						  	


						  		// INITIALISATION DE LA CARTE
						  		if($i==0) {
						  			$coord["X"] = rand(1, 15);
						  			$coord["Y"] = rand(1, 15);
						  		} else {
									$sql = "SELECT car_pos_x, car_pos_y FROM CARTE
											WHERE car_parties_id = ? ";

									    $bind = "i";
									  	$arr = array($_SESSION["partie"]["id"]);
									  
									  	$bdd->prepare($sql,$bind);
									  	$result4 = $bdd->execute($arr);
									

									do {
										$coord = array(
												"X" => rand(1, 15),
												"Y" => rand(1, 15),
											);
									} while (in_array($coord, $result4));

						  		}


						  		$sql = "INSERT INTO carte VALUES (NULL, ? , ? , ? , ? , \"base\" )";

								    $bind = "iiii";
								  	$arr = array($result2[$i]['jou_id'], $_SESSION["partie"]["id"], $coord["X"], $coord["Y"]);
								  
								  	$bdd->prepare($sql,$bind);
								  	$result5 = $bdd->execute($arr);




								// INITIALISATION DES RESSOURCES
						  		$sql = "INSERT INTO ressources VALUES (NULL, ? , ? , 1000 , 1 , CURRENT_TIMESTAMP , 1 )";

								    $bind = "ii";
								  
								  	$bdd->prepare($sql,$bind);
						  		for ($j=1; $j <= 3; $j++) { 
						  			
								  	$arr = array($result2[$i]['jou_id'],$j);

								  	$result6 = $bdd->execute($arr);

						  		}
								
						  	



								// INITIALISATION DES UNITES
						  		$sql = "INSERT INTO total_units VALUES (NULL, ? , 0 , 0 , 0 )";

								    $bind = "i";
								  
								  	$bdd->prepare($sql,$bind);
						  			
								  	$arr = array($result2[$i]['jou_id']);

								  	$result7 = $bdd->execute($arr);

						  		
								// INITIALISATION DES TEAMS
						  		$sql = "INSERT INTO teams VALUES (NULL, ? , 0 , 0 , 0 , ? , ? , 1)";

								    $bind = "iii";
								  
								  	$bdd->prepare($sql,$bind);
						  			
								  	$arr = array($result2[$i]['jou_id'], $coord["X"], $coord["Y"]);

								  	$result8 = $bdd->execute($arr);

						  		
								
						  	













							}


				  		return true;
				  	}
		  	}

			return false;
	}










	public function waiting_games($search="") {
		$bdd = new BDD();


		$sql = "SELECT par_id, par_pwd, par_nom, par_nb_joueurs, par_creator FROM parties WHERE par_wait= ? AND par_H_debut IS NULL";


			if($search==""){
			    $bind = "i";
			  	$arr = array(0);
			  

			} else{
				$sql .= "AND par_nom LIKE ? ";
			    $bind = "is";
			  	$arr = array(0, "%$search%");
			  

			}

			$bdd->prepare($sql,$bind);
		  	$result = $bdd->execute($arr);

		  	
		  	$req12_WAITING_GAMES = array();
		  	if(!empty($result)) {
		  		$i = 0;
		  		foreach ($result as $partie) {
					$sql = "SELECT COUNT(*) FROM joueurs WHERE jou_parties_id = ? ";

					    $bind = "i";
					  	$arr = array($partie["par_id"]);
					  
					  	$bdd->prepare($sql,$bind);
					  	$result2 = $bdd->execute($arr);


					  	$nb_joueurs_reels = $result2[0]["COUNT(*)"];	
		  		

					  	$req12_WAITING_GAMES[$i]["id"] = $partie["par_id"];
					  	$req12_WAITING_GAMES[$i]["pwd"] = (empty($partie["par_pwd"])) ? "" : "<div class=\"link mdp\" title=\"protected\"></div>";
					  	$req12_WAITING_GAMES[$i]["name"] = $partie["par_nom"];
					  	$req12_WAITING_GAMES[$i]["players"] = $nb_joueurs_reels."/".$partie["par_nb_joueurs"];
					  	$req12_WAITING_GAMES[$i]["creator"] = $partie["par_creator"];

					  	$i++;
		  		}


		  	}
		  	return $req12_WAITING_GAMES;


	}







	public function join_game($id_partie, $mdp="") {
			$bdd = new BDD();



			$sql = "SELECT par_pwd FROM parties WHERE par_id = ? ";



		    $bind = "i";
		  	$arr = array($id_partie);
		  
		  	$bdd->prepare($sql,$bind);
		  	$result = $bdd->execute($arr);

		
		  	if(!empty($result)) {

		  		if(empty($result[0]["par_pwd"])) {
		  			$verif_mdp= true;
		  		} else {
		  			$verif_mdp = ($result[0]["par_pwd"]==$mdp) ? true : false;
		  		}



		  		if($verif_mdp) {

				$sql = "UPDATE joueurs SET jou_parties_id = ? WHERE jou_id = ? ";

			    $bind = "ii";
			  	$arr = array($id_partie, $_SESSION["joueur"]["jou_id"]);
			  
			  	$bdd->prepare($sql,$bind);
			  	$result2 = $bdd->execute($arr);


			  	
				  	if($result2 || $_SESSION["joueur"]["jou_parties_id"]==$id_partie) {

				  		$_SESSION["joueur"]["jou_parties_id"] = intval($id_partie);
				  		return true;

				  	} else {
				  		return false;
				  	}

		  		} else {
		  			$_SESSION["message"] = "mot de passe incorrect !";
		  			return false;
		  		}

		  	} else {
		  		return false;
		  	}

		  	
			

	}





}





?>