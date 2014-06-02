<?php

namespace Bundles\Templates;

use Bundles\Parametres\Conf;
use Bundles\Templates\ExtentionsTwig\FormExtTwig;

/**
* 
*/
class Tpl {
	
	protected $environnement = array(
			"debug" => true, //"debug" => false,
			"charset" => "utf-8",
			"base_template_class" => "Twig_Template",
			"cache" => false,
			"auto_reload" => true, // "auto_reload" => false,
			"strict_variables" => false,
			"autoescape" => true, // "autoescape" => true, 
			"optimizations" => -1

		);

	public $dirTwigTpl = '/Views/Twig_Tpl';
	 
	protected $vars = array();

	protected $twig;

	public function __construct($dirTwigTpl=null) {
		if(!$dirTwigTpl) $dirTwigTpl = $this->dirTwigTpl;
		require_once("twig-1.15.1/lib/Twig/Autoloader.php");
		\Twig_Autoloader::register();
		$dirRoot = dirname(dirname(__DIR__));
		$loader = new \Twig_Loader_Filesystem($dirRoot.$dirTwigTpl);
		$this->twig = new \Twig_Environment($loader, $this->environnement);
		$this->twig->addExtension(new \Twig_Extension_Debug());
		$this->twig->addExtension(new FormExtTwig());
	}

	public static function display($vars = array(), $tpl = null) {
		$tplObj = new Tpl();
		return $tplObj->addVars($vars)->getTpl($tpl);
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

	protected function selectTpl() {
		$controller = explode("\\",Conf::$route["controller"]);
		return str_replace("::", DIRECTORY_SEPARATOR, $controller[count($controller)-1]).".twig";
	}

}







?>