<?php

require_once "classes/utilisateur.Class.php";
require_once "classes/cours.Class.php";
require_once "classes/tag.Class.php";
require_once "classes/categorie.Class.php";
require_once "classes/cours_texte.Class.php";
require_once "classes/cours_video.Class.php";


// affichage de tag , affichage de categorie ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
$tag = new Tag();
$categorie = new Categorie();
$tags = $tag->getAllTags();
$categories = $categorie->getAllCategorie();
$result_add_cours = "";

// ajouter cours ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

if (isset($_POST['btn_add_cours'])) {
    echo "Le formulaire a été soumis  -> ";
    switch ($_POST['type_cours']) {
        case "Texte":
            $cours = new CoursText();
            echo "Ajout d'un cours texte 2  -> ";
            $result_add_cours = $cours->ajouterCours($_POST['title_cours'], $_POST['descri_cours'], $_POST['type_cours'], $_POST['text_cours'], $_POST['categorie_cours'], $_POST['tags_cours'], $_POST['photo_cours']);
            echo "Ajout d'un cours texte 3  -> ";
            break;
        case "Video":
            echo "Ajout d'un cours vidéo  -> ";
            $cours = new CoursVideo();
            $result_add_cours = $cours->ajouterCours($_POST['title_cours'], $_POST['descri_cours'], $_POST['type_cours'], $_POST['video_cours'], $_POST['categorie_cours'], $_POST['tags_cours'], $_POST['photo_cours']);
            break;
    }
}

// afficher mes cours ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
$course = new Cours();
$mesCours = $course->getAllMesCours();

// delete cours ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

if (isset($_POST['btn_delete_cours'])) {
    $course->supprimerCours($_POST['btn_delete_cours']);
    header("Location: dashboard_enseignant.php");
}

// details cours ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
if (isset($_POST['details_cours'])) {
    $_SESSION['type_cours'] = $_POST['type_cours'];
    $_SESSION['id_cours'] = $_POST['details_cours'];
    header("Location: E_details_cours.php");
}

//  ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
$utilstr = new Utilisateur();

?>





<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/css/multi-select-tag.css">
    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/js/multi-select-tag.js"></script>

    <title>Youdemy - Enseignant</title>
</head>

