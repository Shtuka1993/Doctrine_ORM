<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once "vendor/autoload.php";

$isDevMode = true;
$path = __DIR__."/src";
$config = Setup::createAnnotationMetadataConfiguration([$path], $isDevMode, null, null, false);
$conn = [
    'driver' => 'pdo_mysql',
    'dbname' => 'doctrine_test_db',
    'user' => 'root',
    'password' => '',
    'host' => 'localhost',
];

$entityManager = EntityManager::create($conn, $config);