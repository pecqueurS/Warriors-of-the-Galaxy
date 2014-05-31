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







// Contraintes de bases
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

	        $type = strtolower($constraint);
	        $type = $type == 'boolean' ? 'bool' : $constraint;
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

// Contraintes sur les chaînes de caractères
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

	private function Url_Check($value, $constraint) {
		if($constraint) {
			if (null === $value || '' === $value) {
	            return true;
	        }

	        $value = (string) $value;
	        $valid = filter_var($value, FILTER_VALIDATE_URL);

	        if (!$valid) {
	            self::$error = 'This value is not a valid url';
		        return false;
	        }
	    } 
		return true; 
    }

	private function Regex_Check($value, $constraint) {
		if (null === $value || '' === $value) {
            return true;
        }

        $value = (string) $value;
        if ($constraint['match']) {
        	if(!preg_match($constraint['pattern'], $value)) {
	            self::$error = 'This value is not valid';
			    return false;
			}
        } else{
			if(preg_match($constraint['pattern'], $value)) {
	            self::$error = 'This value is not valid';
			    return false;
			}
        } 
        return true;
    }

	private function Ip_Check($value, $constraint) {
		if (null === $value || '' === $value) {
            return true;
        }

        $value = (string) $value;

        switch ($constraint['version']) {
            case 'V4':
               $flag = FILTER_FLAG_IPV4;
               break;

            case 'V6':
               $flag = FILTER_FLAG_IPV6;
               break;

            case 'V4_NO_PRIV':
               $flag = FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE;
               break;

            case 'V6_NO_PRIV':
               $flag = FILTER_FLAG_IPV6 | FILTER_FLAG_NO_PRIV_RANGE;
               break;

            case 'ALL_NO_PRIV':
               $flag = FILTER_FLAG_NO_PRIV_RANGE;
               break;

            case 'V4_NO_RES':
               $flag = FILTER_FLAG_IPV4 | FILTER_FLAG_NO_RES_RANGE;
               break;

            case 'V6_NO_RES':
               $flag = FILTER_FLAG_IPV6 | FILTER_FLAG_NO_RES_RANGE;
               break;

            case 'ALL_NO_RES':
               $flag = FILTER_FLAG_NO_RES_RANGE;
               break;

            case 'V4_ONLY_PUBLIC':
               $flag = FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE;
               break;

            case 'V6_ONLY_PUBLIC':
               $flag = FILTER_FLAG_IPV6 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE;
               break;

            case 'ALL_ONLY_PUBLIC':
               $flag = FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE;
               break;

            default:
                $flag = null;
                break;
        }

        if (!filter_var($value, FILTER_VALIDATE_IP, $flag)) {
            self::$error = 'This is not a valid IP address';
			return false;
        } else {
        	return true;
        }
    }

// Contraintes sur les nombres
	private function Range_Check($value, $constraint) {
		if (null === $value) {
            return true;
        }

        if (!is_numeric($value)) {
            self::$error = "This value should be a valid number.";
	        return false;
        }

        if (null !== $constraint['max'] && $value > $constraint['max']) {
            self::$error = "This value should be {$constraint['max']} or less.";
	        return false;
        }

        if (null !== $constraint->min && $value < $constraint->min) {
            self::$error = "This value should be {$constraint['min']} or more.";
	        return false;
        }
        return true;
    }

