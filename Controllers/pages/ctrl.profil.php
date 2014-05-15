<?php

// Appel profil
require_once (PROFIL."profil.php");


// Renvoi sur ACCUEIL si on est pas connecté
$profil = new Profil();

$profil->verif_connect();


if(isset($_SESSION["partie"]) && is_int($_SESSION["joueur"]["jou_parties_id"])) {
	header("location:".URL_WAIT);
}





// MODIF PROFIL
if(isset($_POST["update"])) {

	if($_FILES["avatar"]["name"] != ""){
		$profil->update_profil("avatar");
	}

	if($_POST["pwdNew"] != "") {
		$verif_post = new Check_data();

		if($verif_post->check_data($_POST["pwdOld"],"mdp",array(6,16)) 
			&& $verif_post->check_data($_POST["pwdNew"],"mdp",array(6,16)) 
			&& $verif_post->check_data($_POST["confirmPwd"],"mdp",array(6,16)) 
			&& $_POST["pwdNew"]==$_POST["confirmPwd"] ) {


			$post["mdpOld"] = $_POST["pwdOld"];
			$post["mdpNew"] = $_POST["pwdNew"];
			
			$profil->update_profil("mdp", $post);
		}

	}

	if($_POST["EmailNew"] != "") {
		$verif_post = new Check_data();

		if($verif_post->check_data($_POST["EmailOld"],"email",false) 
			&& $verif_post->check_data($_POST["EmailNew"],"email",false) 
			&& $verif_post->check_data($_POST["confirmEmail"],"email",false) 
			&& $_POST["EmailNew"]==$_POST["confirmEmail"] ) {


			$post["emailOld"] = $_POST["EmailOld"];
			$post["emailNew"] = $_POST["EmailNew"];
			
			$profil->update_profil("email", $post);
		}

	}







}




//HEURE
if($_SESSION["lang"]=="en") {
	// Affichage de quelque chose comme :8th Aug 2005 - 03:12PM
	$date = date('jS M Y - h:iA');

} else {
	// Affichage de quelque chose comme :8 aou 2005	- 15:30
	$mois = date("n")-1;
	$arrMois = array("Jan","Fév","Mars","Avr","Mai","Juin","Juil","Aout","Sept","Oct","Nov","Dec");

	$date = date("j ").$arrMois[$mois]." ".date("Y - H:i");


}



//RANKING
/*REQUETE 5 : Description par page -> $req6_JOUEURS_CLASSEMENT */
$sql = "SELECT jou_id, jou_login, jou_xp FROM joueurs ORDER BY jou_xp DESC";

    
    $arr = array($page, $_SESSION["lang"]);
  
    $bdd->prepare($sql);
    $result = $bdd->execute();

    $i= 0;
    $req6_JOUEURS_CLASSEMENT = array();
	foreach ($result as $joueur) {
	  $req6_JOUEURS_CLASSEMENT[$i]["selected"] = ($_SESSION["joueur"]["jou_id"] == $joueur["jou_id"]) ? "class=\"selected\"" : "" ;
	  $req6_JOUEURS_CLASSEMENT[$i]["pos"] = $i+1;
	  $req6_JOUEURS_CLASSEMENT[$i]["joueur"] = $joueur["jou_login"];
	  $req6_JOUEURS_CLASSEMENT[$i]["xp"] = $joueur["jou_xp"];
	  $i++;
	}




	















$var = array(
	"niveau" => Calculs::niveau_joueur($_SESSION["joueur"]["jou_xp"]),
	"date" => $date,
	"classement_joueur" => $req6_JOUEURS_CLASSEMENT,
);









?>