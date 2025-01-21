<?php

require_once "DataBase.Class.php";

class Cours extends DataBase
{
    // fonction ajouterCours ***************************************************************************************************************************************************
    protected function ajouterCours($titre, $description, $type, $contenu_cours, $categorie, $tags, $photo) {}

    // fonction afficherCours ***************************************************************************************************************************************************
    protected function afficherCours() {}

    // fonction validerDonneesCours ***************************************************************************************************************************************************
    public function validerDonneesCours($titre, $description, $type, $contenu_cours, $categorie, $tags, $photo)
    {
        if (empty($titre) || empty($description) || empty($type) || empty($categorie) || empty($tags) || empty($photo)) {
            echo "<script>alert('Erreur : Tous les champs sont obligatoires !');</script>";
            return false;
        }

        if (!filter_var($photo, FILTER_VALIDATE_URL)) {
            echo "<script>alert('Erreur : L\'URL de la photo n\'est pas valide !');</script>";
            return false;
        }

        if (
            !preg_match('/^[\p{L}0-9\s%&,.:;\'()!?-]+$/u', $titre) ||
            !preg_match('/^[\p{L}0-9\s%&,.:;\'()!?-]+$/u', $description)
        ) {
            echo "<script>alert('Erreur : Le titre ou la description contient des caractères non autorisés !');</script>";
            return false;
        }

        return true;
    }