// Contraintes comparatives    
	private function EqualTo_Check($value, $constraint) {
		foreach ($constraint as $compare) {
        	if($compare == $value) return true;
        }
        $constraintStr = implode(' or ', $constraint);
        self::$error = "This value should be equal to $constraintStr";
        return false;
    }

 	private function NotEqualTo_Check($value, $constraint) {
		foreach ($constraint as $compare) {
        	if($compare == $value) {
				$constraintStr = implode(' or ', $constraint);
		        self::$error = "This value should not be equal to $constraintStr";
		        return false;
        	} 
        }
        return true;
    }

	private function IdenticalTo_Check($value, $constraint) {
		foreach ($constraint as $compare) {
        	if($compare === $value) return true;
        }
        $constraintStr = implode(' or ', $constraint);
        self::$error = "This value should be identical to $constraintStr";
        return false;
    }

 	private function NotIdenticalTo_Check($value, $constraint) {
		foreach ($constraint as $compare) {
        	if($compare === $value) {
				$constraintStr = implode(' or ', $constraint);
		        self::$error = "This value should not be identical to $constraintStr";
		        return false;
        	} 
        }
        return true;
    }

	private function LessThan_Check($value, $constraint) {
		if($constraint > $value) return true;
        else {
        	self::$error = "This value should be less than to $constraint";
        	return false;
        }
    }
        
	private function LessThanOrEqual_Check($value, $constraint) {
		if($constraint >= $value) return true;
        else {
        	self::$error = "This value should be less than or equal to $constraint";
        	return false;
        }
    }
        
	private function GreaterThan_Check($value, $constraint) {
		if($constraint < $value) return true;
        else {
        	self::$error = "This value should be greater than to $constraint";
        	return false;
        }
    }
        
	private function GreaterThanOrEqual_Check($value, $constraint) {
		if($constraint <= $value) return true;
        else {
        	self::$error = "This value should be greater than or equal to $constraint";
        	return false;
        }
    }
        
// Contraintes sur les dates
	private function Date_Check($value, $constraint) {
		if($constraint) {
			if (null === $value || '' === $value || $value instanceof \DateTime) {
	            return true;
	        }

	        $value = (string) $value;

	        switch ($constraint['format']) {
	        	case 'fr':
	        		// jj-mm-aaaa
	        		$pattern = '#^(\d{2})-(\d{2})-(\d{4})$#';
	        		break;
	        	
	        	case 'en':
	        		// mm/jj/aaaa
	        		$pattern = '#^(\d{2})/(\d{2})/(\d{4})$#';
	        		break;
	        	
	        	default:
	        		// aaaa-mm-jj
	        		$pattern = '#^(\d{4})-(\d{2})-(\d{2})$#';
	        		break;
	        	}

	        if (!preg_match($pattern, $value, $matches) || !checkdate($matches[2], $matches[3], $matches[1])) {
	            self::$error = 'This value is not a valid date';
        		return false;
	        }
	    }
    }
        

// Contraintes sur les fichiers
	private function File_Check($value, $constraint) {
		// origin : http://www.php.net/manual/fr/features.file-upload.php#114004
		    // Undefined | Multiple Files | $_FILES Corruption Attack
		    // If this request falls under any of them, treat it invalid.
		    if (
		        !isset($value['upfile']['error']) ||
		        is_array($value['upfile']['error'])
		    ) {
		    	self::$error = 'Invalid parameters.';
        		return false;
		    }

		    // Check $_FILES['upfile']['error'] value.
		    switch ($value['upfile']['error']) {
		        case UPLOAD_ERR_OK:
		            break;
		        case UPLOAD_ERR_NO_FILE:
			        self::$error = 'No file sent.';
	        		return false;
		        case UPLOAD_ERR_INI_SIZE:
		        case UPLOAD_ERR_FORM_SIZE:
			        self::$error = 'Exceeded filesize limit.';
	        		return false;
		        default:
			        self::$error = 'Unknown errors.';
	        		return false;
		    }

		    // You should also check filesize here.
		    if ($value['upfile']['size'] > $constraint['maxSize']) {
		        self::$error = 'Exceeded filesize limit.';
	        	return false;
		    }

		    // DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
		    // Check MIME Type by yourself.
		    $finfo = new \finfo(FILEINFO_MIME_TYPE);
		    if (false === $ext = array_search(
		        $finfo->file($value['upfile']['tmp_name']),$constraint['mimeTypes'], true)) {
		        self::$error = 'Invalid file format.';
	        	return false;
		    }

		    return true;
		
    }
        

    


}







?>