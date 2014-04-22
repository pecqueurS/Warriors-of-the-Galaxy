<?php


if(isset($_POST["sendMail"])) {
	$verif_post = new Check_data();
	if($verif_post->check_data($_POST["login"],"login",true)
		&& $verif_post->check_data($_POST["date"],"dateFR",true)
		&& $verif_post->check_data($_POST["heure2"],"num",array(0,23), true)
		&& $verif_post->check_data($_POST["minute2"],"num",array(0,59), true)
		&& $verif_post->check_data($_POST["message"],"txt",true)

	) {

		$arr_date = preg_split("/[- .\/]/",$_POST["date"]);
		$heure = ($_POST["heure2"]<10) ? "0".$_POST["heure2"] : $_POST["heure2"];
		$minutes = ($_POST["minute2"]<10) ? "0".$_POST["minute2"] : $_POST["minute2"];
		$timestamp_bug = $arr_date[2].$arr_date[1].$arr_date[0].$heure.$minutes."00";

		$sql = "INSERT INTO messages_admin VALUES (NULL, 'abus' , ? , CURRENT_TIMESTAMP , ? , ? )";



		    $bind = "is";
		  	$arr = array($_POST["login"], $timestamp_bug, $_POST["message"]);
						  
		  	$bdd->prepare($sql,$bind);
		  	$result4 = $bdd->execute($arr);

		  	$_SESSION["message"] = "Votre message a été envoyé à l'administrateur. Il sera traité dans les plus brefs delais.";

	} else {
		
		$_SESSION["message"] = "Toutes les informations n'ont pas été remplies correctement";
		$_SESSION["message"] .= ($verif_post->check_data($_POST["login"],"login",true))?"":"<br/>Login non rempli correctement";
		$_SESSION["message"] .= ($verif_post->check_data($_POST["date"],"dateFR",true))?"":"<br/>Veuillez choisir une date dans le format jj/mm/aaaa";
		$_SESSION["message"] .= ($verif_post->check_data($_POST["heure2"],"num",array(0,23), true))?"":"<br/>Entrez une heure entre 0 et 23";
		$_SESSION["message"] .= ($verif_post->check_data($_POST["minute2"],"num",array(0,59), true))?"":"<br/>Entrez des minutes entre 0 et 59";
		$_SESSION["message"] .= ($verif_post->check_data($_POST["message"],"txt",true))?"":"<br/>Ecrivez un message.";
		
		
	}
}






?>