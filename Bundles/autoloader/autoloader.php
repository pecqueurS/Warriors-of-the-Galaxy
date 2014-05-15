<?php

require_once __DIR__.'/ClassLoader/UniversalClassLoader.php';

use Symfony\Component\ClassLoader\UniversalClassLoader;




$loader = new UniversalClassLoader();

/*$loader->registerNamespaces(array(
    'Doctrine\\Common'           => __DIR__.'/vendor/doctrine/common/lib',
    'Doctrine\\DBAL\\Migrations' => __DIR__.'/vendor/doctrine/migrations/lib',
    'Doctrine\\DBAL'             => __DIR__.'/vendor/doctrine/dbal/lib',
    'Doctrine'                   => __DIR__.'/vendor/doctrine/orm/lib',
));*/



$loader->registerNamespaces(array(
    'Bundles\\Bdd'           	=> dirname(dirname(__DIR__)),
    'Bundles\\Parametres'       => dirname(dirname(__DIR__)),
    'Controllers'       		=> dirname(dirname(__DIR__)),
    'Models'					=> dirname(dirname(__DIR__)),
    'Bundles\\Calculs'					=> dirname(dirname(__DIR__)),
    
    
));
var_dump($loader->getNamespaces());
$loader->register();





?>