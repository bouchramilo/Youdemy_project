<?php

require_once "classes/cours.Class.php";
require_once "classes/cours_texte.Class.php";
require_once "classes/cours_video.Class.php";

// affichage de tag , affichage de categorie ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

switch ($_SESSION['type_cours']) {
    case "Texte":
        $cours = new CoursText();
        $cours_actuel = $cours->afficherCours();
        break;
    case "Video":
        $cours = new CoursVideo();
        $cours_actuel = $cours->afficherCours();
        break;
}

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
    <title>Youdemy - Cours</title>

</head>

<body class="bg-[#fff] text-[#14120b]">

    <!-- header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header header header header header -->
    <?php include "header.php"; ?>
    <!-- header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header header header header header -->


    <section class="w-full h-20 px-10 pt-6 flex  max-sm:flex-col-reverse  max-sm:h-max md:h-max  justify-between items-center shadow-md">
        <div class="text-4xl font-semibold text-gray-800"><?php echo $cours_actuel['titre']; ?></div>
    </section>

    <section class="min-h-screen w-full bg-gray-50 p-6">
        <section class="flex flex-col sm:flex-row gap-6 w-full bg-white shadow-lg rounded-lg overflow-hidden">
            <!-- Section principale -->
            <div class="w-full sm:w-8/12 flex flex-col gap-6">
                
                
                <?php if ($_SESSION['type_cours'] === "Video") : ?>
                    <iframe
                    class="w-full aspect-video rounded-lg"
                    src="<?php echo $cours_actuel['content']; ?>"
                    title="Vidéo YouTube"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen>
                </iframe>
                
                <?php elseif ($_SESSION['type_cours'] === "Texte") : ?>
                    <p class="p-10 max-sm:p-4">
                        <?php echo nl2br(htmlspecialchars($cours_actuel['content'])); ?>
                    </p>
                    <?php endif; ?>
                </div>
                
                <!-- Section latérale -->
                <div class="w-full sm:w-4/12 flex flex-col gap-4 items-center bg-gray-50 p-4 min-h-screen">
                    <img src="<?php echo $cours_actuel['photo']; ?>" alt="images de cours" class="h-72 w-full object-cover rounded-t-lg sm:rounded-none">
                    <div class="w-full border border-yellow-400 rounded-lg p-4 text-gray-700">
                        <p class="text-md max-sm:text-sm font-semibold">Auteur : <span class="font-normal"><?php echo $cours_actuel['full_name']; ?></span></p>
                        <p class="text-md max-sm:text-sm font-semibold">Catégorie : <span class="font-normal"><?php echo $cours_actuel['titre_categorie']; ?></span></p>
                        <p class="text-md max-sm:text-sm font-semibold">Description : <span class="font-normal"><?php echo $cours_actuel['description']; ?></span></p>
                        <p class="text-md max-sm:text-sm font-semibold">Date de création : <span class="font-normal"><?php echo $cours_actuel['date_de_creation']; ?></span></p>
                    </div>
            </div>
        </section>
    </section>

    <!-- Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer -->
    <?php include "footer.php"; ?>
    <!-- Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer -->

</body>
<!-- Scripts JavaScript -->
<script src="js/menu_header.js"></script>
<script src="js/crudCours.js"></script>

</html>