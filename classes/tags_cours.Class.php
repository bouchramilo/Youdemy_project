<?php


require_once "DataBase.Class.php";

class TagsCours extends DataBase {



    public function allTagsForCours($id_cours){
        $pdo = $this->connect();

        try{

            $sql_tagsC = "SELECT t.nom_tag
                        FROM tags t
                        INNER JOIN cours_tags ct ON t.id_tag = ct.id_tag
                        WHERE ct.id_cours = :id_cours;
                    ";
            $stmt = $pdo->prepare($sql_tagsC);
            $stmt->execute([':id_cours' => $id_cours]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result ;


        }catch(Exception $e){
            return "Erreur : Lors de la recupération des tags d'un cours !!! " . $e->getMessage();
        }
    }

}
