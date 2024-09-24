<?php

namespace App\Dao;

use App\Entity\Livre;
use PDO;

class LivreDao
{
    private \PDO $db;

    /**
     * @param PDO $db
     */
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    // Envoyer la requête "SELECT * FROM Livre"
    // Retourner les enregistrements sous la forme d'un tableau
    // d'objets de la classe Livre

    public function selectAll(): array
    {
        $requete = $this->db->query("SELECT * FROM livre");
        $livresBD = $requete->fetchAll(\PDO::FETCH_ASSOC);
        // Mapping relationnel vers objet
        $livres = [];
        foreach ($livresBD as $livreBD) {
            $livre = new Livre();
            $livre->setId($livreBD['id_livre']);
            $livre->setTitre($livreBD['titre_livre']);
            $livre->setAuteur($livreBD['auteur_livre']);
            $livre->setNbPages($livreBD['nombre_pages_livre']);
            $livres[] = $livre;
        }
        return $livres;
    }

    public function selectOne(int $id): Livre
    {
        $requete = $this->db->query("SELECT * FROM livre WHERE id_livre = $id");
        $livreBD = $requete->fetch(\PDO::FETCH_ASSOC);
        if (!$livreBD) {
            throw new \Exception("Livre avec ID $id non trouvé");
        }
        $livre = new Livre();
        $livre->setId($livreBD['id_livre']);
        $livre->setTitre($livreBD['titre_livre']);
        $livre->setAuteur($livreBD['auteur_livre']);
        $livre->setNbPages($livreBD['nombre_pages_livre']);
        return $livre;
    }

    public function insert(Livre $livre): void
    {
        $requete = $this->db->prepare("INSERT INTO livre(titre_livre, auteur_livre, nombre_pages_livre) VALUES (:titre_livre, :auteur_livre, :nombre_pages_livre)");
        $requete->bindValue(":titre_livre", $livre->getTitre(), \PDO::PARAM_STR);
        $requete->bindValue(":auteur_livre", $livre->getAuteur(), \PDO::PARAM_STR);
        $requete->bindValue(":nombre_pages_livre", $livre->getNbPages(), \PDO::PARAM_STR);
        $requete->execute();
    }

    public function update(Livre $livre): void
    {
        $requete = $this->db->prepare("UPDATE livre SET titre_livre = :titre_livre, auteur_livre = :auteur_livre, nombre_pages_livre = :nombre_pages_livre WHERE id_livre = :id_livre");
        $requete->bindValue(":titre_livre", $livre->getTitre(), \PDO::PARAM_STR);
        $requete->bindValue(":auteur_livre", $livre->getAuteur(), \PDO::PARAM_STR);
        $requete->bindValue(":nombre_pages_livre", $livre->getNbPages(), \PDO::PARAM_STR);
        $requete->bindValue(":id_livre", $livre->getId(), \PDO::PARAM_STR);
        $requete->execute();
    }

    public function delete(int $id): void
    {
        $requete = $this->db->prepare("DELETE FROM livre WHERE id_livre = :id_livre");
        $requete->bindValue(":id_livre", $id, \PDO::PARAM_INT);
        $requete->execute();
    }
}