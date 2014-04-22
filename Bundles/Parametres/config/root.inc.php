<?php
/**
 * CONSTANTES :
 */

// Constantes DOSSIER PHP
define ('DS', DIRECTORY_SEPARATOR); // '/' ou '\'
define ('CONFIG', __DIR__.DS); // c:\wamp\www\...\config\

// BUNDLE PARAMETRE
define ('PARAM', dirname(CONFIG).DS); // c:\wamp\www\...\parametres\
define ('PAR_CLASS',PARAM.'class'.DS); // c:\wamp\www\...\parametres\class\

define ('BUNDLES', dirname(PARAM).DS); // c:\wamp\www\...\php\

// ROOT ET WEBROOT
define ('ROOT',dirname (BUNDLES).DS); // c:\wamp\www\...\LP_IMAPP\
define ('WEBROOT', ROOT."www".DS); // c:\wamp\www\...\portfolio\

// BUNDLE BDD
define('BDD',BUNDLES."Bdd".DS); // c:\wamp\www\...\php\bdd\

// BUNDLE CALCULS
define('CALCULS',BUNDLES."calculs".DS); // c:\wamp\www\...\php\bdd\

// BUNDLE FUNCTIONS
define('FUNCTIONS',BUNDLES."Functions".DS); // c:\wamp\www\...\php\bdd\

// BUNDLE GAME
define('GAME',BUNDLES."game".DS); // c:\wamp\www\...\php\bdd\

// BUNDLE PROFIL
define('PROFIL',BUNDLES."Profil".DS); // c:\wamp\www\...\php\bdd\

// BUNDLE TEMPLATES
define('TEMPLATES',BUNDLES."Templates".DS); // c:\wamp\www\...\php\formulaire\
define('CONTENU',TEMPLATES."contenu".DS); // c:\wamp\www\...\php\formulaire\

// BUNDLE AJAX
define('AJAX',BUNDLES."Ajax".DS); // c:\wamp\www\...\php\bdd\

// BUNDLE ADMINISTRATION
define('ADMIN',BUNDLES."Administration".DS); // c:\wamp\www\...\php\bdd\



// CONTROLEURS
define ('CTRL', ROOT."Controlleurs".DS); // c:\wamp\www\...\portfolio\


// AVATARS
define ('AVATARS', WEBROOT."images".DS."avatars".DS); // c:\wamp\www\...\portfolio\


// Lien page d'erreur
define ('URL_ERR',WEBROOT."error".DS.'404.html'); // http://localhost/LP_IMAPP/.../index.php?page=accueil
define ('URL_ERR500',WEBROOT."error".DS.'500.html'); // http://localhost/LP_IMAPP/.../index.php?page=accueil

?>