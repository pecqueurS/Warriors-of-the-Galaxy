<?php

namespace Bundles\Templates;

use Bundles\Parametres\Conf;


/**
* 
*/
class Tpl {
	
	private $environnement = array(
			"debug" => true, //"debug" => false,
			"charset" => "utf-8",
			"base_template_class" => "Twig_Template",
			"cache" => false,
			"auto_reload" => true, // "auto_reload" => false,
			"strict_variables" => false,
			"autoescape" => true, 
			"optimizations" => -1

		);
	 
	private $vars = array();

	private $twig;

	public function __construct() {
		require_once("twig-1.15.1/lib/Twig/Autoloader.php");
		\Twig_Autoloader::register();
		$dirRoot = dirname(dirname(__DIR__));
		$loader = new \Twig_Loader_Filesystem($dirRoot."/Views/Twig_Tpl");
		$this->twig = new \Twig_Environment($loader, $this->environnement);
		$this->twig->addExtension(new \Twig_Extension_Debug());
	}

	public static function display($vars = array()) {
		$tpl = new Tpl();
		return $tpl->addVars($vars)->getTpl();
	}

	public function getTpl($tpl = null) {
		if(!$tpl) {
			$tpl = $this->selectTpl();
		}
		return $this->twig->render($tpl, $this->vars);
	}

	public function addVars($vars=array()) {
		$this->vars = array_merge((array)$this->vars, (array)$vars);
		return $this;
	}

	private function selectTpl() {
		$controller = explode("\\",Conf::$route["controller"]);
		return str_replace("::", DIRECTORY_SEPARATOR, $controller[count($controller)-1]).".twig";
	}

}







?>