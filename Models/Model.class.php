<?php


namespace Models;

use Bundles\Bdd\Db;


class Model {

	protected $db;
	protected $className="";
	protected $table=array();

	public function __construct() {
		$this->defineClass();
		$this->loadTable();	
	}


	public static function init() {
		$mod = new Model();
		return $mod;
	}


	protected function defineClass() {
		$this->className = ucfirst($this->tableName)."Model";
	}


	protected function loadTable() {
		$this->db = Db::init($this->tableName);
		$this->table = $this->db->select();
	}


	public function getField($field) {
		return $this->table[$field];
	}

	public function getValues($fields, $rules=array()) {
		$result = array();
		$fields = (!is_array($fields)) ? array($fields) : $fields ;
		$i = 0;
		foreach ($this->table as $row) {
			$takeRow = true;
			foreach ($rules as $key => $value) {
				if(is_array($value)) {
					if(!in_array($row[$key], $value)) $takeRow = false;
					
				} else {
					if($row[$key]!=$value) $takeRow = false;
				}
				
			}
			if($takeRow) {
				foreach ($fields as $field) {
					$result[$i][$field] = $row[$field];
				}
				$i++;
			}
		}

		if(count($result)==1) $result = $result[0];

		return $result;
	}



}


?>