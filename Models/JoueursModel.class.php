<?php


namespace Models;

use Bundles\Bdd\Db;


class JoueursModel extends Model {

	protected $tableName = "joueurs";

	public function __construct() {
		parent::__construct();
	}

	public static function init() {
		$mod = new JoueursModel();
		return $mod;
	}





}


?>