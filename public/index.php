<?php

// Controleur FRONTAL => Routeur
// Toutes les requêtes des utilisateurs passent par ce fichier

require_once __DIR__ . "/../vendor/autoload.php";

/**
 * @var Doctrine\ORM\EntityManager $entityManager
 */

$entityManager = require_once __DIR__ . '/../config/bootstrap.php';

// Chargement des variables d'environnement
$dotEnv = \Dotenv\Dotenv::createImmutable(__DIR__ . "/../");
$dotEnv->load(); // Charger les variables d'environnement de .env dans $_ENV
// Mise en place du routing
$route = $_GET["route"] ?? 'accueil';
// Tester la valeur de $route
switch ($route) {
    case 'accueil':
        $accueilController = new \App\Controllers\AccueilController();
        $accueilController->accueil();
        break;
    case 'livre-list':
        // Injecter la dépendance $livreDao dans l'objet LivreController
        $livreController = new \App\Controllers\LivreController($entityManager);
        $livreController->liste();
        break;
    case 'livre-details':
        $livreController = new \App\Controllers\LivreController($entityManager);
        $livreController->details($_GET["livre"]);
        break;
    case 'livre-add':
        $livreController = new \App\Controllers\LivreController($entityManager);
        $livreController->add();
        break;
    case 'livre-edit':
        $livreController = new \App\Controllers\LivreController($entityManager);
        $livreController->edit($_GET['livre']);
        break;
    case 'livre-delete':
        $livreController = new \App\Controllers\LivreController($entityManager);
        $livreController->delete($_GET['livre']);
        break;
    default:
        // Erreur 404
        echo "Page non trouvée";
        break;
}
// if ($route === "accueil") {
//     // Créer un objet AccueilController
//     $accueilController = new \App\Controllers\AccueilController();
//     $accueilController->accueil();
//
// } else {
//     echo "Page non trouvé";
// }