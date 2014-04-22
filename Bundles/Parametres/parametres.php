<?php

session_start();


// PARAMETRES :
$href_LOCAL_WIN = "http://win.wotg.dev/";  // Adresse du site sur wamp
$href_LOCAL_DEB = "http://debian.wotg.dev/";  // Adresse du site sur wamp
$href_SERVER = "http://wotg.azurdesignsolution.com/";  // Adresse du site sur le serveur distant

$bdd_Database_LOCAL = "galaxy_warriors";  	// Database 
$bdd_Database_SERVER = "azurdesiads";  	// Database SERVER
// PENSER A MODIFIER AUSSI server.inc.php pour les infos serveur distant



/**
 * CHOIX DE L'ENVIRONNEMENT (A MODIFIER A LA MAIN)
 * Environnement de production :
 * PRODUCTION = true
 *
 * Environnement de développement :
 * PRODUCTION = false
 */
$prod = false;




/**
 * FICHIER DE PARAMETRAGE
 * 1. Creation du ROOT
 * 2. Inclusion des classes servant au parametrage
 * 3. Inclusion des fichiers de configuration
 * 4. CHOIX DE L'ENVIRONNEMENT
 * 5. Choix langues
 */


//////////////////////// 1. Creation du ROOT ////////////////////////

// Fichier root
require_once ('../Bundles/Parametres/config/root.inc.php');





////////// 2. Inclusion des classes servant au parametrage //////////

// CLASS pour la configuration du serveur
require_once (PAR_CLASS.'Server.class.php');


////////// 3. Inclusion des fichiers de configuration //////////

// Fichier de configuration
require_once (CONFIG.'config.inc.php');
// Modification du fichier config en fonction du serveur
require_once (CONFIG.'server.inc.php');
// Implantation des Constantes
require_once (CONFIG.'constant.inc.php');



//////////////////////// 4. CHOIX DE L'ENVIRONNEMENT ////////////////////////

// Implantation du mode d'affichage des erreurs
require_once (CONFIG.'production.inc.php');



//////////////////////// 5. Langue ////////////////////////

// Implantation du mode d'affichage des erreurs
require_once (CONFIG.'lang.inc.php');








?>