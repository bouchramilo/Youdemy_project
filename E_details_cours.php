<?php

require_once "classes/utilisateur.Class.php";
require_once "classes/cours.Class.php";
require_once "classes/tag.Class.php";
require_once "classes/categorie.Class.php";
require_once "classes/cours_texte.Class.php";
require_once "classes/cours_video.Class.php";
require_once "classes/tags_cours.Class.php";

$utilstr = new Utilisateur();

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

$tagCours = new TagsCours();
$tagsCours = $tagCours->allTagsForCours($_SESSION['id_cours']);

// tags et catégories pour la forme de update +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
$tag = new Tag();
$categorie = new Categorie();
$tags = $tag->getAllTags();
$categories = $categorie->getAllCategorie();

// update de cours +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

if (isset($_POST['btn_update_cours'])) {


    if (empty($_POST['title_cours']) || empty($_POST['descri_cours']) || empty($_POST['type_cours'])) {
        echo "Certains champs requis sont manquants.";
    } else {
        switch ($_POST['type_cours']) {
            case "Texte":
                $result_update_cours = $cours->modifierCours(
                    $_POST['btn_update_cours'],
                    $_POST['title_cours'],
                    $_POST['descri_cours'],
                    $_POST['type_cours'],
                    $_POST['text_cours'],
                    $_POST['categorie_cours'],
                    $_POST['tags_cours'],
                    $_POST['photo_cours']
                );
                break;

            case "Video":
                $result_update_cours = $cours->modifierCours(
                    $_POST['btn_update_cours'],
                    $_POST['title_cours'],
                    $_POST['descri_cours'],
                    $_POST['type_cours'],
                    $_POST['video_cours'],
                    $_POST['categorie_cours'],
                    $_POST['tags_cours'],
                    $_POST['photo_cours']
                );
                break;
        }
    }
}

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
    <title>Youdemy - E : Cours</title>
</head>

