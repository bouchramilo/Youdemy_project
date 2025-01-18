


<?php

require_once "DataBase.Class.php";

class InscriptionCours extends DataBase
{
    // fonction inscrireCours ***************************************************************************************************************************************************
    public function inscrireCours($id_cours)
    {
        $pdo = $this->connect();

        try {

            $sql_inscrire = "INSERT INTO inscription_cours(id_user, id_cours) VALUES (:id_user, :id_cours)";
            $stmt = $pdo->prepare($sql_inscrire);
            $stmt->execute([
                ':id_user' => $_SESSION['id_utilisateur'],
                ':id_cours' => $id_cours
            ]);

            header("Location: index.php");
            exit();
        } catch (Exception $e) {
            echo "Erreur : Lors de l'inscription dans le cours !!! " . $e->getMessage();
        }
    }

    // fonction mesCours ***************************************************************************************************************************************************
    public function estInscrire($id_cours)
    {
        $pdo = $this->connect();

        try {

            $sql_check = "SELECT * FROM inscription_cours WHERE id_cours = :id_cours AND id_user = :id_user";
            $stmt_check = $pdo->prepare($sql_check);
            $stmt_check->execute([
                ':id_user' => $_SESSION['id_utilisateur'],
                ':id_cours' => $id_cours
            ]);

            return $stmt_check->rowCount();
        } catch (Exception $e) {
            echo "Erreur : Lors de la vérification de l'inscription dans le cours !!! " . $e->getMessage();
            return -1;
        }
    }

    // fonction mesCours ***************************************************************************************************************************************************
    public function mesCours()
    {
        $pdo = $this->connect();
        try {
            $sql_MesCours = "SELECT 
                    ic.id_user,
                    ic.id_cours,
                    c.titre,
                    c.description,
                    c.type_contenu,
                    c.photo,
                    c.date_de_creation,
                    cat.titre_categorie,
                    CONCAT(u.prenom, ' ', u.nom) AS full_name
                FROM 
                    inscription_cours ic
                INNER JOIN 
                    cours c ON ic.id_cours = c.id_cours
                LEFT JOIN 
                    categorie cat ON c.id_categorie = cat.id_categorie
                INNER JOIN 
                    utilisateurs u ON c.id_enseignant = u.id_user
                WHERE 
                    ic.id_user = :id_user
                ORDER BY 
                    ic.date_inscription DESC;
            ";

            $stmt = $pdo->prepare($sql_MesCours);
            $stmt->execute([
                ':id_user' => $_SESSION['id_utilisateur']
            ]);

            $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $resultat;
        } catch (Exception $e) {
            return "Erreur : Lors de la recupération des mes cours !!! " . $e->getMessage();
        }
    }

    // fonction deleteFromMesCours 
    public function deleteFromMesCours($id_cours)
    {
        $pdo = $this->connect();
        try {
            $sql_delete = "DELETE FROM inscription_cours WHERE id_cours = :id_cours AND id_user = :id_user";
            $stmt_delete = $pdo->prepare($sql_delete);
            $stmt_delete->execute([
                ':id_user' => $_SESSION['id_utilisateur'],
                ':id_cours' => $id_cours
            ]);
        } catch (Exception $e) {
            echo "Erreur : Lors de la suppressiom d'un cours from mes cours !!! " . $e->getMessage();
        }
    }

    // fonction AllInscriptionCours ***************************************************************************************************************************************************
    public function AllInscriptionMesCours()
    {
        $pdo = $this->connect();
        try {
            $sql_MesCours = "SELECT 
                    ic.id_user,
                    CONCAT(u.prenom, ' ', u.nom) AS nom_etudiant,
                    u.email,
                    c.id_cours,
                    c.titre,
                    c.description,
                    c.type_contenu,
                    c.photo,
                    DATE_FORMAT(ic.date_inscription, '%d-%m-%Y') AS date_inscription,
                    cat.titre_categorie
                FROM 
                    inscription_cours ic
                INNER JOIN 
                    cours c ON ic.id_cours = c.id_cours
                LEFT JOIN 
                    categorie cat ON c.id_categorie = cat.id_categorie
                INNER JOIN 
                    utilisateurs u ON ic.id_user = u.id_user
                WHERE 
                    c.id_enseignant = :id_enseignant
                ORDER BY date_inscription    
                ";

            $stmt = $pdo->prepare($sql_MesCours);
            $stmt->execute([
                ':id_enseignant' => $_SESSION['id_utilisateur']
            ]);

            $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($resultat) {
                return $resultat;
            } else {
                return [];  
            }
        } catch (Exception $e) {
            return "Erreur : Lors de la récupération des mes cours !!! " . $e->getMessage();
        }
    }

