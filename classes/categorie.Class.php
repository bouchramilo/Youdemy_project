<?php

require_once "DataBase.Class.php";

class Categorie extends DataBase
{
    private $nom_categorie ;
    private $id_categorie ;

    // fonction addcategorie() ***************************************************************************************************************************************************
    public function addcategorie($titre_categorie)
    {
        try {
            if (!preg_match('/^[\p{L}0-9\s%&,.:;\'()!?-]+$/u', $titre_categorie)) {
                return "Le tag doit contenir seulement les lettres.";
            }

            $pdo = $this->connect();
            $sql_add = "INSERT INTO categorie (titre_categorie) VALUES (:titre_categorie)";
            $stmt_add = $pdo->prepare($sql_add);
            $stmt_add->execute([':titre_categorie' => htmlspecialchars($titre_categorie)]);
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
            $sql_delete = "DELETE FROM categorie WHERE id_categorie = :id_categorie";
            $stmt_delete = $pdo->prepare($sql_delete);
            $stmt_delete->execute([':id_categorie' => htmlspecialchars($id_categorie)]);
            header("Location: tags_categories.php");
            return;
        } catch (Exception $e) {
            return "Erreur : Lors de la suupression de categorie !!! " . $e->getMessage();
        }
    }

    // fonction updateCategorie() ***************************************************************************************************************************************************
    public function updateCategorie($id_categorie, $titreCategorie)
    {
        try {
            $pdo = $this->connect();
            $sql_update = "UPDATE categorie SET titre_categorie = :titreCategorie WHERE id_categorie = :id_categorie";
            $stmt_update = $pdo->prepare($sql_update);
            $stmt_update->execute([
                ':titreCategorie' => htmlspecialchars($titreCategorie),
                ':id_categorie' => htmlspecialchars($id_categorie)
            ]);
            header("Location: tags_categories.php");
            return;
        } catch (Exception $e) {
            return "Erreur : Lors de la modification de categorie !!! " . $e->getMessage();
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
