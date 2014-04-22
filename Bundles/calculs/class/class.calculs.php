<?php



class Calculs {

	public static $niveau_joueur = 1000;


	public static function niveau_joueur($xp) {
		$i = 1;
		while ( self::$niveau_joueur*bcpow('2', $i) <= $xp) {
			$i++;
		}
		return $i;
	}



	public static function position($pos, $lang) {
		switch ($pos) {
			case '1':
			case 1:
				return ($lang=="en") ? "1st" : "1er";
			
			case '2':
			case 2:
				return ($lang=="en") ? "2nd" : "2ème";
			
			case '3':
			case 3:
				return ($lang=="en") ? "3rd" : "3ème";
			
			default:
				return ($lang=="en") ? $pos."th" : $pos."ème";
		}
	}



	public static function max_ressources($niv,$max_niv1) {
		return $max_niv1*bcpow('2.5', ($niv));

	}


	public static function cout_ressources($niv,$cout_res_niv1) {
		return $cout_res_niv1*bcpow('2', ($niv));

	}


	public static function gain_ressources($niv,$cout_res_niv1) {
		return $cout_res_niv1*bcpow('1.5', ($niv));

	}


	public static function convert_time($secondes) {
		$s = $secondes;
		$h = 0;
		$m = 0;
		$result = "";
		// LES HEURES
		if($secondes >= 3600) {
			$h = floor($secondes/3600);
			$result .= $h."H";
			$secondes = $secondes%3600;
		}
		// LES MINUTES
		if($s >= 60) {
			$m = floor($secondes/60);
			$m = ($m<10) ? "0".$m : $m;
			$result .= $m."m";
			$secondes = $secondes%60;
		}
		// LES SECONDES
		if($s<3600) {
			$secondes = ($secondes<10) ? "0".$secondes : $secondes;
			$result .= $secondes."s";
		}

		return $result;

	}

	public static function distance($origine, $arrivee){
		$taille_x = (pow($arrivee["x"] - $origine["x"],2));
		$taille_y = (pow($arrivee["y"] - $origine["y"],2));

		$distance = sqrt($taille_x+$taille_y);

		return $distance;

	}



	public static function temps_trajet($vitesse, $distance){
		// Distance d'une case
		$dCase = 1600;
		
		return $distance*$dCase /$vitesse;

	}



	public static function combat($att, $def) {

			$result["att"]["u1"] = $att["u1"]["unite"];
			$result["att"]["u2"] = $att["u2"]["unite"];
			$result["att"]["u3"] = $att["u3"]["unite"];

			$result["def"]["u1"] = $def["u1"]["unite"];
			$result["def"]["u2"] = $def["u2"]["unite"];
			$result["def"]["u3"] = $def["u3"]["unite"];
$i = 0;
$continue = true;
		while($continue) {
			$att_unite1_ATT = $result["att"]["u1"]*$att["u1"]["att"];
			$att_unite2_ATT = $result["att"]["u2"]*$att["u2"]["att"];
			$att_unite3_ATT = $result["att"]["u3"]*$att["u3"]["att"];
			$attaquant["attaque"] = $att_unite1_ATT + $att_unite2_ATT + $att_unite3_ATT; 


			$att_unite1_DEF = $result["att"]["u1"]*($att["u1"]["def"] + $att["u1"]["life"] );
			$att_unite2_DEF = $result["att"]["u2"]*($att["u2"]["def"] + $att["u2"]["life"] );
			$att_unite3_DEF = $result["att"]["u3"]*($att["u3"]["def"] + $att["u3"]["life"] );
			$attaquant["defense"] = $att_unite1_DEF + $att_unite2_DEF + $att_unite3_DEF; 


			$def_unite1_DEF = $result["def"]["u1"]*($def["u1"]["def"] + $def["u1"]["life"] );
			$def_unite2_DEF = $result["def"]["u2"]*($def["u2"]["def"] + $def["u2"]["life"] );
			$def_unite3_DEF = $result["def"]["u3"]*($def["u3"]["def"] + $def["u3"]["life"] );
			$defenseur["defense"] = $def_unite1_DEF + $def_unite2_DEF + $def_unite3_DEF;  

		// tour 1
			$tour1 = $attaquant["attaque"] - $defenseur["defense"];
			

			if($tour1>0) {

				$result["def"]["u1"] = 0;
				$result["def"]["u2"] = 0;
				$result["def"]["u3"] = 0;

				$result["winner"] = "att";
				$continue = false;

			} else {

				if(($attaquant["attaque"] < $def_unite1_DEF ) && $result["def"]["u1"] != 0) {
				$result["def"]["u1"] = intval(($def_unite1_DEF  - $attaquant["attaque"]) / ($def["u1"]["def"] + $def["u1"]["life"] ));
				

				} else {
				$result["def"]["u1"] = 0;
					if(($attaquant["attaque"] < ($def_unite1_DEF + $def_unite2_DEF )) && $result["def"]["u2"] != 0) {
						$result["def"]["u2"] = intval(($def_unite1_DEF  + $def_unite2_DEF  - $attaquant["attaque"]) / ($def["u2"]["def"] + $def["u2"]["life"] ));

					} else {
						$result["def"]["u2"] = 0;
						$result["def"]["u3"] = intval(($def_unite1_DEF  + $def_unite2_DEF  + $def_unite3_DEF  - $attaquant["attaque"]) / ($def["u3"]["def"] + $def["u3"]["life"] ));
					}

				}
			}

		// tour 2 
			$def_unite1_ATT = $result["def"]["u1"]*$def["u1"]["att"];
			$def_unite2_ATT = $result["def"]["u2"]*$att["u2"]["att"];
			$def_unite3_ATT = $result["def"]["u3"]*$att["u3"]["att"];
			$defenseur["attaque"] = $def_unite1_ATT + $def_unite2_ATT + $def_unite3_ATT;
			if(!isset($result["winner"])) {
				$tour2 = $defenseur["attaque"] - $attaquant["defense"];
				if($tour2>0) {

					$result["att"]["u1"] = 0;
					$result["att"]["u2"] = 0;
					$result["att"]["u3"] = 0;

					$result["winner"] = "def";
					$continue = false;

				} else {

					if($defenseur["attaque"] < $att_unite1_DEF) {
					$result["att"]["u1"] = intval((($att_unite1_DEF) - $defenseur["attaque"]) / ($att["u1"]["def"] + $att["u1"]["life"] ));

					} else {
					$result["att"]["u1"] = 0;
						if($defenseur["attaque"] < ($att_unite1_DEF + $att_unite2_DEF)) {
							$result["att"]["u2"] = intval(($att_unite1_DEF + $att_unite2_DEF - $defenseur["attaque"]) / ($att["u2"]["def"] + $att["u2"]["life"] ));

						} else {
							$result["att"]["u2"] = 0;
							$result["att"]["u3"] = intval(($att_unite1_DEF + $att_unite2_DEF + $att_unite3_DEF - $defenseur["attaque"]) / ($att["u3"]["def"] + $att["u3"]["life"] ));
						}

					}

				}

			}
			// Bloque l'attauqe si trop de tours pour ne ps saturer de trop le serveur
			$i++;
			if($i==15){
				$continue = false;
				$result["winner"] = "equal";
			}
		}




		return $result;

	}









}

?>