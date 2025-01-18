<?php

require_once "classes/inscription_cours.Class.php";

$inscrireCours = new InscriptionCours();

$mesCours = $inscrireCours->mesCours();

// details cours ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
if (isset($_POST['details_cours'])) {
    $_SESSION['type_cours'] = $_POST['type_cours'];
    $_SESSION['id_cours'] = $_POST['details_cours'];
    header("Location: details_cours.php");
}

// details cours ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
if (isset($_POST['delete_from_mes_cours'])) {
    $resultat = $inscrireCours->deleteFromMesCours($_POST['delete_from_mes_cours']);
    header("Location: mes_cours.php");
}



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
                                    <div class="w-full flex flex-row justify-between h-max">
                                        <form action="" method="post" class="w-full text-start">
                                            <button class="" title="Delete" name="delete_from_mes_cours" value="<?php echo $CRS['id_cours']; ?>">

                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 fill-red-500 hover:fill-red-700" viewBox="0 0 24 24">
                                                    <path
                                                        d="M19 7a1 1 0 0 0-1 1v11.191A1.92 1.92 0 0 1 15.99 21H8.01A1.92 1.92 0 0 1 6 19.191V8a1 1 0 0 0-2 0v11.191A3.918 3.918 0 0 0 8.01 23h7.98A3.918 3.918 0 0 0 20 19.191V8a1 1 0 0 0-1-1Zm1-3h-4V2a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v2H4a1 1 0 0 0 0 2h16a1 1 0 0 0 0-2ZM10 4V3h4v1Z"
                                                        data-original="#000000" />
                                                    <path d="M11 17v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0Zm4 0v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0Z"
                                                        data-original="#000000" />
                                                </svg>
                                            </button>
                                        </form>
                                        <form action="" method="post" class="w-full text-end">
                                            <input type="hidden" name="type_cours" value="<?php echo $CRS['type_contenu']; ?>">
                                            <button name="details_cours" value="<?php echo $CRS['id_cours']; ?>" class="hover:underline text-[#386641]">Voir le cours</button>
                                        </form>
                                    </div>
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