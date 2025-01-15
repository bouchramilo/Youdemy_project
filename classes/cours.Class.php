<?php

require_once "DataBase.Class.php";

class Cours extends DataBase{

    // fonction addCours ***************************************************************************************************************************************************
    public function addCours(){
        $pdo = $this->connect();

        try{
            $sql = "SELECT * FROM cours";

        }catch(Exception $e){
            return "Erreur : Erreur lors de l'ajout de cours !!! " . $e->getMessage();
        }
    }
}




