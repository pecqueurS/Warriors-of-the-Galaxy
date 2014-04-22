<?php

require_once(TEMPLATES."PEAR/HTML/Template/PHPLIB.php");
require_once(TEMPLATES."class/classTemplate.php");



$infopage = array(
	"PAGE_EN_COURS" => $page,
	"PAGE_HEAD_INFO" => $req2_PAGE_HEAD_INFO,
	"LINKS" => $req3_LINKS,
	"DICO" => $req4_DICO,
	"DESC_PAGE" => $req5_DESC_PAGE,
	"NOSCRIPT" => $noscript,

				);
if(!isset($var)) $var=array();


// HEAD
$template = new template($infopage, $var);
$head = $template->constructHTML("head");

// CONTENU
$contenu = $template->constructHTML($page);

// FOOTER
$footer = $template->constructHTML("footer");

echo $head;
echo $contenu;
echo $footer;
?>