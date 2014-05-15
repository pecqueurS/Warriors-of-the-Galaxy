<?php


namespace Models;

use Bundles\Bdd\Db;


class DictionnaireModel extends Model {

	protected $tableName = "dictionnaire";
	
	public function __construct() {
		parent::__construct();
	}

	public static function init() {
		$mod = new DictionnaireModel();
		return $mod;
	}

	public function getPagesInformations(){
		$this->table = $this->db->addJoin("elem_a_trad", array("eat_id", "pag_elem_a_trad_id"))
								->addJoin("traductions", array("eat_id", "tra_elem_a_trad_id"))
								->addJoin("langues", array("lan_id", "tra_langues_id"))
								->addRule("lan_designation", $_SESSION["lang"])
								->select();
		return $this;
	}




}


?>