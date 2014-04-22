<?php

// Deconnection
if(!isset($_SESSION["admin"]) || isset($_POST["deconnection"])) {
	$_SESSION["admin"] = FALSE;
}

// Connection
if(isset($_POST["authentification"])) {
	$admin["nom_admin"] = "admin";
	$admin["pwd_admin"] = "admin";
	if($_POST["admin"] == $admin["nom_admin"] && $_POST["pwd"] == $admin["pwd_admin"]) {
		$_SESSION["admin"] = TRUE;
	}
	unset($admin);
} 





// Gestion des onglets

if(isset($_GET["onglets"])) {
	$onglets = array("joueurs", "parties", "messages", "erreurs");
	if (!in_array($_GET["onglets"], $onglets)) {
		// Page inexistante
		header("HTTP/1.1 404 Not Found");
		echo file_get_contents(URL_ERR); 
		exit();
	} else {
		$onglet = $_GET["onglets"];
	}
}






if($_SESSION["admin"]==TRUE) {

	// Section joueurs
	if(isset($onglet) && $onglet=="joueurs") {

		$sql = "SELECT jou_id, jou_activate, jou_avatar, jou_login, jou_xp, con_joueurs_id, vec_connexion, vec_deconnect, jou_parties_id, jou_team, jou_races_id, jou_ready, vec_ip_joueur, vec_sess_id  FROM 
				(SELECT * FROM joueurs
				LEFT JOIN connectes ON ( jou_id = con_joueurs_id )
				LEFT JOIN verif_connections ON ( jou_id = vec_joueurs_id )
				ORDER BY jou_id, vec_connexion DESC ) AS test
				GROUP BY jou_id";

		  	$bdd->prepare($sql);
		  	$result1 = $bdd->execute();





		$joueurs = array();
		for ($i=0; $i < count($result1) ; $i++) { 
			$joueurs[$i] = $result1[$i];

			$joueurs[$i]["jou_activate"] =( $result1[$i]["jou_activate"]==1) ? "<span class='rond green' title='activé'></span>": "<span class='rond red' title='desactivé'></span>";
			$joueurs[$i]["jou_avatar"] = "<img src='/images/avatars/".$result1[$i]["jou_avatar"]."'>";

			$joueurs[$i]["con_joueurs_id"] =(!is_null($result1[$i]["con_joueurs_id"])) ? "<span class='rond green' title='connecté'></span>": "<span class='rond red' title='déconnecté'></span>";

			$joueurs[$i]["jou_parties_id"] =(!is_null($result1[$i]["jou_parties_id"])) ? $result1[$i]["jou_parties_id"] : "<span class='rond red' title='déconnecté'></span>";
			$joueurs[$i]["jou_team"] =(!is_null($result1[$i]["jou_team"])) ? $result1[$i]["jou_team"] : "<span class='rond red' title='déconnecté'></span>";

			$joueurs[$i]["jou_ready"] =( $result1[$i]["jou_ready"]==1) ? "<span class='rond green' title='activé'></span>": "<span class='rond red' title='desactivé'></span>";

		}


	}




	// Section Parties
	if(isset($onglet) && $onglet=="parties") {

		$sql = "SELECT par_id, par_nom, par_pwd, par_nb_joueurs, par_type_end, par_H_debut, par_wait, par_creator FROM parties
				WHERE par_H_debut IS NOT NULL 
				ORDER BY par_id DESC";

		  	$bdd->prepare($sql);
		  	$result2 = $bdd->execute();





		$parties = array();
		for ($i=0; $i < count($result2) ; $i++) { 
			$parties[$i] = $result2[$i];

			$parties[$i]["par_wait"] =( !is_null($result2[$i]["par_wait"])) ? "<span class='rond green' title='en cours'></span>": "<span class='rond red' title='terminée'></span>";

		}




	}





	// Section MESSAGES
	if(isset($onglet) && $onglet=="messages") {

		$sql = "SELECT mea_id, mea_type_message, mea_login, mea_date_mess, mea_date_bug, mea_message FROM messages_admin
				ORDER BY mea_id DESC";

		  	$bdd->prepare($sql);
		  	$result3 = $bdd->execute();





		$bugs = array();
		$abus = array();
		foreach ($result3 as $message) {
			if($message["mea_type_message"]=="bug") {
				unset($message["mea_type_message"]);
				$abus[] = $message;
			}else {
				unset($message["mea_type_message"]);
				$bugs[] = $message;
			}
		}



	}




	// Section Erreurs
	if(isset($onglet) && $onglet=="erreurs") {

		if(PRODUCTION) {
			$file = ROOT."error.xml";
		} else {
			$file = ROOT.'php_error.log';
		}

/*			$fp = fopen(ROOT.'php_error.log',"r"); 
			$erreurs = "";
			while (!feof($fp))
			{
			  $erreurs = fgets($fp, 4096) . $erreurs;
			  $erreurs .= "<br>";
			}
*/

			$erreurs = file_get_contents($file);


	}








}





include(ADMIN."vue".DS."head.php");
include(ADMIN."vue".DS."nav.php");
include(ADMIN."vue".DS."vue.php");

 

?>