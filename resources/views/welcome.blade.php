<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestion Contacts</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gradient-to-br from-gray-50 to-gray-100">
    <div class="min-h-screen flex flex-col">
        <!-- Navigation -->
        <nav class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <h1 class="text-2xl font-bold text-gray-900">Gestion Contacts</h1>
                    <div class="flex items-center gap-3">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-5 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 transition-colors">
                                Tableau de bord
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="px-5 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 transition-colors">
                                Connexion
                            </a>
                            <a href="{{ route('register') }}" class="px-5 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition-colors shadow-sm">
                                Inscription
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="flex-1 flex items-center justify-center px-4 py-12">
            <div class="w-full max-w-4xl">
                <div class="bg-white rounded-2xl shadow-xl p-8 sm:p-12 md:p-16">
                    <div class="text-center">
                        <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                            Bienvenue sur Gestion Contacts
                        </h2>
                        <p class="text-base sm:text-lg text-gray-600 mb-10 max-w-2xl mx-auto leading-relaxed">
                            Application web sécurisée pour organiser et gérer vos contacts professionnels et personnels. 
                            Créez des groupes, recherchez rapidement et gardez toutes vos informations à portée de main.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                            <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-3.5 text-base font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-all hover:shadow-lg">
                                S'inscrire en quelques clics
                            </a>
                            <a href="{{ route('login') }}" class="w-full sm:w-auto px-8 py-3.5 text-base font-semibold text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-all">
                                Se connecter
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Features Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                    <div class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition-shadow">
                        <div class="text-blue-600 text-3xl mb-3">✓</div>
                        <h3 class="font-semibold text-gray-900 mb-2">Gestion complète</h3>
                        <p class="text-sm text-gray-600">Créez et gérez vos contacts facilement</p>
                    </div>
                    <div class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition-shadow">
                        <div class="text-blue-600 text-3xl mb-3">◈</div>
                        <h3 class="font-semibold text-gray-900 mb-2">Organisation par groupes</h3>
                        <p class="text-sm text-gray-600">Classez vos contacts par catégories</p>
                    </div>
                    <div class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition-shadow">
                        <div class="text-blue-600 text-3xl mb-3">⚡</div>
                        <h3 class="font-semibold text-gray-900 mb-2">Recherche rapide</h3>
                        <p class="text-sm text-gray-600">Trouvez vos contacts instantanément</p>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t border-gray-200 py-6 mt-auto">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <p class="text-gray-600 text-sm">
                    
                </p>
                <p class="text-gray-500 text-xs mt-2">
                    &copy; 
                </p>
            </div>
        </footer>
    </div>
</body>
</html>
