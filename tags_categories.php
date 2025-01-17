<?php

require_once "classes/tag.Class.php";
require_once "classes/categorie.Class.php";


// getstion de tag ++++++++++++++++++++++++++++++++++++++++++++++++
$tag = new Tag();
$tag_result = '';

$tags = $tag->getAllTags();

if (isset($_POST['btn_addTag'])) {
    $tag_result = $tag->addTag($_POST['input_addTag']);
    header("Location: tags_categories.php");
}

if (isset($_POST['btn_update_tag'])) {
    $tag->updateTag($_POST['id_tag'], $_POST['update_tag']);
}

if (isset($_POST['btn_deleteTag'])) {
    $tag->deleteTag($_POST['btn_deleteTag']);
}

// getstion de categorie ++++++++++++++++++++++++++++++++++++++++++++++++

$categorie = new Categorie();
$categorie_result = '';

$categories = $categorie->getAllCategorie();

if (isset($_POST['btn_addCategorie'])) {
    $categorie_result = $categorie->addcategorie($_POST['input_addCategorie']);
    header("Location: tags_categories.php");
}

if (isset($_POST['btn_update_categorie'])) {
    $categorie->updateCategorie($_POST['id_categorie'], $_POST['update_categorie']);
}

if (isset($_POST['btn_deleteCategorie'])) {
    $categorie->deleteCategorie($_POST['btn_deleteCategorie']);
}

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <title>Youdemy - Admin</title>
    <!-- <link href="https://fonts.googleapis.com/css?family=Sawarabi%20Mincho:700|Sawarabi%20Mincho:400"> -->
    <!-- <style>
        body {
            font-family: 'Sawarabi Mincho';
            font-weight: 400;
        }
    </style> -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#fff] text-[#14120b] ">

    <!-- header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header header header header header -->
    <?php include "header.php"; ?>
    <!-- header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header header header header header -->

    <!-- ********************************************************************************************************************************************************************** -->

    <section class="p-6 ">
        <div class="flex gap-4">
            <img src="images/icons/tagC.png" alt="" class="h-16 w-16">
            <p class="text-5xl font-bold ">Tags & Catégories</p>
        </div>
    </section>
    <section class="w-full min-h-screen grid grid-cols-2 p-2 gap-2 ">
        <!-- tags ************************************************************************************************************************************************************************************* -->
        <section class="w-full h-full ">
            <div class="w-full h-20 flex flex-col p-1">
                <p class="text-red-500 text-sm"><?php echo $tag_result; ?></p>
                <form action="" method="post" class="flex gap-2 h-12 w-full ">
                    <input name="input_addTag" type="text" placeholder="Entrez tag ... " class="w-3/4 h-full flex px-4 py-3 rounded-md border-2 border-[#386641] bg-[#daeadd] overflow-hidden mx-auto font-[sans-serif]">
                    <button name="btn_addTag"
                        class="w-1/4 bg-[#ffba08] hover:bg-[#f48c06] transition-colors duration-300 text-white px-4 py-2 rounded">Ajouter
                        | &#10010;
                    </button>
                </form>
            </div>
            <div>
                <div class="overflow-x-auto font-[sans-serif]">
                    <table class="min-w-full bg-white">
                        <thead class="bg-[#386641] whitespace-nowrap">
                            <tr>
                                <th class="p-4 w-2/3 text-left text-sm font-medium text-white">
                                    Tag
                                </th>
                                <th class="p-4 text-left w-1/3 text-sm font-medium text-white">
                                    Action
                                </th>
                            </tr>
                        </thead>

                        <tbody class="whitespace-nowrap">
                            <?php if (count($tags) > 0) : ?>

                                <?php foreach ($tags as $tagg): ?>
                                    <tr class="border-b-2 border-[#386641] bg-[#daeadd]">
                                        <td class="p-4 text-sm">
                                            <?php echo $tagg['nom_tag'] ?>
                                        </td>
                                        <td class="p-4 text-sm flex">
                                            <button class="mr-4" title="Edit" value="<?php echo $tagg['id_tag'] ?>" onclick="updateTag(<?php echo $tagg['id_tag'] ?>, '<?php echo $tagg['nom_tag'] ?>')">
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
                                            <form action="" method="post">
                                                <button class="mr-4" title="Delete" name="btn_deleteTag" value="<?php echo $tagg['id_tag'] ?>">
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
                                <tr class="text-sm text-gray-200">
                                    <td>
                                        Aucun catégories trouvée !!!
                                    </td>
                                </tr>
                            <?php endif;  ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <!-- ************************************************************************************************************************************************************************************* -->
        <!-- categorie ************************************************************************************************************************************************************************************* -->
        <section class="w-full h-full ">
            <div class="w-full h-20 flex flex-col p-1">
                <p class="text-red-500 text-sm"><?php echo $categorie_result; ?></p>
                <form action="" method="post" class="flex gap-2 h-12 w-full ">
                    <input name="input_addCategorie" type="text" placeholder="Entrez tag ... " class="w-3/4 h-full flex px-4 py-3 rounded-md border-2 border-[#386641] bg-[#daeadd] overflow-hidden mx-auto font-[sans-serif]">
                    <button name="btn_addCategorie"
                        class="w-1/4 bg-[#ffba08] hover:bg-[#f48c06] transition-colors duration-300 text-white px-4 py-2 rounded">Ajouter
                        | &#10010;</button>
                </form>
            </div>
            <div>
                <div class="overflow-x-auto font-[sans-serif]">
                    <table class="min-w-full bg-white">
                        <thead class="bg-[#386641] whitespace-nowrap">
                            <tr>
                                <th class="p-4 w-2/3 text-left text-sm font-medium text-white">
                                    Catégorie
                                </th>
                                <th class="p-4 text-left w-1/3 text-sm font-medium text-white">
                                    Action
                                </th>
                            </tr>
                        </thead>

                        <tbody class="whitespace-nowrap">
                            <?php if (count($categories) > 0) : ?>
                                <?php foreach ($categories as $categoriee): ?>
                                    <tr class="border-b-2 border-[#386641] bg-[#daeadd]">
                                        <td class="p-4 text-sm">
                                            <?php echo $categoriee['titre_categorie'] ?>
                                        </td>
                                        <td class="p-4 text-sm flex">
                                            <button class="mr-4" title="Edit" value="<?php echo $categoriee['id_categorie'] ?>" onclick="updateCategorie(<?php echo $categoriee['id_categorie'] ?>, '<?php echo $categoriee['titre_categorie'] ?>')">
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
                                            <form action="" method="post">
                                                <button class="mr-4" title="Delete" name="btn_deleteCategorie" value="<?php echo $categoriee['id_categorie'] ?>">
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
                                <tr class="text-sm text-gray-200">
                                    <td>
                                        Aucun catégories trouvée !!!
                                    </td>
                                </tr>
                            <?php endif;  ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <!-- ************************************************************************************************************************************************************************************* -->
    </section>


    <!-- ************************************************************************************************************************************************************************************* -->
    <!-- update Tag model ************************************************************************************************************************************************************************************* -->

    <div id="updateTagModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center hidden z-50">
        <div class="bg-white text-black rounded-lg shadow-lg max-w-md w-full p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Modifier le tag :</h2>

            <form method="POST">
                <input type="hidden" id="id_tag" name="id_tag">

                <div class="mb-4">
                    <label for="tag" class="block text-sm font-medium text-gray-600 mb-1">
                        Modifier le tag :
                    </label>
                    <input id="nameTag" name="update_tag" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300">

                </div>

                <div class="flex justify-end space-x-4">
                    <button type="button" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400" onclick="closeModalt()">
                        Annuler
                    </button>
                    <button value="" name="btn_update_tag" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- ************************************************************************************************************************************************************************************* -->
    <!-- ************************************************************************************************************************************************************************************* -->
    <!-- update categoris model ************************************************************************************************************************************************************************************* -->

    <div id="updateCategorieModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center hidden z-50">
        <div class="bg-white text-black rounded-lg shadow-lg max-w-md w-full p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Modifier le categorie :</h2>

            <form method="POST">
                <input type="hidden" id="id_categorie" name="id_categorie">

                <div class="mb-4">
                    <label for="categorie" class="block text-sm font-medium text-gray-600 mb-1">
                        Modifier le categorie :
                    </label>
                    <input id="nameCategorie" name="update_categorie" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300">

                </div>

                <div class="flex justify-end space-x-4">
                    <button type="button" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400" onclick="closeModalC()">
                        Annuler
                    </button>
                    <button value="" name="btn_update_categorie" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- ************************************************************************************************************************************************************************************* -->

    <!-- ********************************************************************************************************************************************************************** -->
    <!-- Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer -->
    <?php include "footer.php"; ?>
    <!-- Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer -->




</body>
<!-- Scripts JavaScript -->
<script src="js/menu_header.js"></script>
<script src="js/tag_categorie.js"></script>

</html>