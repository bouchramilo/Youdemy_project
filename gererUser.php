<?php

require_once "classes/admin.Class.php";
require_once "classes/utilisateur.Class.php";

$admin = new Admin();
$userr = new Utilisateur();

$allUsers = $admin->getAllUsers();

// compte is valide : +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
if (isset($_POST['cptIsValide'])) {
    $isVld = $admin->valideEnseignant($_POST['cptIsValide']);
    echo $isVld;
}

// delete user : +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
if (isset($_POST['btn_delete_user'])) {
    $userr->deleteUser($_POST['btn_delete_user']);
}

// update status users : +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
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
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Youdemy - Admin</title>

</head>

<body class="bg-[#fff] text-[#14120b] ">

    <!-- header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header header header header header -->
    <?php include "header.php"; ?>
    <!-- header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header header header header header -->

    <!-- ********************************************************************************************************************************************************************** -->

    <section class="p-6 ">
        <div class="flex gap-4">
            <img src="images/icons/group.png" alt="" class="h-16 w-16 max-sm:h-12 max-sm:w-12">
            <p class="text-5xl font-bold max-sm:text-3xl">Les utilisateurs</p>
        </div>
    </section>
    <section class="w-full min-h-screen max-sm:p-0 p-6 max-sm:text-xs max-sm:w-full ">
        <div class="font-[sans-serif] overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-[#386641] text-white whitespace-nowrap">
                    <tr>

                        <th class="p-4 text-left text-sm max-sm:text-xs font-semibold">
                            Name
                        </th>
                        <th class="p-4 text-left text-sm max-sm:text-xs font-semibold">
                            Role
                        </th>
                        <th class="p-4 text-left text-sm max-sm:text-xs font-semibold">
                            valide
                        </th>
                        <th class="p-4 text-left text-sm max-sm:text-xs font-semibold">
                            Status
                        </th>
                        <th class="p-4 text-left text-sm max-sm:text-xs font-semibold">
                            Action
                        </th>
                    </tr>
                </thead>

                <tbody class="whitespace-nowrap">

                    <?php foreach ($allUsers as $user): ?>
                        <tr class="border-b-2 border-[#386641] bg-[#daeadd]">

                            <td class="p-4 text-sm max-sm:text-xs">
                                <div class="flex items-center cursor-pointer w-max">
                                    <img src='<?php echo $user['photo']; ?>' class="w-9 h-9 max-sm:w-6 max-sm:h-6 rounded-full shrink-0" />
                                    <div class="ml-4">
                                        <p class="text-sm max-sm:text-xs text-black"><?php echo $user['nom'] . ' ' . $user['prenom']; ?></p>
                                        <p class="text-xs max-sm:text-[10px] text-gray-500 mt-0.5"><?php echo $user['email']; ?></p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4 text-sm max-sm:text-xs text-black">
                                <?php echo $user['role']; ?>
                            </td>
                            <td class="p-4 text-sm max-sm:text-xs">
                                <?php if ($user['role'] === 'Etudiant' || $user['role'] === 'Admin'): ?>

                                    <button name="cptIsValide" value="<?php echo $user['id_user']; ?>" class="w-20 h-7 p-1 flex items-center justify-center bg-[#f48c06] opacity-50 rounded-md ">invalider

                                    <?php else: ?>

                                        <?php if ($user['estValide'] === 1): ?>
                                            <form action="" method="post">
                                                <button name="cptIsValide" value="<?php echo $user['id_user']; ?>" class="w-20 h-7 p-1 flex items-center justify-center bg-[#f48c06] rounded-md ">invalider
                                            </form>
                                        <?php elseif ($user['estValide'] === 0): ?>
                                            <form action="" method="post">
                                                <button name="cptIsValide" value="<?php echo $user['id_user']; ?>" class="w-20 h-7 p-1 flex items-center justify-center bg-gray-300 rounded-md ">valider
                                            </form>
                                        <?php endif; ?>

                                    <?php endif; ?>
                            </td>
                            <td class="p-4 text-sm max-sm:text-xs text-gray-800">
                                <?php if ($user['status'] === 'Activer'): ?>
                                    <button
                                        class="w-[68px] block text-center py-1 border border-green-500 text-green-600 rounded" onclick="editStatus(<?php echo $user['id_user']; ?>, '<?php echo $user['status']; ?>')"
                                        <?php if ($user['role'] === 'Admin') {
                                            echo 'disabled';
                                        } ?>>
                                        <?php echo $user['status']; ?>
                                    </button>

                                <?php elseif ($user['status'] === 'Suspendu'): ?>
                                    <button
                                        class="w-[68px] block text-center py-1 border border-yellow-500 text-yellow-600 rounded" onclick="editStatus(<?php echo $user['id_user']; ?>, '<?php echo $user['status']; ?>')"
                                        <?php if ($user['role'] === 'Admin') {
                                            echo 'disabled';
                                        } ?>>
                                        <?php echo $user['status']; ?>
                                    </button>
                                <?php endif; ?>
                            </td>
                            <td class="p-4">
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