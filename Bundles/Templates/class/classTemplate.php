<?php


class template {

	private $chemin = "../Bundles/Parametres/config/";
	
	private $css = array();

	public $page;

	public $var;

	public function __construct($infoPage, $var=array()){
		$this->page = $infoPage;
		$this->var = $var;
	}

	public function constructHTML($type){
		require_once($this->chemin."root.inc.php");
		require_once($this->chemin."constant.inc.php");
		
		$montemplate = new HTML_Template_PHPLIB(dirname(__FILE__), 'keep');

		if(is_file(TEMPLATES."Prepare".DS."temp.".$type.".php")) {
			
			include(TEMPLATES."Prepare".DS."temp.".$type.".php");

			return $montemplate->finish($montemplate->parse('OUT', $type));

		}


	}






}





?>