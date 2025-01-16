<?php

require_once "DataBase.Class.php";

class Cours extends DataBase{

    // fonction validerDonneesCours ***************************************************************************************************************************************************
    public function validerDonneesCours($titre, $description, $type, $contenu_cours, $categorie, $tags, $photo){
        if (empty($titre) || empty($description) || empty($type) || empty($categorie) || empty($tags) || empty($photo) ) {
            return "Erreur : Les champs ne peuvent pas être vides !!!";
        }

        if (!filter_var($photo, FILTER_VALIDATE_URL)) {
            return "Erreur : Le URL de la photo n'est pas valide !!!";
        }

        if (!preg_match('/^[a-zA-ZÀ-ÖØ-öø-ÿ%&,.:;\'()]+$/u', $titre) || !preg_match('/^[a-zA-ZÀ-ÖØ-öø-ÿ%&,.:;\'()]+$/u', $description)) {
            return "Erreur : Les champs titre ou description est invalide !!!";
        }

        return true ;
    }

    // fonction ajouterCours ***************************************************************************************************************************************************
    protected function ajouterCours($titre, $description, $type, $contenu_cours, $categorie, $tags, $photo){}

    // fonction afficherCours ***************************************************************************************************************************************************
    protected function afficherCours(){}
    
    
    // fonction getAllMesCours ***************************************************************************************************************************************************
    public function getAllMesCours(){
        $pdo = $this->connect();

        try{

            $sql_all_C = "SELECT cr.*, cg.* FROM cours cr
                        LEFT JOIN categorie cg ON cr.id_categorie = cg.id_categorie 
                        WHERE id_enseignant = :id_user 
                ";
            
            $stmt_All = $pdo->prepare($sql_all_C);
            $stmt_All->execute([':id_user' => $_SESSION['id_utilisateur']]);

            $mesCours = $stmt_All->fetchAll(PDO::FETCH_ASSOC);
            return $mesCours ;

        }catch(Exception $e){
            return "Erreur : Lors de la récupération des cours !!! " . $e->getMessage();
        }
    }
    
    // fonction getAllMesCours ***************************************************************************************************************************************************
    public function supprimerCours($id_course){
        $pdo = $this->connect();

        try{

            $sql_dlt_cours = "DELETE FROM cours WHERE id_cours = :id_cours";
            
            $stmt_dlt = $pdo->prepare($sql_dlt_cours);
            $stmt_dlt->execute([':id_cours' => $id_course]);

        }catch(Exception $e){
            return "Erreur : Lors de la suppression d'un cours !!! " . $e->getMessage();
        }
    }
}




