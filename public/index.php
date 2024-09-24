<?php

// Controleur FRONTAL => Routeur
// Toutes les requêtes des utilisateurs passent par ce fichier

require_once __DIR__ . "/../vendor/autoload.php";

// Chargement des variables d'environnement
$dotEnv = \Dotenv\Dotenv::createImmutable(__DIR__ . "/../");
$dotEnv->load(); // Charger les variables d'environnement de .env dans $_ENV

// Configurer la connexion à la base de données
$db = new PDO("mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']}", $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);

// Mise en place du routing
$route = $_GET["route"] ?? 'accueil';
// Tester la valeur de $route
switch ($route) {
    case 'accueil':
        $accueilController = new \App\Controllers\AccueilController();
        $accueilController->accueil();
        break;
    case 'livre-list':
        // $livreDao est une dépendance de LivreController
        $livreDao = new \App\Dao\LivreDao($db);
        // Injecter la dépendance $livreDao dans l'objet LivreController
        $livreController = new \App\Controllers\LivreController($livreDao);
        $livreController->liste();
        break;
    case 'livre-details':
        $livreDao = new \App\Dao\LivreDao($db);
        $livreController = new \App\Controllers\LivreController($livreDao);
        $livreController->details($_GET["livre"]);
        break;
    case 'livre-add':
        $livreDao = new \App\Dao\LivreDao($db);
        $livreController = new \App\Controllers\LivreController($livreDao);
        $livreController->add();
        break;
    case 'livre-edit':
        $livreDao = new \App\Dao\LivreDao($db);
        $livreController = new \App\Controllers\LivreController($livreDao);
        $livreController->edit($_GET['livre']);
        break;
    case 'livre-delete':
        $livreDao = new \App\Dao\LivreDao($db);
        $livreController = new \App\Controllers\LivreController($livreDao);
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