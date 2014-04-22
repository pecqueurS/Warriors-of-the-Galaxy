<?php

// nouvel objet partie
$game = new Game();



// MISE A JOUR DES INFORMATIONS DE LA PAGE
if(isset($_POST["action"]) && $_POST["action"] == "maj") {


	/*REQUETE 2 : Dictionnaire -> $req4_DICO */
	$sql = "SELECT dic_designation,dic_traduction FROM `dictionnaire`
	    INNER JOIN `langues` ON (lan_id = dic_langues_id)
	    WHERE dic_designation IN ('team', 'humans', 'reptils', 'arachnids')
	    AND `lan_designation` = ? ";

	    $bind = "s";
	    $arr = array($_SESSION["lang"]);
	  
	    $bdd->prepare($sql,$bind);
	    $result = $bdd->execute($arr);

	$req4_DICO = array();
	foreach ($result as $dico) {
	  $req4_DICO[$dico["dic_designation"]] = $dico["dic_traduction"];
	}


	/*Requete 3 : Les joueurs ->req8_JOUEURS_PARTIE*/
	$req8_JOUEURS_PARTIE = $game->players_in_game($req4_DICO);
//var_dump($_POST["last_id"]);
	/*Requete 4 : Le chat -> $req9_CHAT*/
	if($_POST["last_id"]!="{ID_CHAT}" ){
		$req9_CHAT = $game->affiche_msg($_POST["last_id"]);
	} else {
		$req9_CHAT = $game->affiche_msg();
	}






	/*Requete 5 : ready -> $ready*/
		$sql = "SELECT jou_ready FROM joueurs WHERE jou_parties_id = ? ";

		    $bind = "i";
		    $arr = array($_SESSION["partie"]["id"]);
		  
		    $bdd->prepare($sql,$bind);
		    $result = $bdd->execute($arr);


		    $count_joueurs = count($result);

		    $count_ready = 0;
		    foreach ($result as $joueur) {
		    	if($joueur["jou_ready"]==1) {
		    		$count_ready ++ ;
		    	}
		    }

		    if($count_ready==$count_joueurs) {
		    	//if($_SESSION["partie"]["max_play"] == $count_joueurs ) {
		    		if($game->launch()) {
		    			$ready = true;
		    		} else {
		    			$ready = false;
		    		}
		    	//}
		    } else {
		    	$ready = false;
		    }








	$data["joueurs"] = $req8_JOUEURS_PARTIE;
	$data["chat"] = $req9_CHAT;

	$data["ready"] = $ready;







}








// ENVOI D'UN MESSAGE
if(isset($_POST["action"]) && $_POST["action"] == "sendMess") {


	/* Envoi d'un message */
	/*Requete 11 : insert un nouveau message*/
	
		$verif_post = new Check_data();
		if($verif_post->check_data($_POST["message"],"txt",array(5,256))) {

			$post["message"] = $_POST["message"];

			/*Requete 11 : insert un nouveau message*/
			$result = $game->send_msg($post);

			    if($result!=1) {
			    		$data["sendMess"] = "Un probleme est survenu";
			    } else {
			    	$data["sendMess"] = "";
			    }


		} else {
				$data["sendMess"] = "Votre message est trop long. Max 255 caractères";
		}

	

	


	
}








// JOUEUR READY
if(isset($_POST["action"]) && $_POST["action"] == "ready") {


/*Ready ?*/
/*Requete 10 : Update des joueurs quand ready*/
	$verif_post = new Check_data();
	if($verif_post->check_data($_POST["team"],"num",false)) {
			switch ($_POST["race"]) {
				case 'reptilians':
					$post["race"] = 2;
					break;
				
				case 'arachnids':
					$post["race"] = 3;
					break;
				
				default:
					$post["race"] = 1;
					break;
			}
			$post["team"] = $_POST['team'];
		/*Requete 10 : Update des joueurs quand ready*/
		$data["ready"] = $game->player_ready($post);


	}



}

















// CHANGE team
if(isset($_POST["action"]) && $_POST["action"] == "changeTeam") {

	$verif_post = new Check_data();
	if($verif_post->check_data($_POST["team"],"num",false)) {
			$post["team"] = $_POST['team'];
		/*Requete 11 : Modifie l'equipe du joueur*/
		$result = $game->change_team($post);
			if($result!=1) {
				$data["team"] = "Un probleme est survenu";
			} else {
			  	$data["team"] = "";
			}

	}



}




// CHANGE race
if(isset($_POST["action"]) && $_POST["action"] == "changeRace") {

		switch ($_POST["race"]) {
			case 'reptilians':
				$post["race"] = 2;
				break;
			
			case 'arachnids':
				$post["race"] = 3;
				break;
			
			default:
				$post["race"] = 1;
				break;
		}
	/*Requete 11 : Modifie l'equipe du joueur*/
		$result = $game->change_race($post);
			if($result!=1) {
				$data["race"] = "Un probleme est survenu";
			} else {
			  	$data["race"] = "";
			}

	



}

















?>