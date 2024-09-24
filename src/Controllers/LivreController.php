<?php

namespace App\Controllers;

use App\Entity\Livre;
use Doctrine\ORM\EntityManager;

class LivreController
{
    private EntityManager $entityManager; // Dépendance

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function liste()
    {
        // Fait appel au modèle afin de récupérer les données dans la BD
        $livres = $this->entityManager->getRepository(Livre::class)->findAll();
        // Fait appel à la vue afin de renvoyer la page
        require __DIR__ . "/../../views/livre/list.php";
    }
    public function details($id)
    {
        $livre = $this->entityManager->getRepository(Livre::class)->find($id);
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
                $this->entityManager->persist($livre);
                $this->entityManager->flush();
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
                $livre = $this->entityManager->getRepository(Livre::class)->find($id);
                if ($livre) {
                    $livre->setTitre($_POST["titre_livre"]);
                    $livre->setAuteur($_POST["auteur_livre"]);
                    $livre->setNbPages($_POST["nombre_pages_livre"]);
                    $this->entityManager->flush();
                }
                header("location: /?route=livre-list");
            } else {
                $livre = $this->entityManager->getRepository(Livre::class)->find($id);
                require __DIR__ . "/../../views/livre/edit.php";
            }
        } else {
            $livre = $this->entityManager->getRepository(Livre::class)->find($id);
            require __DIR__ . "/../../views/livre/edit.php";
        }
    }

    public function delete($id)
    {
        $this->entityManager->remove($this->entityManager->getRepository(Livre::class)->find($id));
        $this->entityManager->flush();
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