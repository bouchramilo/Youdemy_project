<?php

require_once "classes/admin.Class.php";

$admin = new Admin();

$NbrCours = $admin->NbrCours();

$coursPlusEtudiants = $admin->NbrCoursEtudiant();

$repartitionCategories = $admin->getRepartitionParCategorie();

$topEnseignants = $admin->getTop3Enseignants();
?>




<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/css/multi-select-tag.css">
    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/js/multi-select-tag.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Youdemy - Admin : Statistique</title>
</head>

<body class="bg-[#fff] text-[#14120b]">

    <!-- header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header header header header header -->
    <?php include "header.php"; ?>
    <!-- header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header header header header header -->







    <div class="text-center py-6">
        <h2 class="text-3xl font-extrabold text-gray-800 inline-block relative after:absolute after:w-4/6 after:h-1 after:left-0 after:right-0 after:-bottom-4 after:mx-auto after:bg-[#386641] after:rounded-lg-full">Statistiques globales</h2>
    </div>
    <div class="stats-container min-h-screen max-w-7xl max-lg:max-w-3xl max-md:max-w-sm mx-auto grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
        <!-- Nombre total de cours *************************************************************************************************************************************************** -->
        <div class="stat-card shadow-md rounded-lg p-6 flex flex-col justify-center bg-gray-100">
            <h2 class="text-xl font-semibold text-gray-700">Nombre total de cours</h2>
            <p class="text-3xl font-bold text-blue-500 mt-2"><?php echo $NbrCours; ?></p>
        </div>

        <!-- Répartition par catégorie *************************************************************************************************************************************************** -->
        <div class="stat-card shadow-md rounded-lg p-6 flex flex-col justify-center bg-gray-100">
            <h2 class="text-xl font-semibold text-gray-700">Répartition par catégorie</h2>
            <ul class="list-disc list-inside mt-4 space-y-2 text-gray-600">
                <?php if (!empty($repartitionCategories)) : ?>
                    <?php foreach ($repartitionCategories as $categorie) : ?>
                        <li>
                            <?php echo htmlspecialchars($categorie['titre_categorie']); ?> :
                            <span class="font-bold">
                                <?php echo $categorie['nb_cours']; ?> cours
                            </span>
                        </li>
                    <?php endforeach; ?>
                <?php else : ?>
                    <li>Aucune catégorie disponible.</li>
                <?php endif; ?>
            </ul>
        </div>

        <!-- Cours avec le plus d'étudiants *************************************************************************************************************************************************** -->
        <div class="stat-card shadow-md rounded-lg p-6 flex flex-col justify-center bg-gray-100">
            <h2 class="text-xl font-semibold text-gray-700">Cours avec le plus d'étudiants</h2>
            <p class="text-lg text-gray-600 mt-4">
                <span class="font-bold text-blue-500">
                    "<?php echo htmlspecialchars($coursPlusEtudiants['titre_cours']); ?>"
                </span>
                avec <span class="font-bold">
                    <?php echo $coursPlusEtudiants['nb_etudiants']; ?>
                </span> étudiants inscrits.
            </p>
        </div>

        <!-- Top 3 enseignants *************************************************************************************************************************************************** -->
        <div class="stat-card shadow-md rounded-lg p-6 flex flex-col justify-center bg-gray-100">
            <h2 class="text-xl font-semibold text-gray-700">Top 3 enseignants</h2>
            <table class="w-full mt-4 border-collapse">
                <thead>
                    <tr class="bg-gray-200 text-gray-600">
                        <th class="p-2 text-left">#</th>
                        <th class="p-2 text-left">Nom</th>
                        <th class="p-2 text-left">Nombre d'étudiants</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($topEnseignants)) : ?>
                        <?php foreach ($topEnseignants as $index => $enseignant) : ?>
                            <tr class="border-b">
                                <td class="p-2"><?php echo $index + 1; ?></td>
                                <td class="p-2"><?php echo htmlspecialchars($enseignant['nom'] . ' ' . $enseignant['prenom']); ?></td>
                                <td class="p-2"><?php echo htmlspecialchars($enseignant['nb_etudiants']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="3" class="p-2 text-center text-gray-500">Aucun enseignant trouvé.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>










    <!-- Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer -->
    <?php include "footer.php"; ?>
    <!-- Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer -->


</body>
<!-- Scripts JavaScript -->
<script src="js/menu_header.js"></script>

</html>