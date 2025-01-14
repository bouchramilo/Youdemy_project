<?php

require_once "classes/utilisateur.Class.php";

$utilisateur = new Utilisateur();
$login_user = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $login_user = $utilisateur->login($_POST['email'], $_POST['password']);
}
















?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion - Youdemy</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 flex flex-col w-full items-center justify-center min-h-screen">
  <!-- header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header header header header header -->
  <?php include "header.php"; ?>
  <!-- header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header header header header header -->
  <div class="flex items-center justify-center min-h-screen w-full bg-[url('images/image_1.jpg')] bg-cover">
    <div class=" lg:w-1/3 max-sm:w-full max-md:w-full md:w-2/3 bg-white bg-opacity-50 shadow-md rounded-lg p-8">
      <h2 class="text-2xl font-bold text-center text-[#0c0d08] mb-6">Se connecter</h2>
      <form action="" method="POST">

        <p class="text-red-500 text-sm"><?php echo $login_user; ?></p>

        <!-- Email -->
        <div class="mb-4">
          <label for="email" class="block text-sm font-medium text-[#0c0d08] mb-1">Email</label>
          <input type="email" id="email" name="email" required
            class="w-full px-4 py-2 border-0 border-b-2 border-[#ceed15] bg-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-[#ceed15] text-[#0c0d08]"
            placeholder="Entrer votre email">
        </div>

        <!-- Mot de passe -->
        <div class="mb-4">
          <label for="password" class="block text-sm font-medium text-[#0c0d08] mb-1">Mot de passe</label>
          <input type="password" id="password" name="password" required
            class="w-full px-4 py-2 border-0 border-b-2 border-[#ceed15] bg-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-[#ceed15] text-[#0c0d08]"
            placeholder="Entrer votre mot de passe">
        </div>

        <!-- Bouton de connexion -->
        <div class="mb-6">
          <button type="submit"
            class="w-full bg-[#ceed15] text-[#0c0d08] font-medium py-2 px-4 rounded-md hover:bg-[#b1caaa] transition">
            Se connecter
          </button>
        </div>

        <!-- Lien S'inscrire -->
        <p class="text-sm text-center text-[#0c0d08]">
          Pas encore de compte ?
          <a href="register.php" class="text-[#ceed15] hover:underline font-medium">S'inscrire</a>
        </p>
      </form>
    </div>
  </div>


  <!-- Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer -->
  <?php include "footer.php"; ?>
  <!-- Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer  Footer -->


</body>
<!-- Scripts JavaScript -->
<script src="js/menu_header.js"></script>

</html>