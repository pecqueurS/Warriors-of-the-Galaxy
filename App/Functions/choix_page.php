<?php


/**
 * Check la reponse Get['page'] retourne un string formaté si il n'existe pas.
  */
function if_get_page () {

	if(isset($_GET['page']) && is_file(CTRL."pages".DS."ctrl.".$_GET['page'].'.php')) { 
		return $_GET['page'];
	} else { 
		return 'accueil';
	} 
}


?>