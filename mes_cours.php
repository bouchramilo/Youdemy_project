<?php

require_once "classes/inscription_cours.Class.php";

$inscrireCours = new InscriptionCours();

$mesCours = $inscrireCours->mesCours();





?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <title>Youdemy - Accueil</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#fff] text-[#14120b] ">

    <!-- header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header header header header header -->
    <?php include "header.php"; ?>
    <!-- header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header header header header header -->


    <section class="w-full min-h-screen flex flex-col">

        <!-- ************************************************************************************************************************************************************** -->
        <!-- ************************************************************************************************************************************************************** -->

        <!-- Section: Cours Populaires -->

        <div id="catalogue" class="bg-white font-sans">
            <div class="max-w-6xl mx-auto p-4">
                <div class="text-center">
                    <h2 class="text-3xl font-extrabold text-gray-800 inline-block relative after:absolute after:w-4/6 after:h-1 after:left-0 after:right-0 after:-bottom-4 after:mx-auto after:bg-[#386641] after:rounded-lg-full">Mes Cours</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-16 max-lg:max-w-3xl max-md:max-w-md mx-auto">


                    <?php if (!empty($mesCours)): ?>
                        <?php foreach ($mesCours as $CRS) : ?>

                            <div class="bg-white cursor-pointer rounded-lg overflow-hidden shadow-[0_2px_10px_-3px_rgba(6,81,237,0.3)] relative group">
                                <img src="<?php echo $CRS['photo']; ?>" alt="Blog Post 1" class="w-full h-96 object-cover" />
                                <div class="p-6 absolute bottom-0 left-0 right-0 bg-[#ffba08] opacity-90">
                                    <span class="text-sm block text-gray-800 mb-2"><?php echo $CRS['date_de_creation']; ?> | AVEC <?php echo $CRS['full_name']; ?></span>
                                    <h3 class="text-xl font-bold text-[#386641]"><?php echo $CRS['titre']; ?></h3>
                                    <div class="h-0 overflow-hidden group-hover:h-16 group-hover:mt-4 transition-all duration-300">
                                        <p class="text-gray-800 text-sm"><?php echo $CRS['description']; ?>.</p>
                                    </div>
                                    <form action="" method="post" class="w-full text-end">
                                        <button name="isLogin" value="<?php echo $CRS['id_cours']; ?>" class="hover:underline text-[#386641]">Voir le cours</button>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else :  ?>
                        <p class="text-md text-gray-400 text-start">Aucun cours pour ce moment ... .</p>
                    <?php endif; ?>

                </div>
            </div>
        </div>

    </section>

    <!-- Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer -->
    <?php include "footer.php"; ?>
    <!-- Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer -->


</body>
<!-- Scripts JavaScript -->
<script src="js/menu_header.js"></script>

</html>