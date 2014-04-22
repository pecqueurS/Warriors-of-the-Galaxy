<?php
$fichier = ($_SESSION["lang"]=="en") ? "about_en" : "about";
			$montemplate->setFile($type,TEMPLATES."HTML/contenu/".$fichier.".html");

			
?>