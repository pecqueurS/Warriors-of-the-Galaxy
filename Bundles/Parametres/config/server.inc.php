<?php 

// Verification du serveur (WAMP Reseau)
if (server::control_reseau() === TRUE){
	$config["href"] = str_ireplace("localhost", $_SERVER['SERVER_ADDR'], $config["href"]);
}






/**
 * TEST LE SERVEUR ET MODIFIE LES INFOS NECESSAIRES EN FONCTION
 */
if (server::control_serveur() === TRUE){
	ini_set("SMTP","nso.ovh.net" ); // Test si on est en local, sinon modifie le SMTP
	$config['href'] = $href_SERVER; 
	$config['bdd'] = array (
				'username' => 'xxx',
				'password' => 'xxx',
				'database' => $bdd_Database_SERVER,
				'bddServer' => 'xxx');

	$prod = true;
}


/**
 * TEST L'OS ET MODIFIE LES INFOS NECESSAIRES EN FONCTION
 */
$os=server::control_OS();
switch ($os) {
	case 'win':
		$config['href'] = $href_LOCAL_WIN;
		$config['bdd'] = array (
				'username' => 'root',
				'password' => '',
				'database' => $bdd_Database_LOCAL,
				'bddServer' => 'localhost');
		break;
	
	case 'deb':
		$config['href'] = $href_LOCAL_DEB;
		$config['bdd'] = array (
				'username' => 'root',
				'password' => 'Oscar',
				'database' => $bdd_Database_LOCAL,
				'bddServer' => 'localhost');
		break;
	
}



/**
 * TEST LE RESEAU POUR SAVOIR SI ON EST A LA FAC ET MODIFIE LES INFOS NECESSAIRES EN FONCTION
 */
/*if (server::reseau_Fac() === TRUE){
	ini_set("SMTP","smtp.unice.fr" ); // Test si on est à la fac et modifie le SMTP
	ini_set("smtp_port","25" ); // Test si on est à la fac et modifie le port smtp
	ini_set("sendmail_from","ps310612@etu.unice.fr" ); // Test si on est à la fac et modifie le sendmail_from
	$config['email']["admin"] = "ps310612@etu.unice.fr";  // Modifie l'email de reception
}*/


?>