<?php

require_once "DataBase.Class.php";
require_once "utilisateur.Class.php";


class Enseignant extends Utilisateur
{


    public function getNombreInscriptionsParCours()
    {
        $pdo = $this->connect();
        $sql = "SELECT c.titre AS titre_cours,
             COUNT(c.id_cours) AS nb_cours,
             COUNT(ic.id_user) AS nb_inscriptions
            FROM cours c
            LEFT JOIN inscription_cours ic ON c.id_cours = ic.id_cours
            WHERE c.id_enseignant = :id_enseignant
            GROUP BY c.id_cours, c.titre
            ORDER BY nb_inscriptions DESC
        ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id_enseignant'=> $_SESSION['id_utilisateur']]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
