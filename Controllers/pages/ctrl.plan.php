<?php


$sql = "SELECT pag_name, tra_nom FROM pages
		INNER JOIN elem_a_trad ON (eat_id = pag_elem_a_trad_id)
		INNER JOIN traductions ON (eat_id = tra_elem_a_trad_id)
		INNER JOIN langues ON (lan_id = tra_langues_id)
		WHERE lan_designation = ? ";



    $bind = "s";
  	$arr = array($_SESSION["lang"]);
				  
  	$bdd->prepare($sql,$bind);
  	$result = $bdd->execute($arr);


  	foreach ($result as $lien) {
  		$req1_INTITULES_LIENS[$lien["pag_name"]] = $lien["tra_nom"];
  	}























$var = array(
	"name_page" => $req1_INTITULES_LIENS,
);

?>