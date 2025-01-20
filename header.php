<?php

require_once "classes/utilisateur.Class.php";
$userr = new Utilisateur();
$role = $userr->getRole();

if (isset($_POST['deconnecter'])) {
    $userr->logout();
}


?>



<header class="bg-[#386641] text-white w-full">
    <div class="container mx-auto flex items-center justify-between p-4">
        <a href="index.php">
            <h1 class="text-2xl font-bold">Youdemy</h1>
        </a>

        <nav class="flex items-center">
            <ul class="hidden md:flex space-x-4">
                <li><a href="index.php" class="hover:text-[#f48c06]">Accueil</a></li>

                <?php if ($role === "Admin") : ?>
                    <li><a href="gererUser.php" class="hover:text-[#f48c06]">Utilisateurs</a></li>
                    <li><a href="statistique_admin.php" class="hover:text-[#f48c06]">Statistique</a></li>
                    <li><a href="tags_categories.php" class="hover:text-[#f48c06]">Tags/Catégories</a></li>

                <?php elseif ($role === "Etudiant") : ?>
                    <li><a href="mes_cours.php" class="hover:text-[#f48c06]">Mes Cours</a></li>

                <?php elseif ($role === "Enseignant") : ?>
                    <li><a href="dashboard_enseignant.php" class="hover:text-[#f48c06]">Mes Cours</a></li>
                    <li><a href="inscription_cours.php" class="hover:text-[#f48c06]">Inscriptions</a></li>
                    <li><a href="statistique_enseignant.php" class="hover:text-[#f48c06]">Statistique</a></li>
                <?php endif; ?>
            </ul>

            <button class="md:hidden focus:outline-none" id="menu-toggle">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </nav>

        <div class="hidden md:flex space-x-2">
            <?php if (isset($_SESSION["id_utilisateur"])) : ?>
                <form action="" method="post"><button name="deconnecter" class="bg-[#ffba08] hover:bg-[#f48c06] transition-colors duration-300 text-white px-4 py-2 rounded">Se déconnecter</button></form>
            <?php else: ?>
                <a href="login.php" class="bg-[#ffba08] hover:bg-[#f48c06] transition-colors duration-300 text-white px-4 py-2 rounded">Se connecter</a>
                <a href="register.php" class="bg-[#ffba08] hover:bg-[#f48c06] transition-colors duration-300 text-white px-4 py-2 rounded">S'inscrire</a>
            <?php endif; ?>
        </div>
    </div>

    <div id="mobile-menu" class="hidden md:hidden bg-[#84a98c]">
        <ul class="space-y-4 p-4">
            <li><a href="index.php" class="block text-white hover:text-[#f48c06]">Accueil</a></li>
            <?php if ($role === "Admin") : ?>
                <li><a href="gererUser.php" class="block text-white hover:text-[#f48c06]">Utilisateurs</a></li>
                <li><a href="statistique_admin.php" class="block text-white hover:text-[#f48c06]">Statistique</a></li>
                <li><a href="tags_categories.php" class="block text-white hover:text-[#f48c06]">Tags/catégories</a></li>
            <?php elseif ($role === "Etudiant") : ?>
                <li><a href="mes_cours.php" class="block text-white hover:text-[#f48c06]">Mes Cours</a></li>
            <?php elseif ($role === "Enseignant") : ?>
                <li><a href="dashboard_enseignant.php" class="block text-white hover:text-[#f48c06]">Gestion des Cours</a></li>
                <li><a href="inscription_cours.php" class="block text-white hover:text-[#f48c06]">Mes Cours</a></li>
                <li><a href="statistique_enseignant.php" class="block text-white hover:text-[#f48c06]">Statistique</a></li>
            <?php endif; ?>

            <?php if (isset($_SESSION["id_utilisateur"])) : ?>
                <li>
                    <form action="" method="post"><button name="deconnecter" class="block bg-[#ffba08] hover:bg-[#f48c06] text-white px-4 py-2 rounded text-center">Se déconnecter</button></form>
                </li>

            <?php else: ?>
                <li><a href="login.php" class="block bg-[#ffba08] hover:bg-[#f48c06] text-white px-4 py-2 rounded text-center">Se connecter</a></li>
                <li><a href="register.php" class="block bg-[#ffba08] hover:bg-[#f48c06] text-white px-4 py-2 rounded text-center">S'inscrire</a></li>
            <?php endif; ?>
        </ul>
    </div>
</header>