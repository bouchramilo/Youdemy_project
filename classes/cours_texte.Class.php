<?php
// session_start();
require_once "DataBase.Class.php";
require_once "cours.Class.php";
// session_start();


class CoursText extends Cours
{

    // fonction addCoursText ***************************************************************************************************************************************************
    public function ajouterCours($titre, $description, $type, $contenu_cours, $categorie, $tags, $photo)
    {
        $pdo = $this->connect();

        $validationResult = parent::validerDonneesCours($titre, $description, $type, $contenu_cours, $categorie, $tags, $photo);
        if ($validationResult !== true) {
            return $validationResult;
        }

        try {
            $pdo->beginTransaction();

            $sql_add_C_T = "INSERT INTO cours (id_enseignant, titre, description, type_contenu, contenu_text, id_categorie, photo) 
                        VALUES (:id_enseignant, :titre, :descri, :type_contenu, :contenu_text, :id_categorie, :photo)";
            $stmt_add_cours = $pdo->prepare($sql_add_C_T);

            echo "test ttttttttttttttttt";
            echo gettype($_SESSION['id_utilisateur']);
            $stmt_add_cours->execute([
                ':id_enseignant' => $_SESSION['id_utilisateur'],
                ':titre' => $titre,
                ':descri' => $description,
                ':type_contenu' => $type,
                ':contenu_text' => $contenu_cours,
                ':id_categorie' => $categorie,
                ':photo' => $photo
            ]);

            echo $pdo->lastInsertId();

            $ID_cours = $pdo->lastInsertId();

            // if (!empty($tags)) {

            foreach ($tags as $tag_id) {
                $sql_add_TC = "INSERT INTO cours_tags (id_cours, id_tag) VALUES (:ID_cours, :id_tag)";
                $stmt = $pdo->prepare($sql_add_TC);
                $stmt->execute([
                    ':ID_cours' => $ID_cours,
                    ':id_tag' => $tag_id
                ]);
            }
            // }

            $pdo->commit();
            return true;
        } catch (Exception $e) {
            $pdo->rollBack();
            return "Erreur : Lors de l'insertion de cours ou de tags !!! " . $e->getMessage();
        }
    }

    // fonction addCours ***************************************************************************************************************************************************
    public function afficherCours() {}
}
