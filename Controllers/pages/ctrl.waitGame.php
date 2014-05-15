<?php

// Appel profil
require_once (PROFIL."profil.php");

// Appel game
require_once (GAME."game.php");




// Renvoi sur ACCUEIL si on est pas connecté
$profil = new Profil();

$profil->verif_connect();



if(!is_int($_SESSION["joueur"]["jou_parties_id"])) {
	header("location:".URL_PROFIL);
}



/*Quitter la partie*/
if(isset($_POST["quitGame"])) {
	$sql = "UPDATE joueurs SET jou_parties_id = NULL
			WHERE jou_id = ? ";

	    $bind = "i";
	  	$arr = array($_SESSION["joueur"]["jou_id"]);
		$bdd->prepare($sql,$bind);
	  	$result1 = $bdd->execute($arr);

	if($result1==1){
		$_SESSION["joueur"]["jou_parties_id"] = NULL;
		unset($_SESSION["partie"]);
		header("location:".URL_PROFIL);
	}


}







// nouvel objet partie
$game = new Game();










/*Ready ?*/
/*Requete 10 : Update des joueurs quand ready*/
if(isset($_POST["ready"])) {
	$verif_post = new Check_data();
	if($verif_post->check_data($_POST["team"],"num",false)) {
			switch ($_POST["race"]) {
				case 'reptilians':
					$post["race"] = 2;
					break;
				
				case 'arachnids':
					$post["race"] = 3;
					break;
				
				default:
					$post["race"] = 1;
					break;
			}
			$post["team"] = $_POST['team'];
		/*Requete 10 : Update des joueurs quand ready*/
		$game->player_ready($post);


	}




}






/* Envoi d'un message */
/*Requete 11 : insert un nouveau message*/
if(isset($_POST["sendMess"])) {
	$verif_post = new Check_data();
	if($verif_post->check_data($_POST["message"],"txt",array(5,256))) {

		$post["message"] = $_POST["message"];

		/*Requete 11 : insert un nouveau message*/
		$result = $game->send_msg($post);

		    if(!$result) {
		    	$_SESSION["message"] = "Un probleme est survenu";
		    }


	} else {
		$_SESSION["message"] = "Votre message est trop long. Max 255 caractères";
	}

}







/*REQUETE 6 : informations partie en attente -> $req6_INFO_WAIT_GAME */
$req6_INFO_WAIT_GAME = $game->info_partie($req4_DICO);


/*Requete 7 : Les races -> req7_RACE_INFO*/
$req7_RACE_INFO = $game->info_race();




/*Requete 8 : Les joueurs ->req8_JOUEURS_PARTIE*/
$req8_JOUEURS_PARTIE = $game->players_in_game($req4_DICO);






/*Requete 9 : Le chat -> $req9_CHAT*/
$req9_CHAT = $game->affiche_msg();










$var = array(
	"race_info" => $req7_RACE_INFO,
	"joueurs_partie" => $req8_JOUEURS_PARTIE,
	"chat" => $req9_CHAT,
);



?>