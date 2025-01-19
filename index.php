<?php

require_once "classes/cours.Class.php";
require_once "classes/utilisateur.Class.php";
require_once "classes/categorie.Class.php";
require_once "classes/tag.Class.php";

$course = new Cours();
// $allCours = $course->getAllCours();

$utlstr = new Utilisateur();
$InscrCours = new InscriptionCours();

if (isset($_POST['isLogin'])) {
    $result = $utlstr->isLogin($_POST['isLogin']);
}

if (isset($_POST['confirm_inscrire'])) {
    $result = $InscrCours->inscrireCours($_POST['confirm_inscrire']);
}



// affichage de inscription avec search +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
$limit = 3;

$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;

$totalCours = $course->getTotalCours();
$totalPages = ceil($totalCours / $limit);

if (!isset($_POST['search_cours']) && !isset($_POST['search_categorie']) && !isset($_POST['search_cours_title'])) {
    $allCours = $course->getAllCours();
} else {
    if (isset($_POST['search_cours']) && !empty($_POST['nom_tag'])) {
        $allCours = $course->getCoursByTagId($_POST['nom_tag']);
    } elseif (isset($_POST['search_categorie']) && !empty($_POST['title_categorie'])) {
        $allCours = $course->getAllCoursCategorie($_POST['title_categorie']);
    } elseif (isset($_POST['search_cours_title']) && !empty($_POST['search_title'])) {
        $searchTitle = trim($_POST['search_title']);
        $allCours = $course->searchCoursByTitle($searchTitle);
    } else {
        header("Location: index.php");
    }
}




$tagg = new Tag();
$categorie = new Categorie();

$categories = $categorie->getAllCategorie();
$tags = $tagg->getAllTags();


