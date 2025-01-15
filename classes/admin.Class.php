<?php


require_once "DataBase.Class.php";
require_once "utilisateur.Class.php";

class Admin extends Utilisateur
{

    // fonction getAllUsers() ***************************************************************************************************************************************************
    public function getAllUsers()
    {
        $pdo = $this->connect();
        try {

            $sql_users = "SELECT ut.*, eg.estValide FROM utilisateurs ut LEFT JOIN enseignants eg ON ut.id_user = eg.id_user  ";
            $stmt_users = $pdo->prepare($sql_users);
            $stmt_users->execute();

            $allUsers = $stmt_users->fetchAll(PDO::FETCH_ASSOC);

            return $allUsers;
        } catch (Exception $e) {
            return "Erreur : Lors de la récupération de tous les users !!! " . $e->getMessage();
        }
    }
    // fonction valideEnseignant() ***************************************************************************************************************************************************
    public function valideEnseignant($id_user)
    {
        $pdo = $this->connect();

        try {
            $sql_check_valid = "SELECT estValide FROM enseignants WHERE id_user = :id_user";
            $stmt_check_valide = $pdo->prepare($sql_check_valid);
            $stmt_check_valide->execute([':id_user' => $id_user]);
            $rslt = $stmt_check_valide->fetch(PDO::FETCH_ASSOC);

            $isValide = $rslt['estValide'] ? 0 : 1 ;

            $sql_valide = "UPDATE enseignants SET estValide = :isValide WHERE id_user = :id_user ";
            $stmt_valide = $pdo->prepare($sql_valide);
            $stmt_valide->execute([':id_user' => $id_user, ':isValide' => $isValide]);

            header("Location: gererUser.php");

            return true;
        } catch (Exception $e) {
            return "Erreur : Lors de la validation de compte d'un enseignant !!!" . $e->getMessage();
        }
    }
}
