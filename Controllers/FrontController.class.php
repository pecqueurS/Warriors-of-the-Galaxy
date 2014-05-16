<?php


namespace Controllers;

use Bundles\Parametres\Conf;

use Models\PagesModel;
use Models\DictionnaireModel;
use Models\Desc_pagesModel;

class FrontController {

	protected static $page;

	protected $controller;

	public function __construct() {
		
		// Prepare la route
		$this->checkRoute();

		// Prepare les données communes à toutes les pages
		$this->prepare();

		// Lance le controleur de la page demandée
		$this->launchController();
			
		// Affiche la vue
		

	}


	public static function launch() {
		$fc = new FrontController();
		return $fc;
	}



	private function checkRoute() {
		if(!empty(Conf::$route)) {
			self::$page = (isset(Conf::$route["loadUrl"])) ? substr(Conf::$route["loadUrl"],1) : substr(Conf::$route["url"],1) ;
		} else {
			$this->notFound();
		}
	}


	private function launchController() {
		$access = preg_replace('/::[a-zA-Z0-9\/_]+$/', '.class.php', Conf::$route["controller"]);
		$access = str_replace('\\', DS, $access);

		if(is_file(ROOT.$access)){
			$routeArr = explode("::", Conf::$route["controller"]);

			$nsArr = explode("/", $routeArr[0]);
			$class = $nsArr[count($nsArr)-1];

			$method = $routeArr[1];

			require ROOT.$access;
			eval("\$this->controller = new $class();\$this->controller->$method();");

			var_dump(ROOT.$access);
		} else {
			$this->notFound();
		}
	}

	private function notFound() {
			// Page inexistante
			header("HTTP/1.1 404 Not Found");
			echo file_get_contents(URL_ERR); 
			exit();
	}

	private function prepare() {
		// Information sur les pages
		// $req1
		$pagesInfos = PagesModel::init()->getPagesInformations();
		$PAGES_NOJS = $pagesInfos->getValues("pag_name", array("pag_template"=>"styleAccueil")); 

		// Informations sur la page
		// $req2
		$pageHeadInfos = $pagesInfos->getValues(array("tra_nom","pag_name","pag_template"), array("pag_name"=>self::$page));
		$PAGE_HEAD_INFO["traduction"] = $pageHeadInfos["tra_nom"];
		$PAGE_HEAD_INFO["page"] = $pageHeadInfos["pag_name"];
		$PAGE_HEAD_INFO["template"] = $pageHeadInfos["pag_template"];

		// Traduction des liens des pages
		// $req3
		$tradLiensPages = $pagesInfos->getValues(array("pag_name","tra_nom"));
		$LINKS = array();
		foreach ($tradLiensPages as $lien) {
			$LINKS[$lien["pag_name"]] = $lien["tra_nom"];
		}

		// Dictionnaire
		// $req4
		$DICO = DictionnaireModel::init()->getValues();

		// Dictionnaire
		// $req5
		 var_dump(Desc_pagesModel::init()->getValues());
		$description = Desc_pagesModel::init()->getValues(array("tra_nom"), array("pag_name"=>self::$page));
		$DESC_PAGE = array();
		foreach ($description as $desc) {
		  	$DESC_PAGE[] = $desc["tra_nom"];
		}

		var_dump($DESC_PAGE);

	}




/*







// Appel Controleurs
require_once (CTRL."controlleurs.php");




/*

// Appel templates
require_once (TEMPLATES."template.php");*/


















}


?>