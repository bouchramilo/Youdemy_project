<?php

require_once "DataBase.Class.php";
require_once "utilisateur.Class.php";

class Enseignant extends Utilisateur
{

    // fonction getNombreInscriptionsParCours ***************************************************************************************************************************************************
    public function getNombreInscriptionsParCours()
    {
        $pdo = $this->connect();
        $sql = "SELECT c.titre AS titre_cours,
                       COUNT(ic.id_user) AS nb_inscriptions
                FROM cours c
                LEFT JOIN inscription_cours ic ON c.id_cours = ic.id_cours
                WHERE c.id_enseignant = :id_enseignant
                GROUP BY c.id_cours, c.titre";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id_enseignant' => $_SESSION['id_utilisateur']]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // fonction getNbrMesCours ***************************************************************************************************************************************************
    public function getNbrMesCours()
    {
        $pdo = $this->connect();
        try {
            $sql = "SELECT COUNT(*) AS nbrMerCours FROM cours WHERE id_enseignant = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$_SESSION['id_utilisateur']]);
            $nbrMerCours = $stmt->fetch(PDO::FETCH_ASSOC);
            return $nbrMerCours['nbrMerCours'];
        } catch (Exception $e) {
            return "Erreur : Lors de la récupération de nombre des mes cours !!! " . $e->getMessage();
        }
    }

    // fonction getNbrinscriptionCours ***************************************************************************************************************************************************
    public function getNbrinscriptionCours()
    {
        $pdo = $this->connect();
        try {
            $sql = "SELECT COUNT(DISTINCT ic.id_user) AS total_students
                    FROM inscription_cours ic
                    INNER JOIN cours c ON ic.id_cours = c.id_cours
                    WHERE c.id_enseignant = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$_SESSION['id_utilisateur']]);
            $nbrMerCours = $stmt->fetch(PDO::FETCH_ASSOC);
            return $nbrMerCours['total_students'];
        } catch (Exception $e) {
            return "Erreur : Lors de la récupération de nombre des mes cours !!! " . $e->getMessage();
        }
    }
}
