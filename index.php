<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <title>Youdemy - Accueil</title>
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
                <form action="" class=" flex w-full h-12 justify-center mt-4 rounded-lg overflow-hidden">
                    <div class="flex px-4 py-3 w-2/3 rounded-md border-2 border-[#386641] bg-[#daeadd] overflow-hidden max-w-md mx-auto font-[sans-serif]">
                        <input type="email" placeholder="Search Something..."
                            class="w-full outline-none bg-transparent text-gray-600 text-sm" />
                        <button>
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
        <section id="catalogue" class="py-16">
            <div class="container mx-auto px-4">
                <h3 class="text-3xl font-bold text-gray-800 text-center">Cours Populaires</h3>
                <p class="text-center text-gray-600 mt-2">Découvrez nos cours les plus suivis.</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mt-10">
                    <!-- Card 1 -->
                    <div class="bg-[#daeadd] hover:scale-105 hover:shadow-lg shadow-[#386641] shadow-md rounded-lg overflow-hidden">
                        <img src="images/image_7.jpg" alt="Cours 1" class="w-full h-40 object-cover">
                        <div class="p-4">
                            <h4 class="font-bold text-lg text-[#386641]">Introduction à la programmation</h4>
                            <p class="text-gray-600 mt-2">Apprenez les bases de la programmation avec des exemples
                                simples.
                            </p>
                            <a href="#" class="text-[#faa307 hover:underline mt-4 block">Voir le cours</a>
                        </div>
                    </div>
                    <!-- Card 2 -->
                    <div class="bg-[#daeadd] hover:scale-105 hover:shadow-lg shadow-[#386641] shadow-md rounded-lg overflow-hidden">
                        <img src="images/image_7.jpg" alt="Cours 2" class="w-full h-40 object-cover">
                        <div class="p-4">
                            <h4 class="font-bold text-lg text-[#386641]">Data Science pour débutants</h4>
                            <p class="text-gray-600 mt-2">Un guide pour comprendre les bases de la Data Science.</p>
                            <a href="#" class="text-[#faa307 hover:underline mt-4 block">Voir le cours</a>
                        </div>
                    </div>
                    <!-- Card 3 -->
                    <div class="bg-[#daeadd] hover:scale-105 hover:shadow-lg shadow-[#386641] shadow-md rounded-lg overflow-hidden">
                        <img src="images/image_7.jpg" alt="Cours 3" class="w-full h-40 object-cover">
                        <div class="p-4">
                            <h4 class="font-bold text-lg text-[#386641]">Marketing Digital</h4>
                            <p class="text-gray-600 mt-2">Maîtrisez les outils pour développer votre activité en ligne.
                            </p>
                            <a href="#" class="text-[#faa307 hover:underline mt-4 block">Voir le cours</a>
                        </div>
                    </div>

                    <div class="bg-[#daeadd] hover:scale-105 hover:shadow-lg shadow-[#386641] shadow-md rounded-lg overflow-hidden">
                        <img src="images/image_7.jpg" alt="Cours 3" class="w-full h-40 object-cover">
                        <div class="p-4">
                            <h4 class="font-bold text-lg text-[#386641]">Marketing Digital</h4>
                            <p class="text-gray-600 mt-2">Maîtrisez les outils pour développer votre activité en ligne.
                            </p>
                            <a href="#" class="text-[#faa307 hover:underline mt-4 block">Voir le cours</a>
                        </div>
                    </div>

                    <div class="bg-[#daeadd] hover:scale-105 hover:shadow-lg shadow-[#386641] shadow-md rounded-lg overflow-hidden">
                        <img src="images/image_7.jpg" alt="Cours 3" class="w-full h-40 object-cover">
                        <div class="p-4">
                            <h4 class="font-bold text-lg text-[#386641]">Marketing Digital</h4>
                            <p class="text-gray-600 mt-2">Maîtrisez les outils pour développer votre activité en ligne.
                            </p>
                            <a href="#" class="text-[#faa307 hover:underline mt-4 block">Voir le cours</a>
                        </div>
                    </div>

                    <div class="bg-[#daeadd] hover:scale-105 hover:shadow-lg shadow-[#386641] shadow-md rounded-lg overflow-hidden">
                        <img src="images/image_7.jpg" alt="Cours 3" class="w-full h-40 object-cover">
                        <div class="p-4">
                            <h4 class="font-bold text-lg text-[#386641]">Marketing Digital</h4>
                            <p class="text-gray-600 mt-2">Maîtrisez les outils pour développer votre activité en ligne.
                            </p>
                            <a href="#" class="text-[#faa307 hover:underline mt-4 block">Voir le cours</a>
                        </div>
                    </div>

                    <div class="bg-[#daeadd] hover:scale-105 hover:shadow-lg shadow-[#386641] shadow-md rounded-lg overflow-hidden">
                        <img src="images/image_7.jpg" alt="Cours 3" class="w-full h-40 object-cover">
                        <div class="p-4">
                            <h4 class="font-bold text-lg text-[#386641]">Marketing Digital</h4>
                            <p class="text-gray-600 mt-2">Maîtrisez les outils pour développer votre activité en ligne.
                            </p>
                            <a href="#" class="text-[#faa307 hover:underline mt-4 block">Voir le cours</a>
                        </div>
                    </div>

                    <div class="bg-[#daeadd] hover:scale-105 hover:shadow-lg shadow-[#386641] shadow-md rounded-lg overflow-hidden">
                        <img src="images/image_7.jpg" alt="Cours 3" class="w-full h-40 object-cover">
                        <div class="p-4">
                            <h4 class="font-bold text-lg text-[#386641]">Marketing Digital</h4>
                            <p class="text-gray-600 mt-2">Maîtrisez les outils pour développer votre activité en ligne.
                            </p>
                            <a href="#" class="text-[#faa307 hover:underline mt-4 block">Voir le cours</a>
                        </div>
                    </div>
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

</html>