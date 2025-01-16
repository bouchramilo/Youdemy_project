<?php

require_once "DataBase.Class.php";
require_once "cours.Class.php";

class CoursVideo extends Cours
{

    // fonction addCours ***************************************************************************************************************************************************
    // fonction addCoursVideo ***************************************************************************************************************************************************
    public function ajouterCours($titre, $description, $type, $contenu_cours, $categorie, $tags, $photo)
    {
        $pdo = $this->connect();

        // Validation des données de cours (cette fonction est défini dans la classe 'Cours')
        // $validationResult =  parent::validerDonneesCours($titre, $description, $type, $contenu_cours, $categorie, $tags, $photo);
        // if ($validationResult !== true) {
        //     return $validationResult;
        // }

        try {
            $pdo->beginTransaction();

            $sql_add_C_V = "INSERT INTO cours (id_enseignant, titre, description, type_contenu, contenu_video, id_categorie, photo) VALUES (:id_enseignant, :titre, :descri, :type_contenu, :contenu_video, :id_categorie, :photo)";
            $stmt_add_cours = $pdo->prepare($sql_add_C_V);
            $stmt_add_cours->execute([
                ':id_enseignant' => $_SESSION['id_utilisateur'],
                ':titre' => $titre,
                ':descri' => $description,
                ':type_contenu' => $type,
                ':contenu_video' => $contenu_cours,
                ':id_categorie' => $categorie,
                ':photo' => $photo
            ]);

            $ID_cours = $pdo->lastInsertId();

            try {
                $sql_add_TC = "INSERT INTO cours_tags(id_cours, id_tag) VALUES(:ID_cours, :id_tag) ";
                $stmt = $pdo->prepare($sql_add_TC);

                foreach ($tags as $tag_id) {
                    $stmt->execute([
                        ':ID_cours' => $ID_cours,
                        ':id_tag' => $tag_id
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

    public function afficherCours() {}
}
