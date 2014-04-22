<?php
	// Inclus la page de parametres
	require_once ("../Bundles/Parametres/parametres.php");


if(isset($_POST["session"]) || isset($_POST["page"])) {


	// Appel BDD
	require_once (BDD."bdd.php");

/*Initialisation BDD */
$bdd = new BDD();


	// Appel functions
	require_once (FUNCTIONS."functions.php");


	// Appel functions
	require_once (CALCULS."calculs.php");






	// Appel profil
	require_once (PROFIL."profil.php");

	// Appel game
	require_once (GAME."game.php");







	/*REQUETE 1 : Recuperation des pages -> $req_PAGES_NAME */
	$sql = "SELECT pag_name FROM `pages`";

	 	$bdd->requete($sql);
	  
	  	$result = $bdd->retourne_tableau();

	    $req1_PAGES_NAME = array();
	    foreach($result as $value) {
	        $req1_PAGES_NAME[] = $value["pag_name"];
	    }

	$data = array();

	/*Ajax session*/
	if(isset($_POST["session"]) && $_POST["session"]=="session") {
		// Appel ajax

		require_once (AJAX."ajax.".$_POST["session"].".php");

	}


	/*Sur quelle page sommes-nous ? cf-functions.php*/
	if(isset($_POST["page"]) && in_array($_POST["page"], $req1_PAGES_NAME)) {
		// Appel ajax

		require_once (AJAX."ajax.".$_POST["page"].".php");

	}


	



echo json_encode($data);

}





?>