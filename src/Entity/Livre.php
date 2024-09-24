<?php

namespace App\Entity;

// Cette classe représente une entité (table liée dans la BD)
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'livre')]
class Livre
{
    #[ORM\Id]
    #[ORM\Column(name: 'id_livre', type: 'integer')]
    #[ORM\GeneratedValue]
    private int $id;
    #[ORM\Column(name: 'titre_livre', type: 'string', length: 100, nullable: false)]
    private string $titre;
    #[ORM\Column(name: 'auteur_livre', type: 'string', length: 100, nullable: false)]
    private string $auteur;
    #[ORM\Column(name: 'nombre_pages_livre', type: 'integer', nullable: false)]
    private int $nbPages;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTitre(): string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): void
    {
        $this->titre = $titre;
    }

    public function getAuteur(): string
    {
        return $this->auteur;
    }

    public function setAuteur(string $auteur): void
    {
        $this->auteur = $auteur;
    }

    public function getNbPages(): int
    {
        return $this->nbPages;
    }

    public function setNbPages(int $nbPages): void
    {
        $this->nbPages = $nbPages;
    }


}