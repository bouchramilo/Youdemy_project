<?php

require_once "DataBase.Class.php";
require_once "cours.Class.php";

class CoursVideo extends Cours
{

    // fonction addCoursVideo ***************************************************************************************************************************************************
    public function ajouterCours($titre, $description, $type, $contenu_cours, $categorie, $tags, $photo)
    {
        $pdo = $this->connect();

        // Validation des données de cours (cette fonction est défini dans la classe 'Cours')
        $validationResult =  parent::validerDonneesCours($titre, $description, $type, $contenu_cours, $categorie, $tags, $photo);
        if ($validationResult !== true) {
            return $validationResult;
        }

        try {
            $pdo->beginTransaction();

            $sql_add_C_V = "INSERT INTO cours (id_enseignant, titre, description, type_contenu, contenu_video, id_categorie, photo) VALUES (:id_enseignant, :titre, :descri, :type_contenu, :contenu_video, :id_categorie, :photo)";
            $stmt_add_cours = $pdo->prepare($sql_add_C_V);
            $stmt_add_cours->execute([
                ':id_enseignant' => htmlspecialchars($_SESSION['id_utilisateur']),
                ':titre' => htmlspecialchars($titre),
                ':descri' => htmlspecialchars($description),
                ':type_contenu' => htmlspecialchars($type),
                ':contenu_video' => htmlspecialchars($contenu_cours),
                ':id_categorie' => htmlspecialchars($categorie),
                ':photo' => htmlspecialchars($photo)
            ]);

            $ID_cours = $pdo->lastInsertId();

            try {
                $sql_add_TC = "INSERT INTO cours_tags(id_cours, id_tag) VALUES(:ID_cours, :id_tag) ";
                $stmt = $pdo->prepare($sql_add_TC);

                foreach ($tags as $tag_id) {
                    $stmt->execute([
                        ':ID_cours' => htmlspecialchars($ID_cours),
                        ':id_tag' => htmlspecialchars($tag_id)
                    ]);
                }
            } catch (Exception $e) {
                return "Erreur : Lors de l'insertion des tags de cours !!! " . $e->getMessage();
            }

            $pdo->commit();
            return true;
        } catch (Exception $e) {
            $pdo->rollBack();
            return "Erreur : Lors de l'insertion de cours !!! " . $e->getMessage();
        }
    }

    // fonction showCours ***************************************************************************************************************************************************
    public function afficherCours()
    {
        $pdo = $this->connect();
        try {
            $sql_details = "SELECT 
                            cr.id_cours, 
                            cr.titre, 
                            cr.description, 
                            cr.type_contenu, 
                            cr.contenu_video AS content, 
                            cr.date_de_creation, 
                            cr.id_categorie, 
                            cr.photo, 
                            cr.id_enseignant, 
                            c.titre_categorie, 
                            CONCAT(en.nom, ' ', en.prenom) AS full_name
                        FROM cours cr
                        LEFT JOIN cours_tags tc ON cr.id_cours = tc.id_cours
                        -- LEFT JOIN tags t ON tc.id_tag = t.id_tag 
                        LEFT JOIN categorie c ON cr.id_categorie = c.id_categorie
                        LEFT JOIN utilisateurs en ON cr.id_enseignant = en.id_user
                        WHERE cr.id_cours = :id_cours AND cr.type_contenu = 'Video'";

            $stmt = $pdo->prepare($sql_details);
            $stmt->execute([
                ':id_cours' => htmlspecialchars($_SESSION['id_cours'])
            ]);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (Exception $e) {
            error_log("Erreur SQL dans afficherCours : " . $e->getMessage());
            return "Erreur : Impossible de récupérer les détails du cours.";
        }
    }
}
