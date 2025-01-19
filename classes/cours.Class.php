<?php

require_once "DataBase.Class.php";

class Cours extends DataBase
{

    // fonction validerDonneesCours ***************************************************************************************************************************************************
    public function validerDonneesCours($titre, $description, $type, $contenu_cours, $categorie, $tags, $photo)
    {
        if (empty($titre) || empty($description) || empty($type) || empty($categorie) || empty($tags) || empty($photo)) {
            return "Erreur : Les champs ne peuvent pas être vides !!!";
        }

        if (!filter_var($photo, FILTER_VALIDATE_URL)) {
            return "Erreur : Le URL de la photo n'est pas valide !!!";
        }

        if (!preg_match('/^[a-zA-ZÀ-ÖØ-öø-ÿ%&,.:;\'()]+$/u', $titre) || !preg_match('/^[a-zA-ZÀ-ÖØ-öø-ÿ%&,.:;\'()]+$/u', $description)) {
            return "Erreur : Les champs titre ou description est invalide !!!";
        }

        return true;
    }

    // fonction ajouterCours ***************************************************************************************************************************************************
    protected function ajouterCours($titre, $description, $type, $contenu_cours, $categorie, $tags, $photo) {}

    // fonction afficherCours ***************************************************************************************************************************************************
    protected function afficherCours() {}

    // fonction afficherCours ***************************************************************************************************************************************************
    public function modifierCours($id_cours, $titre, $description, $type, $contenu_cours, $categorie, $tags, $photo)
    {
        $pdo = $this->connect();
        try {
            // Démarrage de la transaction
            $pdo->beginTransaction();

            // Récupérer l'ancien type de contenu
            $old_type = $this->getType($id_cours);

            // Cas où le type ne change pas
            if ($old_type === $type) {
                if ($type === "Texte") {
                    $sql_update = "UPDATE cours SET 
                                titre = ?, 
                                description = ?, 
                                contenu_text = ?, 
                                id_categorie = ?, 
                                photo = ? 
                                WHERE id_cours = ?";
                    $stmt_update = $pdo->prepare($sql_update);
                    $stmt_update->execute([$titre, $description, $contenu_cours, $categorie, $photo, $id_cours]);
                } elseif ($type === "Video") {
                    $sql_update = "UPDATE cours SET 
                                titre = ?, 
                                description = ?, 
                                contenu_video = ?, 
                                id_categorie = ?, 
                                photo = ? 
                                WHERE id_cours = ?";
                    $stmt_update = $pdo->prepare($sql_update);
                    $stmt_update->execute([$titre, $description, $contenu_cours, $categorie, $photo, $id_cours]);
                }
            } else {
                // Cas où le type change
                if ($type === "Texte") {
                    $sql_update = "UPDATE cours SET 
                                titre = ?, 
                                description = ?, 
                                type_contenu = ?, 
                                contenu_text = ?, 
                                contenu_video = NULL, 
                                id_categorie = ?, 
                                photo = ? 
                                WHERE id_cours = ?";
                    $stmt_update = $pdo->prepare($sql_update);
                    $stmt_update->execute([$titre, $description, $type, $contenu_cours, $categorie, $photo, $id_cours]);
                    $_SESSION['type_cours'] = "Texte";
                } elseif ($type === "Video") {
                    $sql_update = "UPDATE cours SET 
                                titre = ?, 
                                description = ?, 
                                type_contenu = ?, 
                                contenu_video = ?, 
                                contenu_text = NULL, 
                                id_categorie = ?, 
                                photo = ? 
                                WHERE id_cours = ?";
                    $stmt_update = $pdo->prepare($sql_update);
                    $stmt_update->execute([$titre, $description, $type, $contenu_cours, $categorie, $photo, $id_cours]);
                    $_SESSION['type_cours'] = "Video";
                }
            }

            // Suppression des anciens tags liés au cours
            $sql_delete_tags = "DELETE FROM cours_tags WHERE id_cours = ?";
            $stmt_delete_tags = $pdo->prepare($sql_delete_tags);
            $stmt_delete_tags->execute([$id_cours]);

            // Ajout des nouveaux tags, si disponibles
            if (!empty($tags)) {
                $sql_insert_tags = "INSERT INTO cours_tags (id_cours, id_tag) VALUES (?, ?)";
                $stmt_insert_tags = $pdo->prepare($sql_insert_tags);
                foreach ($tags as $tag) {
                    $stmt_insert_tags->execute([$id_cours, $tag]);
                }
            }

            // Validation de la transaction
            $pdo->commit();
            header("Location: E_details_cours.php");
            return "Le cours a été modifié avec succès.";
        } catch (Exception $e) {
            // Annulation en cas d'erreur
            $pdo->rollBack();
            return "Erreur lors de la modification du cours : " . $e->getMessage();
        }
    }


