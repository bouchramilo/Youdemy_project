<?php

require_once "classes/cours.Class.php";
require_once "classes/tag.Class.php";
require_once "classes/categorie.Class.php";
require_once "classes/cours_texte.Class.php";
require_once "classes/cours_video.Class.php";
require_once "classes/inscription_cours.Class.php";
require_once "classes/enseignant.Class.php";

$inscrireCours = new InscriptionCours();
$enseignant = new Enseignant();

$nbrMerCours = $enseignant->getNbrMesCours();
$NbrinscriptionCours = $enseignant->getNbrinscriptionCours();

$data = $enseignant->getNombreInscriptionsParCours();
echo '<script> const chartData = ' . json_encode($data) . ';</script>';

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

    <title>Youdemy - E : Statistique</title>
</head>

<body class="bg-[#fff] text-[#14120b]">

    <!-- header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header header header header header -->
    <?php include "header.php"; ?>
    <!-- header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header header header header header -->







    <div class="w-full bg-gray-100 py-10 px-6 md:px-8 lg:px-16">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <!-- Nombre d'étudiants inscrits -->
            <div class="flex flex-col sm:flex-row items-center justify-between p-6 bg-green-500 text-white rounded-lg shadow-md">
                <div class="text-center sm:text-left flex gap-4">
                    <img src="images/icons/ecrire.png" alt="Nombre d'étudiants" class="w-32 h-32 mx-auto sm:mx-0 mb-4">
                    <div class="flex flex-col gap-4 ">
                        <h3 class="text-xl sm:text-2xl font-semibold">Étudiants inscrits</h3>
                        <p class="mt-2 text-lg"><?php echo $NbrinscriptionCours; ?> étudiants</p>
                    </div>
                </div>
            </div>

            <!-- Nombre de cours -->
            <div class="flex flex-col sm:flex-row items-center justify-between p-6 bg-blue-500 text-white rounded-lg shadow-md">
                <div class="text-center sm:text-left flex gap-4">
                    <img src="images/icons/livre.png" alt="Nombre de cours" class="w-32 h-32 mx-auto sm:mx-0 mb-4">
                    <div class="flex flex-col gap-4 ">
                        <h3 class="text-xl sm:text-2xl font-semibold">Mes cours</h3>
                        <p class="mt-2 text-lg"><?php echo $nbrMerCours; ?> cours</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- graphique des inscriptions -->
        <div class="mt-8">
            <div class="bg-white p-6 md:p-8 rounded-lg shadow-md">
                <h2 class="text-lg sm:text-xl font-semibold text-gray-800 mb-4 text-center sm:text-left">
                    Inscriptions par cours
                </h2>
                <canvas id="inscriptionsChart" class="w-full h-[300px] sm:h-[400px]"></canvas>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const xValues = chartData.map(item => item.titre_cours);
        const yValues = chartData.map(item => item.nb_inscriptions);

        const barColors = ["#ff6384", "#36a2eb", "#cc65fe", "#ffce56", "#4bc0c0"];

        new Chart("inscriptionsChart", {
            type: "bar",
            data: {
                labels: xValues,
                datasets: [{
                    label: "Nombre d'inscriptions",
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true
                    },
                    title: {
                        display: true,
                        text: "Nombre d'inscriptions par cours"
                    }
                }
            }
        });
    </script>


    <!-- Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer -->
    <?php include "footer.php"; ?>
    <!-- Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer -->


</body>
<!-- Scripts JavaScript -->
<script src="js/menu_header.js"></script>

</html>