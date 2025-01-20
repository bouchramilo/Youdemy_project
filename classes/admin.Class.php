<?php


require_once "DataBase.Class.php";
require_once "utilisateur.Class.php";

class Admin extends Utilisateur
{

    // fonction getAllUsers() ***************************************************************************************************************************************************
    public function getAllUsers()
    {
        $pdo = $this->connect();
        try {

            $sql_users = "SELECT ut.*, eg.estValide FROM utilisateurs ut LEFT JOIN enseignants eg ON ut.id_user = eg.id_user  ";
            $stmt_users = $pdo->prepare($sql_users);
            $stmt_users->execute();

            $allUsers = $stmt_users->fetchAll(PDO::FETCH_ASSOC);

            return $allUsers;
        } catch (Exception $e) {
            return "Erreur : Lors de la récupération de tous les users !!! " . $e->getMessage();
        }
    }
    // fonction valideEnseignant() ***************************************************************************************************************************************************
    public function valideEnseignant($id_user)
    {
        $pdo = $this->connect();

        try {
            $sql_check_valid = "SELECT estValide FROM enseignants WHERE id_user = :id_user";
            $stmt_check_valide = $pdo->prepare($sql_check_valid);
            $stmt_check_valide->execute([':id_user' => $id_user]);
            $rslt = $stmt_check_valide->fetch(PDO::FETCH_ASSOC);

            $isValide = $rslt['estValide'] ? 0 : 1;

            $sql_valide = "UPDATE enseignants SET estValide = :isValide WHERE id_user = :id_user ";
            $stmt_valide = $pdo->prepare($sql_valide);
            $stmt_valide->execute([':id_user' => $id_user, ':isValide' => $isValide]);

            header("Location: gererUser.php");

            return true;
        } catch (Exception $e) {
            return "Erreur : Lors de la validation de compte d'un enseignant !!!" . $e->getMessage();
        }
    }

    // fonction NbrCours() ***************************************************************************************************************************************************
    public function NbrCours()
    {
        $pdo = $this->connect();
        try {
            $sql = "SELECT COUNT(*) AS NbrCours FROM cours ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $NbrCours = $stmt->fetch(PDO::FETCH_ASSOC);
            return $NbrCours['NbrCours'];
        } catch (Exception $e) {
            return "Erreur : Lors la récupération de nombre des cours !!! " . $e->getMessage();
        }
    }

    // fonction NbrCoursEtudiant ***************************************************************************************************************************************************
    public function NbrCoursEtudiant()
    {
        $pdo = $this->connect();
        try {
            $sql = "SELECT c.titre AS titre_cours, 
                       COUNT(ic.id_user) AS nb_etudiants
                FROM cours c
                LEFT JOIN inscription_cours ic ON c.id_cours = ic.id_cours
                GROUP BY c.id_cours
                ORDER BY nb_etudiants DESC
                LIMIT 1";

            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result;
        } catch (Exception $e) {
            return "Erreur : Lors la récupération de nombre des cours !!! " . $e->getMessage();
        }
    }

    // fonction getRepartitionParCategorie ***************************************************************************************************************************************************
    public function getRepartitionParCategorie()
    {
        $pdo = $this->connect();
        try {
            $sql = "SELECT cat.titre_categorie, COUNT(c.id_cours) AS nb_cours
                FROM categorie cat
                LEFT JOIN cours c ON cat.id_categorie = c.id_categorie
                GROUP BY cat.id_categorie, cat.titre_categorie
                ORDER BY nb_cours DESC
                LIMIT 5";

            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return "Erreur : Lors la récupération de nombre de Repartition Par Categorie !!! " . $e->getMessage();
        }
    }

    // fonction getTop3Enseignants ***************************************************************************************************************************************************
    public function getTop3Enseignants()
    {
        $pdo = $this->connect();
        try {
            $sql = "SELECT u.nom, u.prenom, COUNT(ic.id_user) AS nb_etudiants
                        FROM utilisateurs u
                        INNER JOIN enseignants e ON u.id_user = e.id_user
                        INNER JOIN cours c ON e.id_user = c.id_enseignant
                        INNER JOIN inscription_cours ic ON c.id_cours = ic.id_cours
                        GROUP BY u.id_user, u.nom, u.prenom
                        ORDER BY nb_etudiants DESC
                        LIMIT 3";

            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return "Erreur : Lors la récupération des top 3 enseignants !!! " . $e->getMessage();
        }
    }
}