    // fonction getType ***************************************************************************************************************************************************
    public function getType($id_cours)
    {
        $pdo = $this->connect();
        try {
            $sql_check_type = "SELECT type_contenu FROM cours WHERE id_cours = :id_cours";
            $stmt_type = $pdo->prepare($sql_check_type);
            $stmt_type->execute([':id_cours' => $id_cours]);
            $type = $stmt_type->fetch(PDO::FETCH_ASSOC);
            return $type ? $type['type_contenu'] : null;
        } catch (Exception $e) {
            return "Erreur : Lors de la récupérationle typr d'un cours !!! " . $e->getMessage();
        }
    }


    // fonction getAllMesCours ***************************************************************************************************************************************************
    public function getAllMesCours()
    {
        $pdo = $this->connect();

        try {

            $sql_all_C = "SELECT cr.*, cg.* FROM cours cr
                        LEFT JOIN categorie cg ON cr.id_categorie = cg.id_categorie 
                        WHERE id_enseignant = :id_user 
                ";

            $stmt_All = $pdo->prepare($sql_all_C);
            $stmt_All->execute([':id_user' => $_SESSION['id_utilisateur']]);

            $mesCours = $stmt_All->fetchAll(PDO::FETCH_ASSOC);
            return $mesCours;
        } catch (Exception $e) {
            return "Erreur : Lors de la récupération des cours !!! " . $e->getMessage();
        }
    }

    // fonction getAllMesCours ***************************************************************************************************************************************************
    public function supprimerCours($id_course)
    {
        $pdo = $this->connect();

        try {

            $sql_dlt_cours = "DELETE FROM cours WHERE id_cours = :id_cours";

            $stmt_dlt = $pdo->prepare($sql_dlt_cours);
            $stmt_dlt->execute([':id_cours' => $id_course]);
        } catch (Exception $e) {
            return "Erreur : Lors de la suppression d'un cours !!! " . $e->getMessage();
        }
    }

    // fonction getAllMesCours ***************************************************************************************************************************************************
    public function getAllCours()
    {
        $pdo = $this->connect();

        try {
            $page = (int) (isset($_GET['page']) ? 1 : $_GET['page']) ;
            $limit = 3;
            $startPoint = ($page * $limit) - $limit ;

            $sql_all_C = "SELECT cs.id_cours,
                        cs.id_enseignant,
                        cs.titre,
                        cs.description, 
                        cs.type_contenu,
                        DATE_FORMAT(cs.date_de_creation, '%d-%m-%Y') AS date_de_creation,
                        cs.photo, 
                        CONCAT(u.nom, ' ' , u.prenom) as full_name 
                        FROM cours cs
                        LEFT JOIN utilisateurs u ON cs.id_enseignant = u.id_user 
                        LIMIT ?, ? 
                ";

            $stmt_All = $pdo->prepare($sql_all_C);
            $stmt_All->execute([$limit, $startPoint]);

            $AllCours = $stmt_All->fetchAll(PDO::FETCH_ASSOC);
            return $AllCours;
        } catch (Exception $e) {
            return "Erreur : Lors de la récupération de tous les cours !!! " . $e->getMessage();
        }
    }

    // fonction getAllMesCours ***************************************************************************************************************************************************
    public function getAllCoursCategorie($categorie)
    {
        $pdo = $this->connect();

        try {

            $sql_all_C = "SELECT cs.id_cours,
                        cs.id_enseignant,
                        cs.titre,
                        cs.description, 
                        cs.type_contenu,
                        DATE_FORMAT(cs.date_de_creation, '%d-%m-%Y') AS date_de_creation,
                        cs.photo, 
                        CONCAT(u.nom, ' ' , u.prenom) as full_name 
                        FROM cours cs
                        LEFT JOIN utilisateurs u ON cs.id_enseignant = u.id_user 
                        WHERE id_categorie = :categorie
                        -- LIMIT 0, 3 
                ";

            $stmt_All = $pdo->prepare($sql_all_C);
            $stmt_All->execute([':categorie' => $categorie]);

            $AllCours = $stmt_All->fetchAll(PDO::FETCH_ASSOC);
            return $AllCours;
        } catch (Exception $e) {
            return "Erreur : Lors de la récupération de tous les cours !!! " . $e->getMessage();
        }
    }

    // fonction getCoursByTag ***************************************************************************************************************************************************
    public function getCoursByTagId($id_tag)
    {
        $pdo = $this->connect();

        try {
            $sql = "SELECT 
                    cs.id_cours,
                    cs.titre,
                    cs.description,
                    cs.type_contenu,
                    DATE_FORMAT(cs.date_de_creation, '%d-%m-%Y') AS date_de_creation,
                    cs.photo,
                    CONCAT(u.nom, ' ', u.prenom) AS full_name,
                    t.nom_tag
                FROM cours cs
                LEFT JOIN cours_tags ct ON cs.id_cours = ct.id_cours
                LEFT JOIN tags t ON ct.id_tag = t.id_tag
                LEFT JOIN utilisateurs u ON cs.id_enseignant = u.id_user
                WHERE t.id_tag = :id_tag";

            $stmt = $pdo->prepare($sql);

            $stmt->execute([':id_tag' => $id_tag]);

            $cours = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $cours;
        } catch (Exception $e) {
            return "Erreur : Lors de la récupération des cours par id_tag !!! " . $e->getMessage();
        }
    }
}