<body class="bg-[#fff] text-[#14120b] ">

    <!-- header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header header header header header -->
    <?php include "header.php"; ?>
    <!-- header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header header header header header -->


    <section class="w-full h-20 pt-6 flex max-w-5xl max-lg:max-w-3xl max-md:max-w-sm mx-auto  max-sm:flex-col-reverse  max-sm:h-max md:h-max  justify-between items-center  shadow-md">
        <div>
            <h2 class="text-3xl font-extrabold text-gray-800 inline-block">MES COURS</h2>
        </div>
        <div class="flex max-sm:flex-col sm:flex-col md:flex-row max-sm:text-xs gap-4">
            <form action="" method="post">
                <button type="button" <?php if($utilstr->getStatus() === "Suspendu"){ echo 'disabled';} ?>
                    class="addCours bg-[#ffba08] hover:bg-[#f48c06] transition-colors duration-300 text-white px-4 py-2 rounded">&#10010; | Ajouter
                </button>
            </form>
        </div>
    </section>


    <div class="bg-white font-sans p-4 min-h-screen">
        <div class="max-w-5xl max-lg:max-w-3xl max-md:max-w-sm mx-auto">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-10">

                <?php foreach ($mesCours as $courss): ?>

                    <div class="flex max-lg:flex-col bg-[#daeadd] cursor-pointer rounded overflow-hidden shadow-xl hover:scale-[1.03] transition-all duration-300">
                        <div class="h-64 lg:w-1/2 w-full">
                            <img src="<?php echo $courss['photo']; ?>" alt="Blog Post 1" class="w-full h-full object-cover" />
                        </div>
                        <div class="p-6 lg:w-1/2  w-full">
                            <form action="" method="post">
                                <input type="hidden" name="type_cours" value="<?php echo $courss['type_contenu'] ?>">
                                <button name="details_cours" value="<?php echo $courss['id_cours'] ?>" class="text-[#faa307] hover:underline mt-4 block text-xl font-semibold">
                                    <?php echo $courss['titre']; ?>
                                </button>
                            </form>
                            <span class="text-sm block text-gray-400 mt-2"><?php echo $courss['date_de_creation']; ?> | <?php echo $courss['type_contenu']; ?></span>
                            <p class="text-sm text-gray-500 mt-4"><?php echo $courss['description']; ?></p>
                            <form action="" method="post" class="w-full text-end mt-2">
                                <button class="" title="Delete" name="btn_delete_cours" value="<?php echo $courss['id_cours']; ?>" <?php if($utilstr->getStatus() === "Suspendu"){ echo 'disabled';} ?>>

                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 fill-red-500 hover:fill-red-700" viewBox="0 0 24 24">
                                        <path
                                            d="M19 7a1 1 0 0 0-1 1v11.191A1.92 1.92 0 0 1 15.99 21H8.01A1.92 1.92 0 0 1 6 19.191V8a1 1 0 0 0-2 0v11.191A3.918 3.918 0 0 0 8.01 23h7.98A3.918 3.918 0 0 0 20 19.191V8a1 1 0 0 0-1-1Zm1-3h-4V2a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v2H4a1 1 0 0 0 0 2h16a1 1 0 0 0 0-2ZM10 4V3h4v1Z"
                                            data-original="#000000" />
                                        <path d="M11 17v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0Zm4 0v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0Z"
                                            data-original="#000000" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>

                <?php endforeach; ?>


            </div>
        </div>
    </div>


    <!-- les models +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
    <!-- add cours model +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

    <div
        class="coursAddModal hidden fixed inset-0 p-4 flex flex-wrap justify-center items-center w-full h-full z-[1000] before:fixed before:inset-0 before:w-full before:h-full before:bg-[rgba(0,0,0,0.5)] overflow-auto font-[sans-serif]">
        <div class="w-full max-w-lg bg-yellow-50 shadow-lg rounded-lg p-8 relative">
            <div class="flex items-center">
                <h3 class="text-[#386641] text-xl font-bold flex-1">Ajouter un cours</h3>
            </div>

            <form method="post" action="" class="space-y-4 mt-8">
                <p class="text-sm text-red-500"><?php echo $result_add_cours; ?></p>
                <div>
                    <label class="text-gray-800 text-sm mb-1 block">Titre de cours</label>
                    <input type="text" placeholder="Entrez le titre de cours" name="title_cours"
                        class="px-4 py-3 bg-gray-100 w-full text-gray-800 text-sm border-none focus:outline-[#386641] focus:bg-transparent rounded-lg" />
                </div>

                <div>
                    <label class="text-gray-800 text-sm mb-1 block">Description du cours</label>
                    <textarea placeholder='Entrez la description de cours' name="descri_cours"
                        class="resize-none px-4 py-3 bg-gray-100 w-full text-gray-800 text-sm border-none focus:outline-[#386641] focus:bg-transparent rounded-lg" rows="3"></textarea>
                </div>

                <div>
                    <label class="text-gray-800 text-sm mb-1 block">Type de cours</label>
                    <select placeholder="Entrez Type de cours" id="select_type" name="type_cours"
                        class="px-4 py-3 bg-gray-100 w-full text-gray-800 text-sm border-none focus:outline-[#386641] focus:bg-transparent rounded-lg">
                        <option value="Video">Video</option>
                        <option value="Texte">Texte</option>
                    </select>
                </div>
                <!-- contenus selon  le type de contenu ------------------------------------------------------------------------------------------------------------------------------  -->
                <div id="type-text" class="hidden">
                    <label class="text-gray-800 text-sm mb-1 block">Texte de cours</label>
                    <textarea placeholder="Entrez le Contenu Text" name="text_cours"
                        class="resize-none px-4 py-3 bg-gray-100 w-full text-gray-800 text-sm border-none focus:outline-[#386641] focus:bg-transparent rounded-lg"></textarea>
                </div>

                <div id="type-video" class="hidden">
                    <label class="text-gray-800 text-sm mb-1 block">URI video</label>
                    <input type="url" placeholder="Entrez le URL du Video" name="video_cours"
                        class="px-4 py-3 bg-gray-100 w-full text-gray-800 text-sm border-none focus:outline-[#386641] focus:bg-transparent rounded-lg" />
                </div>
                <!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------  -->

                <div>
                    <label class="text-gray-800 text-sm mb-1 block">Catégorie</label>
                    <select placeholder="Enter le Catégorie de cours" name="categorie_cours"
                        class="px-4 py-3 bg-gray-100 w-full text-gray-800 text-sm border-none focus:outline-[#386641] focus:bg-transparent rounded-lg">
                        <?php foreach ($categories as $categoriee): ?>
                            <option value="<?= $categoriee['id_categorie'] ?>"><?= $categoriee['titre_categorie'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label class="text-gray-800 text-sm mb-1 block">Tags</label>
                    <!-- Select tags -->
                    <select name="tags_cours[]" id="tags" multiple>
                        <?php foreach ($tags as $taag): ?>
                            <option value="<?= $taag['id_tag'] ?>"><?= $taag['nom_tag'] ?></option>
                        <?php endforeach; ?>

                    </select>
                    <!-- End Select tags -->
                </div>

                <div>
                    <label class="text-gray-800 text-sm mb-1 block">Photo</label>
                    <input type="url" placeholder="Entrez le URL de la photo de cours" name="photo_cours"
                        class="px-4 py-3 bg-gray-100 w-full text-gray-800 text-sm border-none focus:outline-[#386641] focus:bg-transparent rounded-lg" />
                </div>

                <div class="flex justify-end gap-4 !mt-8">
                    <button type="button"
                        class="close px-6 py-3 rounded-lg text-gray-800 text-sm border-none outline-none tracking-wide bg-gray-200 hover:bg-gray-300">Annuler</button>
                    <button name="btn_add_cours"
                        class="px-6 py-3 rounded-lg text-white text-sm border-none outline-none tracking-wide bg-[#386641] hover:bg-[#277752]">Ajouter</button>
                </div>
            </form>
        </div>
    </div>



    <!-- Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer -->
    <?php include "footer.php"; ?>
    <!-- Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer -->
    <script>
        new MultiSelectTag("tags_update"); // id
    </script>

</body>
<!-- Scripts JavaScript -->
<script src="js/menu_header.js"></script>
<script src="js/crudCours.js"></script>

</html>