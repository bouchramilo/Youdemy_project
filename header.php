<header class="bg-[#386641] text-white w-full">
    <div class="container mx-auto flex items-center justify-between p-4">
        <!-- Logo -->
        <a href="index.php"><h1 class="text-2xl font-bold">Youdemy</h1></a>

        <!-- Navigation Menu -->
        <nav class="flex items-center">
            <!-- Desktop Menu -->
            <ul class="hidden md:flex space-x-4">
                <li><a href="index.php" class="hover:text-[#f48c06]">Accueil</a></li>
                <li><a href="#" class="hover:text-[#f48c06]">Cours</a></li>
                <li><a href="#" class="hover:text-[#f48c06]">À propos</a></li>
                <li><a href="#" class="hover:text-[#f48c06]">Contact</a></li>
            </ul>

            <!-- Mobile Menu Button -->
            <button class="md:hidden focus:outline-none" id="menu-toggle">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </nav>

        <!-- Buttons -->
        <div class="hidden md:flex space-x-2">
            <a href="login.php" class="bg-[#ffba08] hover:bg-[#f48c06] transition-colors duration-300 text-white px-4 py-2 rounded">Se connecter</a>
            <a href="register.php" class="bg-[#ffba08] hover:bg-[#f48c06] transition-colors duration-300 text-white px-4 py-2 rounded">S'inscrire</a>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-[#84a98c]">
        <ul class="space-y-2 p-4">
            <li><a href="index.php" class="block text-white hover:text-[#f48c06]">Accueil</a></li>
            <li><a href="#" class="block text-white hover:text-[#f48c06]">Cours</a></li>
            <li><a href="#" class="block text-white hover:text-[#f48c06]">À propos</a></li>
            <li><a href="#" class="block text-white hover:text-[#f48c06]">Contact</a></li>
            <li><a href="login.php" class="block bg-[#ffba08] hover:bg-[#f48c06] text-white px-4 py-2 rounded text-center">Se connecter</a></li>
            <li><a href="register.php" class="block bg-[#ffba08] hover:bg-[#f48c06] text-white px-4 py-2 rounded text-center">S'inscrire</a></li>
        </ul>
    </div>
</header>