<body class="bg-[#fff] text-[#14120b]">

    <!-- header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header header header header header -->
    <?php include "header.php"; ?>
    <!-- header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header header header header header -->


    <section class="w-full h-20 px-10 pt-6 flex  max-sm:flex-col-reverse  max-sm:h-max md:h-max  justify-between items-center shadow-md">
        <div class="text-4xl font-semibold text-gray-800"><?php echo $cours_actuel['titre']; ?></div>
        <div class="flex max-sm:flex-col sm:flex-col md:flex-row max-sm:text-xs gap-4">
            <button type="button" <?php if($utilstr->getStatus() === "Suspendu"){ echo 'disabled';} ?>
                class=" updateCours flex gap-2  bg-yellow-400 hover:bg-yellow-500 transition-colors duration-300 text-white px-6 py-2 rounded shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 fill-white hover:fill-white"
                    viewBox="0 0 348.882 348.882">
                    <path
                        d="m333.988 11.758-.42-.383A43.363 43.363 0 0 0 304.258 0a43.579 43.579 0 0 0-32.104 14.153L116.803 184.231a14.993 14.993 0 0 0-3.154 5.37l-18.267 54.762c-2.112 6.331-1.052 13.333 2.835 18.729 3.918 5.438 10.23 8.685 16.886 8.685h.001c2.879 0 5.693-.592 8.362-1.76l52.89-23.138a14.985 14.985 0 0 0 5.063-3.626L336.771 73.176c16.166-17.697 14.919-45.247-2.783-61.418zM130.381 234.247l10.719-32.134.904-.99 20.316 18.556-.904.99-31.035 13.578zm184.24-181.304L182.553 197.53l-20.316-18.556L294.305 34.386c2.583-2.828 6.118-4.386 9.954-4.386 3.365 0 6.588 1.252 9.082 3.53l.419.383c5.484 5.009 5.87 13.546.861 19.03z"
                        data-original="#000000" />
                    <path
                        d="M303.85 138.388c-8.284 0-15 6.716-15 15v127.347c0 21.034-17.113 38.147-38.147 38.147H68.904c-21.035 0-38.147-17.113-38.147-38.147V100.413c0-21.034 17.113-38.147 38.147-38.147h131.587c8.284 0 15-6.716 15-15s-6.716-15-15-15H68.904C31.327 32.266.757 62.837.757 100.413v180.321c0 37.576 30.571 68.147 68.147 68.147h181.798c37.576 0 68.147-30.571 68.147-68.147V153.388c.001-8.284-6.715-15-14.999-15z"
                        data-original="#000000" />
                </svg>
                Modifier
            </button>
        </div>
    </section>

    <section class="min-h-screen w-full bg-gray-50 p-6">
        <section class="flex flex-col sm:flex-row gap-6 w-full bg-white shadow-lg rounded-lg overflow-hidden">
            <!-- Section principale -->
            <div class="w-full sm:w-8/12 flex flex-col gap-6 min-h-screen">


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
                    <p class="p-10 ">
                        <?php echo nl2br(htmlspecialchars($cours_actuel['content'])); ?>
                    </p>
                <?php endif; ?>
            </div>

            <!-- Section des informations sur le cours -->
            <div class="w-full sm:w-4/12 flex flex-col gap-4 items-center bg-gray-50 p-4 ">
                <img src="<?php echo $cours_actuel['photo']; ?>" alt="images de cours" class="h-72 w-full object-cover rounded-t-lg sm:rounded-none">
                <div class="w-full border border-yellow-400 rounded-lg p-4 text-gray-700">
                    <p class="text-md max-sm:text-sm font-semibold">Auteur : <span class="font-normal"><?php echo $cours_actuel['full_name']; ?></span></p>
                    <p class="text-md max-sm:text-sm font-semibold">Catégorie : <span class="font-normal"><?php echo $cours_actuel['titre_categorie']; ?></span></p>
                    <p class="text-md max-sm:text-sm font-semibold">Description : <span class="font-normal"><?php echo $cours_actuel['description']; ?></span></p>
                    <p class="text-md max-sm:text-sm font-semibold">Date de création : <span class="font-normal"><?php echo $cours_actuel['date_de_creation']; ?></span></p>
                    <p class="text-md max-sm:text-sm font-semibold">Tags :</p>
                    <ul class="list-disc text-md max-sm:text-sm ml-10 text-gray-600">
                        <?php foreach ($tagsCours as $TC): ?>
                            <li><?php echo $TC['nom_tag']; ?></li>
                        <?php endforeach; ?>

                    </ul>
                </div>
            </div>
        </section>
    </section>



    <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
    <!-- update cours model +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
    <div
        class="coursUpdateModal hidden fixed inset-0 p-4 flex flex-wrap justify-center items-center w-full h-full z-[1000] before:fixed before:inset-0 before:w-full before:h-full before:bg-[rgba(0,0,0,0.5)] overflow-auto font-[sans-serif]">
        <div class="w-full max-w-lg bg-yellow-50 shadow-lg rounded-lg p-8 relative">
            <div class="flex items-center">
                <h3 class="text-[#386641] text-xl font-bold flex-1">Modifier le cours</h3>
            </div>

            <form method="post" action="" class="space-y-4 mt-8">
                <div>
                    <label class="text-gray-800 text-sm mb-1 block">Nouveau Titre de cours</label>
                    <input type="text" placeholder="Entrez le titre de cours" name="title_cours" value="<?php echo $cours_actuel['titre']; ?>"
                        class="px-4 py-3 bg-gray-100 w-full text-gray-800 text-sm border-none focus:outline-[#386641] focus:bg-transparent rounded-lg" />
                </div>

                <div>
                    <label class="text-gray-800 text-sm mb-1 block">Nouveau Description du cours</label>
                    <textarea placeholder='Entrez la description de cours' name="descri_cours"
                        class="resize-none px-4 py-3 bg-gray-100 w-full text-gray-800 text-sm border-none focus:outline-[#386641] focus:bg-transparent rounded-lg" rows="3"><?php echo $cours_actuel['description']; ?></textarea>
                </div>

                <div>
                    <label class="text-gray-800 text-sm mb-1 block">Nouveau Type de cours</label>
                    <select placeholder="Entrez Type de cours" id="select_type" name="type_cours"
                        class="px-4 py-3 bg-gray-100 w-full text-gray-800 text-sm border-none focus:outline-[#386641] focus:bg-transparent rounded-lg">
                        <option value="Video" <?php if ($cours_actuel['type_contenu'] === "Video") {
                                                    echo 'selected';
                                                } ?>>Video</option>
                        <option value="Texte" <?php if ($cours_actuel['type_contenu'] === "Texte") {
                                                    echo 'selected';
                                                } ?>>Texte</option>
                    </select>
                </div>

                <!-- --------------------------------------------------- -->
                <!-- texte -->
                <div id="type-text" <?php if ($cours_actuel['type_contenu'] !== "Texte") {
                                        echo 'class="hidden"';
                                    } ?>>
                    <label class="text-gray-800 text-sm mb-1 block">Nouveau Texte de cours</label>
                    <textarea placeholder="Entrez le Contenu Text" name="text_cours"
                        class="resize-none px-4 py-3 bg-gray-100 w-full text-gray-800 text-sm border-none focus:outline-[#386641] focus:bg-transparent rounded-lg"><?php if ($cours_actuel['type_contenu'] === "Texte") {
                                                                                                                                                                        echo $cours_actuel['content'];
                                                                                                                                                                    }  ?></textarea>
                </div>

                <!-- vidéo -->
                <div id="type-video" <?php if ($cours_actuel['type_contenu'] !== "Video") {
                                            echo 'class="hidden"';
                                        } ?>>
                    <label class="text-gray-800 text-sm mb-1 block">Nouveau URI vidéo</label>
                    <input type="url" placeholder="Entrez le URL du Vidéo" name="video_cours" value="<?php if ($cours_actuel['type_contenu'] === "Video") {
                                                                                                            echo $cours_actuel['content'];
                                                                                                        }  ?>"
                        class="px-4 py-3 bg-gray-100 w-full text-gray-800 text-sm border-none focus:outline-[#386641] focus:bg-transparent rounded-lg" />
                </div>
                <!-- ----------------------------------------- -->

                <div>
                    <label class="text-gray-800 text-sm mb-1 block">Nouveau Catégorie</label>
                    <select placeholder="Enter le Catégorie de cours" name="categorie_cours"
                        class="px-4 py-3 bg-gray-100 w-full text-gray-800 text-sm border-none focus:outline-[#386641] focus:bg-transparent rounded-lg">
                        <?php foreach ($categories as $categoriee): ?>
                            <option value="<?= $categoriee['id_categorie'] ?>"><?= $categoriee['titre_categorie'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label class="text-gray-800 text-sm mb-1 block">Nouveau Tags</label>
                    <!-- Select tags -->
                    <select name="tags_cours[]" id="tags_update" multiple>
                        <?php foreach ($tags as $taag): ?>
                            <option value="<?= $taag['id_tag'] ?>"><?= $taag['nom_tag'] ?></option>
                        <?php endforeach; ?>

                    </select>
                    <!-- End Select tags -->
                </div>

                <div>
                    <label class="text-gray-800 text-sm mb-1 block">Nouveau Photo</label>
                    <input type="url" placeholder="Entrez le URL de la photo de cours" name="photo_cours" value="<?php echo $cours_actuel['photo']; ?>"
                        class="px-4 py-3 bg-gray-100 w-full text-gray-800 text-sm border-none focus:outline-[#386641] focus:bg-transparent rounded-lg" />
                </div>

                <div class="flex justify-end gap-4 !mt-8">
                    <button type="button"
                        class="closeU px-6 py-3 rounded-lg text-gray-800 text-sm border-none outline-none tracking-wide bg-gray-200 hover:bg-gray-300">Annuler</button>
                    <button type="submit" name="btn_update_cours" value="<?= $cours_actuel['id_cours'] ?>"
                        class="px-6 py-3 rounded-lg text-white text-sm border-none outline-none tracking-wide bg-[#386641] hover:bg-[#277752]">Modifier</button>
                </div>
            </form>
        </div>
    </div>





    <!-- Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer -->
    <?php include "footer.php"; ?>
    <!-- Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer -->


    <script>
        const updateCours = document.querySelector(".updateCours");
        const close = document.querySelector(".closeU");
        const coursUpdateModal = document.querySelector(".coursUpdateModal");
        updateCours.addEventListener("click", () => {
            coursUpdateModal.classList.toggle("hidden");
        });
        close.addEventListener("click", () => {
            coursUpdateModal.classList.toggle("hidden");
        });
    </script>
    <script>
        document.getElementById("select_type").addEventListener("change", function() {
            const type = this.value;
            document.getElementById("type-text").classList.add("hidden");
            document.getElementById("type-video").classList.add("hidden");

            if (type === "Texte") {
                document.getElementById("type-text").classList.remove("hidden");
            } else if (type === "Video") {
                document.getElementById("type-video").classList.remove("hidden");
            }
        });
    </script>

    <script>
        new MultiSelectTag("tags_update");
    </script>

</body>
<!-- Scripts JavaScript -->
<script src="js/menu_header.js"></script>
<script src="js/crudCours.js"></script>

</html>