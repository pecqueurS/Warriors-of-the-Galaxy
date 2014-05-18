<?php


/**
 * Check la reponse Get['page'] retourne un string formaté si il n'existe pas.
  */
function recup_page () {
	/*Initialisation BDD */
	$bdd = new BDD();

	/*REQUETE 1 : Recuperation des pages -> $req_PAGES_NAME */
	$sql = "SELECT pag_name FROM `pages`";

	 	$bdd->requete($sql);
	  
	  	$result = $bdd->retourne_tableau();

	    $req1_PAGES_NAME = array();
	    foreach($result as $value) {
	        $req1_PAGES_NAME[] = $value["pag_name"];
	    }

	    return $req1_PAGES_NAME;
}


?>