    // fonction dltInscriptionMesCours ***************************************************************************************************************************************************
    public function dltInscriptionMesCours($id_cours, $id_user)
    {
        $pdo = $this->connect();
        try {
            $sql_delete = "DELETE FROM inscription_cours WHERE id_cours = :id_cours AND id_user = :id_user";
            $stmt_delete = $pdo->prepare($sql_delete);
            $stmt_delete->execute([
                ':id_user' => $id_user,
                ':id_cours' => $id_cours
            ]);
        } catch (Exception $e) {
            echo "Erreur : Lors de la suppressiom d'un cours from mes cours !!! " . $e->getMessage();
        }
    }
    
    
    // fonction searchByCours ***************************************************************************************************************************************************
    public function searchByCours($id_cours)
    {
        $pdo = $this->connect();
        try {
            $sql_MesCours = "SELECT 
                    ic.id_user,
                    CONCAT(u.prenom, ' ', u.nom) AS nom_etudiant,
                    u.email,
                    c.id_cours,
                    c.titre,
                    c.description,
                    c.type_contenu,
                    c.photo,
                    DATE_FORMAT(ic.date_inscription, '%d-%m-%Y') AS date_inscription,
                    cat.titre_categorie
                FROM 
                    inscription_cours ic
                INNER JOIN 
                    cours c ON ic.id_cours = c.id_cours
                LEFT JOIN 
                    categorie cat ON c.id_categorie = cat.id_categorie
                INNER JOIN 
                    utilisateurs u ON ic.id_user = u.id_user
                WHERE 
                    c.id_enseignant = :id_enseignant AND c.id_cours = :id_cours
                ORDER BY date_inscription    
                ";

            $stmt = $pdo->prepare($sql_MesCours);
            $stmt->execute([
                ':id_enseignant' => $_SESSION['id_utilisateur'],
                ':id_cours' => $id_cours
            ]);

            $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($resultat) {
                return $resultat;
            } else {
                return [];  
            }
        } catch (Exception $e) {
            return "Erreur : Lors de la récupération des mes cours !!! " . $e->getMessage();
        }
    }
    
    
    // fonction searchByCategorie ***************************************************************************************************************************************************
    public function searchByCategorie($id_categorie)
    {
        $pdo = $this->connect();
        try {
            $sql_MesCours = "SELECT 
                    ic.id_user,
                    CONCAT(u.prenom, ' ', u.nom) AS nom_etudiant,
                    u.email,
                    c.id_cours,
                    c.titre,
                    c.description,
                    c.type_contenu,
                    c.photo,
                    DATE_FORMAT(ic.date_inscription, '%d-%m-%Y') AS date_inscription,
                    cat.titre_categorie
                FROM 
                    inscription_cours ic
                INNER JOIN 
                    cours c ON ic.id_cours = c.id_cours
                LEFT JOIN 
                    categorie cat ON c.id_categorie = cat.id_categorie
                INNER JOIN 
                    utilisateurs u ON ic.id_user = u.id_user
                WHERE 
                    c.id_enseignant = :id_enseignant AND c.id_categorie = :id_categorie
                ORDER BY date_inscription    
                ";

            $stmt = $pdo->prepare($sql_MesCours);
            $stmt->execute([
                ':id_enseignant' => $_SESSION['id_utilisateur'],
                ':id_categorie' => $id_categorie
            ]);

            $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($resultat) {
                return $resultat;
            } else {
                return [];  
            }
        } catch (Exception $e) {
            return "Erreur : Lors de la récupération des mes cours !!! " . $e->getMessage();
        }
    }
}
