<?php

namespace Bundles\Formulaires\Utils;



/**
* 
*/
class Inspector {

	private static $error;

	public function __construct () {
		
	}

	public static function checkData($value, $type, $constraint) {
		$inspector = new Inspector();

		$method = $type.'_Check';

		return $inspector->$method($value, $constraint);
	}


	public static function getMsg() {
		return self::$error;
	}


	public function __call($method,$arguments) {
		echo 'Vous avez appelé la méthode ', $method, 'avec les arguments : ', implode(', ',$arguments);
	}




	private function NotBlank_Check($value, $constraint) {
		if($constraint) {
			if (false === $value || (empty($value) && '0' != $value)) {
	            self::$error = 'This value should not be blank';
	            return false;
	        }
		} 
		return true;
	}

	private function Blank_Check($value, $constraint) {
		if($constraint) {
			if ('' !== $value && null !== $value) {
	            self::$error = 'This value should be blank';
	            return false;
	        }
		} 
		return true;
	}

	private function NotNull_Check($value, $constraint) {
		if($constraint) {
			if (null === $value) {
	            self::$error = 'This value should not be null';
	            return false;
	        }
		} 
		return true;
	}

	private function Null_Check($value, $constraint) {
		if($constraint) {
			if (null !== $value) {
	            self::$error = 'This value should be null';
	            return false;
	        }
		} 
		return true;
	}

	private function True_Check($value, $constraint) {
		if($constraint) {
			if (true !== $value && 1 !== $value && '1' !== $value) {
	            self::$error = 'This value should be true';
	            return false;
	        }
		} 
		return true;
	}

	private function False_Check($value, $constraint) {
		if($constraint) {
			if (null === $value || false === $value || 0 === $value || '0' === $value) {
	            return true;
	        } else {
	            self::$error = 'This value should be false';
	            return false;
	        }
		} 
		return true;
	}

	private function Type_Check($value, $constraint) {
			if (null === $value) {
	            return true;
	        }

	        $type = strtolower($constraint->type);
	        $type = $type == 'boolean' ? 'bool' : $constraint->type;
	        $isFunction = 'is_'.$type;
	        $ctypeFunction = 'ctype_'.$type;

	        if (function_exists($isFunction) && call_user_func($isFunction, $value)) {
	            return true;
	        } elseif (function_exists($ctypeFunction) && call_user_func($ctypeFunction, $value)) {
	            return true;
	        } elseif ($value instanceof $constraint->type) {
	            return true;
	        }

	        self::$error = "This value should be of type $constraint";
	        return false;
	}

	private function Email_Check($value, $constraint) {
		if($constraint) {
			if (null === $value || '' === $value) {
	            return true;
	        }

	        $value = (string) $value;
	        $valid = filter_var($value, FILTER_VALIDATE_EMAIL);

	        if (!$valid) {
	            self::$error = 'This value is not a valid email address';
		        return false;
	        }
	    } 
		return true;    
	}

	private function Length_Check($value, $constraint) {
		if (null === $value || '' === $value) {
            return true;
        }

        $stringValue = (string) $value;

        $length = strlen($stringValue);
        
        if ($constraint['min'] == $constraint['max'] && $length != $constraint['min']) {
            self::$error = "This value should have exactly {$constraint['min']} characters..";
	        return false;
        }
        

        if (null !== $constraint['max'] && $length > $constraint['max']) {
            self::$error = "This value is too long. It should have {$constraint['max']} characters or less..";
	        return false;
        }

        if (null !== $constraint['min'] && $length < $constraint['min']) {
           self::$error = "This value is too short. It should have {$constraint['min']} characters or more..";
	        return false;
        }

		return true;
	        
	}


}







?>