    // fonction afficherCours ***************************************************************************************************************************************************
    public function modifierCours($id_cours, $titre, $description, $type, $contenu_cours, $categorie, $tags, $photo)
    {
        $pdo = $this->connect();
        try {
            $pdo->beginTransaction();

            $old_type = $this->getType($id_cours);

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
                    $stmt_update->execute([
                                    htmlspecialchars($titre), 
                                    htmlspecialchars($description), 
                                    htmlspecialchars($contenu_cours), 
                                    htmlspecialchars($categorie), 
                                    htmlspecialchars($photo), 
                                    htmlspecialchars($id_cours)]);
                } elseif ($type === "Video") {
                    $sql_update = "UPDATE cours SET 
                                titre = ?), 
                                description = ?, 
                                contenu_video = ?, 
                                id_categorie = ?, 
                                photo = ? 
                                WHERE id_cours = ?";
                    $stmt_update = $pdo->prepare($sql_update);
                    $stmt_update->execute([
                                    htmlspecialchars($titre), 
                                    htmlspecialchars($description), 
                                    htmlspecialchars($contenu_cours), 
                                    htmlspecialchars($categorie), 
                                    htmlspecialchars($photo), 
                                    htmlspecialchars($id_cours)
                            ]);
                }
            } else {
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
                    $stmt_update->execute([
                                        htmlspecialchars($titre), 
                                        htmlspecialchars($description), 
                                        htmlspecialchars($type), 
                                        htmlspecialchars($contenu_cours), 
                                        htmlspecialchars($categorie), 
                                        htmlspecialchars($photo), 
                                        htmlspecialchars($id_cours)
                                ]);
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
                    $stmt_update->execute([
                                    htmlspecialchars($titre), 
                                    htmlspecialchars($description), 
                                    htmlspecialchars($type), 
                                    htmlspecialchars($contenu_cours), 
                                    htmlspecialchars($categorie), 
                                    htmlspecialchars($photo), 
                                    htmlspecialchars($id_cours)
                ]);
                    $_SESSION['type_cours'] = "Video";
                }
            }

            $sql_delete_tags = "DELETE FROM cours_tags WHERE id_cours = ?";
            $stmt_delete_tags = $pdo->prepare($sql_delete_tags);
            $stmt_delete_tags->execute([htmlspecialchars($id_cours)]);

            if (!empty($tags)) {
                $sql_insert_tags = "INSERT INTO cours_tags (id_cours, id_tag) VALUES (?, ?)";
                $stmt_insert_tags = $pdo->prepare($sql_insert_tags);
                foreach ($tags as $tag) {
                    $stmt_insert_tags->execute([htmlspecialchars($id_cours), htmlspecialchars($tag)]);
                }
            }

            $pdo->commit();
            header("Location: E_details_cours.php");
        } catch (Exception $e) {
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
            $stmt_type->execute([':id_cours' => htmlspecialchars($id_cours)]);
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
            $stmt_All->execute([':id_user' => htmlspecialchars($_SESSION['id_utilisateur'])]);

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
            $stmt_dlt->execute([':id_cours' => htmlspecialchars($id_course)]);
        } catch (Exception $e) {
            return "Erreur : Lors de la suppression d'un cours !!! " . $e->getMessage();
        }
    }

    // fonction getAllMesCours ***************************************************************************************************************************************************
    public function getAllCours()
    {
        $pdo = $this->connect();

        try {
            $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
            $limit = 3;
            $startPoint = ($page - 1) * $limit;

            $sql_all_C = "SELECT cs.id_cours,
                      cs.id_enseignant,
                      cs.titre,
                      cs.description, 
                      cs.type_contenu,
                      DATE_FORMAT(cs.date_de_creation, '%d-%m-%Y') AS date_de_creation,
                      cs.photo, 
                      CONCAT(u.nom, ' ', u.prenom) AS full_name 
                    FROM cours cs
                    LEFT JOIN utilisateurs u ON cs.id_enseignant = u.id_user 
                    LIMIT :startPoint, :limite";

            $stmt_All = $pdo->prepare($sql_all_C);
            $stmt_All->bindValue(':startPoint', htmlspecialchars($startPoint), PDO::PARAM_INT);
            $stmt_All->bindValue(':limite', htmlspecialchars($limit), PDO::PARAM_INT);
            $stmt_All->execute();

            $AllCours = $stmt_All->fetchAll(PDO::FETCH_ASSOC);
            return $AllCours;
        } catch (Exception $e) {
            return "Erreur : Lors de la récupération de tous les cours !!! " . $e->getMessage();
        }
    }

    // fonction pour récupérer le nombre total de cours ***************************************************************************************************************************************************
    public function getTotalCours()
    {
        $pdo = $this->connect();

        try {
            $sql_count = "SELECT COUNT(*) AS total FROM cours";
            $stmt = $pdo->query($sql_count);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total'] ?? 0;
        } catch (Exception $e) {
            return 0;
        }
    }

    // fonction getAllMesCours ***************************************************************************************************************************************************
    public function getAllCoursCategorie($categorie)
    {
        $pdo = $this->connect();

        try {
            $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
            $limit = 3;
            $startPoint = ($page - 1) * $limit;

            $sql_all_C = "SELECT 
                                cs.id_cours,
                                cs.titre,
                                cs.description,
                                cs.type_contenu,
                                cs.contenu_text,
                                cs.contenu_video,
                                DATE_FORMAT(cs.date_de_creation, '%d-%m-%Y') AS date_de_creation,
                                cs.photo,
                                c.titre_categorie,
                                CONCAT(u.nom, ' ', u.prenom) AS full_name 
                            FROM 
                                cours cs
                            LEFT JOIN 
                                categorie c ON cs.id_categorie = c.id_categorie
                            LEFT JOIN utilisateurs u ON cs.id_enseignant = u.id_user 
                            WHERE 
                                cs.id_categorie = :id_categorie
                            LIMIT 
                                :startPoint, :limite;
                    ";

            $stmt_All = $pdo->prepare($sql_all_C);
            $stmt_All->bindValue(':id_categorie', htmlspecialchars($categorie));
            $stmt_All->bindValue(':startPoint', htmlspecialchars($startPoint), PDO::PARAM_INT);
            $stmt_All->bindValue(':limite', htmlspecialchars($limit), PDO::PARAM_INT);
            $stmt_All->execute();

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
            $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
            $limit = 3;
            $startPoint = ($page - 1) * $limit;

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
            WHERE t.id_tag = :id_tag
            LIMIT :startPoint, :limite;
            ";

            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id_tag', htmlspecialchars($id_tag));
            $stmt->bindValue(':startPoint', htmlspecialchars($startPoint), PDO::PARAM_INT);
            $stmt->bindValue(':limite', htmlspecialchars($limit), PDO::PARAM_INT);
            $stmt->execute();

            $cours = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $cours;
        } catch (Exception $e) {
            return "Erreur : Lors de la récupération des cours par id_tag !!! " . $e->getMessage();
        }
    }

    // fonction getCoursByTag ***************************************************************************************************************************************************
    function searchCoursByTitle($searchTitle)
    {
        $pdo = $this->connect();

        try {
            $sql = " SELECT 
                    cs.id_cours,
                    cs.titre,
                    cs.description,
                    cs.type_contenu,
                    cs.contenu_text,
                    cs.contenu_video,
                    DATE_FORMAT(cs.date_de_creation, '%d-%m-%Y') AS date_de_creation,
                    cs.photo,
                    CONCAT(u.nom, ' ', u.prenom) AS full_name
                FROM 
                    cours cs
                LEFT JOIN utilisateurs u ON cs.id_enseignant = u.id_user
                WHERE 
                    cs.titre LIKE :searchTitle
                ";

            $stmt = $pdo->prepare($sql);

            $stmt->bindValue(':searchTitle', '%' . htmlspecialchars($searchTitle) . '%', PDO::PARAM_STR);

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return "Erreur : " . $e->getMessage();
        }
    }
}
