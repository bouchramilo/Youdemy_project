<?php

require_once "DataBase.Class.php";

class Utilisateur extends DataBase
{


    // fonction validateDonnees ***************************************************************************************************************************************************
    public function validateDonnees($nom, $prenom, $email, $role, $photo, $motDePasse1, $motDePasse2)
    {

        // verifier si les champs de données sont vides (aux moins un champ)
        if (empty($nom) || empty($prenom) || empty($email) || empty($role) || empty($photo) || empty($motDePasse1) || empty($motDePasse2)) {
            return "Erreur : Les champs ne peuvent pas être vides !!!";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Erreur : Le email n'est pas valide !!!";
        }

        if (!filter_var($photo, FILTER_VALIDATE_URL)) {
            return "Erreur : Le URL de la photo n'est pas valide !!!";
        }

        if (!preg_match('/^[a-zA-Z\s]+$/', $nom) || !preg_match('/^[a-zA-Z\s]+$/', $prenom)) {
            return "Erreur : Les champs prénom et nom ne doivent contenir que des lettres !!!";
        }

        if (!preg_match("/^[a-zA-Z0-9$*-+*.&#:?!;,]{8,}$/", $motDePasse1)) {
            return 'Le mot de passe doit contenir au moins 8 caractères, avec des lettres et des chiffres !!!';
        }

        if ($motDePasse1 !== $motDePasse2) {
            return 'Les mots de passe ne correspondent pas !!!';
        }

        return true;
    }

    // fonction signUp ***************************************************************************************************************************************************
    public function signUp($nom, $prenom, $email, $role, $photo, $motDePasse1, $motDePasse2)
    {
        $pdo = $this->connect();

        // Validation des données
        $validationResult = $this->validateDonnees($nom, $prenom, $email, $role, $photo, $motDePasse1, $motDePasse2);
        if ($validationResult !== true) {
            return $validationResult;
        }

        try {
            $checkEmail = "SELECT * FROM utilisateurs WHERE email = :email";
            $checkStmt = $pdo->prepare($checkEmail);
            $checkStmt->execute(['email' => htmlspecialchars($email)]);
            if ($checkStmt->rowCount() > 0) {
                return "Erreur : Email exist déjà !!!";
            }

            $password_hash = password_hash($motDePasse1, PASSWORD_BCRYPT);

            $add_user = "INSERT INTO utilisateurs(nom, prenom, email, motDePasse, photo, role) 
                     VALUES (:nom, :prenom, :email, :motDePasse, :photo, :role)";
            $stmtInsertUser = $pdo->prepare($add_user);
            $stmtInsertUser->execute([
                ':nom' => htmlspecialchars($nom),
                ':prenom' => htmlspecialchars($prenom),
                ':email' => htmlspecialchars($email),
                ':motDePasse' => $password_hash,
                ':photo' => htmlspecialchars($photo),
                ':role' => htmlspecialchars($role)
            ]);

            $id_user = $pdo->lastInsertId();
            if (!$id_user) {
                return "Erreur : Impossible de récupérer l'ID utilisateur.";
            }

            if (trim($role) === "Enseignant") {
                $sql_teacher = "INSERT INTO enseignants (id_user) VALUES (:id_user)";
                $stmt_teacher = $pdo->prepare($sql_teacher);
                $stmt_teacher->execute([':id_user' => $id_user]);
            }
        } catch (Exception $e) {
            return "Erreur lors de signup : " . $e->getMessage();
        }

        header("Location: login.php");
    }


    // fonction login ***************************************************************************************************************************************************
    public function login($email, $motDePasse)
    {
        $pdo = $this->connect();
        try {
            $sqlLogin = "SELECT * FROM utilisateurs WHERE email = :email";
            $stmtLogin = $pdo->prepare($sqlLogin);
            $stmtLogin->execute([':email' => htmlspecialchars($email)]);
            $user = $stmtLogin->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($motDePasse, $user['motDePasse'])) {
                session_start();
                $_SESSION['id_utilisateur'] = $user['id_user'];
                switch ($user['role']) {
                    case "Admin":
                        header("Location: gererUser.php");
                        break;
                    case "Enseignant": {
                            try{
                                $sql_check_valid = "SELECT estValide FROM enseignants WHERE id_user = :id_user";
                                $stmt_check_valide = $pdo->prepare($sql_check_valid);
                                $stmt_check_valide->execute([':id_user' => $user['id_user']]);
                                $rslt = $stmt_check_valide->fetch(PDO::FETCH_ASSOC);

                                if($rslt['estValide'] === 1){
                                    header("Location: dashboard_enseignant.php");
                                    exit;
                                }
                                else{
                                    header("Location: pas_valide.php");
                                    exit;

                                }
                            }catch(Exception $e){
                                return "Erreur : Lors la connexion comme user " . $e->getMessage();
                            }
                            break;
                        }
                    case "Etudiant":
                        header("Location: home.php");
                        break;
                };
            } else {
                return "Email ou Mot de passe est invalide !!!";
            }
        } catch (Exception $e) {
            return "Erreur lors de login : " . $e->getMessage();
        }
    }

    // fonction logout ***************************************************************************************************************************************************
    public function logout()
    {
        try {
            unset($_SESSION['id_utilisateur']);
            session_unset();
            session_destroy();
            header("Location: index.php");
            exit();
        } catch (Exception $e) {
            return "Erreur : lors de logout !!!" . $e->getMessage();
        }
    }

    // fonction getRole ***************************************************************************************************************************************************
    public function getRole()
    {
        try {
            $pdo = $this->connect();

            if (!isset($_SESSION['id_utilisateur'])) {
                return null;
            }

            $sql = "SELECT role FROM utilisateurs WHERE id_user = :id_user";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([":id_user" => $_SESSION['id_utilisateur']]);
            $role = $stmt->fetch(PDO::FETCH_ASSOC);
            return $role ? $role['role'] : null;
        } catch (Exception $e) {
            echo "Erreur : getRole d'un user !!!" . $e->getMessage();
            return null;
        }
    }
}
