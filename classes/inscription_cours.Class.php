


<?php

require_once "DataBase.Class.php";

class InscriptionCours extends DataBase
{
    // fonction inscrireCours ***************************************************************************************************************************************************
    public function inscrireCours($id_cours)
    {
        $pdo = $this->connect();

        try {

            $sql_check = "SELECT COUNT(*) FROM inscription_cours WHERE id_cours = :id_cours AND id_user = :id_user";
            $stmt_check = $pdo->prepare($sql_check);
            $stmt_check->execute([
                ':id_user' => $_SESSION['id_utilisateur'],
                ':id_cours' => $id_cours
            ]);

            if ($stmt_check->fetchColumn() === 0) {

                $sql_inscrire = "INSERT INTO inscription_cours(id_user, id_cours) VALUES (:id_user, :id_cours)";
                $stmt = $pdo->prepare($sql_inscrire);
                $stmt->execute([
                    ':id_user' => $_SESSION['id_utilisateur'],
                    ':id_cours' => $id_cours
                ]);

                header("Location: index.php");
                exit();
            }
        } catch (Exception $e) {
            echo "Erreur : Lors de l'inscription dans le cours !!! " . $e->getMessage();
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

            // Vérification si les données sont correctement récupérées
            if ($resultat) {
                return $resultat;
            } else {
                return [];  // Retourne un tableau vide si aucun résultat n'est trouvé
            }
        } catch (Exception $e) {
            return "Erreur : Lors de la récupération des mes cours !!! " . $e->getMessage();
        }
    }
}
