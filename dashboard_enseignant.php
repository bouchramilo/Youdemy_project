<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

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

<body class="bg-[#fff] text-[#14120b] ">

    <!-- header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header header header header header -->
    <?php include "header.php"; ?>
    <!-- header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header header header header header -->
    <section class="w-full h-16 px-10 pt-6 flex justify-end">
        <form action="" method="post">
            <button type="button"
                class="addCours bg-[#ffba08] hover:bg-[#f48c06] transition-colors duration-300 text-white px-4 py-2 rounded">Ajouter | &#10010;
            </button>
        </form>
    </section>
    <section class="min-h-screen w-full p-6">
        <div class="overflow-x-auto font-[sans-serif]">
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
        </div>
    </section>



    <!-- les models +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

    <div
        class="coursAddModal hidden fixed inset-0 p-4 flex flex-wrap justify-center items-center w-full h-full z-[1000] before:fixed before:inset-0 before:w-full before:h-full before:bg-[rgba(0,0,0,0.5)] overflow-auto font-[sans-serif]">
        <div class="w-full max-w-lg bg-white shadow-lg rounded-lg p-8 relative">
            <div class="flex items-center">
                <h3 class="text-[#386641] text-xl font-bold flex-1">Add New Product</h3>
                <!-- <svg xmlns="http://www.w3.org/2000/svg" class="close w-3 ml-2 cursor-pointer shrink-0 fill-gray-400 hover:fill-red-500"
                    viewBox="0 0 320.591 320.591">
                    <path
                        d="M30.391 318.583a30.37 30.37 0 0 1-21.56-7.288c-11.774-11.844-11.774-30.973 0-42.817L266.643 10.665c12.246-11.459 31.462-10.822 42.921 1.424 10.362 11.074 10.966 28.095 1.414 39.875L51.647 311.295a30.366 30.366 0 0 1-21.256 7.288z"
                        data-original="#000000"></path>
                    <path
                        d="M287.9 318.583a30.37 30.37 0 0 1-21.257-8.806L8.83 51.963C-2.078 39.225-.595 20.055 12.143 9.146c11.369-9.736 28.136-9.736 39.504 0l259.331 257.813c12.243 11.462 12.876 30.679 1.414 42.922-.456.487-.927.958-1.414 1.414a30.368 30.368 0 0 1-23.078 7.288z"
                        data-original="#000000"></path>
                </svg> -->
            </div>

            <form class="space-y-4 mt-8">
                <div>
                    <label class="text-gray-800 text-sm mb-1 block">Titre de cours</label>
                    <input type="text" placeholder="Enter product name"
                        class="px-4 py-3 bg-gray-100 w-full text-gray-800 text-sm border-none focus:outline-[#386641] focus:bg-transparent rounded-lg" />
                </div>

                <div>
                    <label class="text-gray-800 text-sm mb-1 block">Description du cours</label>
                    <textarea placeholder='Write about the product'
                        class="px-4 py-3 bg-gray-100 w-full text-gray-800 text-sm border-none focus:outline-[#386641] focus:bg-transparent rounded-lg" rows="3"></textarea>
                </div>

                <div>
                    <label class="text-gray-800 text-sm mb-1 block">Type de cours</label>
                    <select placeholder="Enter Type de cours"
                        class="px-4 py-3 bg-gray-100 w-full text-gray-800 text-sm border-none focus:outline-[#386641] focus:bg-transparent rounded-lg">
                        <option value="Video">Video</option>
                        <option value="Texte">Texte</option>
                    </select>
                </div>
                <!-- contenus selon  le type de contenu ------------------------------------------------------------------------------------------------------------------------------  -->
                <div>
                    <label class="text-gray-800 text-sm mb-1 block">Texte de cours</label>
                    <textarea placeholder="Contenu Text"
                        class="px-4 py-3 bg-gray-100 w-full text-gray-800 text-sm border-none focus:outline-[#386641] focus:bg-transparent rounded-lg">
                    </textarea>
                </div>

                <div>
                    <label class="text-gray-800 text-sm mb-1 block">URI video</label>
                    <input type="url" placeholder="Contenu Video"
                        class="px-4 py-3 bg-gray-100 w-full text-gray-800 text-sm border-none focus:outline-[#386641] focus:bg-transparent rounded-lg" />
                </div>
                <!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------  -->

                <div>
                    <label class="text-gray-800 text-sm mb-1 block">Catégorie</label>
                    <select placeholder="Enter Catégorie"
                        class="px-4 py-3 bg-gray-100 w-full text-gray-800 text-sm border-none focus:outline-[#386641] focus:bg-transparent rounded-lg">
                        <option value="1">catégoris 1</option>
                        <option value="2">catégorie 2</option>
                    </select>
                </div>

                <div>
                    <label class="text-gray-800 text-sm mb-1 block">Tags</label>
                    <select placeholder="Enter tag"
                        class="px-4 py-3 bg-gray-100 w-full text-gray-800 text-sm border-none focus:outline-[#386641] focus:bg-transparent rounded-lg">
                        <option value="1">tag 1</option>
                        <option value="2">tag 2</option>
                    </select>
                </div>


                <div>
                    <label class="text-gray-800 text-sm mb-1 block">Photo</label>
                    <input type="url" placeholder="photo"
                        class="px-4 py-3 bg-gray-100 w-full text-gray-800 text-sm border-none focus:outline-[#386641] focus:bg-transparent rounded-lg" />
                </div>



                <div class="flex justify-end gap-4 !mt-8">
                    <button type="button"
                        class="close px-6 py-3 rounded-lg text-gray-800 text-sm border-none outline-none tracking-wide bg-gray-200 hover:bg-gray-300">Cancel</button>
                    <button type="button"
                        class="px-6 py-3 rounded-lg text-white text-sm border-none outline-none tracking-wide bg-[#386641] hover:bg-[#277752]">Submit</button>
                </div>
            </form>
        </div>
    </div>






    <!-- Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer -->
    <?php include "footer.php"; ?>
    <!-- Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer -->

</body>
<!-- Scripts JavaScript -->
<script src="js/menu_header.js"></script>
<script src="js/crudCours.js"></script>

</html>