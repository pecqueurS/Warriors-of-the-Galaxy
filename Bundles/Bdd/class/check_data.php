<?php


class Check_data {

	private $value;

	private $type;

	private $size;



	public function __construct() {

	}






	public function check_data($value, $type, $size=false, $nombre_compris_entre=false) {

		$this->value =$value;
		$this->type =$type;
		$this->size =$size;

		if($size!=false) {

			if($size===true) {
				if(empty($value)) return FALSE;
			} elseif(is_array($size)) {
				if($nombre_compris_entre) {
					$value = intval($value);
					if($value<$size[0] || $value>$size[1]) {return FALSE;}
				} else {
					$long=strlen($value);
					if($long<$size[0] || $long>$size[1]) {return FALSE;}
				}
				
			} else {
				$long=strlen($value);
				if($long>$size) return FALSE;
			}



		}

		switch ($type) {
			case 'login':
				$pattern = '/^([0-9A-Za-z]+$)/';
				if(!preg_match($pattern, $value)) return FALSE;
				break;

			case 'mdp':
				$pattern = '/([0-9]+[a-z]+[A-Z]+)|([0-9]+[A-Z]+[a-z]+)|([A-Z]+[0-9]+[a-z]+)|([A-Z]+[a-z]+[0-9]+)|([a-z]+[A-Z]+[0-9]+)|([a-z]+[0-9]+[A-Z]+)/';
				if(!preg_match($pattern, $value)) return FALSE;
				break;

			case 'email':
				if(!filter_var($value, FILTER_VALIDATE_EMAIL)) return FALSE;
				break;

			case 'num':
				if(!is_numeric($value)) return FALSE;
				break;

			case 'str':
				$pattern = '/^([0-9A-Za-z][0-9A-Za-z ]+$)/';
				if(!preg_match($pattern, $value)) return FALSE;
				break;

			case 'dateFR':
				$arr_date = preg_split("/[- .\/]/", $value);
				if(!checkdate($arr_date[1], $arr_date[0], $arr_date[2])) return FALSE;
				break;

			case 'dateEN':
				$arr_date = preg_split("/[- .\/]/", $value);
				if(!checkdate($arr_date[0], $arr_date[1], $arr_date[2])) return FALSE;
				break;

			case 'txt':
				return true;
				break;

			default:
				return FALSE;
				break;
		}



		return TRUE;
	}










	public function xss($value){
		return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
	}











}



?>