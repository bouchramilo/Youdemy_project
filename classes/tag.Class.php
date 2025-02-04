<?php


require_once "DataBase.Class.php";

class Tag extends DataBase
{

    // fonction addTag() ***************************************************************************************************************************************************
    public function addTag($nom_tag)
    {
        try {
            if (!preg_match('/^[\p{L}0-9\s%&,.:;\'()!?-]+$/u', $nom_tag)) {
                return "Le tag doit contenir uniquement des lettres et des virgules pour séparer les tags.";
            }

            $pdo = $this->connect();

            $name_tags = trim($nom_tag);
            $tags = array_map('trim', explode(',', $name_tags));

            foreach ($tags as $tag) {
                if (!empty($tag)) {
                    $sql_add = "INSERT INTO tags (nom_tag) VALUES (:nom_tag)";
                    $stmt_add = $pdo->prepare($sql_add);
                    $stmt_add->execute([':nom_tag' => htmlspecialchars($tag)]);
                }
            }
            header("Location: tags_categories.php");
        } catch (Exception $e) {
            echo "Erreur : Lors de l'ajout des tags ! " . $e->getMessage();
        }
    }

    // fonction deleteTag() ***************************************************************************************************************************************************
    public function deleteTag($id_tag)
    {
        try {
            $pdo = $this->connect();
            $sql_delete = "DELETE FROM tags WHERE id_tag = :id_tag";
            $stmt_delete = $pdo->prepare($sql_delete);
            $stmt_delete->execute([':id_tag' => htmlspecialchars($id_tag)]);
            header("Location: tags_categories.php");
            return;
        } catch (Exception $e) {
            return "Erreur : Lors de la suupression de tag !!! " . $e->getMessage();
        }
    }

    // fonction updateTag() ***************************************************************************************************************************************************
    public function updateTag($id_tag, $nameTag)
    {
        try {
            $pdo = $this->connect();
            $sql_update = "UPDATE tags SET nom_tag = :nameTag WHERE id_tag = :id_tag";
            $stmt_update = $pdo->prepare($sql_update);
            $stmt_update->execute([
                ':nameTag' => htmlspecialchars($nameTag),
                ':id_tag' => htmlspecialchars($id_tag)
            ]);
            header("Location: tags_categories.php");
            return;
        } catch (Exception $e) {
            return "Erreur : Lors de la modification de tag !!! " . $e->getMessage();
        }
    }

    // fonction getAllTags() ***************************************************************************************************************************************************
    public function getAllTags()
    {
        try {
            $pdo = $this->connect();
            $sqt_all = "SELECT * FROM tags";
            $stmt_all = $pdo->prepare($sqt_all);
            $stmt_all->execute();

            return $stmt_all->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return "Erreur : Lors de la récupération des tags !!! " . $e->getMessage();
        }
    }
}
