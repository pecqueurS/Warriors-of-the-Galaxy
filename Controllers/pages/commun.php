<?php
/*REQUETE 1 : Recuperation des pages -> $req_PAGES_NAME */
$sql = "SELECT pag_name, pag_template FROM `pages`";

 	$bdd->requete($sql);
  
  	$result = $bdd->retourne_tableau();

    $req1_PAGES_NAME = array();
    $req1bis_PAGES_STYLE_ACCUEIL = array();
    foreach($result as $value) {
        $req1_PAGES_NAME[] = $value["pag_name"];
        if($value["pag_template"] == "styleAccueil") $req1bis_PAGES_STYLE_ACCUEIL[] = $value["pag_name"];
    }



/*REDIRECTION PAGE ADMIN*/
if(isset($_GET["page"]) && $_GET["page"]=="wotg-admin") {
  require_once(ADMIN."index.php") ;
  exit();
}








/*Sur quelle page sommes-nous ? cf-functions.php*/

if(isset($_GET["page"]) && in_array($_GET["page"], $req1_PAGES_NAME)) {
	$page = if_get_page (); 
} elseif (!isset($_GET["page"])) {
  // Racine du site
  $page = "accueil";
} else {
  // Page inexistante
  header("HTTP/1.1 404 Not Found");
  echo file_get_contents(URL_ERR); 
  exit();
  //header("location: 404");

}


// NOSCRIPT
if(in_array($page, $req1bis_PAGES_STYLE_ACCUEIL)) {
  $noscript = "<p class=\"error\">Attention. Javascript est obligatoire pour acceder à la partie privée. En effet, ce jeu est basé notamment sur les langages PHP, AJAX et javascript. Sans ces outils, l'expérience de jeu serait quasi nulle. c'est pourquoi, nous vous invitons à activer javascript si vous souhaitez approfondir l'expérience.</p>";
} else {
  $noscript = "<meta http-equiv=\"refresh\" content=\"1; URL=".URL_ACCUEIL."\">";
}









/*REQUETE 2 : Recuperation de la traduction de la page -> $req2_PAGE_HEAD_INFO */
$sql = "SELECT tra_nom,pag_name,pag_template FROM `pages`
		INNER JOIN `elem_a_trad` ON (eat_id = pag_elem_a_trad_id )
		INNER JOIN `traductions` ON (eat_id = tra_elem_a_trad_id)
		INNER JOIN `langues` ON (lan_id = tra_langues_id)
		WHERE `lan_designation` = ? AND `pag_name` = ? ";

    $bind = "ss";
  	$arr = array($_SESSION["lang"], $page);
  
  	$bdd->prepare($sql,$bind);
  	$result = $bdd->execute($arr);


$req2_PAGE_HEAD_INFO["traduction"] = $result[0]["tra_nom"];
$req2_PAGE_HEAD_INFO["page"] = $result[0]["pag_name"];
$req2_PAGE_HEAD_INFO["template"] = $result[0]["pag_template"];













/*REQUETE 3 : traduction des pages -> $req3_LINKS */
$sql = "SELECT tra_nom,pag_name FROM `pages`
		INNER JOIN `elem_a_trad` ON (eat_id = pag_elem_a_trad_id )
		INNER JOIN `traductions` ON (eat_id = tra_elem_a_trad_id)
		INNER JOIN `langues` ON (lan_id = tra_langues_id)
		WHERE `lan_designation` = ? ";

    $bind = "s";
  	$arr = array($_SESSION["lang"]);
  
  	$bdd->prepare($sql,$bind);
  	$result = $bdd->execute($arr);

$req3_LINKS = array();
foreach ($result as $lien) {
	$req3_LINKS[$lien["pag_name"]] = $lien["tra_nom"];
}








/*REQUETE 4 : Dictionnaire -> $req4_DICO */
$sql = "SELECT dic_designation,dic_traduction FROM `dictionnaire`
    INNER JOIN `langues` ON (lan_id = dic_langues_id)
    WHERE `lan_designation` = ? ";

    $bind = "s";
    $arr = array($_SESSION["lang"]);
  
    $bdd->prepare($sql,$bind);
    $result = $bdd->execute($arr);

$req4_DICO = array();
foreach ($result as $dico) {
  $req4_DICO[$dico["dic_designation"]] = $dico["dic_traduction"];
}







/*REQUETE 5 : Description par page -> $req5_DESC_PAGE */
$sql = "SELECT tra_nom FROM `pages`
    INNER JOIN `desc_pages` ON (`pag_id` = `dep_pages_id`)
    INNER JOIN `elem_a_trad` ON (`eat_id` = `dep_elem_a_trad_id`)
    INNER JOIN `traductions` ON (`eat_id` = `tra_elem_a_trad_id`)
    INNER JOIN `langues` ON (`lan_id` = `tra_langues_id`)
    WHERE `pag_name` = ?
    AND `lan_designation` = ? ";

    $bind = "ss";
    $arr = array($page, $_SESSION["lang"]);
  
    $bdd->prepare($sql,$bind);
    $result = $bdd->execute($arr);


$req5_DESC_PAGE = array();
foreach ($result as $desc) {
  $req5_DESC_PAGE[] = $desc["tra_nom"];
}










?>