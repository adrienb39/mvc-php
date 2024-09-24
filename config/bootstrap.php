<?php

require_once __DIR__ . "/../vendor/autoload.php";

$paths = [__DIR__ . "/../src/Entity/"];
$isDevMode = true;

$configuration = \Doctrine\ORM\ORMSetup::createAttributeMetadataConfiguration($paths, $isDevMode);

$configurationDB = ['driver' => 'pdo_mysql', 'path' => __DIR__ . "/../.env"];

$connexionDB = \Doctrine\DBAL\DriverManager::getConnection($configurationDB, $configuration);

$entityManager = new \Doctrine\ORM\EntityManager($connexionDB, $configuration);
return $entityManager;