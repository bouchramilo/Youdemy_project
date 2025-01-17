<?php

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

// delete cours ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
if(isset($_POST['details_cours'])){
    $_SESSION['type_cours'] = $_POST['type_cours'] ; 
    $_SESSION['id_cours'] = $_POST['details_cours'];
    header("Location: E_details_cours.php");
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

    <title>Youdemy - Enseignant</title>
    <!-- <link href="https://fonts.googleapis.com/css?family=Sawarabi%20Mincho:700|Sawarabi%20Mincho:400"> -->
    <!-- <style>
        body {
            font-family: 'Sawarabi Mincho';
            font-weight: 400;
        }
    </style> -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#fff] text-[#14120b]">

    <!-- header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header header header header header -->
    <?php include "header.php"; ?>
    <!-- header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header header header header header -->


    <section class="w-full h-20 px-10 pt-6 flex  max-sm:flex-col-reverse  max-sm:h-max md:h-max  justify-between items-center bg-gray-100 shadow-md">
        <div class="text-4xl font-semibold text-gray-800">Mes cours </div>
        <div class="flex max-sm:flex-col sm:flex-col md:flex-row max-sm:text-xs gap-4">
            <form action="" method="post">
                <button type="button"
                    class="addCours bg-[#ffba08] hover:bg-[#f48c06] transition-colors duration-300 text-white px-4 py-2 rounded">Ajouter | &#10010;
                </button>
            </form>
        </div>
    </section>
    <section class="min-h-screen w-full p-6">

        <!-- Les cartes de mes cours ******************************************************************************************************************************************************* -->
        <div class="grid max-lg:grid-cols-2 max-sm:grid-cols-1 md:grid-cols-1 max-md:grid-cols-2 lg:grid-cols-2 lg:gap-2 w-full h-full ">


            <?php foreach ($mesCours as $courss): ?>

                <div
                    class="bg-[#a2dcea] grid sm:grid-cols-2 h-max items-center shadow-[0_4px_12px_-5px_rgba(0,0,0,0.4)] w-full max-w-2xl max-sm:max-w-sm rounded-lg font-[sans-serif] overflow-hidden mx-auto mt-4">
                    <div class="min-h-[280px] h-full">
                        <img src="<?php echo $courss['photo']; ?>" class="w-full h-72 object-cover" />
                    </div>

                    <div class="px-6 py-4 h-full flex flex-col justify-between">
                        <form action="" method="post">
                            <input type="hidden" name="type_cours" value="<?php echo $courss['type_contenu'] ?>">
                            <button name="details_cours" value="<?php echo $courss['id_cours'] ?>" class="text-[#faa307] hover:underline mt-4 block text-xl font-semibold">
                                <?php echo $courss['titre']; ?>
                            </button>
                        </form>
                        <p class=" mt-3 text-sm text-gray-500 leading-relaxed"><?php echo $courss['description']; ?></p>
                        <p class=" mt-3 text-sm text-gray-500 leading-relaxed"><span class="font-bold">Type de cours : </span><?php echo $courss['type_contenu']; ?></p>
                        <p class=" mt-3 text-sm text-gray-500 leading-relaxed"><span class="font-bold">Date de céation : </span><?php echo $courss['date_de_creation']; ?></p>

                        <div class=" flex flex-row items-center justify-end w-max self-end cursor-pointer border border-gray-300 rounded-lg px-4 py-2 mt-6">
                            <!-- <button class="updateCours mr-4" title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 fill-blue-500 hover:fill-blue-700"
                                    viewBox="0 0 348.882 348.882">
                                    <path
                                        d="m333.988 11.758-.42-.383A43.363 43.363 0 0 0 304.258 0a43.579 43.579 0 0 0-32.104 14.153L116.803 184.231a14.993 14.993 0 0 0-3.154 5.37l-18.267 54.762c-2.112 6.331-1.052 13.333 2.835 18.729 3.918 5.438 10.23 8.685 16.886 8.685h.001c2.879 0 5.693-.592 8.362-1.76l52.89-23.138a14.985 14.985 0 0 0 5.063-3.626L336.771 73.176c16.166-17.697 14.919-45.247-2.783-61.418zM130.381 234.247l10.719-32.134.904-.99 20.316 18.556-.904.99-31.035 13.578zm184.24-181.304L182.553 197.53l-20.316-18.556L294.305 34.386c2.583-2.828 6.118-4.386 9.954-4.386 3.365 0 6.588 1.252 9.082 3.53l.419.383c5.484 5.009 5.87 13.546.861 19.03z"
                                        data-original="#000000" />
                                    <path
                                        d="M303.85 138.388c-8.284 0-15 6.716-15 15v127.347c0 21.034-17.113 38.147-38.147 38.147H68.904c-21.035 0-38.147-17.113-38.147-38.147V100.413c0-21.034 17.113-38.147 38.147-38.147h131.587c8.284 0 15-6.716 15-15s-6.716-15-15-15H68.904C31.327 32.266.757 62.837.757 100.413v180.321c0 37.576 30.571 68.147 68.147 68.147h181.798c37.576 0 68.147-30.571 68.147-68.147V153.388c.001-8.284-6.715-15-14.999-15z"
                                        data-original="#000000" />
                                </svg>
                            </button> -->
                            <form action="" method="post" class="w-5 mt-2">
                                <button class="" title="Delete" name="btn_delete_cours" value="<?php echo $courss['id_cours']; ?>">

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
                </div>


            <?php endforeach; ?>







        </div>


        <!-- <div class="overflow-x-auto font-[sans-serif]">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-700 whitespace-nowrap">
                    <tr>
                        <th class="p-4 text-left text-sm font-medium text-white">
                            Name
                        </th>
                        <th class="p-4 text-left text-sm font-medium text-white">
                            Email
                        </th>
                        <th class="p-4 text-left text-sm font-medium text-white">
                            Role
                        </th>
                        <th class="p-4 text-left text-sm font-medium text-white">
                            Joined At
                        </th>
                        <th class="p-4 text-left text-sm font-medium text-white">
                            Actions
                        </th>
                    </tr>
                </thead>

                <tbody class="whitespace-nowrap">
                    <tr class="even:bg-blue-50">
                        <td class="p-4 text-sm">
                            John Doe
                        </td>
                        <td class="p-4 text-sm">
                            john@example.com
                        </td>
                        <td class="p-4 text-sm">
                            Admin
                        </td>
                        <td class="p-4 text-sm">
                            2022-05-15
                        </td>
                        <td class="p-4">
                            <button class="mr-4" title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 fill-blue-500 hover:fill-blue-700"
                                    viewBox="0 0 348.882 348.882">
                                    <path
                                        d="m333.988 11.758-.42-.383A43.363 43.363 0 0 0 304.258 0a43.579 43.579 0 0 0-32.104 14.153L116.803 184.231a14.993 14.993 0 0 0-3.154 5.37l-18.267 54.762c-2.112 6.331-1.052 13.333 2.835 18.729 3.918 5.438 10.23 8.685 16.886 8.685h.001c2.879 0 5.693-.592 8.362-1.76l52.89-23.138a14.985 14.985 0 0 0 5.063-3.626L336.771 73.176c16.166-17.697 14.919-45.247-2.783-61.418zM130.381 234.247l10.719-32.134.904-.99 20.316 18.556-.904.99-31.035 13.578zm184.24-181.304L182.553 197.53l-20.316-18.556L294.305 34.386c2.583-2.828 6.118-4.386 9.954-4.386 3.365 0 6.588 1.252 9.082 3.53l.419.383c5.484 5.009 5.87 13.546.861 19.03z"
                                        data-original="#000000" />
                                    <path
                                        d="M303.85 138.388c-8.284 0-15 6.716-15 15v127.347c0 21.034-17.113 38.147-38.147 38.147H68.904c-21.035 0-38.147-17.113-38.147-38.147V100.413c0-21.034 17.113-38.147 38.147-38.147h131.587c8.284 0 15-6.716 15-15s-6.716-15-15-15H68.904C31.327 32.266.757 62.837.757 100.413v180.321c0 37.576 30.571 68.147 68.147 68.147h181.798c37.576 0 68.147-30.571 68.147-68.147V153.388c.001-8.284-6.715-15-14.999-15z"
                                        data-original="#000000" />
                                </svg>
                            </button>
                            <button class="mr-4" title="Delete">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 fill-red-500 hover:fill-red-700" viewBox="0 0 24 24">
                                    <path
                                        d="M19 7a1 1 0 0 0-1 1v11.191A1.92 1.92 0 0 1 15.99 21H8.01A1.92 1.92 0 0 1 6 19.191V8a1 1 0 0 0-2 0v11.191A3.918 3.918 0 0 0 8.01 23h7.98A3.918 3.918 0 0 0 20 19.191V8a1 1 0 0 0-1-1Zm1-3h-4V2a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v2H4a1 1 0 0 0 0 2h16a1 1 0 0 0 0-2ZM10 4V3h4v1Z"
                                        data-original="#000000" />
                                    <path d="M11 17v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0Zm4 0v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0Z"
                                        data-original="#000000" />
                                </svg>
                            </button>
                        </td>
                    </tr>

                    <tr class="even:bg-blue-50">
                        <td class="p-4 text-sm">
                            Jane Smith
                        </td>
                        <td class="p-4 text-sm">
                            jane@example.com
                        </td>
                        <td class="p-4 text-sm">
                            User
                        </td>
                        <td class="p-4 text-sm">
                            2022-07-20
                        </td>
                        <td class="p-4">
                            <button class="mr-4" title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 fill-blue-500 hover:fill-blue-700"
                                    viewBox="0 0 348.882 348.882">
                                    <path
                                        d="m333.988 11.758-.42-.383A43.363 43.363 0 0 0 304.258 0a43.579 43.579 0 0 0-32.104 14.153L116.803 184.231a14.993 14.993 0 0 0-3.154 5.37l-18.267 54.762c-2.112 6.331-1.052 13.333 2.835 18.729 3.918 5.438 10.23 8.685 16.886 8.685h.001c2.879 0 5.693-.592 8.362-1.76l52.89-23.138a14.985 14.985 0 0 0 5.063-3.626L336.771 73.176c16.166-17.697 14.919-45.247-2.783-61.418zM130.381 234.247l10.719-32.134.904-.99 20.316 18.556-.904.99-31.035 13.578zm184.24-181.304L182.553 197.53l-20.316-18.556L294.305 34.386c2.583-2.828 6.118-4.386 9.954-4.386 3.365 0 6.588 1.252 9.082 3.53l.419.383c5.484 5.009 5.87 13.546.861 19.03z"
                                        data-original="#000000" />
                                    <path
                                        d="M303.85 138.388c-8.284 0-15 6.716-15 15v127.347c0 21.034-17.113 38.147-38.147 38.147H68.904c-21.035 0-38.147-17.113-38.147-38.147V100.413c0-21.034 17.113-38.147 38.147-38.147h131.587c8.284 0 15-6.716 15-15s-6.716-15-15-15H68.904C31.327 32.266.757 62.837.757 100.413v180.321c0 37.576 30.571 68.147 68.147 68.147h181.798c37.576 0 68.147-30.571 68.147-68.147V153.388c.001-8.284-6.715-15-14.999-15z"
                                        data-original="#000000" />
                                </svg>
                            </button>
                            <button class="mr-4" title="Delete">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 fill-red-500 hover:fill-red-700" viewBox="0 0 24 24">
                                    <path
                                        d="M19 7a1 1 0 0 0-1 1v11.191A1.92 1.92 0 0 1 15.99 21H8.01A1.92 1.92 0 0 1 6 19.191V8a1 1 0 0 0-2 0v11.191A3.918 3.918 0 0 0 8.01 23h7.98A3.918 3.918 0 0 0 20 19.191V8a1 1 0 0 0-1-1Zm1-3h-4V2a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v2H4a1 1 0 0 0 0 2h16a1 1 0 0 0 0-2ZM10 4V3h4v1Z"
                                        data-original="#000000" />
                                    <path d="M11 17v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0Zm4 0v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0Z"
                                        data-original="#000000" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div> -->
    </section>



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