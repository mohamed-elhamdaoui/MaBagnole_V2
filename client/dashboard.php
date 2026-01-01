<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Compte - MaBagnole</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans">

    <nav class="bg-white border-b border-gray-200 px-6 py-4 flex justify-between items-center md:hidden">
        <span class="font-bold text-red-600 italic">MaBagnole</span>
        <button class="text-gray-500"><i class="fas fa-bars text-xl"></i></button>
    </nav>

    <div class="flex min-h-screen">
        
        <aside class="w-72 bg-white border-r border-gray-200 flex-shrink-0 hidden md:flex flex-col">
            <div class="p-8 text-center">
                <div class="w-24 h-24 bg-gradient-to-tr from-red-600 to-red-400 text-white rounded-3xl flex items-center justify-center mx-auto mb-4 text-3xl font-black shadow-lg shadow-red-100 rotate-3">
                    A
                </div>
                <h2 class="font-bold text-gray-900 text-xl">Ahmed Alami</h2>
                <span class="text-[10px] bg-gray-100 px-2 py-1 rounded-full uppercase font-bold text-gray-400">Client Premium</span>
            </div>
            
            <nav class="flex-1 px-6 space-y-1">
                <a href="#reservations" class="flex items-center p-4 text-gray-900 bg-gray-50 rounded-2xl font-bold border-l-4 border-red-600">
                    <i class="fas fa-calendar-check mr-4 text-red-600"></i> Mes Locations
                </a>
                <a href="#avis" class="flex items-center p-4 text-gray-500 hover:bg-gray-50 rounded-2xl transition">
                    <i class="fas fa-star mr-4"></i> Mes Avis
                </a>
                <a href="#settings" class="flex items-center p-4 text-gray-500 hover:bg-gray-50 rounded-2xl transition">
                    <i class="fas fa-user-circle mr-4"></i> Mon Profil
                </a>
            </nav>

            <div class="p-6 border-t border-gray-100">
                <a href="../auth/logout.php" class="flex items-center p-4 text-red-400 hover:text-red-600 transition font-semibold">
                    <i class="fas fa-power-off mr-4"></i> Déconnexion
                </a>
            </div>
        </aside>

        <main class="flex-1 p-6 md:p-12">
            
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12 gap-4">
                <div>
                    <h1 class="text-4xl font-black text-gray-900">Tableau de <span class="text-red-600 italic">Bord.</span></h1>
                    <p class="text-gray-400">Bienvenue dans votre espace personnel.</p>
                </div>
                <a href="../catalogue.php" class="bg-red-600 text-white px-8 py-4 rounded-2xl font-bold shadow-xl shadow-red-200 hover:bg-black transition-all">
                    Louer un véhicule
                </a>
            </div>

            <div class="mb-16">
                <h3 class="text-xl font-bold mb-6 flex items-center">
                    <span class="w-8 h-1 bg-red-600 mr-3 rounded-full"></span>
                    Réservations en cours & passées
                </h3>

                <div class="grid grid-cols-1 gap-6">
                    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 flex flex-col lg:flex-row gap-8 items-center transition hover:shadow-md">
                        <div class="w-full lg:w-48 h-32 bg-gray-100 rounded-2xl overflow-hidden">
                            <img src="https://via.placeholder.com/300x200" class="w-full h-full object-cover">
                        </div>
                        
                        <div class="flex-1 grid grid-cols-1 md:grid-cols-3 gap-6 w-full">
                            <div>
                                <p class="text-xs font-bold text-gray-300 uppercase mb-1">Véhicule</p>
                                <h4 class="font-bold text-lg text-gray-800">Tesla Model 3</h4>
                                <p class="text-sm text-gray-500 italic">Lieu : Aéroport Med V</p>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-gray-300 uppercase mb-1">Dates</p>
                                <p class="text-sm font-semibold text-gray-700">Du 12/01 au 15/01</p>
                                <p class="text-xs text-gray-400">Durée : 3 Jours</p>
                            </div>
                            <div class="flex flex-col items-start md:items-end justify-center">
                                <span class="px-4 py-1 bg-yellow-100 text-yellow-600 text-[10px] rounded-full font-black uppercase mb-2">En attente</span>
                                <p class="text-xl font-black text-gray-900">280€</p>
                            </div>
                        </div>

                        <div class="flex lg:flex-col gap-2 w-full lg:w-auto">
                            <button class="flex-1 bg-gray-50 text-gray-400 px-4 py-2 rounded-xl text-xs font-bold hover:bg-red-50 hover:text-red-500 transition">
                                Annuler
                            </button>
                            <button class="flex-1 bg-gray-900 text-white px-4 py-2 rounded-xl text-xs font-bold hover:bg-red-600 transition">
                                Facture
                            </button>
                        </div>
                    </div>
                    </div>
            </div>

            <div id="avis" class="pt-12 border-t border-gray-100">
                <h3 class="text-xl font-bold mb-8">Mes derniers avis</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    
                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                        <div class="flex justify-between items-start mb-6">
                            <div>
                                <h4 class="font-bold text-gray-900">Peugeot 208</h4>
                                <div class="flex text-yellow-400 text-[10px] mt-1">
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                </div>
                            </div>
                            <span class="text-[10px] text-gray-400 font-medium italic">Posté le 05/12</span>
                        </div>
                        <p class="text-gray-500 text-sm leading-relaxed mb-8">"Service impeccable, la voiture était comme neuve. Je recommande vivement !"</p>
                        
                        <div class="flex gap-4 border-t pt-6">
                            <button class="text-xs font-bold text-blue-600 hover:text-blue-800 transition flex items-center">
                                <i class="fas fa-pen-nib mr-2"></i> Modifier
                            </button>
                            <form action="delete_avis.php" method="POST">
                                <input type="hidden" name="avis_id" value="1">
                                <button type="submit" class="text-xs font-bold text-red-400 hover:text-red-600 transition flex items-center">
                                    <i class="fas fa-trash-alt mr-2"></i> Supprimer
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

        </main>
    </div>

</body>
</html>