?>
<?php

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
        <!-- Section 1: Accueil -->
        <section class="bg-blue-100 py-16 h-max flex flex-col justify-center items-center bg-[url('images/image_1_1.jpg')] bg-center">
            <div class="container mx-auto text-center px-4">
                <h2 class="text-4xl font-bold text-[#386641]">Apprenez à votre rythme, où que vous soyez</h2>
                <p class="text-gray-700 mt-4">Explorez des centaines de cours interactifs avec les meilleurs enseignants.</p>
                <a href="#catalogue" class="mt-6 inline-block bg-[#386641] hover:bg-[#84a98c] transition-colors duration-300 text-white px-6 py-3 rounded">
                    Explorer les cours
                </a>

                <!-- Search Form Section -->
                <form action="" method="post" class=" flex w-full h-12 justify-center mt-4 rounded-lg overflow-hidden">
                    <div class="flex px-4 py-3 w-2/3 rounded-md border-2 border-[#386641] bg-[#daeadd] overflow-hidden max-w-md mx-auto font-[sans-serif]">
                        <input id="search" type="text" name="search_title" placeholder="Rechercher par titre de cours ..."
                            class="w-full outline-none bg-transparent text-gray-600 text-sm" />
                        <button name="search_cours_title">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192.904 192.904" width="16px" class="fill-gray-600">
                                <path
                                    d="m190.707 180.101-47.078-47.077c11.702-14.072 18.752-32.142 18.752-51.831C162.381 36.423 125.959 0 81.191 0 36.422 0 0 36.423 0 81.193c0 44.767 36.422 81.187 81.191 81.187 19.688 0 37.759-7.049 51.831-18.751l47.079 47.078a7.474 7.474 0 0 0 5.303 2.197 7.498 7.498 0 0 0 5.303-12.803zM15 81.193C15 44.694 44.693 15 81.191 15c36.497 0 66.189 29.694 66.189 66.193 0 36.496-29.692 66.187-66.189 66.187C44.693 147.38 15 117.689 15 81.193z">
                                </path>
                            </svg>
                        </button>
                    </div>

                </form>
            </div>
        </section>


        <!-- ************************************************************************************************************************************************************** -->

        <!-- Section: Cours Populaires -->

        <div id="catalogue" class="bg-white font-sans">
            <section class="w-full h-max px-10 py-6 flex  max-sm:flex-col-reverse  max-sm:h-max md:h-max items-center bg-gray-100 shadow-md">
                <form action="" method="post" class=" flex w-full h-12 justify-center mt-4 rounded-lg overflow-hidden">
                    <div class="flex px-4 py-3 w-2/3 rounded-md border-2 border-[#386641] bg-[#daeadd] overflow-hidden max-w-md mx-auto font-[sans-serif]">
                        <select type="email" placeholder="Search Something..." name="nom_tag"
                            class="w-full outline-none bg-transparent text-gray-600 text-sm">
                            <option value="" class="bg-gray-300">--Tag--</option>
                            <?php foreach ($tags as $tg): ?>
                                <option value="<?php echo $tg['id_tag']; ?>"><?php echo $tg['nom_tag']; ?></option>
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
                    <div class="flex px-4 py-3 w-2/3 rounded-md border-2 border-[#386641] bg-[#daeadd] overflow-hidden max-w-md mx-auto font-[sans-serif]">
                        <select type="email" placeholder="Search Something..." name="title_categorie"
                            class="w-full outline-none bg-transparent text-gray-600 text-sm">
                            <option value="" class="bg-gray-300">--Catégorie--</option>
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



            <div class="max-w-6xl mx-auto p-4">
                <div class="text-center">
                    <h2 class="text-3xl font-extrabold text-gray-800 inline-block relative after:absolute after:w-4/6 after:h-1 after:left-0 after:right-0 after:-bottom-4 after:mx-auto after:bg-[#386641] after:rounded-lg-full">Cours Populaires</h2>
                </div>
                <div id="courses" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-16 max-lg:max-w-3xl max-md:max-w-md mx-auto">
                    <?php if (!empty($allCours)): ?>
                        <?php foreach ($allCours as $CRS): ?>
                            <div class="bg-white cursor-pointer rounded-lg overflow-hidden shadow-[0_2px_10px_-3px_rgba(6,81,237,0.3)] relative group">
                                <img src="<?php echo $CRS['photo']; ?>" alt="Blog Post 1" class="w-full h-96 object-cover" />
                                <div class="p-6 absolute bottom-0 left-0 right-0 bg-[#ffba08] opacity-90">
                                    <span class="text-sm block text-gray-800 mb-2">
                                        <?php echo $CRS['date_de_creation']; ?> | AVEC <?php echo $CRS['full_name']; ?>
                                    </span>
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
                    <?php else: ?>
                        <p class="text-sm text-gray-300 text-center tetx-[#386641]">Aucun cours pour ce moment ... .</p>
                    <?php endif; ?>
                </div>

                <!-- Pagination -->
                <div class="flex justify-center mt-8">
                    <nav>
                        <ul class="inline-flex space-x-2">
                            <!-- Bouton "Précédent" -->
                            <?php if ($page > 1): ?>
                                <li>
                                    <a href="?page=<?php echo $page - 1; ?>" class="px-3 py-1 bg-[#386641] text-white rounded hover:bg-[#264d32]">Précédent</a>
                                </li>
                            <?php endif; ?>

                            <!-- Pages numérotées -->
                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <li>
                                    <a href="?page=<?php echo $i; ?>" class="px-3 py-1 <?php echo $i == $page ? 'bg-[#ffba08] text-gray-800' : 'bg-[#386641] text-white'; ?> rounded hover:bg-[#264d32]">
                                        <?php echo $i; ?>
                                    </a>
                                </li>
                            <?php endfor; ?>

                            <!-- Bouton "Suivant" -->
                            <?php if ($page < $totalPages): ?>
                                <li>
                                    <a href="?page=<?php echo $page + 1; ?>" class="px-3 py-1 bg-[#386641] text-white rounded hover:bg-[#264d32]">Suivant</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
            </div>

        </div>




    </section>

    <!-- Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer -->
    <?php include "footer.php"; ?>
    <!-- Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer -->

    <script>
        function closeModal() {
            var modal = document.querySelector('.fixed');
            modal.style.display = 'none';
        }
    </script>


    <script>

    </script>

</body>
<!-- Scripts JavaScript -->
<script src="js/menu_header.js"></script>
<!-- <script src="js/search.js"></script> -->

</html>