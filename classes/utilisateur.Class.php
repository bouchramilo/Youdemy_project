<?php

require_once "DataBase.Class.php";
require_once "inscription_cours.Class.php";
require_once "cours.Class.php";

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
                            try {
                                $sql_check_valid = "SELECT estValide FROM enseignants WHERE id_user = :id_user";
                                $stmt_check_valide = $pdo->prepare($sql_check_valid);
                                $stmt_check_valide->execute([':id_user' => $user['id_user']]);
                                $rslt = $stmt_check_valide->fetch(PDO::FETCH_ASSOC);

                                if ($rslt['estValide'] === 1) {
                                    header("Location: dashboard_enseignant.php");
                                    exit;
                                } else {
                                    header("Location: pas_valide.php");
                                    exit;
                                }
                            } catch (Exception $e) {
                                return "Erreur : Lors la connexion comme user " . $e->getMessage();
                            }
                            break;
                        }
                    case "Etudiant":
                        header("Location: mes_cours.php");
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

    // fonction deleteUser ***************************************************************************************************************************************************
    public function deleteUser($id_user)
    {
        try {
            $pdo = $this->connect();

            $sql = "DELETE FROM utilisateurs WHERE id_user = :id_user";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([":id_user" => $id_user]);
            header("Location: gererUser.php");
            exit;
        } catch (Exception $e) {
            return "Erreur : getRole d'un user !!!" . $e->getMessage();
        }
    }

    // fonction updateStatus ***************************************************************************************************************************************************
    public function updateStatus($id_user, $newStatus)
    {
        try {
            $pdo = $this->connect();

            $sql = "UPDATE utilisateurs SET status = :newStatus WHERE id_user = :id_user";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':id_user' => $id_user,
                ':newStatus' => $newStatus
            ]);
            header("Location: gererUser.php");
            exit;
        } catch (Exception $e) {
            return "Erreur : Lors le changement de status d'un user !!!" . $e->getMessage();
        }
    }

    // fonction updateStatus ***************************************************************************************************************************************************
    public function isLogin($id_cours)
    {
        $coursInscrire = new InscriptionCours();
        $course = new Cours();
        $pdo = $this->connect();

        if ($this->getRole() === "Etudiant") {
            $resultat = $coursInscrire->estInscrire($id_cours);
            if ($resultat > 0) {
                $_SESSION['type_cours'] = $course->getType($id_cours);
                $_SESSION['id_cours'] = $id_cours;
                header('Location: details_cours.php');
                // exit();
            } else {
                echo '

                    <div
                        class="fixed inset-0 p-4 flex flex-wrap justify-center items-center w-full h-full z-[1000] before:fixed before:inset-0 before:w-full before:h-full before:bg-[rgba(0,0,0,0.5)] overflow-auto font-[sans-serif]">
                        <div class="w-full max-w-lg bg-white shadow-lg rounded-xl p-8 relative">
                            <div>
                                <h4 class="text-xl text-gray-800 font-semibold">Êtes-vous sûr de vouloir vous inscrire à ce cours?</h4>
                                <p class="text-sm text-gray-600 mt-4">titre de cours</p>
                            </div>

                            <div class="flex gap-4 max-sm:flex-col mt-8 h-18 ">
                                <button type="button" onclick="closeModal()"
                                    class="h-full px-4 py-2 rounded-lg text-gray-800 text-sm tracking-wide border-none outline-none bg-gray-200 hover:bg-gray-300">No,
                                    Annuler
                                </button>
                                <form action="" method="post" class=" ">
                                    <button name="confirm_inscrire" value="' . $id_cours . '"
                                        class="h-full w-full px-5 py-2.5 rounded-lg text-white text-sm tracking-wide border-none outline-none bg-[#386641] hover:bg-[#497752]">
                                        Oui, confirmer ' . $id_cours . '
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                
                ';
            }
        } elseif ($this->getRole() === "Admin") {
            $_SESSION['type_cours'] = $course->getType($id_cours);
            $_SESSION['id_cours'] = $id_cours;
            header('Location: details_cours.php');
            // exit();
        } elseif ($this->getRole() === "Enseignant") {
            try {
                $sql_check = "SELECT * FROM cours WHERE id_enseignant = :user AND id_cours = :cours";
                $stmt_check = $pdo->prepare($sql_check);
                $stmt_check->execute([
                    ':user' => $_SESSION['id_utilisateur'],
                    ':cours' => $id_cours
                ]);
                if ($stmt_check->rowCount() > 0) {
                    $_SESSION['type_cours'] = $course->getType($id_cours);
                    $_SESSION['id_cours'] = $id_cours;
                    header('Location: E_details_cours.php');
                    // exit();
                } else {
                    echo '
                    <div class="fixed inset-0 p-4 flex flex-wrap justify-end items-end w-full h-full z-[1000] before:fixed before:inset-0 before:w-full before:h-full before:bg-[rgba(0,0,0,0.5)] overflow-auto font-[sans-serif]">
                        <div class="w-full max-w-lg bg-white shadow-lg rounded-lg p-6 relative">
                            <div class="flex items-center pb-3 border-b border-gray-300">
                                <h3 class="text-gray-800 text-xl font-bold flex-1">Erreur</h3>
                            </div>
                            <div class="my-6">
                                <p class="text-gray-600 text-sm leading-relaxed">
                                    Vous n êtes pas autorisé à accéder à ce cours. Ce contenu appartient à un autre enseignant.
                                </p>
                            </div>
                            <div class="border-t border-gray-300 pt-6 flex justify-end gap-4">
                                <button type="button" id="closeM" onclick="closeModal()"
                                    class="px-4 py-2 rounded-lg text-white text-sm border-none outline-none tracking-wide bg-[#386641] hover:bg-[#497752] active:bg-[#386641]">
                                    OK
                                </button>
                            </div>
                        </div>
                    </div>
                ';
                }
            } catch (Exception $e) {
                return "Erreur : Lors de la vérification des cours !!! " . $e->getMessage();
            }
        } else {
            header("Location: login.php");
            exit();
        }
    }
}
