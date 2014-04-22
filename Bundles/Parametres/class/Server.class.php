<?php


class server {



/**
 * ************** METHODES *******************
 */


/** Verifie si on est en local ou sur le reseau
 *  control_reseau()
 *  @return BOL 
 */
public static function control_reseau(){

	if (stristr($_SERVER['SERVER_ADDR'], '192.168') !== FALSE || stristr($_SERVER['SERVER_ADDR'], '134.59.77.20') !== FALSE) {
			return TRUE;
	} else {
			return FALSE;
		}
}


/** Verifie si on est sur le serveur local ou sur le serveur distant
 *  control_serveur()
 *  @return BOL 
 */
public static function control_serveur(){

	if ($_SERVER['SERVER_NAME'] == 'localhost' || 
		$_SERVER['SERVER_NAME'] == 'win.wotg.dev' || // wamp virtualhost
		$_SERVER['SERVER_NAME'] == 'debian.wotg.dev' || // debian virtualhost
		$_SERVER['SERVER_NAME'] == '127.0.0.1' || 
		self::control_reseau() === TRUE){
			return FALSE;
	} else {
			return TRUE;
		}
}



/** Verifie si on est sur le serveur linux ou windows wamp 
 *  control_OS()
 *  @return "win", "deb", FALSE 
 */
public static function control_OS(){

	if ($_SERVER['SERVER_NAME'] == 'win.wotg.dev'){
			return "win";
	} elseif ($_SERVER['SERVER_NAME'] == 'debian.wotg.dev') {
			return "deb";
	} else {
		return FALSE;
	}
}




/** Verifie si on est sur le serveur de la fac ou pas
 *  reseau_Fac()
 *  @return BOL 
 */
public static function reseau_Fac(){
	$res = shell_exec("ipconfig");
	if (strpos($res, '134.59.77') !== FALSE) {
			return TRUE;
	} else {
			return FALSE;
		}

}





} 




?>