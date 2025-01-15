<?php


require_once "DataBase.Class.php";

class Categorie extends DataBase
{

    // fonction addcategorie() ***************************************************************************************************************************************************
    public function addcategorie($titre_categorie)
    {
        try {
            if (!preg_match('/^[a-zA-ZÀ-ÖØ-öø-ÿ]+$/u', $titre_categorie)) {
                return "Le tag doit contenir seulement les lettres.";
            }

            $pdo = $this->connect();
            $sql_add = "INSERT INTO categorie (titre_categorie) VALUES (:titre_categorie)";
            $stmt_add = $pdo->prepare($sql_add);
            $stmt_add->execute([':titre_categorie' => $titre_categorie]);
            return;
        } catch (Exception $e) {
            return "Erreur : Lors de l'ajout de categorie !!! " . $e->getMessage();
        }
    }

    // fonction deletecategorie() ***************************************************************************************************************************************************
    public function deleteCategorie($id_categorie)
    {
        try {
            $pdo = $this->connect();
            $sql_add = "DELETE FROM categorie WHERE id_categorie = :id_categorie";
            $stmt_add = $pdo->prepare($sql_add);
            $stmt_add->execute([':id_categorie' => $id_categorie]);
            header("Location: tags_categories.php");
            return;
        } catch (Exception $e) {
            return "Erreur : Lors de la suupression de categorie !!! " . $e->getMessage();
        }
    }

    // fonction getAllCategorie() ***************************************************************************************************************************************************
    public function getAllCategorie()
    {
        try {
            $pdo = $this->connect();
            $sqt_all = "SELECT * FROM categorie";
            $stmt_all = $pdo->prepare($sqt_all);
            $stmt_all->execute();

            return $stmt_all->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return "Erreur : Lors de la récupération des catégories !!! " . $e->getMessage();
        }
    }
}
