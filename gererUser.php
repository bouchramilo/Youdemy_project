<?php

require_once "classes/admin.Class.php";
require_once "classes/utilisateur.Class.php";

$admin = new Admin();
$userr = new Utilisateur();

$allUsers = $admin->getAllUsers();

if (isset($_POST['cptIsValide'])) {
    $isVld = $admin->valideEnseignant($_POST['cptIsValide']);
    echo $isVld;
}

if (isset($_POST['btn_delete_user'])) {
    $userr->deleteUser($_POST['btn_delete_user']);
    // echo "<script>alert(" . $_POST['btn_delete_user'] . ")</script>";
}

// update status users : 
if (isset($_POST['status_update'])) {
    $rsltUpdateStatus = $userr->updateStatus($_POST['id_utilisateur'], $_POST['status_update']);
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
            <img src="images/icons/group.png" alt="" class="h-16 w-16">
            <p class="text-5xl font-bold ">Les utilisateurs</p>
        </div>
    </section>
    <section class="w-full min-h-screen p-6 ">
        <div class="font-[sans-serif] overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-[#386641] text-white whitespace-nowrap">
                    <tr>

                        <th class="p-4 text-left text-sm font-semibold">
                            Name
                        </th>
                        <th class="p-4 text-left text-sm font-semibold">
                            Role
                        </th>
                        <th class="p-4 text-left text-sm font-semibold">
                            valide
                        </th>
                        <th class="p-4 text-left text-sm font-semibold">
                            Status
                        </th>
                        <th class="p-4 text-left text-sm font-semibold">
                            Action
                        </th>
                    </tr>
                </thead>

                <tbody class="whitespace-nowrap">

                    <?php foreach ($allUsers as $user): ?>
                        <tr class="border-b-2 border-[#386641] bg-[#daeadd]">

                            <td class="p-4 text-sm">
                                <div class="flex items-center cursor-pointer w-max">
                                    <img src='<?php echo $user['photo']; ?>' class="w-9 h-9 rounded-full shrink-0" />
                                    <div class="ml-4">
                                        <p class="text-sm text-black"><?php echo $user['nom'] . ' ' . $user['prenom']; ?></p>
                                        <p class="text-xs text-gray-500 mt-0.5"><?php echo $user['email']; ?></p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4 text-sm text-black">
                                <?php echo $user['role']; ?>
                            </td>
                            <td class="p-4">
                                <?php if ($user['role'] === 'Etudiant' || $user['role'] === 'Admin'): ?>
                                    <!-- <form action="" method="post"> -->
                                    <button name="cptIsValide" value="<?php echo $user['id_user']; ?>" class="w-20 h-7 p-1 flex items-center justify-center bg-[#f48c06] opacity-50 rounded-md text-sm ">invalider
                                        <!-- </form> -->
                                    <?php else: ?>

                                        <?php if ($user['estValide'] === 1): ?>
                                            <form action="" method="post">
                                                <button name="cptIsValide" value="<?php echo $user['id_user']; ?>" class="w-20 h-7 p-1 flex items-center justify-center bg-[#f48c06] rounded-md text-sm ">invalider
                                            </form>
                                        <?php elseif ($user['estValide'] === 0): ?>
                                            <form action="" method="post">
                                                <button name="cptIsValide" value="<?php echo $user['id_user']; ?>" class="w-20 h-7 p-1 flex items-center justify-center bg-gray-300 rounded-md text-sm ">valider
                                            </form>
                                        <?php endif; ?>

                                    <?php endif; ?>
                            </td>
                            <td class="p-4 text-sm text-gray-800">
                                <?php if ($user['status'] === 'Activer'): ?>
                                    <button
                                        class="w-[68px] block text-center py-1 border border-green-500 text-green-600 rounded text-xs" onclick="editStatus(<?php echo $user['id_user']; ?>, '<?php echo $user['status']; ?>')"
                                        <?php if ($user['role'] === 'Admin') {
                                            echo 'disabled';
                                        } ?>>
                                        <?php echo $user['status']; ?>
                                    </button>
                                
                                <?php elseif ($user['status'] === 'Suspendu'): ?>
                                    <button
                                        class="w-[68px] block text-center py-1 border border-yellow-500 text-yellow-600 rounded text-xs" onclick="editStatus(<?php echo $user['id_user']; ?>, '<?php echo $user['status']; ?>')"
                                        <?php if ($user['role'] === 'Admin') {
                                            echo 'disabled';
                                        } ?>>
                                        <?php echo $user['status']; ?>
                                    </button>
                                <?php endif; ?>
                            </td>
                            <td class="p-4">
                                <!-- <button class="mr-4" title="Edit">
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
                                <form action="" method="post">
                                    <button class="mr-4" title="Delete" name="btn_delete_user" value="<?= $user['id_user']; ?>"
                                        <?php if ($user['role'] === 'Admin') {
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

                </tbody>
            </table>
        </div>
    </section>
    <!-- ********************************************************************************************************************************************************************** -->

    <!-- ********************************************************************************************************************************************************************** -->
    <!-- modification de status           ************************************************************************ -->

    <div id="statusModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center hidden z-50">
        <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Modifier le status :</h2>

            <form method="POST">
                <input type="hidden" id="id_utilisateur" name="id_utilisateur" value="">

                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-600 mb-1">
                        Nouveau status
                    </label>
                    <select id="status" name="status_update" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300">
                        <option value="Suspendu">Suspendu</option>
                        <!-- <option value="Supprimer">Supprimer</option> -->
                        <option value="Activer">Activer</option>
                    </select>
                </div>

                <div class="flex justify-end space-x-4">
                    <button type="button" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400" onclick="closeModal()">
                        Annuler
                    </button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- ********************************************************************************************************************************************************************** -->





    <!-- ********************************************************************************************************************************************************************** -->
    <!-- Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer -->
    <?php include "footer.php"; ?>
    <!-- Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer -->

    <script>
        // for status
        function editStatus(id, newStatus) {
            document.getElementById("id_utilisateur").value = id;
            document.getElementById("status").value = newStatus;

            document.getElementById("statusModal").classList.remove("hidden");
        }

        function closeModal() {
            document.getElementById("statusModal").classList.add("hidden");
        }
    </script>

</body>
<!-- Scripts JavaScript -->
<script src="js/menu_header.js"></script>

</html>