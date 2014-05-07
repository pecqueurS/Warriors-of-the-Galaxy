<?php

class db extends BDD {

	protected $cnx;

	protected $tables = array();

	protected $fields = array();

	protected $construct_request = "";

	public function __construct($table=null) {
		parent::__construct();
		$this->cnx = new BDD();
		if($table !== NULL) {
			$this->addTable($table);
		}
	}

	// Initialisation en static pour raccourcir le code
	public static function init($table=null) {
		$db = new db($table);
		return $db;
	}

	// Ajout d'une table
	public function addTable($table){
		$this->tables[] = $table;
		$this->searchFields($table);
	}

	// Recherche les colonnes d'une table
	protected function searchFields($table) {
		$sql = "SHOW COLUMNS FROM ".$table;
		$this->requete($sql);
		$this->fields[$table] = $this->retourne_tableau();
	}


	public function select($fields=array("*")) {
		$this->construct_request .= "SELECT ".implode(",",$fields)." FROM ".$this->tables[0];
	}


	public function addJoin($table, $cles, $type="INNER") {
		
	}

	public function addRule($field, $value, $type="=") {

	}

	public function addOrder($field, $order="ASC") {

	}

	public function addGroup($field) {

	}

	public function insert($fields, $values) {

	}

	public function update($field, $value) {

	}

	public function delete() {
		
	}
























}




$players = db::init("joueurs")->select();












?>