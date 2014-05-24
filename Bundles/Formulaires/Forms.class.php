<?php

namespace Bundles\Formulaires;

use Bundles\Parametres\Conf;

use Bundles\Formulaires\Utils\Inputs;






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

	public $inputs;

	public function __construct($type="POST") {
		
	}

	public static function make() {
		$form = new Forms();
		return $form;
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
		return false;
	}


	private function constructBlock($name, $options) {
		$result  = '<div id="$name-form" class="container-form">';

		// required
		$required = (isset($options['required']) && $options['required'] === TRUE) ? '<span class="required-form"> *</span>' : '' ;

		// Label option
		if(isset($options['label'])) {
			if($options['label']!==FALSE) {
				$result .= "<label id='$name-label' class='label-form' for='$name'>{$options['label']}$required</label>";
			} else {
				$result .= $required;
			}
		} else {
			$result .= "<label id='$name-label' class='label-form' for='$name'>$name$required</label>";
		}

		// Input
		$result .= $this->constructInput($name, $options);

		// Error
		if(isset($this->errors[$name])) {
			$result .= (isset($options['errorMsg']))?
				"<span id='$name-error' class='error-form'>{$options['errorMsg']}</span>" :
				"<span id='$name-error' class='error-form'>{$this->errors[$name]}</span>" ;
		}

		// Description
		if(isset($options['desc'])) {
			$result .= "<p id='$name-desc' class='desc-form'>{$options['desc']}</p>";
		}


		$result .= '</div>';
		return $result;
	}

	private function constructInput($name, $options) {
		if(empty($options)) $options['type'] = 'text'; 
		return Inputs::render($name, $options);
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

