<?php
// Inclus la page de parametres
require_once ("../Bundles/Parametres/parametres.php");


// Appel BDD
require_once (BDD."bdd.php");

/*Initialisation BDD */
$bdd = new BDD();


// Appel functions
require_once (FUNCTIONS."functions.php");

// Appel calculs
require_once (CALCULS."calculs.php");




// Appel Modele
require_once (CTRL."controlleurs.php");






// Appel templates
require_once (TEMPLATES."template.php");
















//var_dump($_POST);
//var_dump($_FILES);
//var_dump($_SESSION);
//var_dump($_SERVER);
//var_dump(get_defined_vars()); 
?>