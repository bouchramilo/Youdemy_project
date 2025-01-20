<?php

require_once "classes/utilisateur.Class.php";
require_once "classes/cours.Class.php";
require_once "classes/tag.Class.php";
require_once "classes/categorie.Class.php";
require_once "classes/cours_texte.Class.php";
require_once "classes/cours_video.Class.php";
require_once "classes/inscription_cours.Class.php";

$utilstr = new Utilisateur();
$inscrireCours = new InscriptionCours();
$course = new Cours();
$categorie = new Categorie();

$categories = $categorie->getAllCategorie();
$mesCours = $course->getAllMesCours();

if (isset($_POST['delete_from_inscription'])) {
    $resultat = $inscrireCours->dltInscriptionMesCours($_POST['delete_from_inscription'], $_POST['id_etudiant']);
    header("Location: inscription_cours.php");
}

// affichage de inscription avec search 
if (!isset($_POST['search_cours']) && !isset($_POST['search_categorie'])) {
    $mesInscriCours = $inscrireCours->AllInscriptionMesCours();
} else {
    if (isset($_POST['search_cours']) && !empty($_POST['title_cours'])) {
        $mesInscriCours = $inscrireCours->searchByCours($_POST['title_cours']);
    } elseif (isset($_POST['search_categorie']) && !empty($_POST['title_categorie'])) {
        $mesInscriCours = $inscrireCours->searchByCategorie($_POST['title_categorie']);
    } else {
        header("Location: inscription_cours.php");
    }
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
    <title>Youdemy - E : Cours</title>
</head>

<body class="bg-[#fff] text-[#14120b]">

    <!-- header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header header header header header -->
    <?php include "header.php"; ?>
    <!-- header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header header header header header -->



    <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
    <section class="w-full h-20 px-10 pt-6 flex  max-sm:flex-col-reverse  max-sm:h-max md:h-max items-center bg-gray-100 shadow-md">
        <form action="" method="post" class=" flex w-full h-12 justify-center mt-4 rounded-lg overflow-hidden">
            <div class="flex px-4 py-3 w-2/3 max-sm:w-full rounded-md border-2 border-[#386641] bg-[#daeadd] overflow-hidden max-w-md mx-auto font-[sans-serif]">
                <select type="email" placeholder="Search Something..." name="title_cours"
                    class="w-full outline-none bg-transparent text-gray-600 text-sm max-sm:text-xs">
                    <option value="">Cours</option>
                    <?php foreach ($mesCours as $courss): ?>
                        <option value="<?php echo $courss['id_cours']; ?>"><?php echo $courss['titre']; ?></option>
                    <?php endforeach; ?>
                </select>

                <button name="search_cours">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192.904 192.904" width="16px" class="fill-gray-600">
                        <path
                            d="m190.707 180.101-47.078-47.077c11.702-14.072 18.752-32.142 18.752-51.831C162.381 36.423 125.959 0 81.191 0 36.422 0 0 36.423 0 81.193c0 44.767 36.422 81.187 81.191 81.187 19.688 0 37.759-7.049 51.831-18.751l47.079 47.078a7.474 7.474 0 0 0 5.303 2.197 7.498 7.498 0 0 0 5.303-12.803zM15 81.193C15 44.694 44.693 15 81.191 15c36.497 0 66.189 29.694 66.189 66.193 0 36.496-29.692 66.187-66.189 66.187C44.693 147.38 15 117.689 15 81.193z">
                        </path>
                    </svg>
                </button>

            </div>

        </form>
        <form action="" method="post" class=" flex w-full h-12 justify-center mt-4 rounded-lg overflow-hidden">
            <div class="flex px-4 py-3 w-2/3 max-sm:w-full rounded-md border-2 border-[#386641] bg-[#daeadd] overflow-hidden max-w-md mx-auto font-[sans-serif]">
                <select type="email" placeholder="Search Something..." name="title_categorie"
                    class="w-full outline-none bg-transparent text-gray-600 text-sm max-sm:text-xs">
                    <option value="">Catégorie</option>
                    <?php foreach ($categories as $categ): ?>
                        <option value="<?php echo $categ['id_categorie']; ?>"><?php echo $categ['titre_categorie']; ?></option>
                    <?php endforeach; ?>
                </select>

                <button name="search_categorie">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192.904 192.904" width="16px" class="fill-gray-600">
                        <path
                            d="m190.707 180.101-47.078-47.077c11.702-14.072 18.752-32.142 18.752-51.831C162.381 36.423 125.959 0 81.191 0 36.422 0 0 36.423 0 81.193c0 44.767 36.422 81.187 81.191 81.187 19.688 0 37.759-7.049 51.831-18.751l47.079 47.078a7.474 7.474 0 0 0 5.303 2.197 7.498 7.498 0 0 0 5.303-12.803zM15 81.193C15 44.694 44.693 15 81.191 15c36.497 0 66.189 29.694 66.189 66.193 0 36.496-29.692 66.187-66.189 66.187C44.693 147.38 15 117.689 15 81.193z">
                        </path>
                    </svg>
                </button>

            </div>

        </form>

    </section>


    <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
    <section class="min-h-screen w-full py-10 max-sm:py-10  bg-gray-100">
        <div class="px-10 pb-6 text-4xl max-sm:text-2xl max-sm:px-4 font-semibold text-gray-800">Les inscription de mes cours : </div>
        <div class="overflow-x-auto font-[sans-serif] shadow-md max-sm:w-full px-2 max-sm:p-1">
            <table class="min-w-full bg-white border border-gray-300">
                <thead class="bg-[#386641] whitespace-nowrap">
                    <tr>
                        <th class="p-2 sm:p-4 text-left text-xs sm:text-sm font-medium text-white">Nom & prénom</th>
                        <th class="p-2 sm:p-4 text-left text-xs sm:text-sm font-medium text-white">Email</th>
                        <th class="p-2 sm:p-4 text-left text-xs sm:text-sm font-medium text-white">Cours</th>
                        <th class="p-2 sm:p-4 text-left text-xs sm:text-sm font-medium text-white">s'inscrire à</th>
                        <th class="p-2 sm:p-4 text-left text-xs sm:text-sm font-medium text-white">Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($mesInscriCours)): ?>
                        <?php foreach ($mesInscriCours as $CRS) : ?>
                            <tr class="border-b-2 border-[#386641] bg-[#daeadd] hover:bg-gray-100 transition duration-150">
                                <td class="py-2 sm:py-4 text-xs sm:text-sm text-[#386641]"><?php echo $CRS['nom_etudiant'] ?></td>
                                <td class="py-2 sm:py-4 text-xs sm:text-sm text-[#386641]"><?php echo $CRS['email'] ?></td>
                                <td class="py-2 sm:py-4 text-xs sm:text-sm text-[#386641]"><?php echo $CRS['titre'] ?></td>
                                <td class="py-2 sm:py-4 text-xs sm:text-sm text-[#386641]"><?php echo $CRS['date_inscription'] ?></td>
                                <td class="py-2 sm:py-4 flex space-x-3 justify-center">
                                    <form action="" method="post" class="">
                                        <input type="hidden" name="id_etudiant" value="<?php echo $CRS['id_user'] ?>">
                                        <button name="delete_from_inscription" class="text-red-500 hover:text-red-700" title="Delete" value="<?php echo $CRS['id_cours'] ?>" <?php if ($utilstr->getStatus() === "Suspendu") {
                                                                                                                                                                                    echo 'disabled';
                                                                                                                                                                                } ?>>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 fill-red-500 hover:fill-red-700" viewBox="0 0 24 24">
                                                <path
                                                    d="M19 7a1 1 0 0 0-1 1v11.191A1.92 1.92 0 0 1 15.99 21H8.01A1.92 1.92 0 0 1 6 19.191V8a1 1 0 0 0-2 0v11.191A3.918 3.918 0 0 0 8.01 23h7.98A3.918 3.918 0 0 0 20 19.191V8a1 1 0 0 0-1-1Zm1-3h-4V2a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v2H4a1 1 0 0 0 0 2h16a1 1 0 0 0 0-2ZM10 4V3h4v1Z"
                                                    data-original="#000000" />
                                                <path d="M11 17v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0Zm4 0v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0Z"
                                                    data-original="#000000" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else :  ?>
                        <p class="text-md text-gray-400 text-start">Aucun cours pour ce moment ... .</p>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>



    <!-- Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer -->
    <?php include "footer.php"; ?>
    <!-- Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer -->


</body>
<!-- Scripts JavaScript -->
<script src="js/menu_header.js"></script>

</html>