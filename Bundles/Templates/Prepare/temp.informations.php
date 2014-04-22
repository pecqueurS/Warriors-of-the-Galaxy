<?php
$fichier = ($_SESSION["lang"]=="en") ? "informations_en" : "informations";
			$montemplate->setFile($type,TEMPLATES."HTML/contenu/".$fichier.".html");

			
?>