<?php

namespace App\Controllers;

use App\Dao\LivreDao;
use App\Entity\Livre;

class LivreController
{
    private LivreDao $livreDao; // Dépendance

    public function __construct(LivreDao $dao)
    {
        $this->livreDao = $dao;
    }

    public function liste()
    {
        // Fait appel au modèle afin de récupérer les données dans la BD
        $livres = $this->livreDao->selectAll();
        // Fait appel à la vue afin de renvoyer la page
        require __DIR__ . "/../../views/livre/list.php";
    }
    public function details($id)
    {
        $livre = $this->livreDao->selectOne($id);
        require __DIR__ . "/../../views/livre/details.php";
    }

    public function add()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $errors = $this->validate($_POST);
            if (empty($errors)) {
                $livre = new Livre();
                $livre->setTitre($_POST["titre_livre"]);
                $livre->setAuteur($_POST["auteur_livre"]);
                $livre->setNbPages($_POST["nombre_pages_livre"]);
                $this->livreDao->insert($livre);
                header("location: /?route=livre-list");
            } else {
                require __DIR__ . "/../../views/livre/add.php";
            }
        } else {
            require __DIR__ . "/../../views/livre/add.php";
        }
    }

    public function edit($id)
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $errors = $this->validate($_POST);
            if (empty($errors)) {
                $livre = new Livre();
                $livre->setId($id);
                $livre->setTitre($_POST["titre_livre"]);
                $livre->setAuteur($_POST["auteur_livre"]);
                $livre->setNbPages($_POST["nombre_pages_livre"]);
                $this->livreDao->update($livre);
                header("location: /?route=livre-list");
            } else {
                $livre = $this->livreDao->selectOne($id);
                require __DIR__ . "/../../views/livre/edit.php";
            }
        } else {
            $livre = $this->livreDao->selectOne($id);
            require __DIR__ . "/../../views/livre/edit.php";
        }
    }

    public function delete($id)
    {
        $this->livreDao->delete($id);
        header("location: /?route=livre-list");
    }
    
    private function validate(array $data): array {
        $errors = [];
        if (empty($data["titre_livre"])) {
            $errors["titre_livre"] = "Le titre du livre est obligatoire";
        }
        if (empty($data["auteur_livre"])) {
            $errors["auteur_livre"] = "L'auteur du livre est obligatoire";
        }
        if (empty($data["nombre_pages_livre"]) || !is_numeric($data['nombre_pages_livre'])) {
            $errors['nombre_pages_livre'] = 'Le nombre de pages du livre est obligatoire et doit un être un nombre';
        }
        return $errors;
    }
}