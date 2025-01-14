<?php
require_once "classes/utilisateur.Class.php";

$utilisateur = new Utilisateur();
$insert_user = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $insert_user = $utilisateur->signUp($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['role'], $_POST['photo'], $_POST['password1'], $_POST['password2']);
}











?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Youdemy</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 flex flex-col w-full items-center justify-center min-h-screen">
    <!-- header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header header header header header -->
    <?php include "header.php"; ?>
    <!-- header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header header header header header -->




    <div class="flex items-center justify-center min-h-screen w-full bg-[url('images/image_1.jpg')] bg-cover">
        <div class=" lg:w-1/3 max-sm:w-full max-md:w-full md:w-2/3 bg-white bg-opacity-65 shadow-md rounded-lg p-8">
            <h2 class="text-2xl font-bold text-center text-[#0c0d08] mb-6">Se connecter</h2>
            <form class="" action="" method="POST">
                <p class="text-red-500 text-sm"><?php echo $insert_user; ?></p>
                <!-- nom -->
                <div class="mb-2">
                    <label for="nom" class="block text-sm font-medium text-[#0c0d08] mb-1">Nom</label>
                    <input type="nom" id="nom" name="nom" required
                        class="w-full px-4 py-2 border-0 border-b-2 border-[#ceed15] bg-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-[#ceed15] text-[#0c0d08] border-[#b1caaa]"
                        placeholder="Entrer votre nom">
                </div>

                <!-- prenom -->
                <div class="mb-2">
                    <label for="prenom" class="block text-sm font-medium text-[#0c0d08] mb-1">Prénom</label>
                    <input type="prenom" id="prenom" name="prenom" required
                        class="w-full px-4 py-2 border-0 border-b-2 border-[#ceed15] bg-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-[#ceed15] text-[#0c0d08] border-[#b1caaa]"
                        placeholder="Entrer votre prenom">
                </div>

                <!-- photo -->
                <div class="mb-2">
                    <label for="photo" class="block text-sm font-medium text-[#0c0d08] mb-1">Photo</label>
                    <input type="url" id="photo" name="photo" required
                        class="w-full px-4 py-2 border-0 border-b-2 border-[#ceed15] bg-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-[#ceed15] text-[#0c0d08] border-[#b1caaa]"
                        placeholder="Entrer votre photo">
                </div>

                <!-- date de birth -->
                <!-- <div class="mb-2">
                    <label for="dateBirth" class="block text-sm font-medium text-[#0c0d08] mb-1">date de naissance</label>
                    <input type="date" id="dateBirth" name="dateBirth" required
                        class="w-full px-4 py-2 border-0 border-b-2 border-[#ceed15] bg-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-[#ceed15] text-[#0c0d08] border-[#b1caaa]"
                        placeholder="Entrer votre date de naissance">
                </div> -->

                <!-- Rôle -->
                <div class="mb-2">
                    <label for="role" class="block text-sm font-medium text-gray-700">Choisissez votre rôle</label>
                    <select id="role" name="role" required
                        class="w-full px-4 py-2 border-0 border-b-2 border-[#ceed15] bg-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-[#ceed15] text-[#0c0d08] border-[#b1caaa]">
                        <!-- <option value=""></option> -->
                        <option value="etudiant">Étudiant</option>
                        <option value="enseignant">Enseignant</option>
                    </select>
                </div>

                <!-- Email -->
                <div class="mb-2">
                    <label for="email" class="block text-sm font-medium text-[#0c0d08] mb-1">Email</label>
                    <input type="email" id="email" name="email" required
                        class="w-full px-4 py-2 border-0 border-b-2 border-[#ceed15] bg-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-[#ceed15] text-[#0c0d08] border-[#b1caaa]"
                        placeholder="Entrer votre email">
                </div>

                <!-- Mot de passe -->
                <div class="mb-2">
                    <label for="password1" class="block text-sm font-medium text-[#0c0d08] mb-1">Mot de passe</label>
                    <input type="password" id="password1" name="password1" required
                        class="w-full px-4 py-2 border-0 border-b-2 border-[#ceed15] bg-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-[#ceed15] text-[#0c0d08] border-[#b1caaa]"
                        placeholder="Entrer votre mot de passe">
                </div>
                <div class="mb-2">
                    <label for="password2" class="block text-sm font-medium text-[#0c0d08] mb-1">Mot de passe (Confirmation)</label>
                    <input type="password" id="password2" name="password2" required
                        class="w-full px-4 py-2 border-0 border-b-2 border-[#ceed15] bg-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-[#ceed15] text-[#0c0d08] border-[#b1caaa]"
                        placeholder="Entrer votre mot de passe">
                </div>

                <!-- Bouton de connexion -->
                <div class="mb-6">
                    <button class="w-full bg-[#ceed15] text-[#0c0d08] font-medium py-2 px-4 rounded-md hover:bg-[#b1caaa] transition">
                        Se connecter
                    </button>
                </div>

                <!-- Lien Se connscter -->
                <p class="text-sm text-center text-[#0c0d08]">
                    Vous avez un compte ?
                    <a href="login.php" class="text-[#ceed15] hover:underline font-medium">Se connecter</a>
                </p>
            </form>
        </div>
    </div>


    <!-- Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer -->
    <?php include "footer.php"; ?>
    <!-- Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer -->

</body>
<!-- Scripts JavaScript -->
<script src="js/menu_header.js"></script>

</html>