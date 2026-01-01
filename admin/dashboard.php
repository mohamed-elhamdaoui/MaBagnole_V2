<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - MaBagnole</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans">

    <div class="flex min-h-screen">
        
        <aside class="w-64 bg-gray-900 text-white flex-shrink-0">
            <div class="p-6">
                <h1 class="text-2xl font-bold">Ma<span class="text-red-500">Bagnole</span> <span class="text-xs font-light text-gray-400">Admin</span></h1>
            </div>
            <nav class="mt-6">
                <a href="index.php" class="flex items-center py-3 px-6 bg-red-600 text-white">
                    <i class="fas fa-chart-line mr-3"></i> Dashboard
                </a>
                <a href="vehicules.php" class="flex items-center py-3 px-6 text-gray-400 hover:bg-gray-800 hover:text-white transition">
                    <i class="fas fa-car mr-3"></i> Véhicules
                </a>
                <a href="categories.php" class="flex items-center py-3 px-6 text-gray-400 hover:bg-gray-800 hover:text-white transition">
                    <i class="fas fa-tags mr-3"></i> Catégories
                </a>
                <a href="reservations.php" class="flex items-center py-3 px-6 text-gray-400 hover:bg-gray-800 hover:text-white transition">
                    <i class="fas fa-calendar-check mr-3"></i> Réservations
                </a>
                <a href="avis.php" class="flex items-center py-3 px-6 text-gray-400 hover:bg-gray-800 hover:text-white transition">
                    <i class="fas fa-star mr-3"></i> Avis
                </a>
                <div class="mt-10 px-6 border-t border-gray-800 pt-6">
                    <a href="../index.php" class="flex items-center text-sm text-gray-500 hover:text-white">
                        <i class="fas fa-arrow-left mr-2"></i> Voir le site
                    </a>
                </div>
            </nav>
        </aside>

        <main class="flex-1 p-10">
            <header class="flex justify-between items-center mb-10">
                <h2 class="text-3xl font-bold text-gray-800">Vue d'ensemble</h2>
                <div class="flex items-center space-x-4">
                    <span class="text-sm font-medium text-gray-600">Bienvenue, Admin</span>
                    <img src="https://ui-avatars.com/api/?name=Admin+User" class="w-10 h-10 rounded-full border-2 border-red-500">
                </div>
            </header>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-red-500">
                    <div class="flex items-center">
                        <div class="p-3 bg-red-100 rounded-full text-red-600 mr-4">
                            <i class="fas fa-car fa-lg"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Véhicules</p>
                            <h3 class="text-2xl font-bold">24</h3>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-blue-500">
                    <div class="flex items-center">
                        <div class="p-3 bg-blue-100 rounded-full text-blue-600 mr-4">
                            <i class="fas fa-calendar-alt fa-lg"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Réservations</p>
                            <h3 class="text-2xl font-bold">156</h3>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-green-500">
                    <div class="flex items-center">
                        <div class="p-3 bg-green-100 rounded-full text-green-600 mr-4">
                            <i class="fas fa-euro-sign fa-lg"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Chiffre d'Affaires</p>
                            <h3 class="text-2xl font-bold">8,450€</h3>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-yellow-500">
                    <div class="flex items-center">
                        <div class="p-3 bg-yellow-100 rounded-full text-yellow-600 mr-4">
                            <i class="fas fa-star fa-lg"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Note Moyenne</p>
                            <h3 class="text-2xl font-bold">4.8/5</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100">
                <div class="p-6 border-b border-gray-50 flex justify-between items-center">
                    <h3 class="font-bold text-gray-800 text-lg">Réservations Récentes</h3>
                    <a href="reservations.php" class="text-sm text-red-600 hover:underline">Tout voir</a>
                </div>
                <table class="w-full text-left">
                    <thead class="bg-gray-50 text-gray-500 text-xs uppercase font-semibold">
                        <tr>
                            <th class="px-6 py-4">Client</th>
                            <th class="px-6 py-4">Véhicule</th>
                            <th class="px-6 py-4">Date</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Montant</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm">
                        <tr>
                            <td class="px-6 py-4 font-medium text-gray-900">Ahmed Alami</td>
                            <td class="px-6 py-4 text-gray-600">Peugeot 208</td>
                            <td class="px-6 py-4 text-gray-600">12 Janv 2026</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-[10px] font-bold uppercase">Confirmée</span>
                            </td>
                            <td class="px-6 py-4 text-right font-bold text-gray-900">135€</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 font-medium text-gray-900">Sara Benali</td>
                            <td class="px-6 py-4 text-gray-600">Tesla Model 3</td>
                            <td class="px-6 py-4 text-gray-600">14 Janv 2026</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded-full text-[10px] font-bold uppercase">En attente</span>
                            </td>
                            <td class="px-6 py-4 text-right font-bold text-gray-900">280€</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </main>
    </div>

</body>
</html>