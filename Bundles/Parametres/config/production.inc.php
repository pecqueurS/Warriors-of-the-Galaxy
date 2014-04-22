<?php

/**
 * CHOIX DE L'ENVIRONNEMENT (A MODIFIER A LA MAIN)
 * Environnement de production :
 * PRODUCTION = true
 *
 * Environnement de développement :
 * PRODUCTION = false
 *
 * A MODIFIER DANS LE FICHIER PARAMETRES.PHP
 */
define ('PRODUCTION',$prod); // Mode d'affichage (Production ou developpement





// Gestion d'erreurs
	function userErrorHandler($errno, $errmsg, $filename, $linenum, $vars){
		// Date et heure de l'erreur
		$dt = date("Y-m-d H:i:s (T)");

		// Définit un tableau associatif avec les chaînes d'erreur
		// En fait, les seuls niveaux qui nous interessent
		// sont E_WARNING, E_NOTICE, E_USER_ERROR,
		// E_USER_WARNING et E_USER_NOTICE
		$errortype = array (
			E_ERROR => "Erreur",
			E_WARNING => "Alerte",
			E_PARSE => "Erreur d'analyse",
			E_NOTICE => "Note",
			E_CORE_ERROR => "Core Error",
			E_CORE_WARNING => "CoreWarning",
			E_COMPILE_ERROR => "Compile Error",
			E_COMPILE_WARNING => "Compile Warning",
			E_USER_ERROR => "Erreur spécifique",
			E_USER_WARNING => "Alerte spécifique",
			E_USER_NOTICE => "Note spécifique",
			E_STRICT => "Runtime Notice"
		);


		// Les niveaux qui seront enregistrés
		$user_errors = array(E_ERROR, E_WARNING, E_PARSE, E_USER_ERROR, E_USER_WARNING, E_USER_NOTICE);
		$err = "<errorentry>\n";
		$err .= "\t<datetime>" . $dt . "</datetime>\n";
		$err .= "\t<errornum>" . $errno . "</errornum>\n";
		$err .= "\t<errortype>" . $errortype[$errno] . "</errortype>\n";
		$err .= "\t<errormsg>" . $errmsg . "</errormsg>\n";
		$err .= "\t<scriptname>" . $filename . "</scriptname>\n";
		$err .= "\t<scriptlinenum>" . $linenum . "</scriptlinenum>\n";
		if (in_array($errno, $user_errors)) {
		$err .= "\t<vartrace>".wddx_serialize_value($vars,"Variables")."</vartrace>\n";
		}
		$err .= "</errorentry>\n\n";

		// sauvegarde de l'erreur, et mail si c'est critique
		error_log($err, 3, ROOT."error.xml");
		if ($errno == E_USER_ERROR ||  $errno == E_USER_WARNING ||  $errno == E_USER_NOTICE) {
			mail("stephane.pecqueur@gmail.com",$errno,$err);
			//echo "<p>Erreur utilisateur critique !</p>";
			/*header("Location: ".URL_ERR);*/
			header("HTTP/1.0 500 Internal Server Error");
			echo file_get_contents(URL_ERR500); 
			exit();
		}
	}








/**
 * Initialisation de l'affichage des erreurs en fonction de PRODUCTION
 */
if (PRODUCTION){
	/*error_reporting(E_ALL);
	ini_set('display_errors', 'Off');*/  // n'affiche pas les erreurs en mode production

	error_reporting(0);


	$old_error_handler = set_error_handler("userErrorHandler");


} else {
	error_reporting(E_ALL|E_STRICT);
	ini_set ('display_errors', 'On');  // affiche les erreurs et les fonctions obsoletes en mode developpement
	/**
	 * Initialisation du fichier de error_log
	 */
	ini_set('error_log',ROOT.'php_error.log'); // enregistre les erreurs dans un fichier 'php_error.log'

}











?>