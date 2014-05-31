<?php

namespace Bundles\Formulaires;

use Bundles\Parametres\Conf;

use Bundles\Formulaires\Utils\Inputs;
use Bundles\Formulaires\Utils\Inspector;





/*

Contraintes supportées¶

Voici les contraintes de base : utilisez les afin de vérifier des données basiques à propos de la valeur d'une propriété ou de la valeur retournée par une méthode de votre objet.

    NotBlank
    Blank
    NotNull
    Null
    True
    False
    Type

Contraintes sur les chaînes de caractères¶

    Email
    Length
    Url
    Regex
    Ip

Contraintes sur les nombres¶

    Range

Contraintes comparatives¶

    EqualTo
    NotEqualTo
    IdenticalTo
    NotIdenticalTo
    LessThan
    LessThanOrEqual
    GreaterThan
    GreaterThanOrEqual

Contraintes sur les dates¶

    Date
    DateTime
    Time

Contraintes sur les collections¶

    Choice
    Collection
    Count
    UniqueEntity
    Language
    Locale
    Country

Contraintes sur les fichiers¶

    File
    Image

Contraintes sur la finance et autres numéros¶

    CardScheme
    Luhn
    Iban
    Isbn
    Issn

Autres Contraintes¶

    Callback
    All
    UserPassword
    Valid


 */

/**
* 
*/
class Forms {
	public $dirForm = FORMS;

	public $nameForm;
	public $type;
	public $inputs;
	public $errors;

	public function __construct($nameForm=null, $type="POST", $dirForm=null) {
		if($nameForm) $this->nameForm = $nameForm;
		if($dirForm) $this->dirForm = ROOT.$dirForm;
		$this->type = $type;
		$this->loadForm();
	}

	public static function make($nameForm=null, $type="POST", $dirForm=null) {
		$form = new Forms($nameForm, $type, $dirForm);
		return $form;
	}

	public function loadForm(){
		$form = json_decode(file_get_contents($this->dirForm.$this->nameForm.'.json'), true);
		foreach ($form as $input) {
			$this->add($input['name'], $input['options']);
		}
	}


	/**
	 * ->add("nom_du_champs", array(
	 *     "label" => "nom_du_champs_different",
	 *     "type" => "text",
	 *     "id" => "id_du_champs",
	 *     "class" => "class_du_champs",
	 *     "attr" => array(
	 *         ["attr1","value1"], 
	 *         ["attr2","value2"]
	 *     ),
	 *     "errorMsg" => "Ce_message_peut_etre_personnalisé",
	 *     "constraints" => array(
	 *         "NotBlank" => true,
	 *         "Type" => "integer",
	 *         "LessThan" => 12
	 *         
	 *     )
	 * ));
	 * @param [str] $name    [description]
	 * @param [arr] $options [description]
	 */
	public function add($name,$options=array()) {
		$this->input[$name] = array("name" => (string)$name, "options" =>(array)$options);
	}



	public function render(){
		$inputsHTML = array();
		foreach ($this->input as $input) {
			$inputsHTML[$input['name']] = $this->constructBlock($input['name'], $input['options']);
		}
		return $inputsHTML;
	}


	public function isValid(){
		$result = true;
		foreach ($this->input as $input) {
			if(!$this->verifBlock($input['name'], $input['options'])) {
				$result = false;
			}
		}
		return $result;
		
	}


	private function constructBlock($name, $options) {
		$result  = "<div id='$name-form' class='container-form'>\n";

		// required
		$required = (isset($options['required']) && $options['required'] === TRUE) ? "<span class='required-form'> *</span>" : '' ;

		// Label option
		if(isset($options['label'])) {
			if($options['label']!==FALSE) {
				$result .= "<label id='$name-label' class='label-form' for='$name'>".ucfirst($options['label']).$required."</label>\n";
			} else {
				$result .= $required;
			}
		} else {
			$result .= "<label id='$name-label' class='label-form' for='$name'>$name$required</label>\n";
		}

		// Input
		$result .= $this->constructInput($name, $options);

		// Error
		if(isset($this->errors[$name])) {
			$result .= (isset($options['errorMsg']))?
				"<span id='$name-error' class='error-form'>{$options['errorMsg']}</span>\n" :
				"<span id='$name-error' class='error-form'>{$this->errors[$name]}</span>\n" ;
		}

		// Description
		if(isset($options['desc'])) {
			$result .= "<p id='$name-desc' class='desc-form'>{$options['desc']}</p>\n";
		}


		$result .= "</div>\n";
		return $result;
	}

	private function constructInput($name, $options) {
		if(empty($options)) $options['type'] = 'text'; 
		return Inputs::render($name, $options);
	}

	

	private function verifBlock($name, $options) {
		switch ($this->type) {
			case 'GET':
				$vars = $_GET;
				break;
			
			default:
				$vars = $_POST;
				break;
		}
		if(isset($vars[$name])) {
			if (isset($options['constraints'])) {
				$response = true;
				$vars = (($options['type'] == 'file')? $_FILES : $vars);
				$value = $vars[$name];
				foreach ($options['constraints'] as $type => $constraint) {
					if(!Inspector::checkData($value, $type, $constraint) || !(isset($options['disabled']) && $options['disabled'] === true)) {
						if(isset($this->errors[$name])) {
							$this->errors[$name] .= Inspector::getMsg();
						} else {
							$this->errors[$name] = Inspector::getMsg();
						}
						$response = false;
					}
					if(isset($options['value'])){
						$options['value'] = (is_array($vars[$name])) ? $vars[$name] : array($vars[$name]);
					}
				}
				return $response;
			} else {
				return true;
			}
		} else {
			return false;
		}
		
	}

	






}




/*
<div id="id-form" class="container-form">
	<label id="id-label" class="label-form" for="id"></label>
	<input type="text" id="id" name="id" value="">
	<span id="id-error" class="error-form"></span>
	<p id="id-desc" class="desc-form">Description du champs ou explication si besoin</p>
</div>
 */


?>

